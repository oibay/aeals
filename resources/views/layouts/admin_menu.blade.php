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
        <a href="{{ url('/admin/stlng') }}">
            <i class="fas fa-calendar-times"></i>К заселению</a>
        <span class="inbox-num">3</span>
    </li>
    <li>
        <a href="{{ url('/admin/companies') }}">
            <i class="fas fa-user"></i>Компании</a>
    </li>
    <li>
        <a href="{{ url('/admin/archive') }}">
            <i class="fas fa-archive"></i>Архив</a>
    </li>


</ul>
