<?php
namespace App\Http\Controllers\Auth\WebsiteControllers\ContentControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Images;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function saveContent($data)
    {

        DB::beginTransaction();

        try {

            if (isset($data['id'])) {

                
                Content::where('id', $data['id'])
                ->update([

                    'users_id' => $data['users_id'],
                    'content_id' => $data['content_id'],
                    'content_type' => $data['content_type'],
                    'content' => $data['content'],

                ]);

                $post = Content::where('id', $data['id'])->first();

            } else {

            $post = Content::create([

                'users_id' => $data['users_id'],
                'content_id' => $data['content_id'],
                'content_type' => $data['content_type'],
                'content' => $data['content'],

            ]);
            
            }
            
            DB::commit();

            return [

                'status' => 'success',
                'message' => 'Contéudo registrado com sucesso!',
                'contentId' => $post->id

            ];

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => 'error',
                'error' => 'Algo deu errado, tente novamente.'
            ];
        }
    }

    public function deleteContent($data) {

        DB::beginTransaction();

        try {

            $postChildren = Content::where('content_id',$data['id'])->delete();

            $postImages = Images::where('origin_id',$data['id'])->where('origin_type','Post')->get();

            foreach($postImages as $index => $images) {

                $images->deleteDir();
                $images->delete();

            }

            $post = Content::where('id',$data['id'])->delete();
            
            DB::commit();

           

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => 'error',
                'error' => 'Algo deu errado, tente novamente.'
            ];
        }


    }
}
