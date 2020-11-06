<?php

namespace Botble\Catalog\Listeners;

use Botble\Catalog\Enum\StatusEnum;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use JsonFeedManager;

class RenderingJsonFeedListener
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
        $products = $this->productRepository->getAllProducts(true);

        foreach ($products as $product) {
            JsonFeedManager::addItem('posts', [
                'id'             => $product->id,
                'title'          => $product->name,
                'url'            => route('public.single', $product->slug),
                'image'          => $product->image,
                'content_html'   => $product->content,
                'date_published' => $product->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $product->updated_at->tz('UTC')->toRfc3339String(),
                'author'         => [
                    'name' => $product->author ? $product->author->name : null,
                ],
            ]);
        }

        $categories = $this->categoryRepository->getAllCategories(['status' => StatusEnum::PUBLISHED]);

        foreach ($categories as $category) {
            JsonFeedManager::addItem('categories', [
                'id'             => $category->id,
                'title'          => $category->name,
                'url'            => route('public.single', $category->slug),
                'image'          => null,
                'content_html'   => $category->description,
                'date_published' => $category->created_at->tz('UTC')->toRfc3339String(),
                'date_modified'  => $category->updated_at->tz('UTC')->toRfc3339String(),
            ]);
        }
    }
}
