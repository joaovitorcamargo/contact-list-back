<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';

    protected $fillable = ['name'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
