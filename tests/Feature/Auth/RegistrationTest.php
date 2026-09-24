<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Models\Merchant;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '01700000000',
            'country' => 'Bangladesh',
            'district' => 'Dhaka',
            'delivery_address' => 'Test delivery address',
            'nid_number' => '1234567890',
            'nid_front' => UploadedFile::fake()->image('nid-front.jpg'),
            'nid_back' => UploadedFile::fake()->image('nid-back.jpg'),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('merchant.index', absolute: false));
        $this->assertDatabaseHas('merchants', [
            'email' => 'test@example.com',
            'nid_number' => '1234567890',
        ]);
    }
}
