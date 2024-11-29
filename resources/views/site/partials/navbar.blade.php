<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="javascript:void(0);" id="alertsDropdown"
                    data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">{{ $notifsCount }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        {{ $notifsCount }} Nouvelles Notifications
                    </div>
                    <div class="list-group">
                        @foreach ($notifs as $notif)
                            <a href="javascript:void(0);" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <span class="text-{{ $notif->color }}"><i
                                                class="{{ $notif->icon }}"></i></span>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">{!! $notif->content !!}
                                        </div>
                                        <div class="text-muted small mt-1">{{ $notif->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="{{ route('notifs.index') }}" class="text-muted">Voir toutes les notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <span class="text-dark">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="align-middle me-1"
                            data-feather="user"></i> Profil</a>
                    <div class="dropdown-divider"></div>

                    <button class="dropdown-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" style="all:unset; cursor: pointer;" class="ms-4">Déconnexion
                        </form>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
