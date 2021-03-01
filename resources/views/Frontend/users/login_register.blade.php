@extends('layouts.frontend_layout.front_layout')
@section('main_content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Login / Register</li>
        </ul>
        <h3> Login / Register</h3>
        <hr class="soft"/>

        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>CREATE YOUR ACCOUNT</h5> <br/>
                    Enter your details  to create an account. <br/>  <br/>
                    <form action="{{url('register')}}" method="post">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" name="name"  type="text" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone">Phone Number</label>
                            <div class="controls">
                                <input class="span3" name="mobile"  type="text" id="phone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">E-mail address</label>
                            <div class="controls">
                                <input class="span3" name="email" type="email" id="inputEmail0" placeholder="Email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input class="span3" name="password" type="password" id="password" placeholder="password">
                            </div>
                        </div>

                        <div class="controls">
                            <button type="submit" class="btn block">Create Your Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5>ALREADY REGISTERED ?</h5>
                    <form>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">Email</label>
                            <div class="controls">
                                <input class="span3"  type="text" id="inputEmail1" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword1">Password</label>
                            <div class="controls">
                                <input type="password" class="span3"  id="inputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Sign in</button> <a href="forgetpass.html">Forget password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
