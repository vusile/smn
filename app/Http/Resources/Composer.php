<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Composer extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'active_songs' => $this->active_songs,
            'has_profile' => $this->has_profile,
            'parokia' => $this->parokia,
            'jimbo' => $this->jimbo,
            'photo1' => $this->photo1 ? url('storage/uploads/files/' . $this->photo1) : null,
            'photo2' => $this->photo2 ? url('storage/uploads/files/' . $this->photo2) : null,
            'photo3' => $this->photo3 ? url('storage/uploads/files/' . $this->photo3) : null,
            'phone' => $this->phone,
            'email' => $this->email,
            'details' => $this->details,
        ];
    }
}
