<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FileActions extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verifier_id');
    }
}
