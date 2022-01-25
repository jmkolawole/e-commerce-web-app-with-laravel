@extends('backend.layouts.master')

@section('content')

@section('icon','fa fa-plus')
@section('page_title','Coupons')

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.coupon') !!}
@endsection

    <form class="form-horizontal" name="add_product" method="POST" action="{{route('add.coupon')}}">
        {!! csrf_field() !!}


        <div class="row">
            <div class="col-md-2 col-lg-2"></div>



            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <h4 class="card-header">Coupons</h4>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="coupon_code" class="col-sm-12 control-label col-form-label">Coupon Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" minlength="5"
                                       maxlength="15" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="amount" class="col-sm-12  control-label col-form-label">Amount</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01"placeholder="amount" required min="1">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="level" class="col-sm-12 control-label col-form-label">Amount Type</label>
                            <div class="col-sm-12">
                                <select name="amount_type" class="select2 form-control custom-select">
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="expiry_date" class="col-sm-12 control-label col-form-label">Expiry Date</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="url" class="col-sm-2 control-label col-form-label" style="position: relative;left:-1em!important;">Enable</label>

                            <div class="custom-control custom-checkbox col-sm-9 col-md-10" style="position: relative;left:-15em!important;top:-1em!important;">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="status" id="status" value="1">
                                <label class="custom-control-label" for="customControlAutosizing1" style="position: relative!important;left: 300px;top:-30px;"></label>
                            </div>
                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Add Coupon</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-2 col-lg-2"></div>

        </div>

    </form>


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
                text: "This brand will no longer exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete brand!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-brand/"+ id;

                } else {
                    swal("Cancelled", "The brand still exist :", "error");
                }
            });
        });
    </script>

@endsection


