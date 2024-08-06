<?php

namespace App\Http\Resources;

class ReceiveOrderItemResource extends Resource
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
            $this->mergeInclude('material', fn () => new Resource($this->resource->material)),
            $this->mergeInclude('coat', fn () => new Resource($this->resource->coat)),
            $this->mergeInclude('protype', fn () => new Resource($this->resource->material)),
        ];
    }
}
