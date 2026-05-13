<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_can_store_message(): void
    {
        $response = $this->post('/hubungi-kami', [
            'name' => 'Thomas Andrianto',
            'email' => 'admin@gmail.com',
            'phone' => '08123456789',
            'message' => 'Halo, saya ingin bertanya tentang pendaftaran.',
        ]);

        $response
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('messages', [
            'name' => 'Thomas Andrianto',
            'email' => 'admin@gmail.com',
            'is_read' => false,
        ]);
    }

    public function test_contact_form_validation_fails_when_required_fields_are_missing(): void
    {
        $response = $this->post('/hubungi-kami', []);

        $response
            ->assertSessionHasErrors([
                'name',
                'email',
                'message',
            ]);
    }
}