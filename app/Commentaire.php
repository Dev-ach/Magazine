<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Commentaire
 *
 * @package App
 * @property string $pseudo
 * @property string $email
 * @property string $commentaire
 * @property tinyInteger $valider
 * @property string $article
*/
class Commentaire extends Model
{
    use SoftDeletes;

    protected $fillable = ['pseudo', 'email', 'commentaire', 'valider', 'article_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setArticleIdAttribute($input)
    {
        $this->attributes['article_id'] = $input ? $input : null;
    }
    
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id')->withTrashed();
    }
    
}
