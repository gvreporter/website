<?php

namespace App\Models;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

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
        'updated_at',
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
        'localized_date',
        'author',
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
     * Generate the sharable image
     *
     * @return \Intervention\Image\Image
    */
    public function generateImage()
    {
        $text = wordwrap($this->title, 20, PHP_EOL);
        $canvas = Image::canvas(1080, 1080);
        $canvas->fill("#000000");
        $image = Image::canvas(1080, 1080)
            ->insert($this->cover_url, 'center-center')
            ->opacity(50);
        $canvas->insert($image);
        $canvas->text($text, 100, 100, function($font) {
            $font->file(resource_path('fonts/WorkSans.ttf'));
            $font->size(100);
            $font->color('#ffffff');
        });

        Log::info(gettype($canvas));

        return $canvas;
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
