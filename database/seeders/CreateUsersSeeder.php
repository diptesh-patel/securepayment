<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@securepayments.com',
                'is_admin'=>'1',
                'role_id'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Merchant',
               'email'=>'merchant@securepayments.com',
                'is_admin'=>'1',
                'role_id'=>'2',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}