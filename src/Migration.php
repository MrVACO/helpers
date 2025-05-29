<?php

declare(strict_types = 1);

namespace MrVaco\Helpers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class Migration
{
    /**
     * Returns existing migration file if found, else uses the current timestamp.
     * Возвращает существующий файл миграции, если он найден, в противном случае используется текущая временная метка.
     */
    public static function get(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = app()->make(Filesystem::class);

        return Collection::make([database_path('migrations')])
            ->flatMap(fn ($path) => $filesystem->glob($path . '*_' . $migrationFileName))
            ->push(database_path("migrations/{$timestamp}_$migrationFileName}"))
            ->first();
    }
}
