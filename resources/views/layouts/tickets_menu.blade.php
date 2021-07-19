<ul class="list-unstyled navbar__list">
    <li>
        <a href="{{ url('/') }}">
            <i class="fas fa-home"></i>Запросы</a>
    </li>

    @if(\Illuminate\Support\Facades\Auth::user()->profile_photo_path != 'zapros')
        <li>
            <a href="{{ url('/tickets/department') }}">
                <i class="fas fa-book"></i>Отдел</a>
        </li>

        <li>
            <a href="{{ url('/tickets/users') }}">
                <i class="fas fa-user"></i>Пользователи</a>
        </li>
    @endif



</ul>
