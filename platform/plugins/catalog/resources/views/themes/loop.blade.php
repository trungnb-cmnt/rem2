@foreach ($products as $product)
    <div>
        <article>
            <div><a href="{{ route('public.single', $product->slug) }}"></a>
                <img src="{{ url($product->image) }}" alt="{{ $product->name }}">
            </div>
            <header><a href="{{ route('public.single', $product->slug) }}"> {{ $product->name }}</a></header>
        </article>
    </div>
@endforeach

<div class="pagination">
    {!! $products->links() !!}
</div>
