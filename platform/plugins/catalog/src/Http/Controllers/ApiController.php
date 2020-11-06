<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Theme;

class ApiController extends Controller
{

    /**
     * Search post
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param ProductInterface $productInterface
     * @param PageInterface $pageRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @author Sang Nguyen
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSearch(
        Request $request,
        ProductInterface $productInterface,
        PageInterface $pageRepository,
        BaseHttpResponse $response
    ) {
        $query = $request->input('q');
        if (!empty($query)) {
            $products = $productInterface->getSearch($query);
            $pages = $pageRepository->getSearch($query);

            $data = [
                'items' => [
                    'Products'  => Theme::partial('search.product', compact('products')),
                    'Pages'     => Theme::partial('search.page', compact('pages')),
                ],
                'query' => $query,
                'count' => $products->count() + $pages->count(),
            ];

            if ($data['count'] > 0) {
                return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data, 10, 1));
            }
        }

        return $response
            ->setError()
            ->setMessage(trans('core/base::layouts.no_search_result'));
    }
}
