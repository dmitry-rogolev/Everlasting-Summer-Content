@if ($sort)
    <x-element.flex flex="justify-content-end" {{ $attributes }}>
        <div class="m-2">
            <a href="{{ url()->current() }}/?sort={{ $sort == 'asc' ? 'desc' : 'asc' }}">
                <x-element.form.button class="btn-{{ $theme }} drop {{ $sort == 'asc' ? 'active' : '' }}" title="{{ $sort == 'asc' ? __('element.sort.up') : __('element.sort.down') }}"></x-element.form.button>
            </a>
        </div>
    </x-element.flex>
@endif