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
        return $this->belongsTo('App\Jobs','job_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User','receiver_id');
    }
}