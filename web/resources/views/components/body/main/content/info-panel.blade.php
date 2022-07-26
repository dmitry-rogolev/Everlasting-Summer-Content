<x-element.flex flex="justify-content-center align-items-center">
    <div class="m-2">
        <a href="{{ route('user', [ 'user' => $user->id ]) }}">
            <x-element.form.button class="btn-{{ $theme }}">
                <x-element.flex flex="align-items-center">
                    @if ($user->avatar)
                        <x-element.image src="/storage/avatars/{{ $user->id }}/{{ $user->avatar->name }}" class="rounded-circle mr-3" width="50" />
                    @endif
                    <div>
                        {{ $user->name }}
                    </div>
                </x-element.flex>
            </x-element.form.button>
        </a>
    </div>
    <div class="m-2">
        <x-element.header3>
            {{ Str::limit($content->title, 40) }}
        </x-element.header3>
    </div>
    @auth
        <div class="m-2">
            <form action="{{ route('content.like', [ 'content' => $content->id ]) }}" method="POST">
                @csrf
                <x-element.form.button type="submit" title="{{ __('page.content.like') }}">
                    <x-element.flex flex="align-items-center">
                        <div class="{{ $like ? 'like active' : 'like' }}" style="height: 50px; width: 50px;"></div>
                        <div class="badge badge-{{ $theme }}" style="font-size: 100%;">{{ $content->likes()->count() }}</div>
                    </x-element.flex>
                </x-element.form.button>
            </form>
        </div>
    @else
        <div class="m-2">
            <x-element.flex flex="align-items-center">
                <div class="{{ $like ? 'like active' : 'like' }}" style="height: 50px; width: 50px;"></div>
                <div class="badge badge-{{ $theme }}" style="font-size: 100%;">{{ $content->likes()->count() }}</div>
            </x-element.flex>
        </div>
    @endauth
    @auth
        <div class="m-2">
            <form action="{{ route('content.dislike', [ 'content' => $content->id ]) }}" method="POST">
                @csrf
                <x-element.form.button type="submit" class="{{ $dislike ? 'dislike active' : 'dislike' }}" style="height: 50px; width: 50px;" title="{{ __('page.content.dislike') }}"></x-element.form.button>
            </form>
        </div>
    @endauth
    @auth 
        <div class="m-2">
            <form action="{{ route('content.favorite', [ 'content' => $content->id ]) }}" method="POST">
                @csrf 
                <x-element.form.button type="submit" class="{{ $favorite ? 'favorite active' : 'favorite' }}" style="height: 50px; width: 50px;" title="{{ $favorite ? __('page.favorite.out') : __('page.favorite.in') }}"></x-element.form.button>
            </form>
        </div>
    @endauth
    <div class="m-2">
        <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
            {{ $content->views()->count() . " " . __("page.content.views") }}
        </div>
    </div>
    <div class="m-2">
        <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
            {{ $content->downloads()->count() . " " . __("page.content.downloads") }}
        </div>
    </div>
    <div class="m-2">
        <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
            {{ $content->comments()->count() . " " . __("page.content.comments-count") }}
        </div>
    </div>
</x-element.flex>
@if ($content->description)
    <div class="col-12 bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} shadow-lg p-3 my-2" style="border-radius: 15px;">
        <h5>{{ __("page.content.description") }}</h5>
        <p>{{ $content->description }}</p>
    </div>
@endif