<?php
declare(strict_types=1);

namespace App\Repositories\Blog\Posts;

use App\Models\Blog\BlogPost as Model;
use App\Repositories\CoreRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для работы с постами.
 *
 * Class PostAdminCategoryRepository
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }


    /**
     * Вернуть страницы с пагинацией, c ленивой подгрузкой связей.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginator(int $perPage): LengthAwarePaginator
    {
        $fields = [
            'id', 'user_id', 'category_id',
            'title', 'slug', 'content_raw',
            'excerpt', 'is_published', 'published_at'
        ];

        return $this->startConditions()
            ->select($fields)
            ->with([
                'category:id,title',
                'user:id,name',
            ])
            ->latest()
            ->paginate($perPage);
    }


    /**
     * Получить модель для редактирования в админке.
     *
     * @param int $id
     * @return Model
     */
    public function getEdit(int $id): Model
    {
        return $this->startConditions()->findOrFail($id);
    }


    /**
     * Получить все не опубликованные записи.
     *
     * @return Collection
     */
    public function getUnpublishedPosts(): Collection
    {
        return $this->startConditions()
            ->select()
            ->where('is_published', '=', 0)
            ->whereNotNull('published_at')
            ->get();
    }
}
