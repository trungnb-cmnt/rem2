<div>
    <h3>{{ $product->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $product->name }}</h3>
    <div>
        @if (!$product->categories->isEmpty())
            <span>
                <a href="{{ route('public.single', $product->categories->first()->slug) }}">{{ $product->categories->first()->name }}</a>
            </span>
        @endif
        <span><a href="#">{{ date_from_database($product->created_at, 'M d, Y') }}</a></span>
        <span><a href="{{ route('public.author', $product->user->username) }}">{{ $product->user->getFullName() }}</a></span>

        @if (!$product->tags->isEmpty())
            <span>
                @foreach ($product->tags as $tag)
                    <a href="{{ route('public.single', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
            </span>
        @endif
    </div>
</header>
{!! $product->content !!}
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}
<footer>
    @foreach (get_related_posts($product->slug, 2) as $related_item)
        <div>
            <article>
                <div><a href="{{ route('public.single', $related_item->slug) }}"></a>
                    <img src="{{ url($related_item->image) }}" alt="{{ $related_item->name }}">
                </div>
                <header><a href="{{ route('public.single', $related_item->slug) }}"> {{ $related_item->name }}</a></header>
            </article>
        </div>
    @endforeach
</footer>
