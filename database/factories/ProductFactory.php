<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //  $table->string('name');

            // // description
            // $table->text('description')->nullable();
            // $table->integer('price');
            // $table->integer('stock');
            // $table->foreignId('category_id')->constrained();
            // $table->string('image')->nullable();
            // // status
            // $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            // // enum  criteria
            // $table->enum('criteria', ['perorangan', 'rombongan'])->default('perorangan');
            // // favorite
            // $table->boolean('favorite')->default(false);

            'name' => $this->faker->word,
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 2),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'status' =>  'published',
            'criteria' => $this->faker->randomElement(['perorangan', 'rombongan']),
            'favorite' => $this->faker->boolean,

        ];
    }
}
