<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Imagick;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Image;

class UploadController extends Controller
{
    const TYPE_JSON = 'application/json';

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('image')) {
            return $this->uploadFormData($request->file('image'));
        }

        if ($request->header('content-type') == self::TYPE_JSON) {
            return $this->uploadJson($request->getContent());
        }

        return response()->json('Incorrect request', 401);
    }

    /**
     * Метод загрузки изображений в наше хранилище
     *
     * @param UploadedFile[] $files загруженные файлы
     * @return \Illuminate\Http\JsonResponse
     */
    private function uploadFormData($files): \Illuminate\Http\JsonResponse
    {
        $files = is_array($files) ? $files : [$files];
        $filenames = [];
        foreach ($files as $file) {
            $filenames[] = $filename = $file->getFilename() . '.' . $file->extension();
            Storage::disk('images')->put($filename, File::get($file));
            Storage::disk('previews')->put($filename, Imagick::make($file)
                ->resize(100, 100)->save());
            $this->saveImage($file, $filename);
        }

        return response()->json($filenames, 201);
    }

    /**
     * Метод загрузки изображений в наше хранилище по переданным URL
     *
     * @param Json[]|resource $json
     * @return \Illuminate\Http\JsonResponse
     */
    private function uploadJson($json): \Illuminate\Http\JsonResponse
    {
        $json = json_decode($json);

        if (isset($json->urls)) {
            return $this->uploadUrls($json);
        }

        if (isset($json->base64)) {
            return $this->uploadBase64($json);
        }

        return response()->json('Incorrect request', 401);
    }

    /**
     * Проверка существования изображения по URL
     *
     * @param string $url
     * @return bool
     */
    private function checkRemoteFile($url): bool
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return (curl_exec($ch) !== FALSE);
    }

    /**
     * Метод загрузки изображений в наше хранилище по переданным URL
     *
     * @param \stdClass $json
     * @return \Illuminate\Http\JsonResponse
     */
    private function uploadUrls($json): \Illuminate\Http\JsonResponse
    {
        $urls = is_array($json->urls) ? $json->urls : [$json->urls];
        $filenames = [];
        foreach ($urls as $url) {
            if ($this->checkRemoteFile($url)) {
                $info = pathinfo($url);
                $contents = file_get_contents($url);

                $tempFile = '/tmp/' . $info['basename'];
                file_put_contents($tempFile, $contents);

                $file = new UploadedFile($tempFile, $info['basename']);
                $filenames[] = $filename = uniqid() . '.' . $file->getExtension();
                Storage::disk('images')->put($filename, File::get($file));
                Storage::disk('previews')->put($filename, Imagick::make($file)
                    ->resize(100, 100)->save());
                $this->saveImage($file, $filename);
            }
        }

        return response()->json($filenames, 201);
    }

    /**
     * Метод загрузки изображений в наше хранилище по переданным URL
     *
     * @param \stdClass $json
     * @return \Illuminate\Http\JsonResponse
     */
    private function uploadBase64($json): \Illuminate\Http\JsonResponse
    {
        $files = is_array($json->base64) ? $json->base64 : [$json->base64];
        $filenames = [];
        foreach ($files as $file) {
            preg_match_all('/data\:image\/([a-zA-Z]+)\;base64/', $file, $matched);
            $ext = isset($matched[1]) ? reset($matched[1]) : false;
            $filenames[] = $filename = uniqid() . '.' . $ext;
            Imagick::make($file)->save(storage_path('app/public/images/') . $filename);
            Imagick::make($file)
                ->resize(100, 100)->save(storage_path('app/public/previews/') . $filename);
            $this->saveBase64Image($filename,$ext);
        }

        return response()->json($filenames, 201);
    }

    /**
     * Метод сохранения данных в БД о загруженном изображении
     *
     * @param UploadedFile $file
     * @param string $filename
     */
    private function saveImage($file, $filename): void
    {
        $image = new Image();
        $image->original_filename = $file->getClientOriginalName();
        $image->filename = $filename;
        $image->mime = $file->getClientMimeType();
        $image->save();
    }

    /**
     * Метод сохранения данных полученных из base64
     *
     * @param $filename
     * @param $extension
     */
    private function saveBase64Image($filename, $extension): void
    {
        $image = new Image();
        $image->original_filename = 'from_base64';
        $image->filename = $filename;
        $image->mime = $extension;
        $image->save();
    }
}
