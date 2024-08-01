<?php

namespace App\Http\Resources;

class ReceiveOrderResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->mergeAttributes(),
            $this->mergeInclude('items', fn () => ReceiveOrderItemResource::collection($this->resource->items)),
            $this->mergeInclude('customer', fn () => new CustomerResource($this->resource->customer)),
            $this->mergeInclude('created_uid', fn () => new UserResource($this->resource->created_user)),
        ];
    }
}
