@extends('backend.layouts.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('team.index') }}
@endsection



@section('content')

@section('icon','fa fa-users')
@section('page_title','All Team Members')

<style>

    *, *:before, *:after{
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing:border-box;
        box-sizing: border-box;
    }


    .container{
        padding: 1em 0;
        float: left;
        width: 100%;
    }


    .content {
        position: relative;
        width: 90%;
        max-width: 400px;
        margin: auto;
        overflow: hidden;
    }


    .content .content-overlay {
        background: rgba(0,0,0,0.7);
        position: absolute;
        height: 99%;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        opacity: 0;
        -webkit-transition: all 0.4s ease-in-out 0s;
        -moz-transition: all 0.4s ease-in-out 0s;
        transition: all 0.4s ease-in-out 0s;
    }

    .content:hover .content-overlay{
        opacity: 1;
    }

    .content-image{
        width: 100%;
    }

    .content-details {
        position: absolute;
        text-align: center;
        padding-left: 1em;
        padding-right: 1em;
        width: 100%;
        top: 50%;
        left: 50%;
        opacity: 0;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .content:hover .content-details{
        top: 50%;
        left: 50%;
        opacity: 1;
    }

    .content-details h3{
        color: #fff;
        font-weight: 500;
        font-size: 90%!important;
        letter-spacing: 0.15em;
        margin-bottom: 0.5em;
        text-transform: uppercase;
    }

    .content-details p{
        color: antiquewhite;
        font-size: 0.7em;
        font-weight: 400;
    }

    .fadeIn-bottom{
        top: 80%;
    }

    .fadeIn-top{
        top: 20%;
    }

    .fadeIn-left{
        left: 20%;
    }

    .fadeIn-right{
        left: 80%;
    }
</style>



<div class="row">
    <div class="col-lg-1 col-md-1 col-xl-1"></div>
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('team.add')}}" class="btn btn-success btn-sm" style="float: right!important;">
                    <i class="fa fa-plus"></i>
                </a><br><br>

                <div class="row">
                    @foreach($team as $value)
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6" style="padding: 0!important;">
                            <div class="container">
                                <div class="content">
                                    <a href="{{route('team.show',$value->id)}}">
                                        <div class="content-overlay"></div>
                                        <img class="content-image image img img-thumbnail"
                                             src="{{asset('images/backend/teams/small/'.$value->image)}}">
                                        <div class="content-details fadeIn-top">
                                            <h3>{{$value->name}}</h3>
                                            <p>{{$value->title}}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="btn-group" style="float: right!important;position: relative;right: 5%;">
                                    <button type="button" class="btn btn-success">Action</button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('team.show',$value->id)}}">Open</a>
                                        <a class="dropdown-item" href="{{route('team.edit',$value->id)}}">Edit</a>
                                        @if(Auth::user()->hasRole('Admin'))
                                            <a class="dropdown-item" href="{{route('team.delete',$value->id)}}"
                                               onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>@endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
                </div>



                <br>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" style="text-align:center;padding-left: 10%!important;">
                        <p style="margin-left: 2em!important;">{{$team->links()}}</p>

                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                    </div>
                </div>



            </div>

        </div>
    </div>
    <div class="col-lg-1 col-md-1 col-xl-1"></div>
</div>

@endsection
