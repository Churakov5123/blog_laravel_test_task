<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models
 */
class BlogPost extends Model
{
    use SoftDeletes;

    /** @var string $table */
    protected $table = 'blog_posts';

    /** @var string[] $fillable */
    protected $fillable =
        [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
            'user_id',
            'is_published',
        ];

    protected $dates = ['deleted_at'];

    /**
     * Cвязь с категорией.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Blog\BlogCategory');
    }


    /**
     * Связь с пользователями/авторами.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
