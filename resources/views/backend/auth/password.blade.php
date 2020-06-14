@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-lock')
@section('page_title','Edit Password')
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.password') !!}
@endsection


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="tile">
            <h3 class="tile-title">Change Password</h3>


            <form method="POST" action="{{route('edit.password')}}">
                {{csrf_field()}}
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
                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password">

                    </div>
                </div>




                <button class="btn btn-primary" type="submit">Update</button>
            </form>







        </div>
    </div>
    <div class="col-md-2"></div>

</div>


@endsection


@section('script')

@endsection