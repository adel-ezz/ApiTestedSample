<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable=['message','subject','receiver_id','sender_id','room','created_at'];


    //
    /**
     * The users that belong to the messge.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'archive_message_users');
    }

    /**
     * The users that belong to the messge.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}
