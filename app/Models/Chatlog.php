<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatlog extends Model{
    protected $primaryKey="chat_id";
    
    public function room(){
        return $this->belongsTo(Room::class);
    }
    
    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }
}
