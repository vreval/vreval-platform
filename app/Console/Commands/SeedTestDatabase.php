<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\Environment;
use App\Models\Form;
use App\Models\Marker;
use App\Models\User;
use Illuminate\Console\Command;

class SeedTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-test-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::first();
        auth()->loginUsingId($user->id);
        Form::factory()->count(5)->create();
        Asset::factory()->count(5)->create();
        Marker::factory()->count(5)->create();
        Environment::factory()->count(5)->create();
    }
}
