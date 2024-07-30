<?php

namespace App\Http\ApiControllers;

use App\Http\Filters\CoatFilter;
use App\Models\Coat;
use App\Http\Resources\CoatResource;
use Illuminate\Http\Request;

class CoatController extends Controller
{
    public function index (CoatFilter $filter)
    {
        $collection = Coat::filter($filter)->collective();

        return CoatResource::collection($collection);
    }

    public function show ($id)
    {
        $record = Coat::findOrFail($id);

        return new CoatResource($record);
    }

    public function save (Request $request)
    {
        $request->validate([
            "id" => "nullable|exists:coats,id",
            "name" => "required",
        ]);

        $row = $request->only([
            "name", "notes",
        ]);

        app('db')->beginTransaction();

        /** @var Coat $record*/
        $record = Coat::firstOrNew(['id' => intval($request->id)]);

        $record->fill($row);

        $record->save();

        app('db')->commit();

        $message = "The record has been saved.";

        return (new CoatResource($record))->additional([
            "message" => $message,
        ]);
    }

    public function delete ($id)
    {
        $record = Coat::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "The record has been deleted."
        ]);
    }
}
