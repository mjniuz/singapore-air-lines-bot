<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_user = [
            'full_name' => 'Administrator',
            'password'  => Hash::make('singapore_bot2017'),
            'username'  => 'administrator',
            'access'    => User::ADMIN,
        ];

        $user = User::create($new_user);
    }
}
