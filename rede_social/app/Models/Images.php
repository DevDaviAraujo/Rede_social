<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Images extends Model
{
    protected $fillable = [

        'id',
        'file',
        'file_type',
        'width',
        'height',
        'origin_type',
        'origin_id',
        'created_at',
        'updated_at'

    ];

    public function getDir()
    {

        $file_path = '/uploads/img/' . $this->file;

        if (Storage::disk('public')->exists($file_path)) {

           $file_dir = Storage::disk('public')->url($file_path);

            return $file_dir;
        }
        
        return 'Não há imagem';

    }

    public function deleteDir()
    {

        $file_path = '/uploads/img/' . $this->file;

        if (Storage::disk('public')->exists($file_path)) {

            $file_dir = Storage::disk('public')->delete($file_path);

        }

    }
}
