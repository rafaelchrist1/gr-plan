<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::create(
            [
                'descricao' => 'Electrolux'
            ]
        );
        Marca::create(
            [
                'descricao' => 'Brastemp'
            ]
        );
        Marca::create(
            [
                'descricao' => 'Fischer'
            ]
        );
        Marca::create(
            [
                'descricao' => 'Samsung'
            ]
        );
        Marca::create(
            [
                'descricao' => 'LG'
            ]
        );
    }
}
