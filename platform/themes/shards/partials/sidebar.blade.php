<?php $categories = get_catalog_categories();?>
<?php if(!empty($categories)): ?>
    <div class="left-sidebar">
        <div class="category py-3">
            <h2 class="text-uppercase mb-0">Danh mục sản phẩm</h2>
        </div>
        <?php foreach ($categories as $key => $category): ?>
            <div class="list-category">
                <a href="{{ url($category->slug) }}"><span class="icon-next"></span>{{ $category->name }}</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>