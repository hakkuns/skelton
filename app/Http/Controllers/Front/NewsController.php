<?php

namespace App\Http\Controllers\Front;

use App\Repositories\NewsRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * CategoryController constructor.
     *
     * @param NewsRepositoryInterface $categoryRepository
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepo = $newsRepository;
    }

    /**
     * @param string $slug
     * @return \App\Models\Category
     */
    public function show()
    {

        $news = $this->newsRepo->list();
        return view('front.news.index', [
            'news' => $news
        ]);
    }
}
