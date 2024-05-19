<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $adminrole = Role::create(['name' => 'admin']);
        $superadminrole = Role::create(['name' => 'Super Admin']);
        $managerrole = Role::create(['name' => 'manager']);
        $cashierrole = Role::create(['name' => 'cashier']);

        $this->call([
           StoreSeeder::class,
           UserSeeder::class,
           ProductSeeder::class,
           OrderSeeder::class,
        ]);

        $superadmin = User::create([
            'name' => 'peter',
            'username' => 'peter',
            'email' => 'peter@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', /* password */
            'store_id' => null,
         ]);

        $superadmin->assignRole('Super Admin');

    }
}
