<div {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <a href="{{ $row->getRelated()->url }}" target="{{ $row->target }}" class="nav-link">
            {{ $row->getRelated()->name }}
        </a>
    @endforeach
</div>