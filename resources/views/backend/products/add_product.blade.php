@extends('backend.layouts.master')

@section('icon','fa fa-pencil-square')
@section('page_title','Add New Product')
@section('breadcrumbs')
    {!! Breadcrumbs::render('add.product') !!}
@endsection

@section('content')
    <form class="form" action="{{route('add.product')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-8">
                <div class="tile">
                    <h3 class="tile-title">Add A New Product</h3>
                    <div class="tile-body">

                        <style>
                            .form-group{
                                margin-top: 2em!important;
                            }
                        </style>


                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Product Name<span style="color: red">*</span></b></label>
                            <input class="form-control" id="product_name" name="product_name" type="text" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Product Code<span style="color: red">*</span></b></label>
                            <input class="form-control" id="product_code" name="product_code" type="text" placeholder="Product Code">
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Category<span style="color: red">*</span></b></label>
                            <select class="form-control" id="input-select" name="category_id">
                                <?php
                                echo $categories_dropdown
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Brand<span style="color: red">*</span></b></label>
                            <select class="form-control" id="input-select" name="brand_id">
                                <option>Select</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="exampleInputAmount"><b>Product Price<span style="color: red">*</span></b></label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="Product Price">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="exampleInputAmount"><b>Previous Price:</b></label>
                                    <input class="form-control" id="prev_price" name="prev_price" type="text" placeholder="Previous Price">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <br>
                                <br>
                                <br>
                                <div class="animated-checkbox">
                                    <label>
                                        <input type="checkbox" name="check" id="check"><span class="label-text">Does This Product Have A Type?</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6" id="stock-area">
                                <div class="form-group">
                                    <label class="control-label" for="exampleInputAmount"><b>Stock<span style="color: red">*</span></b></label>
                                    <input class="form-control" id="stock"  name="stock" type="text" placeholder="Stock">
                                </div>
                            </div>

                        </div>







                        <div class="form-group">
                            <label class="control-label"><b>Description</b></label>
                            <textarea class="form-control" rows="5" placeholder="Product Description" name="description" id="description"></textarea>
                        </div>

                    </div>
                    <div class="tile-footer"><button class="btn btn-primary" type="submit">Create</button></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="tile">
                    <div class="tile-body">
                        <h6>PUBLISHER</h6>
                        <hr>

                        <a href=""><b>{{Auth::user()->username}}</b></a>



                        <h6 style="margin-top: 50px!important;">SEO</h6>
                        <hr>
                        <label><b>Keywords</b></label>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-link" id="keywords-link">Click Here To Add</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-hide" id="keywords-hide">Hide Textbox</a></small>
                        <div class="form-group">
                            <input type="text" name="keywords" id="keywords" class="form-control keywords" placeholder="Add Keywords">
                        </div>


                        <h6 style="margin-top: 50px!important;">PRODUCT IMAGE<span style="color: red">*</span></h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="exampleInputFile"><b>Feature Image</b></label>
                                    <input class="form-control-file" id="image" type="file" aria-describedby="fileHelp" name="image">
                                    <small class="form-text text-muted" id="fileHelp">Choose A Feature Image For This Product</small>
                                </div>
                            </div>

                            <style>
                                img{
                                    max-height: 5.5em!important;
                                }
                                .author,.author-hide, .keywords,.keywords-hide,.description,.description-hide{
                                    display: none;
                                }
                            </style>
                            <div class="col-md-3">
                                <img id="preview" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                     src="{{asset('images/placeholder.jpg')}}" alt="your image"/>

                            </div>

                        </div>


                        <h6 style="margin-top: 50px!important;">PRODUCT VIDEO (OPTIONAL)</h6>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputFile"><b>Video</b></label>
                            <input class="form-control-file" id="video" type="file" aria-describedby="fileHelp" name="video">
                            <small class="form-text text-muted" id="fileHelp">Choose A Video For The Product</small>
                        </div>


                        <h6 style="margin-top: 50px!important;">STATUS</h6>
                        <hr>
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" name="status"><span class="label-text">Enable</span>
                            </label>
                        </div>

                        <h6 style="margin-top: 50px!important;">ALLOW REVIEW</h6>
                        <hr>
                        <div class="toggle" style="">
                            <label>
                                <input type="checkbox" name="review"><span class="button-indecator" style="display: inline"></span><span style="display: inline">Product Review</span>
                            </label>
                        </div>

                        <h6 style="margin-top: 50px!important;">ALVINS MAKEUP  SPECIAL ?</h6>
                        <hr>
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" name="featured"><span class="label-text">Yes</span>
                            </label>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection


@section('script')



    <script type="text/javascript" src="{{asset('js/backend/plugins/select2.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/backend/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinyMCE.init(
            {
                selector : '#description'
            }
        );
    </script>
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>

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

        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script>

        $(document).ready(function() {


            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");


            $("#keywords-link").on("click", function () {
                $("#keywords").show();
                $("#keywords-link").hide();
                $("#keywords-hide").show();
            })


            $("#keywords").hide();
            $("#keywords-hide").hide();
            $("#keywords-hide").on("click", function () {
                $("#keywords").hide();
                $("#keywords-hide").hide();
                $("#keywords-link").show();
            });


            $("#check").on('click',function () {

                if (document.getElementById('check').checked) {
                    $("#stock-area").hide();
                }else {
                    $("#stock-area").show();
                }
            });









        });





    </script>

@endsection