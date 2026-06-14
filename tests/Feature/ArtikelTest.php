<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\AhliBotani;
use App\Models\Artikel;
use Database\Seeders\SproutlySeeder;

class ArtikelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the database for each test to have realistic data
        $this->seed(SproutlySeeder::class);
    }

    /**
     * Test that guest/unauthenticated users are redirected to login.
     */
    public function test_routes_redirect_unauthenticated_users(): void
    {
        $protectedGetRoutes = [
            '/daftarArtikel',
            '/detailArtikelUser',
            '/bookmarkArtikelUser',
            '/articleExpert',
            '/myarticleExpert',
            '/tulisartikelExpert',
        ];

        foreach ($protectedGetRoutes as $route) {
            $response = $this->get($route);
            $response->assertRedirect('/login');
        }
    }

    /**
     * Test that authenticated users can see article lists, details, and bookmarks.
     */
    public function test_user_can_access_article_routes(): void
    {
        $user = User::where('role', 'user')->firstOrFail();
        $artikel = Artikel::firstOrFail();

        // 1. Check article list
        $response = $this->actingAs($user)->get('/daftarArtikel');
        $response->assertStatus(200);
        $response->assertSee($artikel->judul);

        // 2. Check article detail
        $response = $this->actingAs($user)->get("/detailArtikelUser?id={$artikel->id}");
        $response->assertStatus(200);
        $response->assertSee($artikel->judul);

        // 3. Check bookmark page
        $response = $this->actingAs($user)->get('/bookmarkArtikelUser');
        $response->assertStatus(200);
        $response->assertSee($artikel->judul);
    }

    /**
     * Test that authenticated experts can access expert dashboard routes.
     */
    public function test_expert_can_access_expert_article_routes(): void
    {
        $expertUser = User::where('role', 'ahli')->firstOrFail();
        $artikel = Artikel::firstOrFail();

        // 1. Check expert dashboard articles list
        $response = $this->actingAs($expertUser)->get('/articleExpert');
        $response->assertStatus(200);
        $response->assertSee($artikel->judul);

        // 2. Check my article list
        $response = $this->actingAs($expertUser)->get('/myarticleExpert');
        $response->assertStatus(200);

        // 3. Check write article page
        $response = $this->actingAs($expertUser)->get('/tulisartikelExpert');
        $response->assertStatus(200);
    }

    /**
     * Test that experts can successfully write and publish a new article.
     */
    public function test_expert_can_publish_article(): void
    {
        $expertUser = User::where('role', 'ahli')->firstOrFail();
        
        $articleData = [
            'judul' => 'New Agronomy Techniques in 2026',
            'kategori' => 'Agronomy',
            'konten' => '<p>These are the latest agronomy techniques that help save water and maximize soil nutrients.</p>',
        ];

        $response = $this->actingAs($expertUser)->post('/tulisartikelExpert', $articleData);

        // Check response (redirect to /myarticleExpert or similar)
        $response->assertRedirect('/myarticleExpert');

        // Check database persistence
        $this->assertDatabaseHas('artikel', [
            'judul' => 'New Agronomy Techniques in 2026',
            'kategori' => 'Agronomy',
        ]);
    }
}
