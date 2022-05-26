<div class="container-fluid {{ $class }}" style="{{ $style }}">
    <div class="row justify-content-between">
        <div class="col-2 p-0">
            @if ($referer !== "")
                <div class="container-fluid">
                    <div class="row justify-content-start">
                        <a href="{{ $referer }}">
                            <x-element.button theme="{{ $theme }}" name="<" title="Назад" />
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-8 p-0">
            @if ($header !== "")
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <x-element.header theme="{{ $theme }}" name="{{ $header }}" />
                    </div>
                </div>
            @endif
        </div>
        <div class="col-2 p-0">
            <div class="container-fluid">
                <div class="row justify-content-end">
                    <a href="{{ url()->current() . '/download/all' }}">
                        <x-element.button theme="{{ $theme }}" name="⤓" title="Скачать все" />
                    </a>
                </div> 
            </div>
        </div>
    </div>
</div>
