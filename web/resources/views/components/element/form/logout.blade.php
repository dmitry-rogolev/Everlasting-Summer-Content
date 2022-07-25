<form method="POST" action="{{ route('logout') }}" {{ $attributes }}>
    @csrf
    <div onclick="event.preventDefault();this.closest('form').submit();">
        {{ __('auth.logout') }}
    </div>
</form>