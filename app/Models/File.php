<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'path',
        'mime_type',
    ];

    protected $table = 'files';

    public static function putAndCreate(UploadedFile $file): File
    {
        $path = Storage::disk('public')->put('file', $file);
        $file = File::create([
            'path' => $path,
            'mime_type' => $file->getClientOriginalExtension(),
        ]);

        return $file;
    }
}
