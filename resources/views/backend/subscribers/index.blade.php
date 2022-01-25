@extends('backend.layouts.master')

@section('icon','fa fa-list')
@section('page_title','All Subscribers')
@section('breadcrumbs')
    {!! Breadcrumbs::render('subscribers') !!}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <a href="" class="btn btn-sm" target="-_blank">Export To Excel</a>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>ID:</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td>{{$subscriber->id}}</td>
                                <td>{{$subscriber->email}}</td>
                                <td>@if($subscriber->status == 1) <span style="color: forestgreen">Active</span>@elseif($subscriber->status == 0)
                                        <span style="color: indianred">Inactive</span>@endif</td>
                                <td>{{date('M j, Y h:ia',strtotime($subscriber->created_at))}}</td>
                                <td><button type= "button" title="Delete Coupon" class="d-inline-block delete-sub btn btn-danger btn-sm" rel="{{$subscriber->id}}">
                                    <span class="fa fa-trash"></span>
                                </button>
                                @if($subscriber->status == 1)
                                <a href="{{route('deactivate.subscriber',$subscriber->id)}}" class="btn btn-sm">Deactivate</a>
                                @elseif ($subscriber->status == 0)
                                <a href="{{route('activate.subscriber',$subscriber->id)}}" class="btn btn-sm">Activate</a>
                                @endif
                                </td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                    

                    <div class="shop-breadcrumb-area border-default mt-30">
                        <div class="center" style="text-align: center!important;">
                            <div style="display: inline!important;">
                                {{$subscribers->links()}}
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
    <script type="text/javascript">
        $('#sampleTable').DataTable(
                {
                    "paging": false,
                }
        );
    </script>

<script>
    $('.delete-sub').click(function(){
        var id = $(this).attr('rel');
        var token = $("meta[name='csrf-token']").attr("content");
        swal({
            title: "Are you sure?",
            text: "This subscriber will no longer exist!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete subscriber!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = "delete-subscriber/"+ id;

            } else {
                swal("Cancelled", "The coupon still exist :", "error");
            }
        });
    });
</script>
@endsection
