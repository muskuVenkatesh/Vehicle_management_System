<?php

namespace App\Http\Resources\resources\views\emails;

use Illuminate\Http\Resources\Json\JsonResource;

class user_notification.blade.php extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
