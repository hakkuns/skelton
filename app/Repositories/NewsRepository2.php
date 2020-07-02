<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class NewsRepository2 extends BaseRepository implements NewsRepositoryInterface
{
  //  use UploadableTrait, ProductTransformable;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
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
    public function list(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->xxxxxxxx($order, $sort)->get()->except($except);
    }

}
