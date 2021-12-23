<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>
        {{-- <div class="navbar-brand">
            <a href="{{ route('admin.dashboard') }}" style=""><img src="{{ asset('assets/img/logo.png') }}"
                    alt="Lucid Logo" class="img-responsive logo"></a>
        </div> --}}
        <div class="navbar-right">
            <span class="main_head">Student Management System</span>
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('admin.dashboard') }}" class="icon-menu"
                            title="Dashboard"><i class="icon-home"></i></a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="icon-menu" title="Logout">
                            <i class="icon-power"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
