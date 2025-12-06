<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;
use App\Models\buku;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\buku>
 */
class bukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = buku::class;

    public function definition(): array
    {
        return [
            'judul_buku'    => $this->faker->sentence(3),
            'pengarang'     => $this->faker->name(),
            'penerbit'      => $this->faker->company(),
            'tahun_terbit'  => $this->faker->year(),
            'isbn'          => $this->faker->unique()->isbn13(),
            'stock'         => $this->faker->numberBetween(1, 100),
            'kategori_id'   => Kategori::inRandomOrder()->first()->id,
        ];
    }
}
