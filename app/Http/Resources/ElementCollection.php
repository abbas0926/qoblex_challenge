<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ElementCollection extends ResourceCollection {
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->collection->map(function ($element) use ($request) {
                return (new ElementResource($element))->toArray($request);
            })->all(),
        ];
    }
}