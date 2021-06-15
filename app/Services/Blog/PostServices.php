<?php
declare(strict_types=1);

namespace App\Services\Blog;

use App\Http\Requests\Blog\BlogPostUpdate;
use App\Models\Blog\BlogPost;
use App\Presenters\Blog\Post\AuxiliaryData;
use App\Presenters\Blog\Post\PostEditPresenter;
use App\Repositories\Blog\Categories\BlogCategoryRepository;
use App\Repositories\Blog\Posts\BlogPostRepository;
use App\Repositories\Users\UserRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для работы взаимодействия пользователей с новостями
 *
 * Class BlogServices
 * @package App\Services\Blog
 */
class PostServices
{

    private const PUBLISH = 1;

    private const DEFAULT_PAGINATION_PAGES = 10;

    /** @var BlogPostRepository */
    private $blogPostRepository;

    /** @var BlogCategoryRepository */
    private $blogCategoryRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var BlogPost */
    private $blogPost;

    /**
     * BlogServices constructor.
     */
    public function __construct()
    {
        $this->blogPostRepository = new BlogPostRepository();
        $this->blogCategoryRepository = new BlogCategoryRepository();
        $this->userRepository = new UserRepository();
        $this->blogPost = new BlogPost();
    }


    /**
     * Получение всех записей.
     *
     * @return LengthAwarePaginator
     */
    public function getAllNews(): LengthAwarePaginator
    {
        return $this->blogPostRepository
            ->getAllWithPaginator(self::DEFAULT_PAGINATION_PAGES);
    }


    /**
     * Показать новость.
     *
     * @param int $id
     * @return BlogPost
     */
    public function showNews(int $id): BlogPost
    {
        try {
            return $this->blogPostRepository->getEdit($id);
        } catch (Exception $ex) {
            $ex->getMessage();// залогирую
            abort(404);
        }
    }


    /**
     * Получаем дополнительные данные к новости.
     *
     * @return AuxiliaryData
     */
    public function getAuxiliaryData(): AuxiliaryData
    {
        return new AuxiliaryData(
            $this->blogCategoryRepository->getAllCategories(),
            $this->userRepository->getAllUsers()
        );
    }


    /**
     * Данные для редактирования.
     *
     * @param int $id
     * @return PostEditPresenter
     */
    public function getDataForEdit(int $id): PostEditPresenter
    {
        return new PostEditPresenter($this->showNews($id), $this->getAuxiliaryData());
    }


    /**
     * Данные для создания новости.
     *
     * @return PostEditPresenter
     */
    public function getDataForCreate(): PostEditPresenter
    {
        return new PostEditPresenter($this->blogPost, $this->getAuxiliaryData());
    }


    /**
     * Обновление новости.
     *
     * @param BlogPostUpdate $request
     * @param int $id
     * @return bool
     */
    public function updateNews(BlogPostUpdate $request, int $id): bool
    {
        $news = $this->showNews($id);

        return $news->update($request->all());
    }


    /**
     * @param BlogPostUpdate $request
     * @return bool
     */
    public function saveNews(BlogPostUpdate $request): bool
    {
        $this->blogPost->fill($request->all());

        return $this->blogPost->save();
    }


    /**
     * Удаление записи.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteNews(int $id): bool
    {
        $news = $this->showNews($id);

        return $news->delete();
    }


    /**
     *  Запуск процесса публикации постов.
     */
    public function startPublishingProcess(): void
    {
        try {
            $unpublishedPosts = $this->blogPostRepository->getUnpublishedPosts();

            $filteredUnpublishedPosts = $this->getFilteredUnpublishedPosts($unpublishedPosts);

            $this->updateStatusPost($filteredUnpublishedPosts);

        } catch (Exception $ex) {
            $ex->getMessage();// залогирую
        }
    }


    /**
     * Фильтруем данные к добавлению на публикацию.
     *
     * @param Collection $posts
     * @return BlogPost[]
     */
    private function getFilteredUnpublishedPosts(Collection $posts): array
    {
        $result = [];

        foreach ($posts as $value) {
            if (!(Carbon::parse($value->published_at)->unix() <= time())) {
                continue;
            }

            $result[] = $value;
        }

        return $result;
    }


    /**
     * Меняем статус неопубликованных постов.
     *
     * @param array $filteredUnpublishedPosts
     */
    private function updateStatusPost(array $filteredUnpublishedPosts): void
    {
        foreach ($filteredUnpublishedPosts as $unpublishedPost) {
            $unpublishedPost->update(['is_published' => self::PUBLISH]);
        }
    }
}
