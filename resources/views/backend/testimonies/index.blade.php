@extends('backend.layouts.master')

@section('icon','fa fa-eye')
@section('page_title','Testimonies')
@section('breadcrumbs')
    {!! Breadcrumbs::render('index.testimony') !!}
@endsection


@section('content')

    <div class="tile">
        <div class="tile-body">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Testimonies ({{$testimonies->count()}})</h4>

                    <div class="comment-widgets scrollable">

                        @foreach($testimonies as $testimony)
                            <div class="d-flex flex-row comment-row m-t-0" id="post{{$testimony->id}}">

                                <div class="comment-text w-100">
                                    <h5 class="font-medium d-inline-block">{{$testimony->name}}</h5> @if($testimony->title)/
                                    <span><i>{{$testimony->title}}</i></span>@endif
                                    <span class="m-b-15 d-block"><p>{{$testimony->body,100}}</p></span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">{{$testimony->created_at->diffForHumans()}}</span>
                                        <button type="button" onclick="location.href = '{{route('edit.testimony',$testimony->id)}}';" class="btn btn-cyan btn-sm">Edit</button>
                                        <button type="button" onclick="location.href = '{{route('show.testimony',$testimony->id)}}';" class="btn btn-secondary btn-sm">Open</button>

                                        @if(Auth::user()->hasRole('Admin'))
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimony')"
                                               href="{{route('delete.testimony',$testimony->id)}}">
                                                <span style="color: white!important;">Delete</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div><br>
                        @endforeach

                            <hr>
                            <div class="shop-breadcrumb-area border-default mt-30">
                                <div class="center" style="text-align: center!important;">
                                    <div style="display: inline!important;">
                                        {{$testimonies->links()}}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
