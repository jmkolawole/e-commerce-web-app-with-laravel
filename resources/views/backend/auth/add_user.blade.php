@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-plus')
@section('page_title','Add New User')
@section('breadcrumbs')
    {{ Breadcrumbs::render('add.user') }}
@endsection


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="tile">
            <a href="{{route('add.user')}}" class="btn btn-success btn-sm"
               style="float: right!important;margin-bottom: 10px;">
                Add New Admin <i class="fa fa-plus"></i>
            </a>
            <h3 class="tile-title">Add User</h3>

            <form method="POST" action="{{route('add.user')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <label class="control-label">Username</label>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-user"></i></span></div>
                        <input class="form-control" id="username" name="username" type="text" placeholder="Username">

                    </div>
                </div>


                <label class="control-label">Email</label>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-envelope"></i></span></div>
                        <input class="form-control" id="email" name="email" type="text" placeholder="Email Address">

                    </div>
                </div>


                <label class="control-label">Password</label>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-lock"></i></span></div>
                        <input class="form-control" id="password" name="password" type="password">

                    </div>
                </div>

                <label class="control-label">Confirm Password</label>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-lock"></i></span></div>
                        <input class="form-control" id="password" name="password_confirmation" type="password">

                    </div>
                </div>


                <button class="btn btn-success" type="submit">Add</button>
            </form>







        </div>
    </div>
    <div class="col-md-2"></div>

</div>


@endsection


@section('script')

@endsection