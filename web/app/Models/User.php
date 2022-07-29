<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as ResetPassword;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements ResetPassword/* , MustVerifyEmail */
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        "email_visibility", 
        'password',
        "visibility", 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    public function folder()
    {
        return $this->hasMany(Folder::class)->whereFolderId(null);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function remove() : ?bool
    {
        if ($this->avatar) $this->avatar->remove();

        $this->folder()->first()->remove();

        $this->favorites()->delete();

        return $this->delete();
    }

    public function forceRemove() : ?bool
    {
        if ($this->avatar) $this->avatar->forceRemove();

        $this->folder()->first()->forceRemove();

        $this->favorites()->withTrashed()->forceDelete();

        return $this->forceDelete();
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
