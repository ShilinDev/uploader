<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use App\Image;
use Illuminate\Http\Request;
use \App\Http\Resources\ImageResource;
use App\Http\Resources\ImageCollection;

class ViewController extends Controller
{
    public function getImage()
    {
        return ImageResource::collection(Image::all());
    }

    /**
     * @SWG\Get(
     *     path="/api/images",
     *     summary="Получить список доступных изображений",
     *     tags={"Images"},
     *     description="Получаем список доступных изображений",
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/ImageResource"),
     *     )
     * )
     */
    public function getImages()
    {
        return ImageResource::collection(Image::all());
    }

    public function getOriginalImages()
    {
        return new ImageCollection(Image::paginate());
    }
}
