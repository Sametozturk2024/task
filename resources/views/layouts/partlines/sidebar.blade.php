<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Görevlerim</span>
            </a>
        </li>

    @if(auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link" href="{{ url("admin")  }}">
                <i class="icon-paper
 menu-icon"></i>
                <span class="menu-title">Tüm Görevler </span>
            </a>
        </li>
        @endif
    </ul>
</nav>
