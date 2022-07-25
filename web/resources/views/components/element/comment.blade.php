<div class="toast show bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} {{ $class }}" style="{{ $style }}" id="comment_{{ $comment->id }}" {{ $attributes }}>
    <div class="toast-header bg-{{ $theme }}">
        <x-element.flex flex="align-items-center">
            <div class="mx-2">
                <a href="{{ route('user', [ 'user' => $comment->user->id ]) }}">
                    <x-element.form.button class="btn-{{ $theme }}">
                        <x-element.flex flex="align-items-center">
                            @if ($comment->user->avatar)
                                <x-element.image src="/storage/avatars/{{ $comment->user->id }}/{{ $comment->user->avatar->name }}" class="rounded-circle mr-3" width="35" height="40" />
                            @endif
                            <strong>{{ $comment->user->name }}</strong>
                        </x-element.flex>
                    </x-element.form.button>
                </a>
            </div>
            @auth
                <div class="mx-2">
                    <x-element.modal.button class="btn-secondary" target="#{{ $add->get('id') }}">
                        {{ __("page.content.to-comment") }}
                    </x-element.modal.button>
                    <x-element.modal id="{{ $add->get('id') }}" labelledby="{{ $add->get('labelledby') }}">
                        <form action="{{ route('content.comment.comment', [ 'content' => $content->id, 'comment' => $comment->id ]) }}" method="POST">
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
                </div>
            @endauth
            <div class="mx-2">
                @if ($comment->comments()->count())
                    <x-element.form.button class="drop text-{{ $inversion_themes->get($theme) }}" onclick="this.classList.toggle('active')" data-toggle="collapse" data-target="#{{ $id }}" aria-controls="{{ $id }}" aria-expanded="false">
                        <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
                            {{ $comment->comments()->count() . " " . __("page.content.comments-count") }}
                        </div>
                    </x-element.form.button>
                @else 
                    <div class="badge badge-{{ $theme }}" style="font-size: 100%;">
                        {{ $comment->comments()->count() . " " . __("page.content.comments-count") }}
                    </div>
                @endif
            </div>
            <div class="mx-2">
                <x-element.flex flex="align-items-center">
                    @auth
                        <form action="{{ route('comment.like', [ 'comment' => $comment->id ]) }}" method="POST">
                            @csrf
                            <x-element.form.button type="submit" title="{{ __('page.content.like') }}">
                                <x-element.flex flex="align-items-center">
                                    <div class="{{ $like ? 'like-inversion active' : 'like-inversion' }}" style="height: 30px; width: 30px;"></div>
                                    <div class="badge badge-{{ $theme }}" style="font-size: 100%;">{{ $comment->likes()->count() }}</div>
                                </x-element.flex>
                            </x-element.form.button>
                        </form>
                    @else
                        <x-element.flex flex="align-items-center">
                            <div class="like-inversion" style="height: 30px; width: 30px;"></div>
                            <div class="badge badge-{{ $theme }}" style="font-size: 100%;">{{ $content->likes()->count() }}</div>
                        </x-element.flex>
                    @endauth
                    @auth
                        <form action="{{ route('comment.dislike', [ 'comment' => $comment->id ]) }}" method="POST">
                            @csrf
                            <x-element.form.button type="submit" class="{{ $dislike ? 'dislike-inversion active' : 'dislike-inversion' }}" style="height: 30px; width: 30px;" title="{{ __('page.content.dislike') }}"></x-element.form.button>
                        </form>
                    @endauth
                </x-element.flex>
            </div>
            <div class="ml-auto">
                @if ($comment->updated_at == $comment->created_at)
                    <span class="text-secondary">{{ $date }}</span>
                @else
                    <span class="text-secondary ml-2">{{ __("page.content.changed") . " " . $date }}</span>
                @endif
            </div>
        </x-element.flex>
    </div>
    <div class="toast-body">
        {{ $comment->comment }}
    </div>
    <div class="toast-footer">
        <x-element.flex flex="align-items-center">
            @auth 
                @can ("show", $comment)
                    <div class="m-2">
                        <x-element.modal.button class="btn-secondary" target="#{{ $change->get('id') }}">
                            {{ __("page.content.change-comment") }}
                        </x-element.modal.button>
                        <x-element.modal id="{{ $change->get('id') }}" labelledby="{{ $change->get('labelledby') }}">
                            <form action="{{ route('comment.change', [ 'comment' => $comment->id ]) }}" method="POST">
                                @csrf
                                <x-element.modal.header class="border-bottom-0">
                                    <x-element.modal.title id="{{ $change->get('labelledby') }}">
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
                @endcan
            @endauth
            @auth
                @can ("show", $comment)
                    <div class="m-2">
                        <x-element.modal.button class="btn-danger" target="#{{ $remove->get('id') }}">
                            {{ __("page.content.remove") }}
                        </x-element.modal.button>
                        <x-element.modal id="{{ $remove->get('id') }}" labelledby="{{ $remove->get('labelledby') }}">
                            <form action="{{ route('comment.remove', [ 'comment' => $comment->id ]) }}" method="POST">
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
                @endcan
            @endauth
        </x-element.flex>
    </div>
</div>
<div class="collapse" id="{{ $id }}">
    @foreach ($comment->comments()->get() as $sub_comment)
        <x-element.comment :comment="$sub_comment" :content="$content" class="col-12 py-2 my-2" />
    @endforeach
</div>
