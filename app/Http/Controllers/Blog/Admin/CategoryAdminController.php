<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\Blog\BlogCategoryUpdate;
use App\Services\Blog\CategoryServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер упралвления категориями.
 *
 * Class CategoryAdminController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryAdminController extends BaseAdminController
{
    /** @var CategoryServices */
    private $categoryServices;

    private const   SAVED_SUCCESSFULLY = 'Сохранено успешно';
    private const   SAVED_ERROR_REPORT = 'Ошибка сохранения';

    private const   DELETE_SUCCESSFULLY = 'Удаленно успешно';
    private const   DELETE_ERROR_REPORT = 'Ошибка удаления';


    /**
     * CategoryAdminController constructor.
     * @param \App\Services\Blog\CategoryServices|null $categoryServices
     */
    public function __construct(?CategoryServices $categoryServices = null)
    {
        $this->categoryServices = $categoryServices ?? new CategoryServices();
    }


    /**
     * Вывести список всех категорий.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryServices->getCategories();

        return view('blog.admin.category.index', compact('categories'));
    }


    /**
     * Создание категории.
     *
     * @return View
     */
    public function create(): View
    {
        $freshCategory = $this->categoryServices->createCategory();

        return view('blog.admin.category.create', compact('freshCategory'));
    }


    /**
     * Сохраняем новую категорию.
     *
     * @param BlogCategoryUpdate $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryUpdate $request): RedirectResponse
    {
        $result = $this->categoryServices->saveCategory($request);

        if ($result) {
            return redirect()
                ->route('blog.admin.category.index')
                ->with(['success' => self::SAVED_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::SAVED_ERROR_REPORT])
            ->withInput();
    }


    /**
     * Показать конкретную статью.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $category = $this->categoryServices->categoryShow($id);

        return view('blog.admin.category.show',
            compact('category'));
    }


    /**
     * Вид для редактирования категории.
     *
     * @param $id
     * @return View
     */
    public function edit($id): view
    {
        $dataForEdit  = $this->categoryServices->getDataForEdit($id);

        return view('blog.admin.category.edit',
            compact('dataForEdit'));

    }


    /**
     * Обновление категории.
     *
     * @param BlogCategoryUpdate $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdate $request, int $id): RedirectResponse
    {
        $result = $this->categoryServices->updateCategory($request, $id);

        if ($result) {
            return redirect()
                ->route('blog.admin.category.index')
                ->with(['success' => self::SAVED_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::SAVED_ERROR_REPORT])
            ->withInput();
    }


    /**
     * Удаление сущности.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $result = $this->categoryServices->deleteCategory($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.category.index')
                ->with(['success' => self::DELETE_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::DELETE_ERROR_REPORT])
            ->withInput();
    }
}
