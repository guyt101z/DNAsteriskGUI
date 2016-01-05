<html>
    <head>
        <title>FLHSI - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
        <script type="text/javascript" src="/assets/js/jQuery.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/js/dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/js/toastr.min.js"></script>
    </head>
    <body>
        
        
        <img src="{{env('COMPANY_LOGO_PATH')}}" height="75px">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home <span class="sr-only"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users & Phone Numbers <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/user">Manage Users</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/did">Inbound Phone Numbers</a></li>
                                <li><a href="#">Call Blocking</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Features <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/speeddials">Speed Dials</a></li>
                                <li><a href="/voicemail">Voicemail Boxes</a></li>
                                <li><a href="#">Auto Attendants</a></li>
                                <li><a href="#">Schedules</a></li>
                                <li><a href="/ringgroups">Ring Groups</a></li>
                                <li><a href="/queue">Call Queues</a></li>
                                <li><a href="/conf">Conference Bridges</a></li>
                                <li><a href="/sounds">Sound Files</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">My Call Settings</a></li>
                                <li><a href="/password/change">Change Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>


    <script>
    @if (Session::has('error_message'))
        toastr.error('{{Session::get('error_message')}}');
    @endif
    @if (Session::has('success_message'))
        toastr.success('{{Session::get('success_message')}}');
    @endif
    @yield('scripts')

    </script>
    @yield('bottom')
</html>