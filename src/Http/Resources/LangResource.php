<?php

namespace Conquest\Relay\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LangResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->resource[0],
            'label' => $this->resource[1],
        ];
    }

    public static function wrap($value)
    {
        static::$wrap = null;
    }
}
