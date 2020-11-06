<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SeoHelper;
use Theme;

class PublicController extends Controller
{

    /**
     * @var SlugInterface
     */
    protected $slugRepository;

    /**
     * PublicController constructor.
     * @param SlugInterface $slugRepository
     */
    public function __construct(SlugInterface $slugRepository)
    {
        $this->slugRepository = $slugRepository;
    }

    /**
     * @param Request $request
     * @param ProductInterface $postRepository
     * @return \Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSearch(Request $request, ProductInterface $postRepository)
    {
        $query = $request->input('q');
        SeoHelper::setTitle(__('Search result for: ') . '"' . $query . '"')
            ->setDescription(__('Search result for: ') . '"' . $query . '"');

        $products = $postRepository->getSearch($query, 0, 12);

        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Search result for: ') . '"' . $query . '"', route('public.search'));

        return Theme::scope('search', compact('products'))->render();
    }
}
