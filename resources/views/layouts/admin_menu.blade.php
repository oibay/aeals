<ul class="list-unstyled navbar__list">
    <li>
        <a href="{{ url('/') }}">
            <i class="fas fa-home"></i>Главная</a>
    </li>
    <li>
        <a href="{{ url('/admin/guests') }}">
            <i class="fas fa-users"></i>Гости</a>
    </li>
    <li>
        <a href="{{ url('/admin/guests/stlng') }}">
            <i class="fas fa-calendar-times"></i>К заселению</a>

        @if(isset($guestCount) )
            <span class="inbox-num">
            @if($guestCount > 0)
                {{ $guestCount }}
            @endif
             </span>
        @endif
    </li>

    <li>
        <a href="{{ url('/admin/event') }}">
            <i class="fas fa-chevron-circle-right"></i>Питание</a>
    </li>
    <li>
        <a href="{{ url('/admin/companies') }}">
            <i class="fas fa-user"></i>Компании</a>
    </li>
    <li>
        <a href="{{ url('/admin/materials') }}">
            <i class="fas fa-bed"></i>Мебель</a>
    </li>
    <li>
        <a href="{{ url('/admin/room-number') }}">
            <i class="fas fa-sort-numeric-up"></i>Номер комнаты</a>
    </li>
    <li>
        <a href="{{ url('/admin/report') }}">
            <i class="fas fa-file-excel"></i>Репорт</a>
    </li>
    <li>
        <a href="{{ url('/admin/archive') }}">
            <i class="fas fa-archive"></i>Архив</a>
    </li>


</ul>
