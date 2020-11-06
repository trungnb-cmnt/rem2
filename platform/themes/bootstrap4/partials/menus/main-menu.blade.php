<div {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <div class="col-12 col-md-4 col-lg-3 col-xl-2dot4 nav-item">
            <h2 class="heading">
                <a href="{{ $row->getRelated()->url }}" target="{{ $row->target }}" class="nav-link">
                    {{ $row->getRelated()->name }}
                </a>
            </h2>
            @if ($row->hasChild())
                @foreach ($row->child as $k => $child)
                    <a href="{{ $child->getRelated()->url }}" target="{{ $child->target }}" class="nav-link">
                        {{ $child->getRelated()->name }}
                    </a>
                @endforeach
            @endif
        </div>
    @endforeach
</div>