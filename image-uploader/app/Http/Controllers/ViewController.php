<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use App\Image;
use Illuminate\Http\Request;
use \App\Http\Resources\ImageResource;
use App\Http\Resources\ImageCollection;

class ViewController extends Controller
{

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

    /**
     * @SWG\Get(
     *     path="/api/originalImagesInfo",
     *     summary="Получить список оригинальных данных по изображениям из базы с пагинацией",
     *     tags={"Images"},
     *     description="Получаем список доступных изображений с пагинацией",
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/Image"),
     *     )
     * )
     */
    public function getOriginalImages()
    {
        return new ImageCollection(Image::paginate());
    }
}
