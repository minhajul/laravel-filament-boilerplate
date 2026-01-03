<?php

declare(strict_types=1);

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;
}
