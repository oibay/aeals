<ul class="list-unstyled navbar__list">
    <li>
        <a href="{{ url('/') }}">
            <i class="fas fa-home"></i>Главная</a>
    </li>
    <li>
        <a href="{{ url('/company/guests') }}">
            <i class="fas fa-users"></i>Гости</a>
    </li>
    <li>
        <a href="{{ url('/company/guests/request_') }}">
            <i class="fas fa-boxes"></i>Мои заявки</a>
    </li>
    <li>
        <a href="{{ url('/company/guests/stlng') }}">
            <i class="fas fa-calendar-times"></i>К заселению</a>
        <span class="inbox-num">
            @if(isset($guestCount) )
                @if($guestCount > 0)
                 {{ $guestCount }}
                    @endif
            @endif
        </span>
    </li>
    <li>
        <a href="{{ url('/company/guests/archive') }}">
            <i class="fas fa-archive"></i>Архив</a>
    </li>



</ul>
