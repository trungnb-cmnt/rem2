<?php

namespace Botble\Catalog\Services;

use Botble\Catalog\Models\Product;
use Botble\Catalog\Services\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{

    /**
     * @param Request $request
     * @param Product $product
     * @author Sang Nguyen
     * @return mixed|void
     */
    public function execute(Request $request, Product $product)
    {
        $categories = $request->input('categories');
        if (!empty($categories)) {
            $product->categories()->detach();
            foreach ($categories as $category) {
                $product->categories()->attach($category);
            }
        }
    }
}
