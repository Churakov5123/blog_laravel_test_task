<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 */
class BlogCategory extends Model
{

    use SoftDeletes;

    /** @var string $table */
    protected $table = 'blog_categories';

    /** @var string[] $fillable */
    protected $fillable =
        [
            'title',
            'slug',
            'parent_id',
            'description',
        ];

    protected $dates = ['deleted_at'];
}
