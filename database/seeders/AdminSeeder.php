<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => \Str::uuid(),
            'name' => 'admin',
            'email' => 'admin@glitterups.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'phone_code	' => '+92',
            'phone_number' => '3030045452',
            'phone_verified_at' => date('Y-m-d H:i:s'),
            'is_social' => '0',
            'social_id' => 'null',
            'social_email' => 'null',
            'social_type' => 'null',
            'is_social_password_updated' => '0',
            'gender' => 'null',
            'is_online' => '1',
            'type' => 'admin',
            'status' => 'pending',
            'long' => 'null',
            'lat' => 'null',
            'address' => 'null',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
            'remember_token' => '0',
        ]);
    }
}
