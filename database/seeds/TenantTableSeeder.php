<?php

use App\Tenant;
use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'name' => 'Default Tenant',
        ]);
    }
}
