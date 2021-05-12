<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'user_id',
        'cover_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'views',
        'user_id',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'author',
        'localized_date'
    ];

    /**
     * Get the content of the post
     *
     * @return string
    */
    public function contents()
    {
        return Storage::disk('posts')->get($this->id . '.md');
    }

    /**
     * Get the author of the post
     *
     * @return string
    */
    public function getAuthorAttribute()
    {
        return User::find($this->user_id);
    }

    /**
     * Get the author of the post
     *
     * @return string
    */
    public function getLocalizedDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('DD/MM/YYYY [alle] HH:mm');
    }
}
