<?php

namespace Database\Seeders;

use Database\Factories\HappeningFactory;
use Illuminate\Database\Seeder;

class HappeningUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 150)
            ->create()
            ->each(function($user) {
                $user->fields()->saveMany(factory(Field::class, rand(0, 4))->make());
            });
    }
}
