<?php

namespace Database\Factories;

use App\Models\Fase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => 1,
            'email_copy' => 'teste@teste.com',
            'outside_requester' => 'Tester Silva',
            'type' => 'E',
            'title' => 'Teste de Bug',
            'description' => 'Descrição do Bug',
            'direction_id' => 1,
            'screen_id' => 1,
            'priority_id' => 1,
            'dead_line' => now(),
            'deployed' => false,
            'canceled' => false,
            'created_by' => 1,
            'created_at' => now(),
            'fase_id' => '1',
            'visibility' => 1
        ];
    }
}
