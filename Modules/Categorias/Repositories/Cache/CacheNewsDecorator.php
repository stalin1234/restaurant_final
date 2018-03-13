<?php

namespace Modules\Categorias\Repositories\Cache;

use Modules\Categorias\Repositories\NewsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheNewsDecorator extends BaseCacheDecorator implements NewsRepository
{
    public function __construct(NewsRepository $news)
    {
        parent::__construct();
        $this->entityName = 'categorias.news';
        $this->repository = $news;
    }
}
