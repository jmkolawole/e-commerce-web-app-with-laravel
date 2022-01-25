@extends('backend.layouts.master')
<style>
    #preview{

        height: 150px;
        width: 150px;
    }
</style>

@section('content')

        <div class="row user">
            <div class="col-md-12">
                <div class="profile">
                    <div class="info"><img class="user-img" src="@if(Auth::user()->image != "")
                        {{asset('images/backend/users/'.Auth::user()->image)}}@else{{asset('images/placeholder.jpg')}}@endif">
                        <h4>{{Auth::user()->username}}</h4>

                    </div>
                    <div class="cover-image"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tile p-0">
                    <ul class="nav flex-column nav-tabs user-tabs">
                        <li class="nav-item"><a class="nav-link active" href="#user-details" data-toggle="tab">Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#user-timeline" data-toggle="tab">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="user-details">
                        <div class="tile user-settings">
                            <h4 class="line-head">Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Username</b></label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->username}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Email</b></label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Status</b></label>
                            </div>
                            <div class="col-md-6">
                                @if($user->active == 1)
                                    <p><span style="color: green">Active</span></p>
                                @elseif($user->active != 1)
                                    <p><span style="color: red">Inactive</span></p>
                                @endif

                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="user-timeline">
                        <div class="tile user-settings">
                            <h4 class="line-head">Timeline</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Created</b></label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Last Updated</b></label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->updated_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-settings">
                        <div class="tile user-settings">
                            <h4 class="line-head">Settings</h4>
                            <form action="{{route('edit.profile')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row mb-12">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="username" value="{{$user->username}}">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="email" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><br>
                                    </div>

                                    <div class="col-md-3">

                                            <img id="preview" class="img img-responsive img-thumbnail"
                                                 src="@if($user->image == ""){{asset('images/placeholder.jpg')}}@endif{{asset('images/backend/users/'.$user->image)}}" alt="your image"/>

                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input class="form-control-file" id="profile_image" type="file" aria-describedby="fileHelp" name="image">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row mb-12">
                                    <div class="col-md-12">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
