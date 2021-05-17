<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * All the roles avaible for the users.
     *
     * The first are the more important, the last the less important.
    */
    protected $roles = [
        'admin',
        'writer',
        'user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'google_id',
        'profile_pic_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'google_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'pic_url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Check if a user can do something, based on its role
     *
     * @param  iterable|string  $abilities
     * @param  array|mixed  $arguments
     *
     * @return bool
    */
    public function can($ability, $role = []): bool
    {
        if($ability != 'role') return parent::can($ability, $role);

        if(!in_array($role, $this->roles)) return false;
        if(!in_array($this->role, $this->roles)) return false;

        $wanted = array_search($role, $this->roles);
        $owned = array_search($this->role, $this->roles);

        return $owned <= $wanted;
    }


    public function getPicUrlAttribute()
    {
        return $this->profile_pic_url ?? url('/imgs/no-pic.png');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
