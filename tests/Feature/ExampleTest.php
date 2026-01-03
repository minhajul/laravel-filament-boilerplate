<?php

declare(strict_types=1);

namespace Tests\Feature;

it('returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200);
});
