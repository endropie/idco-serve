<?php

namespace Database\Seeders;

use App\Models\ReceiveOrder;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class ReceiveSeeder extends Seeder
{
    protected \Faker\Generator $fake;
    protected \Illuminate\Database\Eloquent\Collection $customers,
        $protypes, $materials, $coats,
        $rtypes, $r0types, $fltypes;


    public function run(): void
    {
        $this->fake = fake('ID_id');
        $this->customers = \App\Models\Customer::all();
        $this->protypes = \App\Models\Protype::all();
        $this->materials = \App\Models\Material::all();
        $this->coats = \App\Models\Coat::all();

        $this->rtypes = \App\Models\Rtype::all();
        $this->r0types = \App\Models\R0type::all();
        $this->fltypes = \App\Models\Fltype::all();


        $this->fakerReceiveOrder(20);
    }

    protected function getRequestReceiveOrder()
    {
        $items = collect();
        for ($i=0; $i < 10; $i++) {
            $dimension = rand(0,10) > 3
                ? ['p' => rand(1,15), "l" => rand(1,15), "t" => rand(1,15)]
                : ['o' => rand(1,15), "p" => rand(1,15)];

            $items->push([
                "name" => $this->fake->word ."-". $this->fake->unique()->numberBetween(10000, 999999),
                "quantity" => $this->fake->numberBetween(1, 15),
                "weight" => rand(1, 15) * 0.8,
                "hrc" => "HRC-". $this->fake->numberBetween(1, 5),
                "isexpress" => rand(0, 10) > 4 ? false : true,
                "condition" => null,
                "dimension" => $dimension,
                "material_id" => $this->materials->random()->id,
                "coat_id" => $this->coats->random()->id,
                "protype_id" => $this->protypes->random()->id,
                "rtype" => $this->rtypes->random()->code,
                "r0type" => $this->r0types->random()->code,
                "fltype" => $this->fltypes->random()->code,
            ]);
        }

        $customer = $this->customers->random();
        return new Request([
            "number" => null,
            "type" => collect(\App\Enums\OrderType::cases())->pluck('value')->random(),
            "date" => $this->fake->dateTimeBetween('-10 days', 'now')->format('Y-m-d'),
            "due" => null,
            "customer_id" => $customer->id,
            "customer_name" => $customer->name,
            "customer_contact" => $customer->contact?->phone ?? null,
            "customer_address" => $customer->contact?->address ?? null,
            "items" => $items->toArray(),
        ]);
    }

    protected function fakerReceiveOrder($count = 10)
    {

        for ($i=0; $i < $count; $i++) {
            $request = $this->getRequestReceiveOrder();

            /** @var \App\Http\Resources\ReceiveOrderResource $response */
            $response = app(\App\Http\ApiControllers\ReceiveOrderController::class)->save($request);
        }

    }
}
