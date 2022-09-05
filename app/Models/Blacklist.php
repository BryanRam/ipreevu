<?php
/**
 * Blacklist.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @filesource
 */
class Blacklist extends Model{
    protected $table = 'blacklist';
    
    public function conference(){
        return $this->belongsTo(Conference::class);
    }
    
    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }
}
