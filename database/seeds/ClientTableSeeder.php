<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Client::create([
            'client_name' => 'Anonymous',
            'phone' => '0000000000',
            'address' => 'Mila',
            'description' => 'Nothing',
            'rc' => '1000000',
            'article' => '1000000',
            'nif' => '1000000',
            'nis' => '1000000'
        ]);
    }
}