@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/owl.theme.default.min.css')}}">
@endsection
@section('icon','fa fa-eye')
@section('page_title','View Products')
@section('breadcrumbs')
    {!! Breadcrumbs::render('view.products') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <a href="{{route('add.product')}}" class="btn btn-success btn-sm"
                   style="float: right!important;margin-bottom: 10px;">
                    Add New Product <i class="fa fa-plus"></i>
                </a>
                <h3 class="tile-title">All Products</h3>
                <div class="tile-body">
                    <a href="{{route('export.products')}}" class="btn btn-sm" target="-_blank">Export To Excel</a>
                    <form method="POST" action="{{route('delete.products')}}" class="bulk_form" id="bulk_form">
                        {{csrf_field()}}
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ID:</th>
                            <th>Name:</th>
                            <th>Brand:</th>
                            <th>Niche:</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr id="{{$product->id}}">
                                <td><input class="" type="checkbox" name="action[]" value="{{$product->id}}"></td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->brand->name}}</td>
                                <td>
                                    <?php
                                    $cat = \App\Category::where('id',$product->category->parent_id)->get();
                                    foreach($cat as $item){
                                        echo $item->name;
                                    }

                                    ?>
                                </td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->product_code}}</td>
                                <td>{{$product->price}}</td>
                                <td align="center" style="text-align: center">
                                    @if(!empty($product->image))
                                        <img width="60" height="60" src='{{asset("images/backend/products/small/$product->image")}}'>
                                    @endif
                                </td>
                                <td style="text-align: center!important;">
                                    <div class="btn-group">
                                        <a class="btn btn-secondary btn-sm" href="{{route('edit.product',$product->id)}}" title="Edit Product"><i class="fa fa-lg fa-edit"></i></a>
                                        @if($product->stock_status == "yes")
                                        <a class="btn btn-info btn-sm" href="{{route('add.attributes',$product->id)}}"><i class="fa fa-lg fa-plus" title="Add Product Attribute"></i></a>
                                        @endif
                                        <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" href="#myModal{{$product->id}}" title="View Product"><i class="fa fa-lg fa-eye"></i></a>
                                        <a class="btn btn-sm" href="{{route('add.images',$product->id)}}" style="background-color: #00AAAA!important; color: #fff!important;" title="Add Alternate Images"><i class="fa fa-lg fa-plus"></i></a>
                                        <a class="btn btn-secondary btn-sm" href="{{route('show.reviews',$product->id)}}" title="Manage Product Reviews"><i class="fa fa-lg fa-comment"></i></a>
                                        <a class="btn btn-danger btn-sm delete-product" rel="{{$product->id}}">
                                            <i class="fa fa-lg fa-trash" style="color: white!important;"></i></a>

                                    </div>


                                </td>

                                <style>
                                    .modal-lg{
                                        max-width: 70%!important;
                                    }
                                </style>
                                <div class="actions"style="margin-top: 0!important;">
                                    <div class="modal hide" id="myModal{{$product->id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">{{$product->product_name}} Full Details</h4>
                                                </div>


                                                <div class="modal-body">
                                                    <div class="row">

                                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                                            <p><b>Product ID:</b> {{$product->id}}</p>
                                                            <p><b>Niche:</b>
                                                                <?php
                                                                $cat = \App\Category::where('id',$product->category->parent_id)->get();
                                                                foreach($cat as $item){
                                                                    echo $item->name;
                                                                }

                                                                ?>
                                                            </p>
                                                            <p><b>Category:</b> {{$product->category->name}}</p>
                                                            <p><b>Brand:</b> {{$product->brand->name}}</p>
                                                            <p><b>Product Code:</b> {{$product->product_code}}</p>
                                                            @if($product->stock_status == "yes")
                                                            <p><b>Available Swatches:</b>
                                                                @foreach ($product->attributes as $value)
                                                                    {{ $loop->first ? '' : ', ' }}
                                                                    {{ $value->color }}
                                                                @endforeach
                                                            </p>
                                                            @endif

                                                        </div>


                                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                                            <p><b>Product Price: </b>{{$product->price}}</p>
                                                            <p><b>Description: </b><span style="display: inline!important;">{!! $product->description !!}</span></p>
                                                            <p><b>Product Added On: </b>{{date('M j, Y',strtotime($product->created_at))}}</p>
                                                            <p><b>Status: </b>
                                                                @if($product->status == 1) <span style="color: forestgreen">Active</span>@elseif($product->status == 0)
                                                                    <span style="color: indianred">Inactive</span>@endif
                                                            </p>

                                                            <p><b>Publisher: </b>{{$product->user->username}}</p>
                                                            <p>
                                                            <div class="animated-checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="featured" @if($product->featured == 1)checked="checked"@endif><span class="label-text">Featured Item</span>
                                                                </label>
                                                            </div>
                                                            <hr>
                                                            <div class="toggle" style="">
                                                                <label>
                                                                    <input type="checkbox" name="review" @if($product->review == 1)checked="checked"@endif><span class="button-indecator" style="display: inline"></span><span style="display: inline">Product Review</span>
                                                                </label>
                                                            </div>
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <h6>Product Picture</h6>
                                                           <div style="align-content: center;text-align: center">
                                                            <img src='{{asset("images/backend/products/medium/$product->image")}}' class="img img-responsive img-thumbnail">
                                                           </div>

                                                        </div>

                                                        @if($product->video != '')
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <h6>Product Video</h6>
                                                            <div style="align-content: center; text-align: center">
                                                                <video width="320" height="240" controls>
                                                                    <source src="{{url('videos/'.$product->video)}}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    <style>
                                                        .owl-carousel .item img{
                                                            display: block;
                                                            width: 100%;
                                                            height: auto;
                                                        }
                                                    </style>

                                                        <?php
                                                        $images = \App\Picture::where('product_id',$product->id)->get();
                                                        ?>


                                                        @if($images->count() > 0)
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <h6>Product Alternate Pictures</h6>

                                                            <?php
                                                            $images = \App\Picture::where('product_id',$product->id)->get();

                                                            ?>


                                                            <div class="owl-carousel owl-theme">
                                                                @foreach($images as $image)

                                                                    <div class="item">
                                                                        <img src="{{asset('images/backend/pictures/medium/'.$image->image)}}" class="img img-thumbnail img-responsive" style="width:100%">
                                                                    </div>
                                                                @endforeach
                                                            </div>


                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                </div>
                            </tr>
                        @endforeach


                        </tbody>
                        </table>
                        <b>Bulk Action:</b> <button type="button" class="btn btn-default" id="deleteButton">Delete</button>
                         <input type="submit" class="btn btn-default" value="Send Newsletter" formaction="{{route('send.newsletter')}}">
                         &nbsp;<a href="javascript:void(0);" id="text-link">Open/Close Message Section</a>

                        <div id="textarea" style="display: none!important;" class="row">
                         <div class="col-md-2">
                             <input type="text" class="form-control"  placeholder="Topic of mail" name="topic" formaction="{{route('send.newsletter')}}">
                         </div>
                         <div class="col-md-4 col-xl-4 col-lg-4" >
                             <textarea name="body" class="form-control" formaction="{{route('send.newsletter')}}" id="message"></textarea>
                         </div>


                        </div>


                    </form>


                    <style>
                        .shop-breadcrumb-area.border-default {
                            padding: 20px;
                        }

                        .pfolio-breadcrumb-list li {
                            display: inline;
                        }

                        .pfolio-breadcrumb-list li a {
                            font-size: 14px;
                            font-weight: 400;
                            padding: 0 5px;
                        }

                        .pfolio-breadcrumb-list li.active a {
                            color: #7b7b7b;
                        }

                        .pfolio-breadcrumb-list li i {
                            font-size: 16px;
                        }

                        .pfolio-breadcrumb-list li.prev a i {
                            margin-right: 4px!important;
                        }
                        .pfolio-breadcrumb-list li.next a i {
                            margin-left: 4px!important;
                        }
                        .pfolio-breadcrumb-list li:hover a {
                            color: #c7b270;
                        }
                    </style>

                    <div class="shop-breadcrumb-area border-default mt-30">
                        <div class="center" style="text-align: center!important;">
                            <div style="display: inline!important;">
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script type="text/javascript" src="{{asset('js/backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backend/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backend/plugins/tinymce/tinymce.min.js')}}"></script>

    <script>
        tinymce.init({
            selector : '#message'
        });
    </script>


    <script type="text/javascript">
        $('#sampleTable').DataTable(
                {
                    "paging": false,
                }
        );
    </script>



    <script>
        $('.delete-product').click(function(){
            var id = $(this).attr('rel');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Are you sure?",
                text: "This Product Will No Longer Exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete product!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-product/"+ id;

                } else {
                    swal("Cancelled", "The product still exists :", "error");
                }
            });
        });
    </script>

    <script type="text/javascript" src="{{asset('js/backend/plugins/owl.carousel.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#textarea").hide();
    $('.owl-carousel').owlCarousel(
            {
                nav: true,
                navText:['Prev','Next'],
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem:true,
                items:1
            }
    );
    $("#text-link").on('click',function () {
        $("#textarea").toggle();
    })

    });
</script>

<script>
    $("#deleteButton").on('click',function(){
        var token = $("meta[name='csrf-token']").attr("content");
        swal({
            title: "Are you sure?",
            text: "The selected products will no longer exist!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete products!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $("#bulk_form").submit();

            } else {
                swal("Cancelled", "The products still exist :", "error");
            }
        });
    });
</script>
@endsection