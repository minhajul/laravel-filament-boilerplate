<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

it('returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200);
});
