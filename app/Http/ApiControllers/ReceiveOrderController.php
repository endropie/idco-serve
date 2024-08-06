<?php

namespace App\Http\ApiControllers;

use App\Http\Filters\ReceiveOrderFilter;
use App\Http\Resources\ReceiveOrderResource;
use App\Models\ReceiveOrder;
use Illuminate\Http\Request;

class ReceiveOrderController extends Controller
{
    public function index (ReceiveOrderFilter $filter)
    {
        $collection = ReceiveOrder::filter($filter)->collective();

        return ReceiveOrderResource::collection($collection);
    }

    public function show ($id)
    {
        $record = ReceiveOrder::findOrFail($id);

        return new ReceiveOrderResource($record);
    }

    public function save (Request $request)
    {
        $request->validate([
            "id" => "nullable|exists:receive_orders,id",
            "type" => "required|in:". collect(\App\Enums\OrderType::cases())->pluck('value')->join(','),
            "number" => "nullable|unique:receive_orders,number,". $request->get('id') .",id",
            "date" => "required|date",
            "due" => "nullable|date",
            "customer_id" => "required|exists:customers,id",
            "items" => "sometimes|array",
            "items.*.name" => "required",
            "items.*.quantity" => "required",
            "items.*.protype_id" => "required|exists:protypes,id",
            "items.*.material_id" => "required|exists:materials,id",
            "items.*.coat_id" => "required|exists:coats,id",
            "items.*.rtype" => "required",
            "items.*.r0type" => "required",
            "items.*.fltype" => "required",
        ]);

        app('db')->beginTransaction();


        $row = $request->only([
            'number', 'date', 'due', 'reference', 'type', 'description',
            'customer_id', 'customer_name', 'customer_contact', 'customer_address',
        ]);


        /** @var ReceiveOrder $record*/
        $record = ReceiveOrder::firstOrNew(['id' => $request->get('id')], $row);

        $record->fill($row);

        $record->save();

        if ($request->has('items'))
        {
            $deleteItems = collect($request->get('items'))->whereNotNull('id')->pluck('id');

            if ($deleteItems->count()) $record->items()->whereNotIn('id', $deleteItems->toArray())->delete();

            foreach ($request->get('items') as $requestItem) {

                $requestItem = new Request($requestItem);

                $fillItem = [
                    'name', 'quantity', 'weight', 'condition', 'hrc', 'dimension', 'isexpress',
                    'protype_id', 'material_id', 'coat_id', 'rtype', 'r0type', 'fltype',
                ];

                $rowItem = $requestItem->only($fillItem);

                /** @var ReceiveOrderItem $recordItem */
                $recordItem = $record->items()->firstOrNew(['id' => $requestItem->get('id')], $rowItem);

                $recordItem->fill($rowItem);

                $recordItem->save();
            }

        }

        app('db')->commit();

        $record->setNumber();

        $message = "The record has been saved.";

        return (new ReceiveOrderResource($record))->additional([
            "message" => $message,
        ]);
    }

    public function delete ($id)
    {
        $record = ReceiveOrder::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "The record has been deleted."
        ]);
    }
}
