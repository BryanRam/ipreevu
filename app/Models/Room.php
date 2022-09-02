<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\RoomFactory;

/**
 * The Room model.
 * 
 * The model for the rooms table.
 * @filesource
 */
class Room extends Model {
    protected $primaryKey="room_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
    
    public function presentations(){
        return $this->hasMany('App\Models\Presentation');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function factory()
    {
        return RoomFactory::new();
    }
    
    
     public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($room)
        {
            if (is_null($room->presentations)) {
                //Do nothing
            }
            else
            {
                $room->presentations()->delete();
                //$speaker->presentations()->delete();
            }
            
            
            
           
        });
    }    
    
}