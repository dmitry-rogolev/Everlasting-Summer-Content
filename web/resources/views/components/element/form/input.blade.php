@if ($label) 
    <label for="{{ $id }}">
        {!! $label !!}
    </label>
@endif
<input {{ $attributes }} class="form-control {{ $class }}" id="{{ $id }}" @if ($small) aria-describedby="{{ $aria }}" @endif />
@if ($small)
    <small id="{{ $aria }}" class="form-text text-muted">
        {!! $small !!}
    </small>
@endif