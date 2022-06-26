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
        'password',
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

    public function forceDelete()
    {
        $avatar = $this->avatar;
        if ($avatar)
        {
            Storage::disk("public")->delete("avatars/" . $this->id . "_" . $avatar->hash . "." . $avatar->extension);
            $this->avatar()->delete();
        }

        Storage::disk("public")->deleteDirectory("contents/" . $this->id);
        $this->remove();

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
}
