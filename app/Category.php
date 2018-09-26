<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App
 * @property string $categorie
*/
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['categorie'];
    protected $hidden = [];
    
    
    
    public function articles() {
        return $this->hasMany(Article::class, 'categories_id');
    }
}
