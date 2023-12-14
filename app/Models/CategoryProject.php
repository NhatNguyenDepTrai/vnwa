<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProject extends Model
{
    use HasFactory;
    protected $fillable = ['url_bg', 'url_avatar', 'url_avatar_mobile', 'url_bg', 'name', 'slug', 'desc', 'meta_title', 'content', 'meta_image', 'meta_desc'];

    public function listImages()
    {
        return $this->hasMany(ListImage::class, 'id_tb');
    }
}
