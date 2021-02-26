<?php

namespace Database\Factories;

use App\Models\refundCustomerModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class refundCustomerModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = refundCustomerModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $i = 1;
        return [
            'deposit' => Str::random(15),
            'uname' => Str::random(15),
            'note' => Str::random(50),
            'date_in' => now()->addDays($i++),
            'money' => rand(10000, 99999),
            'billcode' => rand(100000, 999999),
        ];
    }
}
