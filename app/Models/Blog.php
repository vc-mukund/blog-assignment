<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'image',
        'status',
    ];

    /**
     * Reverse one to many relationship with users
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * For search title query
     *
     */
    public function scopeUser($query)
    {
        $query->where('user_id', Auth::user()->id);
    }
}
