<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 *
 * @package App
 * @property string $titre
 * @property text $contenue
 * @property string $categories
 * @property string $image
 * @property tinyInteger $publier
 * @property string $redacteur
*/
class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['titre', 'contenue', 'image', 'publier', 'categories_id', 'redacteur_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoriesIdAttribute($input)
    {
        $this->attributes['categories_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRedacteurIdAttribute($input)
    {
        $this->attributes['redacteur_id'] = $input ? $input : null;
    }
    
    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id')->withTrashed();
    }
    
    public function tag_id()
    {
        return $this->belongsToMany(Tag::class, 'article_tag')->withTrashed();
    }
    
    public function redacteur()
    {
        return $this->belongsTo(User::class, 'redacteur_id');
    }
    
}
