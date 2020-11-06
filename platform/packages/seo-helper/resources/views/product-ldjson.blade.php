@if (!empty($product))
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Product",
        "name": "<?= $product->name ?>",
        "image": [
            "<?= get_object_image($product->image, 'medium')  ?>"
        ],
        "description": "<?= strip_tags($product->description) ?>",
        "sku": "<?= $product->name ?>",
        "mpn": "<?= $product->name ?>",
        "offers": {
            "@type": "Offer",
            "availability": "http://schema.org/InStock",
            <?php if ($product->price) : ?>
                "price": "<?= $product->price ?>",
            <?php else : ?>
                "price": "500.000",
            <?php endif ?>
            "priceCurrency": "VND",
            "url": "<?= route('public.single', $product->slug) ?>"
        }
        <?php if (!empty($product->primary_category_id)) : ?>
        <?php $category = get_catalog_category_by_id($product->primary_category_id) ?>
        <?php if ($category) : ?>
            ,
            "brand": {
                "@type": "Thing",
                "name": "<?= $category->name ?>"
        }
        <?php endif ?>
        <?php endif ?>
    }
</script>
@endif