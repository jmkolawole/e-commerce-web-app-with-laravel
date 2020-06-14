@extends('backend.layouts.master')

@section('icon','fa fa-plus')
@section('page_title','New Testimony')
@section('breadcrumbs')
    {!! Breadcrumbs::render('add.testimony') !!}
@endsection


@section('content')

    <div class="tile">
        <div class="tile-body">

            <div class="section-block" id="basicform">
                <h3 class="section-title">Testimony</h3>
                <p>Create a new testimony to be displayed on the home page</p>
            </div>
            <div class="card">
                <h5 class="card-header">Testimony details</h5>
                <div class="card-body">
                    <form action="{{route('add.testimony')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Customer Name(s)</label>
                            <input id="inputText3" type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Body</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Create <i class="fa fa-arrow-right ml-2"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>

    </div>


@endsection
