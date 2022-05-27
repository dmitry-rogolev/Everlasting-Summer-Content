<!DOCTYPE html>
<html lang="ru">
    <x-head theme="{{ $theme }}" title="{{ $title }}" />
    <body class="background height-100">
        <div class="background-albugo height-100">
            {{ $slot }}
        </div>
    </body>
</html>