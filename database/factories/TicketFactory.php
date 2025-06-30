<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'ticket_type_id' => TicketType::inRandomOrder()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id,
            'assign_at' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
            'status' => 'open',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
