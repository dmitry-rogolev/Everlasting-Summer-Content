@if (session("status"))
    <x-element.alert class="alert-info">
        {{ session("status") }}
    </x-element.alert>
@endif