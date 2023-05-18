<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
    <div class="navbar-wrapper">

            <div class="navbar-header d-md-none">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto">
                    @if(auth()->user() && auth()->user()->type != 'user')
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="ft-menu font-large-1"></i>
                        </a>
                    @endif
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="navbar-brand" href="@if(auth()->user()->type == 'admin') {{route('admin.dashboard')}} @else # @endif">
                            <img class="brand-logo d-none d-md-block" alt="CryptoDash admin logo" src="/log.png">
                            <img class="brand-logo d-md-none" alt="CryptoDash admin logo sm" src="/log.png">
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="la la-ellipsis-v">  </i>
                        </a>
                    </li>
                </ul>
            </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    @if(auth()->user() && auth()->user()->type != 'user')
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a>
                    </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">{{ auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="dropdown-item"><i class="ft-power"></i>Выход</button>
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
