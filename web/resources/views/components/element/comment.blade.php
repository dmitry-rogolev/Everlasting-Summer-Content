<div class="toast show bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} {{ $class }}" style="{{ $style }}" id="comment_{{ $comment->id }}" {{ $attributes }}>
    <div class="toast-header bg-{{ $theme }}">
        <x-element.flex flex="align-items-center">
            <a href="{{ url($user->id . '/profile') }}" class="mr-3">
                <x-element.form.button class="btn-{{ $theme }}">
                    <x-element.flex flex="align-items-center">
                        @if ($user->avatar)
                            <img src="/storage/avatars/{{ $user->id }}/{{ $user->avatar->title }}.{{ $user->avatar->extension }}" class="img-fluid rounded-circle mr-3" width="35" height="40" />
                        @endif
                        <strong>{{ $user->name }}</strong>
                    </x-element.flex>
                </x-element.form.button>
            </a>
            <x-element.modal.button class="btn-secondary mr-3" target="#{{ $add->get('id') }}">
                {{ __("page.content.to-comment") }}
            </x-element.modal.button>
            <x-element.modal id="{{ $add->get('id') }}" labelledby="{{ $add->get('labelledby') }}">
                <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . $content->title . '/' . $comment->id . '/comment') }}" method="POST">
                    @csrf
                    <x-element.modal.header class="border-bottom-0">
                        <x-element.modal.title id="{{ $add->get('labelledby') }}">
                            {{ __("page.content.to-comment") }}
                        </x-element.modal.title>
                        <x-element.modal.quit />
                    </x-element.modal.header>
                    <x-element.modal.body>
                        <x-element.form.group>
                            <x-element.form.textarea name="comment" class="bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" style="height: 100px;" placeholder="{{ __('page.content.comment') }}" label="{{ __('page.content.comment') }}" autocomplete="off" spellcheck required></x-element.form.textarea>
                        </x-element.form.group>
                    </x-element.modal.body>
                    <x-element.modal.footer class="border-top-0">
                        <x-element.modal.close>
                            {{ __('element.modal.close') }}
                        </x-element.modal.close>
                        <x-element.modal.save type="submit">
                            {{ __("element.modal.save") }}
                        </x-element.modal.save>
                    </x-element.modal.footer>
                </form>
            </x-element.modal>
            @if ($comment->comments()->count())
                <x-element.form.button class="drop text-{{ $inversion_themes->get($theme) }}" onclick="this.classList.toggle('active')" data-toggle="collapse" data-target="#{{ $id }}" aria-controls="{{ $id }}" aria-expanded="false">
                    <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
                        {{ $comment->comments()->count() . " " . __("page.content.comments-count") }}
                    </div>
                </x-element.form.button>
            @else 
                <x-element.form.button class="drop text-{{ $inversion_themes->get($theme) }}" data-toggle="collapse" data-target="#{{ $id }}" aria-controls="{{ $id }}" aria-expanded="false">
                    <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
                        {{ $comment->comments()->count() . " " . __("page.content.comments-count") }}
                    </div>
                </x-element.form.button>
            @endif
            <span class="text-secondary ml-auto">{{ __("page.content.created") . ": " . $comment->created_at . "." }}</span>
            @if ($comment->updated_at != $comment->created_at)
                <span class="text-secondary ml-2">{{ __("page.content.changed") . ": " . $comment->updated_at . "." }}</span>
            @endif
        </x-element.flex>
    </div>
    <div class="toast-body">
        {{ $comment->comment }}
    </div>
    <div class="toast-footer">
        <x-element.flex flex="align-items-center">
            @auth 
                @if ($comment->user_id == request()->user()->id)
                    <div class="m-2">
                        <x-element.modal.button class="btn-secondary" target="#{{ $add->get('id') }}">
                            {{ __("page.content.change-comment") }}
                        </x-element.modal.button>
                        <x-element.modal id="{{ $add->get('id') }}" labelledby="{{ $add->get('labelledby') }}">
                            <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . $content->title . '/' . $comment->id . '/change-comment') }}" method="POST">
                                @csrf
                                <x-element.modal.header class="border-bottom-0">
                                    <x-element.modal.title id="{{ $add->get('labelledby') }}">
                                        {{ __("page.content.change-comment") }}
                                    </x-element.modal.title>
                                    <x-element.modal.quit />
                                </x-element.modal.header>
                                <x-element.modal.body>
                                    <x-element.form.group>
                                        <x-element.form.textarea name="comment" class="bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" style="height: 100px;" placeholder="{{ __('page.content.comment') }}" label="{{ __('page.content.comment') }}" autocomplete="off" spellcheck required>{{ $comment->comment }}</x-element.form.textarea>
                                    </x-element.form.group>
                                </x-element.modal.body>
                                <x-element.modal.footer class="border-top-0">
                                    <x-element.modal.close>
                                        {{ __('element.modal.close') }}
                                    </x-element.modal.close>
                                    <x-element.modal.save type="submit">
                                        {{ __("element.modal.save") }}
                                    </x-element.modal.save>
                                </x-element.modal.footer>
                            </form>
                        </x-element.modal>
                    </div>
                @endif
            @endauth
            @auth
                <div class="m-2">
                    <x-element.modal.button class="btn-danger" target="#{{ $remove->get('id') }}">
                        {{ __("page.content.remove") }}
                    </x-element.modal.button>
                    <x-element.modal id="{{ $remove->get('id') }}" labelledby="{{ $remove->get('labelledby') }}">
                        <form action="{{ url($user->id . '/' . ($path ? $path . '/' : $path) . $content->title . '/' . $comment->id . '/remove-comment') }}" method="POST">
                            @csrf
                            <x-element.modal.header class="border-bottom-0">
                                <x-element.modal.title id="{{ $remove->get('labelledby') }}">
                                    {{ __("page.content.remove") }}
                                </x-element.modal.title>
                                <x-element.modal.quit />
                            </x-element.modal.header>
                            <x-element.modal.body>
                                <p>
                                    {{ __("page.content.remove-comment-text") }}
                                </p>
                            </x-element.modal.body>
                            <x-element.modal.footer class="border-top-0">
                                <x-element.modal.close>
                                    {{ __('element.modal.close') }}
                                </x-element.modal.close>
                                <x-element.modal.save type="submit" class="btn-danger">
                                    {{ __("page.content.remove") }}
                                </x-element.modal.save>
                            </x-element.modal.footer>
                        </form>
                    </x-element.modal>
                </div>
            @endauth
        </x-element.flex>
    </div>
</div>
<div class="collapse" id="{{ $id }}">
    @foreach ($comment->comments()->get() as $sub_comment)
        <x-element.comment :user="$user" :comment="$sub_comment" :content="$content" class="col-12 py-2 my-2" path="{{ $path }}" />
    @endforeach
</div>
