<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Insiden', 'Perubahan Permintaan', 'Penugasan'];

        foreach ($types as $type) {
            TicketType::create([
                'id' => Str::uuid(),
                'name' => $type
            ]);
        }
    }
}

