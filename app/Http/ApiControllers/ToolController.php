<?php

namespace App\Http\ApiControllers;

use App\Http\Filters\ToolFilter;
use App\Models\Tool;
use App\Http\Resources\ToolResource;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index (ToolFilter $filter)
    {
        $collection = Tool::filter($filter)->collective();

        return ToolResource::collection($collection);
    }

    public function show ($id)
    {
        $record = Tool::findOrFail($id);

        return new ToolResource($record);
    }

    public function save (Request $request)
    {
        $request->validate([
            "id" => "nullable|exists:tools,id",
            "name" => "required",
        ]);

        $row = $request->only([
            "name", "notes",
        ]);

        app('db')->beginTransaction();

        /** @var Tool $record*/
        $record = Tool::firstOrNew(['id' => intval($request->id)]);

        $record->fill($row);

        $record->save();

        app('db')->commit();

        $message = "The record has been saved.";

        return (new ToolResource($record))->additional([
            "message" => $message,
        ]);
    }

    public function delete ($id)
    {
        $record = Tool::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "The record has been deleted."
        ]);
    }
}
