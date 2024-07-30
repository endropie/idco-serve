<?php

namespace App\Http\ApiControllers;

use App\Http\Filters\MaterialFilter;
use App\Models\Material;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index (MaterialFilter $filter)
    {
        $collection = Material::filter($filter)->collective();

        return MaterialResource::collection($collection);
    }

    public function show ($id)
    {
        $record = Material::findOrFail($id);

        return new MaterialResource($record);
    }

    public function save (Request $request)
    {
        $request->validate([
            "id" => "nullable|exists:materials,id",
            "name" => "required",
        ]);

        $row = $request->only([
            "name", "notes",
        ]);

        app('db')->beginTransaction();

        /** @var Material $record*/
        $record = Material::firstOrNew(['id' => intval($request->id)]);

        $record->fill($row);

        $record->save();

        app('db')->commit();

        $message = "The record has been saved.";

        return (new MaterialResource($record))->additional([
            "message" => $message,
        ]);
    }

    public function delete ($id)
    {
        $record = Material::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "The record has been deleted."
        ]);
    }
}
