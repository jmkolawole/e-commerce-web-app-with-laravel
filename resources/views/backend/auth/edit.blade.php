@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-edit')
@section('page_title','Edit Profile')
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.profile') !!}
@endsection


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="tile">
            <h3 class="tile-title">Edit Your Profile</h3>


            <form method="POST" action="{{route('edit.profile')}}" enctype="multipart/form-data">
                {{csrf_field()}}
            <label class="control-label">Username</label>
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-user"></i></span></div>
                    <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="{{$user->username}}">

                </div>
            </div>


            <label class="control-label">Email</label>
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class=" fa fa-envelope"></i></span></div>
                    <input class="form-control" id="email" name="email" type="text" placeholder="Email Address" value="{{$user->email}}">

                </div>
            </div>


            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input class="form-control-file" id="profile_image" type="file" aria-describedby="fileHelp" name="image">
                        <small class="form-text text-muted" id="fileHelp">Choose A New Profile Picture</small>
                    </div>
                </div>

                <style>
                    img{
                    max-height: 11.5em!important;
                    }
                </style>
                <div class="col-md-3">
                    <img id="preview" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                         src="@if($user->image == ""){{asset('images/placeholder.jpg')}}@else{{asset('images/backend/users/'.$user->image)}}@endif" alt="your image"/>

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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profile_image").change(function() {
        readURL(this);
    });
</script>
@endsection