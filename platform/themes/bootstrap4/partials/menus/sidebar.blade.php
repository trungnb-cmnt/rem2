<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li>
            <a href="{{ $row->getRelated(true)->url }}" target="{{ $row->target }}">
                <span>
                    <span class="circle-dot">&nbsp;</span>
                    {{ $row->getRelated(true)->name }}
                </span>
            </a>
        </li>
    @endforeach
</ul>
