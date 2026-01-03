<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected to login page', function () {
    $this->get('/profile')
        ->assertRedirect('/login');
});

test('authenticated users can visit dashboard', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/profile')
        ->assertOk();
});
