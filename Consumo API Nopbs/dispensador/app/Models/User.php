<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the custom password field for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->token;
    }

    public function adminlte_image()
    {
        $folder = explode(" ",$this->name);
        return '/storage'.'/'.strtolower($folder[0]).'/'.$this->image;
    }

    public function adminlte_desc()
    {
        return $this->nit;
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
