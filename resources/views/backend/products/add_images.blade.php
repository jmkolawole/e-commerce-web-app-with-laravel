@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/dropzone.min.css')}}">
@endsection
@section('icon','fa fa-plus')
@section('page_title','Add Alternate Image(s)')




@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
            <div class="row">

            <div class="col-md-5 col-lg-5">
                <div class="tile-body">
                    <h3 class="tile-title">Product Alternate Images</h3>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <h5 class="card-header">Product Details</h5>
                        </tr>
                        </thead>

                        <tbody>


                        <tr>
                            <td><b>Product Name:</b></td>
                            <td>{{$product->product_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Product Code:</b</td>
                            <td>{{$product->product_code}}</td>
                        </tr>
                        <tr>
                            <td><b>Product Price:</b></td>
                            <td>{{$product->price}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

                <div class="col-md-7 col-lg-7">
                <div class="card">
                    <h5 class="card-header">Upload Images</h5>
                    <div class="card-body">
                        <form action="{{route('add.images',$product->id)}}" method="POST" class="dropzone" id="my-awesome-dropzone">
                            {{csrf_field()}}
                        </form>
                    </div>

                </div>
                </div>
            </div>
                <div class="card">
                    <h3 class="card-header">Product Pictures</h3>
                    <div class="card-body">
                        <div class="container" style="padding: 2px!important;">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        @foreach($images as $value)

                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6" style="padding: 2px!important;">
                                                <a href="">
                                                    <img src="{{asset('images/backend/pictures/medium/'.$value->image)}}"
                                                         alt="Avatar" class="image img img-thumbnail img-responsive"></a>

                                                <div class="btn-group" style="float: right!important;">
                                                    <button type="button" class="btn btn-dark">Action</button>
                                                    <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('delete.image',$value->id)}}"
                                                           onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>



                            </div>

                        </div>
                        <div style="margin-top: 10px!important;" class="text-center">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



<?php $id = $product->id;?>
@section('script')

    <script type="text/javascript" src="{{asset('js/backend/plugins/dropzone.min.js')}}"></script>

    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            //Dropzone class
            var myDropzone = new Dropzone(".dropzone",{
                dictDefaultMessage : 'Select Or Drop Product Alternate Images Here!',

            });
            myDropzone.on("queuecomplete", function() {
                var id = '<?php echo $id?>';
                //Redirect URL
                setTimeout(function () {
                    window.location.replace('/alvinsmakeup/public/admin/product/' + id + '/add-images')
                }, 1000);
            });
        });
    </script>
@endsection