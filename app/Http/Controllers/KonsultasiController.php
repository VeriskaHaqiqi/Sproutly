<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\AhliBotani;
use App\Models\TarifAhli;
use App\Models\Pembayaran;
use App\Models\Konsultasi;
use App\Models\Pesan;
use App\Models\Rating;

class KonsultasiController extends Controller
{
    // Web: Find Experts
    public function findExperts(Request $request)
    {
        $experts = AhliBotani::with('user')->get();

        foreach ($experts as $expert) {
            $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
                ->where('status_aktif', 'aktif')
                ->first();
            $expert->active_tarif = $activeTarif ? (int)$activeTarif->tarif : 45000;
        }

        return view('find-experts', compact('experts'));
    }

    // Web: Info Ahli
    public function infoAhli(Request $request)
    {
        $expertId = $request->query('id');
        if ($expertId) {
            $expert = AhliBotani::with('user')->findOrFail($expertId);
        } else {
            $expert = AhliBotani::with('user')->first();
            if (!$expert) {
                return redirect()->route('homeUser')->with('error', 'No experts available.');
            }
        }

        $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
        $expert->active_tarif = $activeTarif ? (int)$activeTarif->tarif : 45000;

        return view('infoahli', compact('expert'));
    }

    // Web: Lock Room User (Pre-payment screen)
    public function lockRoomUser(Request $request)
    {
        $expertId = $request->query('expert_id');
        if (!$expertId) {
            $expert = AhliBotani::with('user')->first();
        } else {
            $expert = AhliBotani::with('user')->find($expertId);
        }

        if (!$expert) {
            return redirect()->route('find-experts')->with('error', 'Expert not found.');
        }

        $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();
        $expert->active_tarif = $activeTarif ? (int)$activeTarif->tarif : 45000;

        return view('lockRoomUser', compact('expert'));
    }

    // Web: Book consultation
    public function book(Request $request, $expert_id)
    {
        $expert = AhliBotani::findOrFail($expert_id);
        $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();

        $price = $activeTarif ? $activeTarif->tarif : 45000;

        // 1. Create pembayaran record
        $pembayaran = Pembayaran::create([
            'user_id' => Auth::id(),
            'jumlah' => $price,
            'metode' => 'Bank Transfer',
            'status_pembayaran' => 'pending',
        ]);

        // 2. Create konsultasi record
        $konsultasi = Konsultasi::create([
            'user_id' => Auth::id(),
            'ahli_botani_id' => $expert->id,
            'pembayaran_id' => $pembayaran->id,
            'tarif_ahli_id' => $activeTarif ? $activeTarif->id : null,
            'status_konsultasi' => 'pending',
            'topik' => $request->query('topic', 'General Consultation'),
        ]);

        return redirect()->route('paymentUser', ['id' => $konsultasi->id]);
    }

    // Web: Payment Page
    public function paymentUser(Request $request)
    {
        $id = $request->query('id');
        if ($id) {
            $konsultasi = Konsultasi::with(['ahliBotani.user', 'pembayaran'])->findOrFail($id);
        } else {
            // Fallback to latest pending consultation
            $konsultasi = Konsultasi::with(['ahliBotani.user', 'pembayaran'])
                ->where('user_id', Auth::id())
                ->where('status_konsultasi', 'pending')
                ->latest()
                ->first();

            if (!$konsultasi) {
                return redirect()->route('find-experts')->with('info', 'Please select an expert to start consultation.');
            }
        }

        $expert = $konsultasi->ahliBotani;
        $pembayaran = $konsultasi->pembayaran;

        return view('paymentUser', compact('konsultasi', 'expert', 'pembayaran'));
    }

    // Web: Submit proof of payment
    public function submitPayment(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $pembayaran = Pembayaran::findOrFail($konsultasi->pembayaran_id);

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('bukti-transfer', 'public');
            $pembayaran->bukti_transfer = $path;
            $pembayaran->status_pembayaran = 'success'; // Auto-verify for seamless flow
            $pembayaran->tgl_pembayaran = now();
            $pembayaran->save();

            // Set consultation status to aktif
            $konsultasi->status_konsultasi = 'aktif';
            $konsultasi->tanggal_mulai = now();
            $konsultasi->save();

            // Seed initial greeting message from the expert
            Pesan::create([
                'konsultasi_id' => $konsultasi->id,
                'pengirim' => 'ahli',
                'isi_pesan' => "Hello! I am " . $konsultasi->ahliBotani->nama_ahli . ". How can I help you and your plants today?",
                'waktu_kirim' => now()
            ]);
        }

