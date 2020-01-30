@if(Auth::user()->role !=  'teacher')
<ul class="sidebar-menu">
    <li class="header">Dashboard</li>
    <li class="treeview"><a href="/dashboard"><i class="fa fa-dashboard"></i><span>Главная</span></a></li>
    <li><a href="/dashboard/users"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
    <li><a href="/dashboard/subsidiary"><i class="fa fa-building"></i> <span>Филиалы</span></a></li>
    <li><a href="/dashboard/class_room"><i class="fa fa-book"></i> <span>Кабинеты</span></a></li>
    <li><a href="/dashboard/course"><i class="fa fa-language"></i> <span>Курсы</span></a></li>
    <li><a href="/dashboard/group"><i class="fa fa-graduation-cap"></i> <span>Группы</span></a></li>
    <li><a href="/dashboard/students"><i class="fa fa-child"></i> <span>Учащиеся</span></a></li>
    <li><a href="/dashboard/lesson_week"><i class="fa fa-table"></i> <span>Расписание</span></a></li>

    <li><a href="/dashboard/student"><i class="fa fa-money"></i> <span>Финансы</span></a></li>
    <li><a href="/dashboard/statistics"><i class="fa fa-line-chart"></i><span>Статистика</span></a></li>
    <li><a href="/dashboard/log"><i class="fa fa-archive"></i> <span>Архив событий</span></a></li>
</ul>
@endif

@if(Auth::user()->role ==  'teacher')
<ul class="sidebar-menu">
    <li class="header">Dashboard</li>
    <li class="treeview"><a href="/dashboard"><i class="fa fa-dashboard"></i><span>Главная</span></a></li>
    <li><a href="/dashboard/students"><i class="fa fa-users"></i> <span>Учащиеся</span></a></li>
    <li><a href="/dashboard/lesson_week/{{ strtotime(date('Y-m-d')).'/'.Auth::user()->id.'/0/0' }}"><i class="fa fa-table"></i> <span>Расписание</span></a></li>
</ul>
@endif

