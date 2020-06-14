@extends('backend.layouts.master')

@section('icon','fa fa-eye')
@section('page_title',$testimony->name)
@section('breadcrumbs')
    {!! Breadcrumbs::render('show.testimony',$testimony) !!}
@endsection


@section('content')

    <div class="tile">
        <div class="tile-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-body show-post">
                            <h3 class="card-title d-inline-block">{{$testimony->name}} @if($testimony->title){{$testimony->title}})@endif</h3>
                            <p>{!!html_entity_decode($testimony->body) !!}</p>

                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col--12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Testimony Details</h4>

                            <label class="form-spacer"><i class="fa fa-clock"></i> Testimony Created on:</label>
                            <p>{{date('M j, Y h:ia',strtotime($testimony->created_at))}}</p>

                            <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                            <p>{{date('M j, Y h:ia',strtotime($testimony->updated_at))}}</p>

                            <div class="row">
                                <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer">
                                    <button class="btn btn-secondary btn-block" onclick="location.href = '{{route('edit.testimony',$testimony->id)}}';">
                                        <span style="color: white!important;">Edit</span></button>
                                </div>
                                <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer bottom-button">
                                    <a class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this testimony')"
                                       href="{{route('delete.testimony',$testimony->id)}}">
                                        <span style="color: white!important;">Delete</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection