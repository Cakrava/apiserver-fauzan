<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nidn2010054' => $this->nidn2010054,
            'namalengkap2010054' => $this->namalengkap2010054,
            'jenkel2010054' => $this->jenkel2010054,
            'tmp_lahir2010054' => $this->tmp_lahir2010054,
            'tgl_lahir2010054' => $this->tgl_lahir2010054,
            'alamat2010054' => $this->alamat2010054,
            'notelp2010054' => $this->notelp2010054
        ];

    }
}
