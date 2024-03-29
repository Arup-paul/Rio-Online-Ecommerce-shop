@extends('layouts.frontend_layout.front_layout')
@section('main_content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">My Account</li>
        </ul>
        <h3> My Account</h3>
        <hr class="soft"/>

        @include('Frontend.msg.error')

        @include('Frontend.msg.validation')

        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>Contact Details</h5> <br/>
                    Enter your contact details. <br/>  <br/>
                    <form id="accountForm" action="{{url('account')}}" method="post">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" name="name"  type="text" id="name"  value="{{$userDetaills['name']}}" pattern="[A-Za-z]+">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <input class="span3" name="address"  type="text" id="address" value="{{$userDetaills['address']}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <input class="span3" name="city"  type="text" id="city" value="{{$userDetaills['city']}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="state">State</label>
                            <div class="controls">
                                <input class="span3" name="state"  type="text" id="state" value="{{$userDetaills['state']}}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="country">Country</label>
                            <div class="controls">
                               <select name="country" id="country">
                                   <option value="">Select Country</option>
                                   @foreach($countries as $country)
                                   <option @if($country->country_name == $userDetaills['country']) selected @endif value="{{$country->country_name}}" >{{$country->country_name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="zipcode">Zipcode</label>
                            <div class="controls">
                                <input class="span3" name="zipcode"  type="text" id="zipcode" value="{{$userDetaills['zipcode']}}">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="phone">Mobile Number</label>
                            <div class="controls">
                                <input class="span3" name="mobile"  type="text" id="phone" value="{{$userDetaills['mobile']}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">E-mail </label>
                            <div class="controls">
                                <input class="span3" value="{{$userDetaills['email']}}"    readonly>
                            </div>
                        </div>

                        <div class="controls">
                            <button type="submit" class="btn block" > Update </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5>Update Password</h5>
                    <form id="passwordForm" action="{{url('update-user-password')}}" method="post">
                         @csrf
                        
                        <div class="control-group">
                            <label class="control-label" for="current_pwd">Current Password</label>
                            <div class="controls">
                                <input type="password" name="current_pwd" class="span3"  id="current_pwd" placeholder="Enter Current Password">
                                <br/>
                                <span id="chkPwd"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="new_pwd">New Password</label>
                            <div class="controls">
                                <input type="password" name="new_pwd" class="span3"  id="new_pwd" placeholder="Enter New Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="confirm_pwd">Confirm Password</label>
                            <div class="controls">
                                <input type="password" name="confirm_pwd" class="span3"  id="confirm_pwd" placeholder="Enter Confirm Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Update</ 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
