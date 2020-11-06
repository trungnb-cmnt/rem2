<?php

namespace Botble\Catalog\Listeners;

use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use SiteMapManager;

class RenderingSiteMapListener
{
    /**
     * @var ProductInterface
     */
    protected $productRepository;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param ProductInterface $productRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     * @author Sang Nguyen
     */
    public function handle()
    {
        $products = $this->productRepository->getDataSiteMap();

        foreach ($products as $product) {
            SiteMapManager::add(route('public.single', $product->slug), $product->updated_at, '0.8', 'daily');
        }

        // get all categories from db
        $categories = $this->categoryRepository->getDataSiteMap();

        // add every category to the site map
        foreach ($categories as $category) {
            SiteMapManager::add(route('public.single', $category->slug), $category->updated_at, '0.8', 'daily');
        }
    }
}
