<section id="{{ $id }}" class="{{ $class }}" style="{{ $style }}" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 shadow-lg {{ 'bg-' . $theme }}">
        @foreach($breadcrumbs as $name => $link)
            @if ($name !== $breadcrumbs->keys()->last())
                <li class="breadcrumb-item">
                    <a href="{{ $link }}">{{ $name }}</a>
                </li>
            @else 
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $name }}
                </li>
            @endif
        @endforeach
    </ol>
</section>
