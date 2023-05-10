<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first',
        'last',
        'preferred',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function emails()
    {
        return $this->belongsToMany(Email::class);
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
