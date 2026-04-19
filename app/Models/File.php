<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'disk', 'mime_type', 'original_name'];
    
    public function url()
    {
        return \Illuminate\Support\Facades\Storage::disk($this->disk)->url($this->file_path);
    }
}
