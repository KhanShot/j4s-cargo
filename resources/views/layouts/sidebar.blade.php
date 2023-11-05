<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
    <div class="main-menu-content">
        <a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="@if(auth()->user()->type == 'admin') {{route('admin.dashboard')}} @else # @endif">
            <span class="h3 text-danger">JUSAN</span>
        </a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(auth() && auth()->user()->type == 'admin')
            <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="icon-grid"></i><span class="menu-title visible" data-i18n="">Дашборд</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('admin.users')}}"><i class="icon-users"></i><span class="menu-title visible" data-i18n="">Пользователи</span></a></li>

            <li class=" nav-item"><a href="{{route('admin.tracks')}}"><i class="icon-map"></i><span class="menu-title visible" data-i18n="">Треки</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('admin.logs')}}"><i class="icon-list"></i><span class="menu-title visible" data-i18n="">Логи</span></a>
            </li>
                <li class=" nav-item"><a href="{{route('admin.costs')}}"><i class="icon-bag"></i><span class="menu-title visible" data-i18n="">Цена</span></a>
                </li>
            @else
                <li class=" nav-item hover active" style="display: block">
                    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow d-block">5</span>
                    <a href="{{route('admin.tracks')}}"><i class="icon-map"></i>
                        <span class="menu-title visible" style="display:block;" data-i18n="">Треки</span>
                    </a>
                </li>
                <li class=" nav-item"><a href="{{route('admin.logs')}}"><i class="icon-list"></i><span class="menu-title visible" data-i18n="">Логи</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>
<div >
    <add-tracking></add-tracking>
</div>
<script>

</script>
