



@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <ol class="breadcrumb breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">404</li>
        </ol>
    </div>
</div>

<div class="error404-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-wrapper text-center">
                    <div class="error-text">
                        <h1>404</h1>
                        <h2>Opps! PAGE NOT BE FOUND</h2>
                        <p>Uh... So it looks like you found yourself on the wrong page. The page you are looking for does not exist, have been removed, name
                            changed or is temporarily unavailable.</p>
                    </div>
                    <div class="search-error">
                        <form id="search-form" action="{{route('search')}}" method="GET">
                            <input type="text"  name="product" placeholder="Search For Products Instead">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="error-button">
                        <a href="{{route('home')}}">Take Me Back Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
