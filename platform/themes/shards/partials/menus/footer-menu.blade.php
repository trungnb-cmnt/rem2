<ul class="menu-about">
    @foreach ($menu_nodes as $key => $row)
    <li class="@if ($row->getRelated()->url == Request::url()) active @endif pb-2">
        <a href="{{ $row->getRelated(true)->url }}" class="text-uppercase">{{ $row->getRelated()->name }}</a>
        @if ($row->hasChild())
        {!! Menu::generateMenu([
        'slug' => $menu->slug,
        'parent_id' => $row->id,
        'options' => ['id="about-sub-menu"'],
        ]) !!}
        @endif
    </li>
    @endforeach
</ul>