        return redirect()->route('paymentVerified', ['id' => $konsultasi->id]);
    }

    // Web: Payment Verified success screen
    public function paymentVerified(Request $request)
    {
        $id = $request->query('id');
        $konsultasi = Konsultasi::with('ahliBotani')->findOrFail($id);
        $clientName = Auth::user()->nama_user;
        $sessionId = 'sess_' . $konsultasi->id;

        return view('paymentVerified', compact('konsultasi', 'clientName', 'sessionId'));
    }

    // Web: User Chat Room
    public function roomChatUser(Request $request)
    {
        $id = $request->query('id');
        if (!$id) {
            // Fallback to latest active consultation
            $konsultasi = Konsultasi::where('user_id', Auth::id())
                ->where('status_konsultasi', 'aktif')
                ->latest()
                ->first();

            if (!$konsultasi) {
                return redirect()->route('consultationUser')->with('info', 'No active consultations.');
            }
        } else {
            $konsultasi = Konsultasi::findOrFail($id);
        }

        // Security check
        if ($konsultasi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this chat room.');
        }

        // If ended, redirect to ended room
        if ($konsultasi->status_konsultasi === 'selesai') {
            return redirect()->route('endedRoomUser', ['id' => $konsultasi->id]);
        }

        $expert = $konsultasi->ahliBotani;
        
        // Fetch recent chat lists for the sidebar
        $activeChats = Konsultasi::with('ahliBotani')
            ->where('user_id', Auth::id())
            ->whereIn('status_konsultasi', ['aktif', 'pending'])
            ->get();

        return view('roomChatUser', compact('konsultasi', 'expert', 'activeChats'));
    }

    // Web: Expert Chat Room
    public function roomChatExpert(Request $request)
    {
        $id = $request->query('id');
        $expert = Auth::user()->ahliBotani;

        if (!$expert) {
            abort(403, 'Only botanists can access the expert chat room.');
        }

        if (!$id) {
            // Fallback to latest active consultation
            $konsultasi = Konsultasi::where('ahli_botani_id', $expert->id)
                ->where('status_konsultasi', 'aktif')
                ->latest()
                ->first();

            if (!$konsultasi) {
                return redirect()->route('consultexpert')->with('info', 'No active consultations.');
            }
        } else {
            $konsultasi = Konsultasi::findOrFail($id);
        }

        // Security check
        if ($konsultasi->ahli_botani_id !== $expert->id) {
            abort(403, 'Unauthorized access to this chat room.');
        }

        $client = $konsultasi->user;

        // Fetch recent active chats for the expert sidebar
        $activeChats = Konsultasi::with('user')
            ->where('ahli_botani_id', $expert->id)
            ->where('status_konsultasi', 'aktif')
            ->get();

        return view('roomChatExpert', compact('konsultasi', 'client', 'activeChats'));
    }

    // API: Fetch messages for a consultation
    public function getMessages($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        // Security check
        $user = Auth::user();
        if ($user->role === 'user' && $konsultasi->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'ahli' && $konsultasi->ahli_botani_id !== $user->ahliBotani->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Pesan::where('konsultasi_id', $id)
            ->orderBy('waktu_kirim', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'status' => $konsultasi->status_konsultasi,
            'messages' => $messages->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'from' => $msg->pengirim,
                    'text' => $msg->isi_pesan,
                    'type' => $msg->gambar ? (preg_match('/\.(mp4|webm|ogg|mov)$/i', $msg->gambar) ? 'video' : 'image') : 'text',
                    'src' => $msg->gambar ? asset('storage/' . $msg->gambar) : null,
                    'time' => $msg->waktu_kirim->format('h:i A'),
                ];
            })
        ]);
    }

    // API: Send message
    public function sendMessage(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->status_konsultasi === 'selesai') {
            return response()->json(['success' => false, 'message' => 'Consultation has ended.'], 400);
        }

        $user = Auth::user();
        $pengirim = $user->role === 'ahli' ? 'ahli' : 'user';

        // Security check
        if ($user->role === 'user' && $konsultasi->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'ahli' && $konsultasi->ahli_botani_id !== $user->ahliBotani->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'text' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB limit
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat-attachments', 'public');
        }

        $message = Pesan::create([
            'konsultasi_id' => $konsultasi->id,
            'pengirim' => $pengirim,
            'isi_pesan' => $request->input('text'),
            'gambar' => $filePath,
            'waktu_kirim' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'from' => $message->pengirim,
                'text' => $message->isi_pesan,
                'type' => $message->gambar ? (preg_match('/\.(mp4|webm|ogg|mov)$/i', $message->gambar) ? 'video' : 'image') : 'text',
                'src' => $message->gambar ? asset('storage/' . $message->gambar) : null,
                'time' => $message->waktu_kirim->format('h:i A'),
            ]
        ]);
    }

    // Web / API: End Consultation
    public function endChat($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->status_konsultasi = 'selesai';
        $konsultasi->tanggal_selesai = now();
        $konsultasi->save();

        Pesan::create([
            'konsultasi_id' => $konsultasi->id,
            'pengirim' => 'ahli',
            'isi_pesan' => 'System: Consultation has been ended by the expert.',
            'waktu_kirim' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultation ended successfully.'
        ]);
    }

    // Web: Ended Room User (Feedback/Rating)
    public function endedRoomUser(Request $request)
    {
        $id = $request->query('id');
        $konsultasi = Konsultasi::with(['ahliBotani.user', 'pesan'])->findOrFail($id);

        if ($konsultasi->user_id !== Auth::id()) {
            abort(403);
        }

        return view('endedRoomUser', compact('konsultasi'));
    }

    // Web: Submit Review & Rating
    public function submitReview(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'ahli_botani_id' => $konsultasi->ahli_botani_id,
            'konsultasi_id' => $konsultasi->id,
            'nilai' => $validated['rating'],
            'ulasan' => $validated['comment'] ?? '',
            'tanggal' => now(),
        ]);

        return redirect()->route('consultationUser')->with('success', 'Thank you for your feedback!');
    }

    // Web: Consultation History (User)
    public function consultationUser(Request $request)
    {
        $consultations = Konsultasi::with(['ahliBotani.user', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('consultationUser', compact('consultations'));
    }

    // Web: Consultation History (Expert)
    public function consultexpert(Request $request)
    {
        $expert = Auth::user()->ahliBotani;
        if (!$expert) {
            abort(403);
        }

        $consultations = Konsultasi::with(['user', 'pembayaran'])
            ->where('ahli_botani_id', $expert->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('consulexpert', compact('consultations', 'expert'));
    }
}