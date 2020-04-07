<?php

namespace App\Http\Resources\Administrador;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Usuario\UsuarioTblResource;

class AdministradorResource extends JsonResource
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
            'id_administrador' => $this->id,
            $this->mergeWhen(
                $this->resource->relationLoaded('usuario') && !is_null($this->usuario), 
                new UsuarioTblResource($this->usuario) 
            )
        ];
    }
}
