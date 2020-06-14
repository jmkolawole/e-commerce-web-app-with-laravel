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
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

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
@endsection