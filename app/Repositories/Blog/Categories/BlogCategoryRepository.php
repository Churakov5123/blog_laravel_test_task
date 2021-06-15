<?php
declare(strict_types=1);

namespace App\Repositories\Blog\Categories;

use App\Models\Blog\BlogCategory as Model;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для работы с категориями.
 *
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository

{
    /**
     * @return string
     */
    protected function getModelClass():string
    {
        return Model::class;
    }


    /**
     * Получить модель категорий.
     *
     * @param int $id
     * @return Model
     *
     */
    public function getEdit(int $id): Model
    {
        return $this->startConditions()->findOrFail($id);
    }


    /**
     * Получить список категорий.
     *
     * @return Collection
     */
    public function getAllCategories():Collection
    {
        return $this->startConditions()::select()->latest()->get()->unique('id');
    }

}
