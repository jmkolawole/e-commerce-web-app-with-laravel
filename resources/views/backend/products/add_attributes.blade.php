@extends('backend.layouts.master')

@section('icon','fa fa-plus')
@section('page_title','Add Product Attribute(s)')



@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">

                    <div class="col-md-5 col-lg-5">
                        <div class="tile-body">
                            <h3 class="tile-title" style="display: inline!important;">Product Alternate Attribute</h3>
                            <a class="" href="{{route('view.products')."#$product->id"}}" style="display: inline!important;float: right!important;"> Back </a>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <h5 class="card-header">Product Details</h5>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td><b>Product Name:</b></td>
                                    <td>{{$product->product_name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Product Code:</b</td>
                                    <td>{{$product->product_code}}</td>
                                </tr>
                                <tr>
                                    <td><b>Product Price:</b></td>
                                    <td>{{$product->price}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-7 col-lg-7">
                        <div class="card">
                            <h5 class="card-header">Add Products Attribute</h5>
                            <div class="card-body">
                                <form action="{{route('add.attributes',$product->id)}}" method="POST" class="">
                                    Color <input type="radio" name="type" value="color" checked="checked" id="check1">
                                    Size <input type="radio" name="type" value="size" id="check2">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="product_code" class="col-sm-3 text-right control-label col-form-label">Product Color:</label>
                                        <div class="col-sm-9">
                                            <div class="field_wrapper">

                                            <input  type="text" name="color[]" value="" class="form-control" style="width:35%!important;display: inline!important;" id="size" placeholder="Variant / Size"/>
                                            <input  type="number" name="stock[]" value="" class="form-control" style="width:35%!important;display: inline!important;" id="size" placeholder="Stock"/>
                                            <input type="color" name="picker[]" id="picker" class="picker">&nbsp;&nbsp;
                                            <a href="javascript:void(0);" class="add_button" style="display: inline!important;" title="Add field"><span class="fa fa-plus">Add</span></a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile-footer"><button class="btn btn-primary" type="submit">Add</button></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card">
                    <h3 class="card-header">Product Attributes</h3>
                    <div class="card-body">
                        <div class="container" style="padding: 2px!important;">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                    <div class="table-responsive">

                                        <form action="{{route('edit.attributes',$product->id)}}" method="POST">
                                            {{csrf_field()}}
                                            <table id="my_Table" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Attribute ID</th>
                                                    <th>Color</th>
                                                    <th>Stock</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $counter = 0;?>
                                                @foreach($product->attributes as $prod)
                                                    <?php $counter++;?>
                                                    <tr>
                                                        <td><input type="hidden" name="idAttr[]" value="{{$prod->id}}">{{$counter}}</td>
                                                        <td><input type="text" value="{{$prod->color}}" class="form-control" name="color[]"
                                                                   style="display: inline!important;width:85%!important;">
                                                            @if($prod->picker != "")
                                                            <input type="color" name="picker[]" id="picker" value="{{$prod->picker}}">
                                                             @endif
                                                        </td>
                                                        <td><input type="text" value="{{$prod->stock}}" class="form-control" name="stock[]"></td>
                                                        <td class="-align-center">
                                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this attribute?')"
                                                               href="{{route('delete.attribute',$prod->id)}}">
                                                                <span style="color: white!important;">Delete</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>


                                            </table>
                                            <span><input type="submit" value="Update" class="btn btn-secondary"></span>
                                        </form>
                                    </div>

                                </div>



                            </div>

                        </div>
                        <div style="margin-top: 10px!important;" class="text-center">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection





@section('script')


    <script>
        $(document).ready(function(){


            $("#check1").on('click',function () {

                if (document.getElementById('check1').checked) {
                    $(".picker").show();
                }
            });




            $("#check2").on('click',function () {

                if (document.getElementById('check2').checked) {
                       $(".picker").hide();
                }
            });



            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div>' +
                '<input type="text" name="color[]" class="form-control" value="" placeholder="Variant / Size" style="margin-right: 4px!important;' +
                    'margin-top: 4px;!important; width:35%;display: inline"/>' + '' +
                '<input  type="number" name="stock[]" value="" class="form-control" style="width:35%!important;display: inline!important;" id="size" placeholder="Stock"/>' +
                '<input type="color" name="picker[]" id="picker" class="picker">&nbsp;&nbsp;'+
                    ' <a href="javascript:void(0);" class="remove_button"> <span class="fa fa-minus" style="color: red!important;">Remove</span></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });



        });
    </script>

@endsection