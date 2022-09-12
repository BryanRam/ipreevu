<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\PresentationFactory;

/**
 * Presentation model.
 * 
 * The model for the presentations table.
 * @filesource
 */
class Presentation extends Model {
    protected $primaryKey="presentation_id";

    public function conference(){
        return $this->belongsTo(Conference::class, 'conference_id');
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function speakers(){
        return $this->belongsToMany(Speaker::class, 'pres_speakers', 'presentation_id', 'speaker_id');
    }
    
    public function chats(){
        return $this->hasMany(Chatlog::class);
    }
    
    public function room(){
        return $this->belongsTo(Room::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function factory()
    {
        return PresentationFactory::new();
    }
    
    
    public static function boot()
    {
        parent::boot();    
    /*
        static::deleted(function($presentation)
        {
                
            
            if (is_null($presentation->categories)) {
                //Do nothing
            }
            else
            {
                $presentation->categories()->detach($presentation->presentation_id);
                //$presentation->categories()->delete();
            }
            
            
            if (is_null($presentations->speakers)) {
                //Do nothing
            }
            else
            {
                $presentation->speakers()->detach($presentation->speakers()->speaker_id);

               // $presentations->speakers()->delete();
            }
            
            
           
        });
     
        
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($presentation)
        {
            if (is_null($presentation->chats)) {
                //Do nothing
            }
            else
            {
                $presentation->chats()->delete();
            }
            
            
            
            if (is_null($presentation->categories)) {
                //Do nothing
            }
            else
            {
                $presentation->categories()->detach($presentation->presentation_id);
                //$presentation->categories()->delete();
            }
            
            
            if (is_null($presentations->speakers)) {
                //Do nothing
            }
            else
            {
                $presentation->speakers()->detach($presentation->speakers()->speaker_id);

               // $presentations->speakers()->delete();
            }
            
            
           
        });
     
     */
    }    
}