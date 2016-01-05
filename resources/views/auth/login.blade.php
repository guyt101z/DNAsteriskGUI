<html>
    <head>
        <title>FLHSI - Login</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="top-buffer"></div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Login
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="/auth/login">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <img src="/assets/images/logos/logo.jpg" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Username</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="username" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" name="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <button class="btn btn-default" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                            @if ($errors->any())
                                <ul class="portal-form-errors">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript" src="/assets/js/jQuery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
</html>