<?php

namespace App\Models;

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
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, CanResetPassword 
    {
        SoftDeletes::forceDelete as parentForceDelete;
    }

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

    public function folders()
    {
        return $this->hasMany(Folder::class)->whereFolderId(null);
    }

    public function contents()
    {
        return $this->hasMany(Content::class)->whereFolderId(0);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function delete()
    {
        $avatar = $this->avatar;
        if ($avatar)
        {
            Storage::disk("public")
                ->move("avatars/" . $this->id . "_" . $avatar->hash . "." . $avatar->extension, 
                       "../deletes/avatars/" . $this->id . "_" . $avatar->hash . "." . $avatar->extension);
            $this->avatar()->delete();
        }

        Storage::disk("public")
            ->move("contents/" . $this->id, 
                   "../deletes/contents/" . $this->id);
        $this->remove();

        $this->likes()->delete();
        $this->dislikes()->delete();
        $this->views()->delete();
        $this->downloads()->delete();
        $this->favorites()->delete();

        return parent::delete();
    }

    public function forceDelete()
    {
        $avatar = $this->avatar;

        if ($avatar)
        {
            Storage::disk("local")
                ->delete("deletes/avatars/" . $this->id . "_" . $avatar->hash . "." . $avatar->extension);
            $this->avatar()->forceDelete();
        }

        Storage::disk("local")->deleteDirectory("deletes/contents/" . $this->id);
        
        foreach ($this->folders as $folder)
        {
            $folder->forceDelete();
        }

        $this->contents()->forceDelete();

        $this->likes()->forceDelete();
        $this->dislikes()->forceDelete();
        $this->views()->forceDelete();
        $this->downloads()->forceDelete();
        $this->favorites()->forceDelete();

        return $this->parentForceDelete();
    }

    public function remove()
    {
        foreach ($this->folders as $folder)
        {
            $folder->remove();
        }

        return $this->contents()->delete();
    }

    public function scopeVisibles($query)
    {
        return $query->whereVisibility(true);
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
}
