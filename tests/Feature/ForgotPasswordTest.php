<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_page_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
        $response->assertSee('Reset Password');
    }

    public function test_forgot_password_fails_if_email_does_not_exist(): void
    {
        $response = $this->post('/forgot-password', [
            'email' => 'unregistered@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertInvalid(['email' => 'Alamat email tidak terdaftar di sistem.']);
    }

    public function test_forgot_password_fails_if_password_confirmation_does_not_match(): void
    {
        $response = $this->post('/forgot-password', [
            'email' => 'any@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_forgot_password_successfully_updates_user_password(): void
    {
        $user = User::factory()->create([
            'email' => 'student@pilarabdi.id',
            'password' => Hash::make('oldpassword'),
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'student@pilarabdi.id',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Password berhasil diubah. Silakan login menggunakan password baru Anda.');

        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    public function test_forgot_password_successfully_updates_guru_password(): void
    {
        $guru = Guru::create([
            'nama' => 'Guru Test',
            'spesialisasi' => 'TIU',
            'email' => 'guru@pilarabdi.id',
            'password' => Hash::make('oldpassword'),
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'guru@pilarabdi.id',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Password berhasil diubah. Silakan login menggunakan password baru Anda.');

        $guru->refresh();
        $this->assertTrue(Hash::check('newpassword123', $guru->password));
    }
}
