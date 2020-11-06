<?php
$cart = Cart::getContent();
?>
<ul class="navbar-nav w-100">
    @foreach ($menu_nodes as $key => $row)
        <li class="nav-item px-5 @if ($row->getRelated()->url == Request::url()) active @endif @if ($row->hasChild()) position-relative sub-active  @endif"
            <?php if ($row->hasChild()) : ?> data-toggle="collapse" data-target="#sub-menu" <?php endif; ?>>
            <a href="{{ $row->getRelated()->url }}" class="nav-link text-uppercase"
               target="{{ $row->target }}">{{ $row->getRelated()->name }}</a>
            @if ($row->hasChild())
                <i class="icon-down-product"></i>
                {!! Menu::generateMenu([
                    'slug' => $menu->slug,
                    'parent_id' => $row->id,
                    'options' => ['class="sub-menu collapse" id="sub-menu"'],
                ]) !!}
            @endif
        </li>
    @endforeach
    <li class="pl-5 pl-xl-4">
        <a href="/cart">
            <span class="fas fa-cart-plus pr-2 cart-icon">
                <span class="itemCart" id="itemCart">
                    @if(isset($cart))
                        {{ count($cart) }}
                    @endif
                </span>
            </span>
        </a>
    </li>
</ul>
