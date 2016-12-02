<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
