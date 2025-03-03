<?php
namespace App\Http\Controllers\Auth\WebsiteControllers\ImagesControllers;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use getID3;

class ImagesController extends Controller
{

    public function save_content_file(array $files, string $postId)
    {
        DB::beginTransaction();

        try {

            foreach ($files as $index => $file) {

                $file_path = $file->getRealPath();
                $file_name = $index . time() . '.' . $file->getClientOriginalExtension();
                $file_type = mime_content_type($file_path);
                $store_path = 'uploads/img/' . $file_name;

                if (preg_match("/image/", $file_type)) {

                    $file_width = getimagesize($file_path)[0];
                    $file_height = getimagesize($file_path)[1];

                }

                if (preg_match("/image/", $file_type)) {

                    $getID3 = new getID3;

                    $videoFilePath = $file_path;
                    $fileInfo = $getID3->analyze($videoFilePath);

                    if (isset($fileInfo['video']['resolution_x']) && isset($fileInfo['video']['resolution_y'])) {
                        $file_width = $fileInfo['video']['resolution_x'];
                        $file_height = $fileInfo['video']['resolution_y'];
                    }

                }

                Storage::disk('public')->put($store_path, file_get_contents($file_path));



                if (Storage::disk('public')->exists($store_path)) {

                    $image = Images::create([
                        'file' => $file_name,
                        'file_type' => $file_type,
                        'width' => $file_width,
                        'height' => $file_height,
                        'origin_type' => 'Post',
                        'origin_id' => $postId,
                    ]);
                }
            }

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Upload de imagem com Sucesso!'
            ];

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => 'error',
                'error' => 'Erro ao fazer upload da imagem, tente novamente.'
            ];
        }
    }
    public function save_avatar_image(object $img_file, string $userId, bool $updating)
    {


        DB::beginTransaction();

        $imageName = time() . '.' . $img_file->getClientOriginalExtension();
        $file_type = mime_content_type($img_file->getRealPath());
        $img_width = getimagesize($img_file->getRealPath())[0];
        $img_height = getimagesize($img_file->getRealPath())[1];

        $imagePath = 'uploads/img/' . $imageName;

        Storage::disk('public')->put($imagePath, file_get_contents($img_file->getRealPath()));

        try {

            if (Storage::disk('public')->exists($imagePath)) {

                if ($updating) {

                    $image = Users::find($userId)->avatar->update([
                        'file' => $imageName,
                        'file_type' => $file_type,
                        'width' => $img_width,
                        'height' => $img_height,
                    ]);

                } else {

                    $image = Images::create([
                        'file' => $imageName,
                        'file_type' => $file_type,
                        'width' => $img_width,
                        'height' => $img_height,
                        'origin_type' => 'User',
                        'origin_id' => $userId,
                    ]);
                }
                DB::commit();

                return [
                    'status' => 'success',
                    'message' => 'Upload de imagem com Sucesso!'
                ];
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => 'error',
                'error' => 'Erro ao fazer upload da imagem, tente novamente.'
            ];
        }

    }

    public function update_avatar_image($img_file, $userId)
    {
        $image = Users::find($userId)->avatar;
        Storage::disk('public')->delete('/uploads/img/' . $image->file);

        return app(ImagesController::class)->save_avatar_image($img_file, $userId, true);

    }

}
