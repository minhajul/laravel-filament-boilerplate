<?php

namespace Tests\Unit;

it('returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200);
});
