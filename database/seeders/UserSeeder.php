<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fname' => 'Super',
            'lname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'dob' => Carbon::create('1994', '10', '31'),
            'verified' => 1,
            'created_at' => now(),
        ]);

        $user = User::find(1);
        $user->assignRole('admin');
    }
}
