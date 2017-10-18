<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use Notifiable;

    protected $fillable = [
        'author_id', 'user_name', 'record_name', 'user_id', 'record_id',
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function records(){
        return $this->belongsTo('App\Record');
    }

}