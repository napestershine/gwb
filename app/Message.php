<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    public function jobs()
    {
        return $this->belongsTo('App\Jobs');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
