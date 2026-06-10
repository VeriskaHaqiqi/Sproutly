<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AhliBotani; 
class ahlibotani_controller extends Controller
{
    public function index()
    {
        $ahli = AhliBotani::all();
        return view('ahli_botani.index', compact('ahli'));
    }

    public function create()
    {
        return view('ahli_botani.create');
    }

    public function store(Request $request)
    {
        AhliBotani::create($request->all());

        return redirect()->route('ahli_botani.index');
    }

    public function edit(AhliBotani $ahli_botani)
    {
        return view('ahli_botani.edit', compact('ahli_botani'));
    }

    public function update(Request $request, AhliBotani $ahli_botani)
    {
        $ahli_botani->update($request->all());

        return redirect()->route('ahli_botani.index');
    }

    public function destroy(AhliBotani $ahli_botani)
    {
        $ahli_botani->delete();

        return redirect()->route('ahli_botani.index');
    }
}
