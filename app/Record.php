<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_public', 'is_folder', 'folder_hash',
    ];

    public function users(){
    	return $this->belongsTo('App\User');
    }

    public function notifications(){
        return $this->hasOne('App\Notification');
    }

}