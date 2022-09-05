<?php
/**
 * Category.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\CategoryFactory;

/**
 * @filesource
 */
class Category extends Model{
    protected $primaryKey="category_id";

    public function presentations(){
        return $this->belongsToMany(Presentation::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function factory()
    {
        return CategoryFactory::new();
    }
}
