@extends('backend.layouts.master')


@section('icon','fa fa-plus')
@section('page_title','Page Banners')
@section('breadcrumbs')
    {!! Breadcrumbs::render('banners') !!}
@endsection

<style>
    img {
        max-height: 5.5em !important;
    }
</style>



@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card">
                    <h3 class="card-header">Sliders And Banners</h3>
                    <div class="card-body">
                        <div class="container" style="padding: 2px!important;">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            @if($banner)
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->slider1)}}" alt="your image"/>
                                            <pre style="display: block; white-space: pre-line;margin-bottom: 0; text-align: center"><p><b>{{$banner->topic1}}</b></p></pre><br>
                                            <pre style="display: block; white-space: pre-line;margin-top: -2em!important;
                                            top: -30px; text-align: center; max-height: 4em!important;"><p>{{$banner->body1}}</p></pre>
                                            @endif
                                        </div>

                                        @if($banner)
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->slider2)}}" alt="your image"/>
                                            <pre style="display: block; white-space: pre-line;margin-bottom: 0; text-align: center"><p><b>{{$banner->topic2}}</b></p></pre><br>
                                            <pre style="display: block; white-space: pre-line;margin-top: -2em!important;
                                            top: -30px; text-align: center; max-height: 4em!important;"><p>{{$banner->body2}}</p></pre>
                                        </div>
                                        @endif

                                        @if($banner)
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->slider3)}}" alt="your image"/>
                                            <pre style="display: block; white-space: pre-line;margin-bottom: 0; text-align: center"><p><b>{{$banner->topic3}}</b></p></pre><br>
                                            <pre style="display: block; white-space: pre-line;margin-top: -2em!important;
                                            top: -30px; text-align: center; max-height: 4em!important;"><p>{{$banner->body3}}</p></pre>
                                        </div>
                                        @endif
                                    </div>
                                    <hr>
                                    @if($banner)
                                    <div class="row" style="text-align: center!important;">
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->banner1)}}" alt="your image"/>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->banner2)}}" alt="your image"/>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <img id="" class="img img-responsive img-thumbnail" style="min-height: 150px!important;"
                                                 src="{{asset('images/backend/banners/'.$banner->banner3)}}" alt="your image"/>
                                        </div>
                                    </div>
                                    @endif
                                </div>



                            </div>

                        </div>
                    </div>

                </div>




                <form method="POST" action="{{route('banners')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="card">
                    <h3 class="card-header">Change Banner(s)</h3>
                    <div class="card-body">
                        <div class="container" style="padding: 2px!important;">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">


                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Slider 1</h4>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                    <input type="text" class="form-control" value="{{$banner ? $banner->topic1 : '' }}" name="topic1">
                                                </div>
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                     <textarea name="body1" class="form-control body">{{$banner ? $banner->body1 : ''}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input class="form-control-file" id="slider1" type="file" aria-describedby="fileHelp" name="slider1">
                                                    <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                    <img id="preview1" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                    src="{{$banner ? asset('images/backend/banners/'.$banner->slider1) : ''}}" alt="your image"/>
                                            </div>
                                        
                                            </div>
                                        </div>


                                        @if($banner)
                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Slider 2</h4>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                    <input type="text" class="form-control" value="{{$banner->topic2}}" name="topic2">
                                                </div>
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                    <textarea name="body2" class="form-control body" id="message">{{$banner->body2}}</textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input class="form-control-file" id="slider2" type="file" aria-describedby="fileHelp" name="slider2">
                                                        <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="preview2" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                         src="{{asset('images/backend/banners/'.$banner->slider2)}}" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($banner)
                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Slider 3</h4>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                    <input type="text" class="form-control" value="{{$banner->topic3}}" name="topic3">
                                                </div>
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 8px">
                                                    <textarea name="body3" class="form-control body">{{$banner->body3}}"</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input class="form-control-file" id="slider3" type="file" aria-describedby="fileHelp" name="slider3">
                                                        <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="preview3" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                         src="{{asset('images/backend/banners/'.$banner->slider3)}}" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="row">

                                        @if($banner)
                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Banner 1</h4>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input class="form-control-file" id="banner1" type="file" aria-describedby="fileHelp" name="banner1">
                                                        <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="preview1" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                         src="{{asset('images/backend/banners/'.$banner->banner1)}}" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                        @if($banner)
                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Banner 2</h4>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input class="form-control-file" id="banner2" type="file" aria-describedby="fileHelp" name="banner2">
                                                        <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="preview2" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                         src="{{asset('images/backend/banners/'.$banner->banner2)}}" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($banner)
                                        <div class="col-md-4 col-sm-4">
                                            <h4 class="card-title">Banner 3</h4>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input class="form-control-file" id="banner3" type="file" aria-describedby="fileHelp" name="banner3">
                                                        <small class="form-text text-muted" id="fileHelp">Choose An Image To Display</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="preview3" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                                         src="{{asset('images/backend/banners/'.$banner->banner3)}}" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div style="margin-top: 10px!important;" class="text-center">

                        </div>
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')


@endsection