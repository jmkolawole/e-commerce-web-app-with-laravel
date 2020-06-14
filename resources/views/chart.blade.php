@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart Demo</div>

                    <div class="panel-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
<script type="text/javascript" src="{{asset('js/backend/plugins/chart.js')}}"></script>
{!! $chart->script() !!}}}
