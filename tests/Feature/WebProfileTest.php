<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AhliBotani;
use App\Models\TarifAhli;
use App\Models\JadwalAhli;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebProfileTest extends TestCase
{
    use RefreshDatabase;

    // === USER TESTS ===

    public function test_unauthenticated_user_cannot_access_profile_routes()
    {
        $this->get(route('accountUser'))->assertRedirect(route('login'));
        $this->get(route('editProfileUser'))->assertRedirect(route('login'));
    }

    public function test_user_can_view_account_page()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('accountUser'));

        $response->assertStatus(200);
        $response->assertSee($user->nama_user);
        $response->assertSee($user->email);
    }

    public function test_user_can_view_edit_profile_page()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('editProfileUser'));

        $response->assertStatus(200);
    }

    public function test_user_can_update_profile()
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'user']);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'full_name' => 'New User Name',
            'email' => 'newemail@example.com',
            'phone' => '08123456789',
            'gender' => 'male',
            'photo' => $file,
        ]);

        $response->assertRedirect(route('accountUser'));
        
        $user->refresh();
        $this->assertEquals('New User Name', $user->nama_user);
        $this->assertEquals('newemail@example.com', $user->email);
        $this->assertEquals('L', $user->jenis_kelamin_user);
        $this->assertNotNull($user->profile_picture);
        Storage::disk('public')->assertExists($user->profile_picture);
    }

    // === EXPERT TESTS ===

    public function test_expert_can_view_account_page()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
            'domisili' => 'Malang',
            'nama_almamater' => 'Brawijaya University',
        ]);

        $response = $this->actingAs($user)->get(route('accountExpert'));

        $response->assertStatus(200);
        $response->assertSee($expert->nama_ahli);
        $response->assertSee('Malang');
        $response->assertSee('Brawijaya University');
    }

    public function test_expert_can_view_edit_profile_page()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $response = $this->actingAs($user)->get(route('editProfileExpert'));

        $response->assertStatus(200);
    }

    public function test_expert_can_update_profile()
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->put(route('expert.profile.update'), [
            'full_name' => 'New Expert Name',
            'email' => 'newexpert@example.com',
            'phone' => '0877777777',
            'gender' => 'female',
            'domisili' => 'Surabaya',
            'nama_almamater' => 'Airlangga University',
            'photo' => $file,
        ]);

        $response->assertRedirect(route('accountExpert'));

        $user->refresh();
        $expert->refresh();

        $this->assertEquals('New Expert Name', $user->nama_user);
        $this->assertEquals('newexpert@example.com', $user->email);
        $this->assertEquals('New Expert Name', $expert->nama_ahli);
        $this->assertEquals('P', $expert->jenis_kelamin_ahli);
        $this->assertEquals('Surabaya', $expert->domisili);
        $this->assertEquals('Airlangga University', $expert->nama_almamater);
    }

    public function test_expert_can_view_pricing_page()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $tarif = TarifAhli::create([
            'ahli_botani_id' => $expert->id,
            'tarif' => 50000,
            'status_aktif' => 'aktif',
            'tgl_mulai_berlaku' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('setpricingexpert'));

        $response->assertStatus(200);
        $response->assertSee('50,000');
    }

    public function test_expert_can_update_pricing()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $response = $this->actingAs($user)->postJson(route('expert.pricing.update'), [
            'tarif' => 75000,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $activeTarif = TarifAhli::where('ahli_botani_id', $expert->id)
            ->where('status_aktif', 'aktif')
            ->first();

        $this->assertNotNull($activeTarif);
        $this->assertEquals(75000, $activeTarif->tarif);
    }

    public function test_expert_can_view_schedule_page()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        JadwalAhli::create([
            'ahli_botani_id' => $expert->id,
            'hari' => 'monday',
            'jam_mulai' => '09:00',
            'jam_selesai' => '12:00',
            'status_ketersediaan' => 'tersedia',
        ]);

        $response = $this->actingAs($user)->get(route('manageSchedule'));

        $response->assertStatus(200);
        $response->assertSee('09:00');
        $response->assertSee('12:00');
    }

    public function test_expert_can_save_schedule()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $response = $this->actingAs($user)->post(route('expert.schedule.save'), [
            'days' => [
                'monday' => [
                    'active' => '1',
                    'slots' => [
                        [
                            'start' => '08:00',
                            'end' => '11:00',
                        ]
                    ]
                ]
            ]
        ]);

        $response->assertRedirect(route('manageSchedule'));

        $schedules = JadwalAhli::where('ahli_botani_id', $expert->id)->get();
        $this->assertCount(1, $schedules);
        $this->assertEquals('monday', $schedules->first()->hari);
        $this->assertStringContainsString('08:00', $schedules->first()->jam_mulai);
        $this->assertStringContainsString('11:00', $schedules->first()->jam_selesai);
    }
}
