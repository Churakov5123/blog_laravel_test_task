<?php
declare(strict_types=1);

namespace App\Presenters\Blog\Post;

use App\Models\Blog\BlogPost;

/**
 * Презентер для редактирования новости.
 *
 * Class PostEditPresenter
 * @package App\Presenters\Blog
 */
class PostEditPresenter
{
    /** @var BlogPost $news */
    private $news;

    /** @var AuxiliaryData $auxiliaryData */
    private $auxiliaryData;


    /**
     * PostEditPresenter constructor.
     * @param BlogPost $news
     * @param AuxiliaryData $auxiliaryData
     */
    public function __construct(BlogPost $news, AuxiliaryData $auxiliaryData)
    {
        $this->news = $news;
        $this->auxiliaryData = $auxiliaryData;
    }


    /**
     * @return BlogPost
     */
    public function getNews(): BlogPost
    {
        return $this->news;
    }


    /**
     * @return AuxiliaryData
     */
    public function getAuxiliaryData(): AuxiliaryData
    {
        return $this->auxiliaryData;
    }
}
