<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    const STORAGE_DIR = 'upload/';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'link' => asset('storage/images/' . $this->filename),
            'thumbLink' => asset('storage/previews/' . $this->filename),
            'createTime' => $this->created_at
        ];
    }
}
