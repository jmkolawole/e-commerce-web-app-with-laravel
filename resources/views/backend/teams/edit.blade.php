@extends('backend.layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('team.edit',$team) }}
@endsection


@section('content')

@section('icon','fa fa-edit')
@section('page_title','Edit Team Member Details')
<div class="row">
    <div class="col-lg-2 col-md-2 col-xl-2"></div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Team</h3>
            <p>Create a new team member</p>
        </div>
        <div class="card">
            <h5 class="card-header">Member details</h5>
            <div class="card-body">
                <form action="{{route('team.edit',$team->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Full Name</label>
                        <input id="inputText3" type="text" class="form-control" name="name" value="{{$team->name}}">
                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Title</label>
                        <input id="inputText3" type="text" class="form-control" name="title" value="{{$team->title}}">
                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Facebook</label>
                        <input id="inputText3" type="text" class="form-control" name="facebook" value="{{$team->facebook}}">
                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Twitter</label>
                        <input id="inputText3" type="text" class="form-control" name="twitter" value="{{$team->twitter}}">
                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Instagram</label>
                        <input id="inputText3" type="text" class="form-control" name="instagram" value="{{$team->instagram}}">
                    </div>

                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" name="image">
                        <label class="custom-file-label" for="customFile">Select Image</label>
                    </div>


                    <button type="submit" class="btn btn-success">
                        Update <i class="fa fa-arrow-right ml-2"></i>
                    </button>

                </form>
            </div>

        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-xl-2"></div>
</div>

@endsection
