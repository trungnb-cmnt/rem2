<?php

namespace Botble\Catalog\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Catalog\Forms\ProductForm;
use Botble\Catalog\Http\Requests\ProductRequest;
use Botble\Catalog\Models\Product;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Catalog\Tables\ProductTable;
use Botble\Catalog\Services\StoreCategoryService;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class ProductController extends BaseController
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
     * @param ProductInterface $productRepository
     * @param CategoryInterface $categoryRepository
     * @author Sang Nguyen
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ProductTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Sang Nguyen
     * @throws \Throwable
     */
    public function getList(ProductTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/catalog::products.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     * @author Sang Nguyen
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/catalog::products.create'));

        return $formBuilder->create(ProductForm::class)->renderForm();
    }

    /**
     * @param ProductRequest $request
     * @param StoreCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function postCreate(
        ProductRequest $request,
        StoreCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        /**
         * @var Product $product
         */
        $product = $this->productRepository->createOrUpdate(array_merge($request->input(), [
            'author_id'   => Auth::user()->getKey(),
            'is_featured' => $request->input('is_featured', false),
        ]));

        event(new CreatedContentEvent(CATALOG_PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        $categoryService->execute($request, $product);

        return $response
            ->setPreviousUrl(route('catalog_products.list'))
            ->setNextUrl(route('catalog_products.edit', $product->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     * @author Sang Nguyen
     */
    public function getEdit($id, FormBuilder $formBuilder, Request $request)
    {
        $post = $this->productRepository->findOrFail($id);

        event(new BeforeEditContentEvent(CATALOG_PRODUCT_MODULE_SCREEN_NAME, $request, $post));

        page_title()->setTitle(trans('plugins/catalog::products.edit') . ' #' . $id);

        return $formBuilder->create(ProductForm::class, ['model' => $post])->renderForm();
    }

    /**
     * @param int $id
     * @param ProductRequest $request
     * @param StoreCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function postEdit(
        $id,
        ProductRequest $request,
        StoreCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        $post = $this->productRepository->findOrFail($id);

        $post->fill($request->input());
        $post->is_featured = $request->input('is_featured', false);

        $this->productRepository->createOrUpdate($post);

        event(new UpdatedContentEvent(CATALOG_PRODUCT_MODULE_SCREEN_NAME, $request, $post));

        $categoryService->execute($request, $post);

        return $response
            ->setPreviousUrl(route('catalog_products.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $product = $this->productRepository->findOrFail($id);
            $this->productRepository->delete($product);

            event(new DeletedContentEvent(CATALOG_PRODUCT_MODULE_SCREEN_NAME, $request, $product));

            return $response
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @author Sang Nguyen
     * @throws Exception
     */
    public function postDeleteMany(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $product = $this->productRepository->findOrFail($id);
            $this->productRepository->delete($product);
            event(new DeletedContentEvent(CATALOG_PRODUCT_MODULE_SCREEN_NAME, $request, $product));
        }

        return $response
            ->setMessage(trans('core/base::notices.delete_success_message'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws \Throwable
     * @author Sang Nguyen
     */
    public function getWidgetRecentProducts(Request $request, BaseHttpResponse $response)
    {
        $limit = $request->input('paginate', 10);
        $products = $this->productRepository->getModel()
            ->orderBy('products.created_at', 'desc')
            ->paginate($limit);

        return $response
            ->setData(view('plugins/catalog::products.widgets.products', compact('products', 'limit'))->render());
    }
}
