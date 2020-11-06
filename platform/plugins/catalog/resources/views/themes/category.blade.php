<div>
    <h3>{{ $category->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<div>
    @if ($products->count() > 0)
        @foreach ($products as $product)
            <article>
                <div>
                    <a href="{{ route('public.single', $product->slug) }}"><img src="{{ url($product->image) }}" alt="{{ $product->name }}"></a>
                </div>
                <div>
                    <header>
                        <h3><a href="{{ route('public.single', $product->slug) }}">{{ $product->name }}</a></h3>
                        <div><span><a href="#">{{ date_from_database($product->created_at, 'M d, Y') }}</a></span><a href="{{ route('public.author', $product->user->username) }}">{{ $product->user->getFullName() }}</a> - <a href="{{ route('public.single', $category->slug) }}">{{ $category->name }}</a></div>
                    </header>
                    <div>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </article>
        @endforeach
        <div>
            {!! $products->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
