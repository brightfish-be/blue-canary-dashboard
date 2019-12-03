<?php

use App\App;
use App\Counter;
use App\Tenant;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run seeding for default/example items.
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        /** @var App $app */
        $app = App::create([
            'name' => 'Default App',
            'tenant_id' => $tenant->id,
        ]);

        /** @var Counter $counter */
        $counter = Counter::create([
            'name' => 'default.counter',
            'app_id' => $app->id,
        ]);

        $this->command->info('✓ A default application with a default counter has been generated:');
        $this->command->line('→ You can push metrics to it via: ' . $counter->generateUrl());
    }
}
