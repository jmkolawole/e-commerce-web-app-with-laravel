@extends('backend.layouts.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('team.show',$team) }}
@endsection


@section('content')

@section('icon','fa fa-user-circle')
@section('page_title',$team->name)

<div class="row">
    <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-body show-post">
                <h3 class="card-title d-inline-block">{{$team->name}} (@if($team->title){{$team->title}})@endif</h3>

                @if($team->facebook)
                    <label class="form-spacer"><i class="fa fa-user"></i> Facebook Address</label>
                    <p>{{$team->facebook}}</p>
                @endif

                @if($team->twitter)
                    <label class="form-spacer"><i class="fa fa-user"></i> Twitter Address</label>
                    <p>{{$team->twitter}}</p>
                @endif

                @if($team->instagram)
                    <label class="form-spacer"><i class="fa fa-user"></i> Instagram Address</label>
                    <p>{{$team->instagram}}</p>
                @endif

            </div>
        </div>
    </div>


    <div class="col-sm-12 col--12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Member Details</h4>
                <div>
                    <img src="{{asset('images/backend/teams/small/' . $team->image)}}" class="img img-responsive img-thumbnail">
                </div>


                <label class="form-spacer"><i class="fa fa-clock"></i> Member Created on:</label>
                <p>{{date('M j, Y h:ia',strtotime($team->created_at))}}</p>

                <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                <p>{{date('M j, Y h:ia',strtotime($team->updated_at))}}</p>

                <div class="row">
                    <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer">
                        <button class="btn btn-primary btn-block" onclick="location.href = '{{route('team.edit',$team->id)}}';">
                            <span style="color: white!important;">Edit</span></button>
                    </div>
                    <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer bottom-button">
                        <a class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this member')"
                           href="{{route('team.delete',$team->id)}}">
                            <span style="color: white!important;">Delete</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection