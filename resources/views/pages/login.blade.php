@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php if (Session::has('loginFailed')) { ?>
                <div class="alert alert-danger">
                    <?= Session::get('loginFailed'); ?>
                </div>
                <?php } ?>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <?php if (Session::has('loginSuccess')) { ?>
                <div class="alert alert-success">
                    <?= Session::get('loginSuccess'); ?>
                </div>
                <?php } ?>


                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="active">Login</a>
                            </div>
                        </div>
                        <hr>
                    </div>


                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="" method="post">
                                    {!! csrf_field() !!}

                                    <div class="alert alert-info" role="alert">

                                        <p style="text-align: center">Please choose one of the options below</p>

                                    </div>


                                    <div class="col-lg-6">

                                        <div class="funkyradio">
                                            <div class="funkyradio-success">
                                                <input type="radio" name="role" value="lawyer" id="radio3"/>
                                                <label for="radio3"><strong>Lawyer</strong></label>
                                            </div>
                                        </div>

                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-6">

                                        <div class="funkyradio">
                                            <div class="funkyradio-success">
                                                <input type="radio" name="role" value="citizen" id="radio2" checked/>
                                                <label for="radio2"><strong>Citizen</strong></label>
                                            </div>
                                        </div>

                                    </div><!-- /.col-lg-6 -->

                                    <div class="divider" style="clear: both;"></div>

                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop