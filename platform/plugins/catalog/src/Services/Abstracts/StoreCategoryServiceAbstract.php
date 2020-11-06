<?php

namespace Botble\Catalog\Services\Abstracts;

use Botble\Catalog\Models\Product;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

abstract class StoreCategoryServiceAbstract
{
    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param CategoryInterface $categoryRepository
     * @author Sang Nguyen
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return mixed
     * @author Sang Nguyen
     */
    abstract public function execute(Request $request, Product $product);
}
