<section {{ $attributes }} aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 shadow-lg {{ 'bg-' . $theme }}">
        @foreach($breadcrumbs as $key => $breadcrumb)
            @if ($key !== $breadcrumbs->count() - 1)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->get('url') }}">{!! Str::limit($breadcrumb->get('name'), 40) !!}</a>
                </li>
            @else 
                <li class="breadcrumb-item active" aria-current="page">
                    {!! Str::limit($breadcrumb->get('name'), 40) !!}
                </li>
            @endif
        @endforeach
    </ol>
</section>
