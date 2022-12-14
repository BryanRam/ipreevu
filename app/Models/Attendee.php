<?php
/**
 * Attendee.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
//use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Database\Factories\AttendeeFactory;

/**
 * Attendee model.
 * 
 * The Attendee model for the attendees table.
 * 
 * @filesource
 */
class Attendee extends Model implements CanResetPasswordContract, /*JWTSubject,*/ Authenticatable{
    use CanResetPassword, AuthenticatableTrait, Authorizable;

    protected $primaryKey = 'attendee_id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    /**
     * Establishes a many-to-many relationship with conferences table
     * @return type
     */
    public function conferences(){
        return $this->belongsToMany(Conference::class, 'conference_attendees', 'attendee_id', 'conference_id');
    }
    
    /**
     * Establishes a one-to-many relationship with chatlogs table
     * @return type
     */
    public function chats()
    {
        return $this->hasMany(Chatlog::class);
    }
    
    /**
     * Establishes a one-to-many relationship with whitelists table
     * @return type
     */
    public function whitelist()
    {
        return $this->hasMany(Whitelist::class);
    }
    
    /**
     * Establishes a one-to-many relationship with blacklists table
     * @return type
     */
    public function blacklist()
    {
        return $this->hasMany(Blacklist::class);
    }
    
     /**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    // public function getJWTIdentifier(){
    //     return $this->getKey();
    // }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    // public function getJWTCustomClaims(){
    //     return [];
    // }
    
    public function getRememberToken()
    {   
    return $this->remember_token;
    }

    public function setRememberToken($value)
    {
    $this->remember_token = $value;
    }   

    public function getRememberTokenName()
    {
    return 'remember_token';
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function factory()
    {
        return AttendeeFactory::new();
    }
}
