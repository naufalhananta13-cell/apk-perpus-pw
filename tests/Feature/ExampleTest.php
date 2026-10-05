<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pastikan pengunjung tanpa login dialihkan ke halaman login saat membuka data buku.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/buku');

        $response->assertRedirect('/login');
    }

    /**
     * Pastikan admin yang sudah login dapat mengakses halaman data buku.
     */
    public function test_authenticated_admin_can_access_buku(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/buku');

        $response->assertStatus(200);
    }

    /**
     * Pastikan fitur pencarian buku berdasarkan judul atau pengarang berfungsi.
     */
    public function test_buku_search_by_title_and_author(): void
    {
        $user = User::factory()->create();

        Buku::create([
            'kode_buku' => 'BK01',
            'judul' => 'Pemrograman Laravel Modern',
            'pengarang' => 'Taylor Otwell',
            'penerbit' => 'Informatika',
            'tahun_terbit' => 2024,
            'stok' => 10,
        ]);

        Buku::create([
            'kode_buku' => 'BK02',
            'judul' => 'Algoritma dan Struktur Data',
            'pengarang' => 'Donald Knuth',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2023,
            'stok' => 5,
        ]);

        // Cari berdasarkan judul 'Laravel'
        $responseTitle = $this->actingAs($user)->get('/buku?search=Laravel');
        $responseTitle->assertStatus(200);
        $responseTitle->assertSee('Pemrograman Laravel Modern');
        $responseTitle->assertDontSee('Algoritma dan Struktur Data');

        // Cari berdasarkan pengarang 'Donald Knuth'
        $responseAuthor = $this->actingAs($user)->get('/buku?search=Knuth');
        $responseAuthor->assertStatus(200);
        $responseAuthor->assertSee('Algoritma dan Struktur Data');
        $responseAuthor->assertDontSee('Pemrograman Laravel Modern');
    }
}
