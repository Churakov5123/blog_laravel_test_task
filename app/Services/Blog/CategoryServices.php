<?php
declare(strict_types=1);

namespace App\Services\Blog;

use App\Http\Requests\Blog\BlogCategoryUpdate;
use App\Models\Blog\BlogCategory;
use App\Presenters\Blog\Category\CategoryEditPresenter;
use App\Repositories\Blog\Categories\BlogCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для работы с категориями.
 *
 * Class CategoryServices
 * @package App\Services\Blog
 */
class CategoryServices
{
    /** @var BlogCategoryRepository */
    private $blogCategoryRepository;

    /** @var BlogCategory */
    private $blogCategory;


    /**
     * BlogServices constructor.
     */
    public function __construct()
    {
        $this->blogCategoryRepository = new BlogCategoryRepository();
        $this->blogCategory = new BlogCategory();
    }


    /**
     * Коллекция всех категорий.
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->blogCategoryRepository->getAllCategories();
    }


    /**
     * Показать категорию.
     *
     * @param int $id
     * @return BlogCategory
     */
    public function categoryShow(int $id): BlogCategory
    {
        try {
            return $this->blogCategoryRepository->getEdit($id);
        } catch (Exception $ex) {
            $ex->getMessage();// залогирую
            abort(404);
        }
    }


    /**
     * Удаление категории.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->categoryShow($id);

        return $category->delete();
    }

    /**
     * Презентер для вью содздания и редактирования категорий.
     *
     * @return CategoryEditPresenter
     */
    public function createCategory(): CategoryEditPresenter
    {
        return new CategoryEditPresenter($this->blogCategory, $this->getCategories());
    }


    /**
     * Cохранение категории.
     *
     * @param BlogCategoryUpdate $request
     * @return bool
     */
    public function saveCategory(BlogCategoryUpdate $request): bool
    {
        $category = $this->blogCategory->fill($request->all());

        return $category->save();
    }


    /**
     * Обновление категорий.
     *
     * @param BlogCategoryUpdate $request
     * @param int $id
     * @return bool
     */
    public function updateCategory(BlogCategoryUpdate $request, int $id): bool
    {
        $category = $this->categoryShow($id);

        return $category->update($request->all());
    }


    /**
     * Данные для редактирования.
     *
     * @param int $id
     * @return CategoryEditPresenter
     */
    public function getDataForEdit(int $id): CategoryEditPresenter
    {
        return new CategoryEditPresenter($this->categoryShow($id), $this->getCategories());
    }
}
