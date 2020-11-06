@php
    /**
     * @var string $value
     */
    $value = isset($value) ? (array)$value : [];
@endphp
@if($catalog_categories)
    <ul>
        @foreach($catalog_categories as $category)
            @if($category->id != $currentId)
                <li value="{{ $category->id ?? '' }}"
                    {{ $category->id == $value ? 'selected' : '' }}>
                    {!! Form::customCheckbox([
                        [
                            $name, $category->id, $category->indent_text . $category->name, in_array($category->id, $value),
                        ]
                    ]) !!}
                    @include('plugins/catalog::categories.partials._categories-checkbox-option-line', [
                        'catalog_categories' => $category->child_cats,
                        'value' => $value,
                        'currentId' => $currentId,
                        'name' => $name
                    ])
                </li>
            @endif
        @endforeach
    </ul>
@endif
