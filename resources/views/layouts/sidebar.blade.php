<style>
    .login_namehead {
        font-size: 18px;
        font-weight: 500;
        display: block;
        color: #ad7006;
        padding-top: 10px;
        margin-bottom: 5px;
        text-align: center;
    }


    .logged {
        font-size: 15px;
    }

    span.login_namehead.new_class {
        color: #707273;
        font-size: 15px;
    }

</style>


<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('assets/img/user-small.png') }}" class="rounded-circle user-photo"
                alt="User Profile Picture">
            <div class="dropdown">

                <hr>
                <span class="logged">Logged in as</span> <a href="javascript:void(0);"
                    class="dropdown-toggle user-name" data-toggle="dropdown"><strong>
                        {{ Auth::user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="icon-power"></i>Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
                    </form>
                </ul>
            </div>
        </div>
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">
                        <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                            <a href="{{route('admin.dashboard')}}" class="has-arrow"><i class="icon-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::segment(1) === 'student-manage-defaults' ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="fa fa-wrench"></i>
                                <span>Student Control</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'students' ? 'active' : null }}">
                                    <a href="{{ route('students.index') }}">
                                        <span>Students</span>
                                    </a>
                                </li>
                                <li class="{{ Request::segment(2) === 'marklist' ? 'active' : null }}">
                                    <a href="{{ route('marklist.index') }}">
                                        <span>Marklist</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!----->
        <div class="user-account">
            <hr>
            <div class="" style="margin-right: 12px;">
            </div>
            <div class="" style="margin-right: 12px;">
            </div>
        </div>
        <!------>
    </div>
</div>
