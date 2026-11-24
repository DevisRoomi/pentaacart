<?php

namespace Tests\Feature;

use App\Models\Merchant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Satu Hub QRIS Mahasiswa IDN');
    }

    public function test_landing_page_displays_qris_cards_search_and_active_wa_chat_even_when_closed(): void
    {
        $owner = User::factory()->create(['name' => 'Bang Devis']);
        Merchant::create([
            'user_id' => $owner->id,
            'name' => 'Dimsum Asrama',
            'slug' => 'dimsum-asrama',
            'phone' => '6281234567890',
            'qris_image' => 'qris-images/demo-dimsum-corner-idn.svg',
            'keywords' => 'dimsum, makanan, umar',
            'is_open' => false,
            'schedule' => [['start' => '00:00', 'end' => '00:01']],
        ]);

        $res = $this->get('/?q=dimsum');
        $res->assertStatus(200);
        $res->assertSee('Dimsum Asrama');
        $res->assertSee('Scan QRIS');
        $res->assertSee('Chat WA');
        $res->assertSee('https://wa.me/6281234567890');
    }

    public function test_landing_page_displays_merchant_products_and_prices(): void
    {
        $user = User::factory()->create();

        $merchant = Merchant::create([
            'user_id' => $user->id,
            'name' => 'Gorio Rio Asrama',
            'slug' => 'gorio-rio-asrama',
            'phone' => '6281455147800',
            'is_open' => true,
            'schedule' => null,
        ]);

        $merchant->products()->create([
            'name' => 'Gorio Rio Es',
            'price' => 1500,
            'is_available' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Gorio Rio Asrama');
        $response->assertSee('Gorio Rio Es');
        $response->assertSee('Rp 1.500');
    }

    public function test_landing_page_displays_product_description(): void
    {
        $user = User::factory()->create();

        $merchant = Merchant::create([
            'user_id' => $user->id,
            'name' => 'Mie Arya Asrama',
            'slug' => 'mie-arya-asrama',
            'phone' => '6282288705542',
            'is_open' => true,
            'schedule' => null,
        ]);

        $merchant->products()->create([
            'name' => 'Jasa Masak',
            'price' => 2000,
            'description' => 'jasa masak (bawa mie sendiri)',
            'is_available' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Mie Arya Asrama');
        $response->assertSee('Jasa Masak');
        $response->assertSee('jasa masak (bawa mie sendiri)');
    }
}
