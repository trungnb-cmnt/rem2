<div {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <div class="col-12 col-md-4 col-lg-3 col-xl-2dot4 nav-item">
            <h2 class="heading">
                <a href="{{ $row->getRelated()->url }}" target="{{ $row->target }}" class="nav-link">
                    {{ $row->getRelated()->name }}
                </a>
            </h2>
            @if ($row->hasChild())
                {!!
                    Menu::generateMenu([
                        'slug' => $menu->slug,
                        'view' => 'menus.main-sub',
                        'options' => ['class' => ''],
                        'parent_id' => $row->id,
                    ])
                !!}
            @endif
        </div>
    @endforeach
</div>