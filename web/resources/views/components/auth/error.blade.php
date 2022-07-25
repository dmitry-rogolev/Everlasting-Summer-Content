@if ($errors->any())
    <div class="my-2">
        @foreach ($errors->all() as $error)
            <x-element.alert class="alert-danger">
                {{ $error }}
            </x-element.alert>
        @endforeach
    </div>
@endif