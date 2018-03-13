<?php

namespace Modules\Categorias\Repositories\Cache;

use Modules\Categorias\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'categorias.categories';
        $this->repository = $category;
    }
}
