<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *  definition="ImageResource",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="link",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="thumbLink",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="createTime",
 *      type="object"
 *  )
 * )
 */
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
