<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','votes'];

    protected $appends = ['content_trimmed'];

    public function getContentTrimmedAttribute()
    {
        return Str::limit($this->content, 15, '...') ;
    }
}
