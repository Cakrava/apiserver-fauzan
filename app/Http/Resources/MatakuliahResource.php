<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatakuliahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kdmatkul2010054' => $this->kdmatkul2010054,
            'namamat2010054' => $this->namamat2010054,
            'sks2010054' => $this->sks2010054

        ];
    }
}
