<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected to login page', function () {
    $this->get('/dashboard')
        ->assertRedirect('/login');
});

test('authenticated users can visit dashboard', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/dashboard')
        ->assertOk();
});
