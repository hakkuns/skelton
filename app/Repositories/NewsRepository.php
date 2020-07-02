<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Support\Collection;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public function __construct(News $news)
    {
        parent::__construct($news);
        $this->model = $news;
    }

    /**
     * List all the categories
     *
     * @param string $order
     * @param string $sort
     * @param array $except
     * @return \Illuminate\Support\Collection
     */

    public function list(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->all($columns, $order, $sort);
    }
}
