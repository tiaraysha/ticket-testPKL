<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = ['Website A', 'Mobile App B'];

        foreach ($projects as $project) {
            Project::create([
                'id' => Str::uuid(),
                'name' => $project
            ]);
        }
    }
}

