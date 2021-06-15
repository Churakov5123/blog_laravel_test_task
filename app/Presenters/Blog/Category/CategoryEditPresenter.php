<?php
declare(strict_types=1);

namespace App\Presenters\Blog\Category;

use App\Models\Blog\BlogCategory;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryEditPresenter
 * @package App\Presenters\Blog\Category
 */
class CategoryEditPresenter
{
    /** @var BlogCategory */
    private $category;

    /** @var Collection */
    private $categories;


    /**
     *
     * CategoryEditPresenter constructor.
     * @param BlogCategory $category
     * @param Collection $categories
     */
    public function __construct(BlogCategory $category, Collection $categories)
    {
        $this->category = $category;
        $this->categories = $categories;
    }


    /**
     * @return BlogCategory
     */
    public function getCategory(): BlogCategory
    {
        return $this->category;
    }


    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }
}
