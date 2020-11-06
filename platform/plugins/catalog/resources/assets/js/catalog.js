$(document).ready(() => {
    BDashboard.loadWidget($('#widget_product_recent').find('.widget-content'), route('catalog_products.widget.recent-catalog.products'));
});
