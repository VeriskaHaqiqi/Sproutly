<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AhliBotani;
use App\Models\Artikel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArtikelTest extends TestCase
{
    use RefreshDatabase;

    // === USER ARTICLE TESTS ===

    public function test_user_can_view_articles_catalog()
    {
        $user = User::factory()->create(['role' => 'user']);
        $expertUser = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $expertUser->id,
            'nama_ahli' => $expertUser->nama_user,
        ]);

        $article = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Test Article 1',
            'konten' => 'This is content for test article.',
            'kategori' => 'Horticulture',
            'tanggal_unggah' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('daftarArtikel'));

        $response->assertStatus(200);
        $response->assertSee('Test Article 1');
    }

    public function test_user_can_view_article_details()
    {
        $user = User::factory()->create(['role' => 'user']);
        $expertUser = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $expertUser->id,
            'nama_ahli' => $expertUser->nama_user,
        ]);

        $article = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Detail Article Test',
            'konten' => "Line 1\n# Heading 1\nLine 2\n> A quote\nLine 3",
            'kategori' => 'Urban Planning',
            'tanggal_unggah' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('detailArtikelUser', ['id' => $article->id]));

        $response->assertStatus(200);
        $response->assertSee('Detail Article Test');
        $response->assertSee('Heading 1');
        $response->assertSee('A quote');
    }

    public function test_user_can_toggle_bookmark()
    {
        $user = User::factory()->create(['role' => 'user']);
        $expertUser = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $expertUser->id,
            'nama_ahli' => $expertUser->nama_user,
        ]);

        $article = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Bookmark Toggle Test',
            'konten' => 'Some content.',
            'kategori' => 'Soil Health',
            'tanggal_unggah' => now(),
        ]);

        // Toggle Bookmark ON
        $response = $this->actingAs($user)->postJson(route('bookmark.toggle', ['id' => $article->id]));
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'bookmark_status' => 'bookmarked'
        ]);
        $this->assertTrue($user->bookmarkedArticles()->where('artikel_id', $article->id)->exists());

        // Toggle Bookmark OFF
        $response = $this->actingAs($user)->postJson(route('bookmark.toggle', ['id' => $article->id]));
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'bookmark_status' => 'unbookmarked'
        ]);
        $this->assertFalse($user->bookmarkedArticles()->where('artikel_id', $article->id)->exists());
    }

    public function test_user_can_view_bookmarked_articles()
    {
        $user = User::factory()->create(['role' => 'user']);
        $expertUser = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $expertUser->id,
            'nama_ahli' => $expertUser->nama_user,
        ]);

        $article = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Saved Article Title',
            'konten' => 'Content for saved article.',
            'kategori' => 'IoT & Sensors',
            'tanggal_unggah' => now(),
        ]);

        $user->bookmarkedArticles()->attach($article->id);

        $response = $this->actingAs($user)->get(route('bookmarkArtikelUser'));

        $response->assertStatus(200);
        $response->assertSee('Saved Article Title');
    }

    // === EXPERT ARTICLE TESTS ===

    public function test_expert_can_view_their_articles()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $article = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'My Expert Article 1',
            'konten' => 'Content of expert article.',
            'kategori' => 'Education',
            'tanggal_unggah' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('myarticleExpert'));

        $response->assertStatus(200);
        $response->assertSee('My Expert Article 1');
    }

    public function test_expert_can_publish_article()
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $file = UploadedFile::fake()->image('thumbnail.jpg');

        $response = $this->actingAs($user)->postJson(route('tulisartikelExpert.store'), [
            'judul' => 'New Expert Insight',
            'konten' => 'Content for published article by expert.',
            'kategori' => 'Organic Care',
            'thumbnail' => $file,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'judul',
                'konten',
                'kategori',
                'thumbnail',
            ]
        ]);

        $this->assertDatabaseHas('artikel', [
            'ahli_botani_id' => $expert->id,
            'judul' => 'New Expert Insight',
            'kategori' => 'Organic Care',
        ]);

        $art = Artikel::where('judul', 'New Expert Insight')->first();
        $this->assertNotNull($art->thumbnail);
        Storage::disk('public')->assertExists($art->thumbnail);
    }

    public function test_expert_can_delete_articles()
    {
        $user = User::factory()->create(['role' => 'ahli']);
        $expert = AhliBotani::create([
            'user_id' => $user->id,
            'nama_ahli' => $user->nama_user,
        ]);

        $article1 = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Delete Me 1',
            'konten' => 'Short content.',
            'kategori' => 'General',
            'tanggal_unggah' => now(),
        ]);

        $article2 = Artikel::create([
            'ahli_botani_id' => $expert->id,
            'judul' => 'Delete Me 2',
            'konten' => 'Short content 2.',
            'kategori' => 'General',
            'tanggal_unggah' => now(),
        ]);

        $response = $this->actingAs($user)->postJson(route('myarticleExpert.delete'), [
            'ids' => [$article1->id, $article2->id]
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Articles deleted successfully']);

        $this->assertDatabaseMissing('artikel', ['id' => $article1->id]);
        $this->assertDatabaseMissing('artikel', ['id' => $article2->id]);
    }
}
