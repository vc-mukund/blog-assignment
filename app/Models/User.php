<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'dob',
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

     /**
     * One to one relationship to verify_user
     *  
     */
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class, 'user_id', 'id');
    }

    /**
     * For store first name with first capital letter
     * 
     */
    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = ucfirst($value);
    }

    /**
     * For store last name with first capital letter
     * 
     */
    public function setLnameAttribute($value)
    {
        $this->attributes['lname'] = ucfirst($value);
    }

    /**
     * For store email in lower case.
     * 
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
}
