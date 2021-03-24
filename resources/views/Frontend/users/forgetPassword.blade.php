
@extends('layouts.frontend_layout.front_layout')
@section('main_content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Forget password?</li>
    </ul>
    <h3> FORGET YOUR PASSWORD?</h3>
    <hr class="soft"/>
    @include('Frontend.msg.error')

    <div class="row">
        <div class="span9" style="min-height:900px">
            <div class="well">
                <h5>Reset your password</h5><br/>
                Enter your Email Get The New Password<br/><br/><br/>
                <form id="forgotPasswordForm" action="{{url('/forget-password')}}" method="post">
                    @csrf
                    <div class="control-group">
                        <label class="control-label" for="inputEmail1">E-mail address</label>
                        <div class="controls">
                            <input class="span3" name="email"  type="email" id="inputEmail1" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

@endsection
