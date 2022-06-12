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
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements ResetPassword/* , MustVerifyEmail */
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, CanResetPassword, Prunable;

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

    public function prunable()
    {
        return static::where("deleted_at", "<=", now()->minute());
    }

    public function pruning()
    {
        $avatar = $this->avatar;
        !$avatar ?: Storage::disk("public")->delete("avatars/" . $this->id . "_" . $avatar->hash . "." . $avatar->extension);
    }
}
