<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Services\Blog\PostServices;
use Illuminate\View\View;

/**
 * Контроллер отображения новостей.
 *
 * Class PostController
 * @package App\Http\Controllers\Blog
 */
class PostController extends BaseController
{
    /** @var PostServices */
    private $blogServices;


    /**
     * PostController constructor.
     * @param PostServices|null $blogServices
     */
    public function __construct(?PostServices $blogServices = null)
    {
        $this->blogServices = $blogServices ?? new PostServices();
    }


    /**
     * Список всех новостей.
     *
     * @return View
     */
    public function index(): View
    {
        $allNews = $this->blogServices->getAllNews();

        return view('blog.post.index', compact('allNews'));
    }


    /**
     * Показать новость.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $news = $this->blogServices->showNews($id);

        return view('blog.post.show', compact('news'));
    }
}
