@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="register-form" action="{{URL::route('register')}}" method="post">
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

                                <div class="divider"></div>

                                <div class="form-group">
                                    <input type="text" name="firstName" id="firstName" tabindex="1" class="form-control" placeholder="First name" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="lastName" id="lastName" tabindex="1" class="form-control" placeholder="Last name" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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
@stop