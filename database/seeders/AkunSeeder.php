<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nip'=>'1234',
                'name'=>'DONI',
                'email'=>'doni@gmail.com',
                'level'=>'DIREKTUR',
                'password'=>Hash::make('123456')
            ],
            
            [
                'nip'=>'1235',
                'name'=>'DONO',
                'email'=>'dono@gmail.com',
                'level'=>'FINANCE',
                'password'=>Hash::make('123456')
            ],

            [
                'nip'=>'1236',
                'name'=>'DONA',
                'email'=>'dona@gmail.com',
                'level'=>'STAFF',
                'password'=>Hash::make('123456')
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
