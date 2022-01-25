@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-edit')
@section('page_title','Coupons')
@section('breadcrumbs')
    {!! Breadcrumbs::render('view.coupons') !!}
@endsection

<div class="row">
    <div class="col-xl-1 col-lg-1">
    </div>
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h4 class="card-header">Coupons <span class="text-right" style="float: right!important;">
                    <a href="{{route('add.coupon')}}" title="Add New Coupon" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                    </a>
                </span></h4>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">

                            <table class="table table-bordered" id="cat_table">
                                <tr>
                                    <th width="30px">No:</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Amount</th>
                                    <th>Coupon Type</th>
                                    <th>Created On</th>
                                    <th>Expiry Date</th>
                                    <th>Actions</th>
                                </tr>

                                <div class="chat-box scrollable">

                                    @foreach($coupons as $value)

                                        <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->coupon_code}}</td>
                                        <td>@if($value->amount_type == 'Fixed')₦ @endif{{$value->amount}}@if($value->amount_type == 'Percentage')% @endif</td>
                                        <td>{{$value->amount_type}}</td>
                                        <td>
                                            {{date('D M j, Y',strtotime($value->created_at))}}
                                        </td>

                                        <td>
                                            {{date('D M j, Y',strtotime($value->expiry_date))}}
                                        </td>

                                        <td>
                                            <a class="d-inline-block edit-modal btn btn-warning btn-sm" href="{{route('edit.coupon',$value->id)}}" title="Edit Coupon"><i class="fa fa-pencil"></i></a>

                                            <button type= "button" title="Delete Coupon" class="d-inline-block delete-cat btn btn-danger btn-sm" rel="{{$value->id}}">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </td>





                                        </tr>



                                    @endforeach

                                </div>
                            </table>


                            
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
    <div class="col-xl-1 col-lg-1">
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backend/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#cat_table').DataTable();</script>

    <script>
        $('.delete-cat').click(function(){
            var id = $(this).attr('rel');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Are you sure?",
                text: "This coupon will no longer exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete coupon!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-coupon/"+ id;

                } else {
                    swal("Cancelled", "The coupon still exist :", "error");
                }
            });
        });
    </script>

@endsection

