<ul class="navbar-nav w-100 d-block py-2 p-lg-0 d-lg-flex align-items-center justify-content-center">
    @foreach ($menu_nodes as $key => $row)
        <?php if ($row->hasChild()) : ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-uppercase px-4" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $row->getRelated()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    {!! Menu::generateMenu([
                    'slug' => $menu->slug,
                    'parent_id' => $row->id,
                    ]) !!}
                </div>
            </li>
        <?php else: ?>
        <li class="nav-item ">
            <a class="nav-link text-uppercase px-4" href="{{ $row->getRelated()->url }}">{{ $row->getRelated()->name }}</a>
        </li>
        <?php endif;?>
    @endforeach
</ul>
