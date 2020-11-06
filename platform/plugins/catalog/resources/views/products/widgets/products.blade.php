@if ($products->count() > 0)
    <div class="scroller">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('core/base::tables.name') }}</th>
                <th>{{ trans('core/base::tables.created_at') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>@if ($product->slug) <a href="{{ route('public.single', $product->slug) }}" target="_blank">{{ Str::limit($product->name, 100) }}</a> @else <strong>{{ str_limit($product->name, 100) }}</strong> @endif</td>
                    <td>{{ date_from_database($product->created_at, 'd-m-Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($products->total() > $limit)
        <div class="widget_footer">
            @include('core.dashboard::partials.paginate', ['data' => $products, 'limit' => $limit])
        </div>
    @endif
@else
    @include('core.dashboard::partials.no-data', ['message' => trans('plugins/catalog::posts.no_new_post_now')])
@endif
