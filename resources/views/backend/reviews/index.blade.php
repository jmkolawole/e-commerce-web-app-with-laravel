@extends('backend.layouts.master')

@section('icon','fa fa-plus')
@section('page_title','Add Product Attribute(s)')



@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="tile-body">
                            <h3 class="tile-title" style="display: inline!important;">Customer Reviews On "{{$product->product_name}}"</h3>
                            <a class="" href="{{route('view.products')."#$product->id"}}" style="display: inline!important;float: right!important;"> Back </a>
                            <div class="comment-widgets scrollable">


                                @foreach($reviews as $review)
                                    <div class="d-flex flex-row comment-row m-t-0" id="">

                                        <div class="comment-text w-100">
                                            <?php
                                            $name = \App\Visitor::where('id',$review->user_id)->first();
                                            ?>
                                            <br>
                                            <h5 class="font-medium d-inline-block mt-40">{{$review->title}}</h5>
                                            <span><i>({{$name->first_name}})</i></span>
                                            <span class="m-b-15 d-block"><p>
                                                    {{$review->body}}

                                                </p>
                                            </span>

                                             <div>

                                                @if($review->rating == 1)

                                                        <i>Rating: &nbsp;</i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>

                                                @elseif($review->rating == 2)

                                                    <i>Rating: &nbsp;</i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>


                                                @elseif($review->rating == 3)

                                                    <i>Rating: &nbsp;</i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>


                                                @elseif($review->rating == 4)

                                                    <i>Rating: &nbsp;</i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>



                                                @elseif($review->rating == 5)

                                                    <i>Rating: &nbsp;</i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>

                                                    @endif
                                             </div>

                                            <div class="comment-footer">
                                                <span class="text-muted float-right"></span>
                                                <a type="button" data-toggle="modal"  data-target="#show{{$review->id}}" class="btn btn-cyan btn-sm">Edit</a>
                                                <div class="modal fade" id="show{{$review->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Edit Review</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form autocomplete="off" action="{{route('admin.edit.review',$review->id)}}" method="POST">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="product_id" value="{{$review->product_id}}">
                                                                    <div class="form-group">
                                                                        <label class="req" for="subject">Title of review<span style="color: red">*</span></label>
                                                                        <input type="text" class="form-control" value="{{$review->title}}" id="subject" name="title"
                                                                               required="required">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="req" for="subject">Rating<span style="color: red">*</span></label>
                                                                        <select class="form-control" name="rating">
                                                                            <option value="1" @if($review->rating == 1)selected @endif>1</option>
                                                                            <option value="2" @if($review->rating == 2)selected @endif>2</option>
                                                                            <option value="3" @if($review->rating == 3)selected @endif>3</option>
                                                                            <option value="4" @if($review->rating == 4)selected @endif>4</option>
                                                                            <option value="5" @if($review->rating == 5)selected @endif>5</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="req" for="comments">Your Review</label>
                                                                        <textarea class="form-control" name="body" rows="5" id="comments"
                                                                                  required="required">{{$review->body}}</textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="toggle-flip">
                                                                            <input type="checkbox"  name="approve" @if($review->approve == 1)checked="checked" @endif>
                                                                            <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                                        </label>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-info btn-sm">Save Changes</button>
                                                                </form>

                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>

                                                @if(Auth::user()->hasRole('Admin'))
                                                    <a class="btn btn-danger btn-sm" onclick="deleteReview({{$review->id}})">
                                                        <span style="color: white!important;">Delete</span></a>
                                                @endif



                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach

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

                                <hr>


                                <div class="shop-breadcrumb-area border-default mt-30">
                                    <div class="center" style="text-align: center!important;">
                                        <div style="display: inline!important;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function deleteReview(clicked) {


        swal({
            title: "Are you sure?",
            text: "This Review Will No Longer Exist!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete review!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                location.href = "http://localhost/alvinsmakeup/public/admin/delete-review/"+clicked;

            } else {
                swal("Cancelled", "The Review Still Exists :", "error");
            }
        });




        }

</script>