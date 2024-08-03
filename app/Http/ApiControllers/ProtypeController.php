<?php

namespace App\Http\ApiControllers;

use App\Http\Filters\ProtypeFilter;
use App\Models\Protype;
use App\Http\Resources\ProtypeResource;
use Illuminate\Http\Request;

class ProtypeController extends Controller
{
    public function index (ProtypeFilter $filter)
    {
        $collection = Protype::filter($filter)->collective();

        return ProtypeResource::collection($collection);
    }

    public function show ($id)
    {
        $record = Protype::findOrFail($id);

        return new ProtypeResource($record);
    }

    public function save (Request $request)
    {
        $request->validate([
            "id" => "nullable|exists:protypes,id",
            "name" => "required",
        ]);

        $row = $request->only([
            "name", "notes",
        ]);

        app('db')->beginTransaction();

        /** @var Protype $record*/
        $record = Protype::firstOrNew(['id' => intval($request->id)]);

        $record->fill($row);

        $record->save();

        app('db')->commit();

        $message = "The record has been saved.";

        return (new ProtypeResource($record))->additional([
            "message" => $message,
        ]);
    }

    public function delete ($id)
    {
        $record = Protype::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "The record has been deleted."
        ]);
    }
}
