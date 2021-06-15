<?php
declare(strict_types=1);

namespace App\Presenters\Blog\Post;

use Illuminate\Database\Eloquent\Collection;

/**
 * Презентер AuxiliaryData.
 *
 * Class AuxiliaryData
 * @package App\Presenters\Blog
 */
class AuxiliaryData
{
    /** @var Collection */
    private $categories;

    /** @var Collection */
    private $users;


    /**
     * AuxiliaryData constructor.
     * @param Collection $categories
     * @param Collection $users
     */
    public function __construct(Collection $categories, Collection $users)
    {
        $this->categories = $categories;
        $this->users = $users;
    }


    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }


    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}
