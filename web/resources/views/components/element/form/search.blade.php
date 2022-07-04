<form action="{{ route('search') }}" method="GET" class="form-inline {{ $class }}">
    <div class="input-group">
        <input name="search" type="search" placeholder="{{ __('element.form.search') }}" class="form-control bg-{{ $theme }} border-{{ $inversion_themes->get($theme) }}" autocomplete="off" required />
        <div class="input-group-append">
            <x-element.form.button type="submit" class="btn-{{ $inversion_themes->get($theme) }} search-icon" style="width: 50px;"></x-element.form.button>
        </div>
    </div>
</form>