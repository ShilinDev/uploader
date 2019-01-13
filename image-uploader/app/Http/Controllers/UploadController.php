<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageUploaderService;

class UploadController extends Controller
{
    const TYPE_JSON = 'application/json';

    /**
     * @SWG\Post(
     *     path="/api/upload",
     *     summary="Загрузка изображения на сервер",
     *     tags={"Images"},
     *     description="Загрузка изображения на сервер, поддерживается загрузка через передачу изображений в
    1) form-data в ключе image;
    2) URL в ключе urls;
    3) Base64 в ключе base64
    Пример:

    POST /api/upload HTTP/1.1
    Host: localhost
    Content-Type: application/json
    Cache-Control: no-cache

    {
    'urls':[
    'https://jsoneditoronline.org/doc/img/code_editor12312.png',
    'https://cdn-images-1.medium.com/max/1600/1*aXW_00lLrZn0_V4ytKoQUw.gif'
    ]
    }",
     *     @SWG\Response(
     *         response=201,
     *         description="Массив имен созданных файлов",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Incorrect request",
     *     )
     * )
     *
     * @param Request $request
     * @param ImageUploaderService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, ImageUploaderService $service): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('image')) {
            return $service->uploadFormData($request->file('image'));
        }

        if ($request->header('content-type') == self::TYPE_JSON) {
            return $service->uploadJson($request->getContent());
        }

        return response()->json('Incorrect request', 401);
    }
}
