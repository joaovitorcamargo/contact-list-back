<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['people_id', 'type', 'contact_info'];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
