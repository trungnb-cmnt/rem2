<?php

namespace Botble\SeoHelper;

use Botble\Catalog\Models\Product;
use Botble\Blog\Models\Post;

class SeoLdJson
{
    protected $breadCrumbs;
    protected $post;
    protected $product;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    public function getBreadCrumbs()
    {
        return $this->breadCrumbs;
    }

    public function setBreadCrumbs($breadCrumbs)
    {
        $this->breadCrumbs = $breadCrumbs;
    }

    public function renderBreadcrumbLdJson($breadCrumbs = null)
    {
        if ($breadCrumbs) return view('packages/seo-helper::breadcrumb-ldjson', compact('breadCrumbs'));
        return null;
    }

    /**
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderPostLdJson(Post $post = null)
    {
        if ($post) return view('packages/seo-helper::post-ldjson', compact('post'));
        return null;
    }

    public function renderProductLdJson($product = null)
    {
        if ($product) return view('packages/seo-helper::product-ldjson', compact('product'));
        return null;
    }

    public function renderContactLdJson()
    {
        return view('packages/seo-helper::contact-ldjson');
    }

    /**
     * Render all seo tags.
     *
     * @return string
     */
    public function render()
    {
        return implode(PHP_EOL, array_filter([
            $this->renderBreadcrumbLdJson($this->getBreadCrumbs()),
            $this->renderPostLdJson($this->getPost()),
            $this->renderProductLdJson($this->getProduct()),
            $this->renderContactLdJson(),
        ]));
    }

    /**
     * Render all seo tags.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function __toString()
    {
        return $this->render();
    }
}
