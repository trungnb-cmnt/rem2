<aside class="single-sidebar-widget">
    {!! Theme::partial('section-heading', ['title' => __($config['name'])]) !!}
    <div class="section-content">
        <div class="sidebar-menu">
            {!!
                Menu::generateMenu([
                    'slug' => $config['menu_id'],
                    'view' => 'menus.sidebar',
                    'options' => ['class' => 'list-unstyled']
                ])
            !!}
        </div>
    </div>
</aside>