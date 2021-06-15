<?php
declare(strict_types=1);

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\Blog\BlogPostUpdate;
use App\Services\Blog\PostServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер редактирование статей блога.
 *
 * Class PostAdminController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostAdminController extends BaseAdminController
{
    /** @var PostServices */
    private $postServices;

    private const   SAVED_SUCCESSFULLY = 'Сохранено успешно';
    private const   SAVED_ERROR_REPORT = 'Ошибка сохранения';

    private const   DELETE_SUCCESSFULLY = 'Удаленно успешно';
    private const   DELETE_ERROR_REPORT = 'Ошибка удаления';


    /**
     * PostController constructor.
     * @param PostServices|null $postServices
     */
    public function __construct(?PostServices $postServices = null)
    {
        $this->postServices = $postServices ?? new PostServices();
    }


    /**
     * Список всех новостей на редактирование.
     *
     * @return View
     */
    public function index(): View
    {
        $allNews = $this->postServices->getAllNews();

        return view('blog.admin.post.index', compact('allNews'));
    }


    /**
     * Создание новости.
     *
     * @return View
     */
    public function create(): view
    {
        $freshNews = $this->postServices->getDataForCreate();

        return view('blog.admin.post.create', compact('freshNews'));
    }


    /**
     * Сохраняет посты.
     *
     * @param BlogPostUpdate $request
     * @return RedirectResponse
     */
    public function store(BlogPostUpdate $request):RedirectResponse
    {
        $newNews = $this->postServices->saveNews($request);

        if ($newNews) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => self::SAVED_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::SAVED_ERROR_REPORT])
            ->withInput();
    }


    /**
     * Показать новость.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $news = $this->postServices->showNews($id);

        return view('blog.admin.post.show', compact('news'));
    }

    /**
     * Вид редактирования новсти.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $dataForEdit = $this->postServices->getDataForEdit($id);

        return view('blog.admin.post.edit', compact('dataForEdit'));
    }


    /**
     * Запрос на обновление новости.
     *
     * @param BlogPostUpdate $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdate $request, int $id): RedirectResponse
    {
        $newNews = $this->postServices->updateNews($request, $id);

        if ($newNews) {
            return redirect()
                ->route('blog.admin.posts.show', $id)
                ->with(['success' => self::SAVED_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::SAVED_ERROR_REPORT])
            ->withInput();
    }

    /**
     * Удаление записи.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $result = $this->postServices->deleteNews($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => self::DELETE_SUCCESSFULLY]);
        }

        return back()
            ->withErrors([self::DELETE_ERROR_REPORT])
            ->withInput();
    }
}
