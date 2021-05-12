<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that  are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the content of the post
     *
     * @return string
    */
    public function contents()
    {
        return Storage::disk('posts')->get($this->id . '.md');
    }
}