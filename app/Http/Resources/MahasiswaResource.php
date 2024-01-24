<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nim_2010054' => $this->nim_2010054,
            'nama_lengkap_2010054' => $this->nama_lengkap_2010054,
            'jenis_kelamin_2010054' => $this->jenis_kelamin_2010054,
            'tmp_lahir_2010054' => $this->tmp_lahir_2010054,
            'tgl_lahir_2010054' => $this->tgl_lahir_2010054,
            'alamat_2010054' => $this->alamat_2010054,
            'notelp_2010054' => $this->notelp_2010054,
            'foto' => $this->foto


        ];
    }
}
