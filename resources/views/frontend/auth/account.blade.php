@extends('frontend.layouts.master')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">My Account</li>
            </ol>
        </div>
    </div>

    <!-- Breadcrumb Area End Here -->
    <!-- My Account Page Start Here -->
    <div class="my-account white-bg ptb-90">
        <div class="container">
            <div class="account-dashboard">
                <div class="dashboard-upper-info">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="d-single-info">
                                <p class="user-name">Hello <span>{{$user->first_name}}</span></p>

                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="d-single-info">
                                <p>Need Assistance? Contact us at 08067835621</p>
                                <p>admin@example.com.</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="d-single-info">
                                <p>E-mail us at </p>
                                <p>support@alvinsmakeup.com</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-2 col-md-6">
                            <div class="d-single-info text-lg-center">
                                <a class="view-cart" href="{{route('cart')}}">view cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#dashboard">Dashboard</a></li>
                            <li> <a class="nav-link" data-toggle="tab" href="#orders">Orders</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#account-details">Account details</a>
                            </li>
                            <li><a class="nav-link" data-toggle="tab" href="#change-password">Change Password</a></li>
                            <li><a class="nav-link" href="{{route('logout.user')}}">logout</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content mt-all-40">
                            <div id="dashboard" class="tab-pane fade show active">
                                <h3>Dashboard </h3>
                                <p>From your account dashboard. you can easily check & view your <b>recent
                                        orders</b>, manage your <b>account details</b> and
                                    <b>edit your password.</b></p>
                            </div>

                            <div id="orders" class="tab-pane fade">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{date('M j, Y h:ia',strtotime($order->created_at))}}</td>
                                            <td>{{$order->order_status}}</td>
                                            <td>₦{{round($order->grand_total,2)}} for {{$order->orders->count()}} items</td>
                                            <td><a class="view" href="{{route('view.visitor.order',$order->id)}}">view</a></td>
                                        </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    <div style="margin-top:20px">{{$orders->links()}}</div>
                                </div>
                            </div>

                            <div id="account-details" class="tab-pane fade">
                                <h3>Account details </h3>
                                <div class="register-form login-form clearfix">
                                    <form action="{{route('user.account')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group row">
                                            <label for="f-name" class="col-lg-3 col-md-4 col-form-label">First
                                                Name</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="f-name" name="first_name" value="{{$user->first_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="l-name" class="col-lg-3 col-md-4 col-form-label">Last
                                                Name</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="l-name" name="last_name" value="{{$user->last_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Email
                                                address</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Phone</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="address" name="phone" value="{{$user->phone}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">State</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="address" name="state" value="{{$user->state}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">City / Town</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="city" name="city" value="{{$user->town}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Country</label>
                                            <div class="col-lg-6 col-md-8">
                                                <select class="form-control country-select" name="country" id="country">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Pincode</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="pincode" name="pincode" value="{{$user->pincode}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Address</label>
                                            <div class="col-lg-6 col-md-8">
                                                <textarea name="address" class="form-control" rows="3">{{$user->address}}

                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="register-box mt-40">
                                            <button type="submit"
                                                    class="return-customer-btn float-right">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div id="change-password" class="tab-pane fade">
                                <h3>Change Password </h3>
                                <div class="register-form login-form clearfix">
                                    <form action="{{route('password.change')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group row">
                                            <label for="inputpassword"
                                                   class="col-lg-3 col-md-4 col-form-label">Current password</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="password" class="form-control" id="inputpassword" name="current_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newpassword" class="col-lg-3 col-md-4 col-form-label">New
                                                password</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="password" class="form-control" id="newpassword" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="c-password" class="col-lg-3 col-md-4 col-form-label">Confirm
                                                password</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="password" class="form-control" id="c-password" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="register-box mt-40">
                                            <button type="submit" class="return-customer-btn float-right">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


<script>


</script>
