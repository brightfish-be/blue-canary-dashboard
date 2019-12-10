<?php

use App\Tenant;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Create roles with abilities for the default user.
     * @return void
     */
    protected function createRoles(): void
    {
        /** @var Silber\Bouncer\Bouncer $bouncer */
        $bouncer = app('Silber\Bouncer\Bouncer');

        $bouncer->allow('super-admin')->to([
            'manage_settings',
            'manage_users',
            'manage_apps',
        ]);

        $bouncer->allow('admin')->to([
            'manage_apps',
        ]);
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $this->createRoles();

        $email = config('canary.settings.admin_email');

        $pw = Str::random(16);

        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($pw),
            'tenant_id' => Tenant::first()->id
        ]);

        $user->assign('super-admin');

        $this->command->info('✓ Default login credentials generated:');
        $this->command->line("→ Username: $email");
        $this->command->line("→ Password: $pw");
    }
}
