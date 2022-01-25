@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-edit')
@section('page_title','Categories')
@section('breadcrumbs')
    {!! Breadcrumbs::render('categories') !!}
@endsection

<div class="row">
    <div class="col-xl-2 col-lg-2">
    </div>
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h4 class="card-header">Categories</h4>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">

                            <table class="table table-bordered" id="cat_table">
                                <tr>
                                    <th width="150px">No:</th>
                                    <th>Name</th>
                                    <th>Level/Parent</th>
                                    <th class="text-center" width="150px">
                                        @if(Auth::user()->hasRole('Admin'))
                                            <button href="" class="create-modal btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        @endif
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <form class="form-horizontal" role="form" method="POST" action="{{route('add.category')}}">
                                                    {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"></h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group row add">
                                                                <label class="control-label col-sm-3" for="name">Name:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="name" name="name"
                                                                           placeholder="Type Category name Here" required>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="level" class="col-sm-3 text-right control-label col-form-label">Category Level</label>
                                                                <div class="col-sm-9">
                                                                    <select name="parent_id" class="form-control">
                                                                        <option value="0">Main Category</option>
                                                                        @foreach($levels as  $level)
                                                                            <option value="{{$level->id}}">{{$level->name}}</option>

                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row add">
                                                                <label class="control-label col-sm-3" for="name">Description: </label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control" name="description"></textarea>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row add">
                                                                <label class="control-label col-sm-3" for="name">Keywords: </label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control" name="keywords"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-check form-group row">
                                                                <label class="form-check-label control-label col-sm-3 col-md-3"
                                                                      style="position: relative;left: -190px;"
                                                                       for="status">Enabled:</label>
                                                                <div class="col-sm-9 col-md-9" style="display: relative;left: -40px;top: -20px">
                                                                <input class="form-check-input" name="status" type="checkbox">
                                                                </div>
                                                            </div>





                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit" id="add">
                                                                <span class="fa fa-save"></span> Save
                                                            </button>
                                                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                                                <span class="fa fa-window-close"></span> Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <div class="chat-box scrollable">

                                    @foreach($categories as $value)

                                        <tr class="tag{{$value->id}}">
                                            <td>{{ $value->id }}</td>
                                            <td><a href="{{route('show.category.products',$value->url)}}">{{ ucwords($value->name) }}</a></td>
                                            <td>
                                                @if($value->parent_id != 0)
                                                <?php
                                                    $parent = \App\Category::where('id',$value->parent_id)->get();
                                                    foreach($parent as $p){
                                                        echo ucwords($p->name);
                                                    }
                                                    ?>
                                                @else
                                                    Main Category
                                                @endif
                                            </td>
                                            <td><div class="actions">
                                                    <a class="d-inline-block show-modal btn btn-info btn-sm" data-toggle="modal"
                                                       href="#show{{$value->id}}"><i class="fa fa-eye"></i></a>
                                                    <div  class="modal fade" id="show{{$value->id}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Category Details</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="">Name:</label>
                                                                        <b><a href="">{{$value->name}}</a></b>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="">Parent:</label>
                                                                        <b><a href="">
                                                                                @if($value->parent_id != 0)
                                                                                    <?php
                                                                                    $parent = \App\Category::where('id',$value->parent_id)->get();
                                                                                    foreach($parent as $p){
                                                                                        echo ucwords($p->name);
                                                                                    }
                                                                                    ?>
                                                                                @else
                                                                                    Main Category
                                                                                @endif

                                                                            </a></b>
                                                                    </div>

                                                                    @if($value->description != "")
                                                                    <div class="form-group">
                                                                        <label for="">Description:</label>
                                                                        <b>{{$value->description}}</b>

                                                                    </div>
                                                                    @endif

                                                                    @if($value->keywords != "")
                                                                    <div class="form-group">
                                                                        <label for="">Keywords:</label>
                                                                        <b>{{$value->keywords}}</b>

                                                                    </div>
                                                                    @endif

                                                                    <div class="form-group">
                                                                        <label for="">Created:</label>
                                                                        <b>{{$value->updated_at->diffForHumans()}}</b>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="">Last Updated:</label>
                                                                        <b>{{$value->updated_at->diffForHumans()}}</b>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    @if(Auth::user()->hasRole('Admin'))
                                                        <a class="d-inline-block edit-modal btn btn-warning btn-sm" data-toggle="modal"
                                                           href="#{{$value->id}}"><i class="fa fa-pencil"></i></a>
                                                        <div class="modal fade" id="{{$value->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Edit Category</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form class="form-horizontal" method="POST" role="form" action="{{route('edit.category',$value->id)}}">
                                                                            {{csrf_field()}}
                                                                            <div class="card-body">
                                                                                <div class="form-group row">
                                                                                    <label for="name" class="control-label">Category</label>
                                                                                    <input type="text" class="form-control"
                                                                                           value="{{$value->name}}"
                                                                                           id="name" name="name">
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="level" class="control-label">Category Level</label>
                                                                                        <select name="parent_id" class="form-control">
                                                                                            <option value="0">Main Category</option>
                                                                                            @foreach($levels as  $level)
                                                                                                <option value="{{$level->id}}"
                                                                                                        @if($level->id == $value->parent_id) selected @endif>{{$level->name}}</option>

                                                                                            @endforeach

                                                                                        </select>

                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="description" class="control-label">Description</label>

                                                                                    <textarea class="form-control" name="description">{{$value->description}}</textarea>

                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="description" class="control-label">Keywords</label>
                                                                                    <textarea class="form-control" name="keywords">{{$value->keywords}}</textarea>
                                                                                </div>

                                                                                <div class="form-check form-group row">
                                                                                    <label class="form-check-label control-label col-sm-3 col-md-3"
                                                                                           style="position: relative;left: -35px;"
                                                                                           for="status">Enabled:</label>
                                                                                    <div class="col-sm-9 col-md-9" style="display: relative;left: 45px;top: -20px">
                                                                                        <input class="form-check-input" name="status" type="checkbox" @if($value->status == 1) checked="checked"@endif>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>
                                                    @endif


                                                    @if(Auth::user()->hasRole('Admin'))

                                                        @if($value->parent_id != 0)
                                                        <button type= "button" class="d-inline-block delete-cat btn btn-danger btn-sm" rel="{{$value->id}}">
                                                            <span class="fa fa-trash"></span></button>
                                                        @elseif($value->parent_id == 0)
                                                            <button type= "button" class="d-inline-block delete-cat2 btn btn-danger btn-sm" rel="{{$value->id}}">
                                                                <span class="fa fa-trash"></span></button>
                                                         @endif

                                                    @endif

                                                </div></td>
                                        </tr>


                                    @endforeach


                                </div>
                            </table>


                        </div>

                       

                        <div class="shop-breadcrumb-area border-default mt-30">
                            <div class="center" style="text-align: center!important;">
                                <div style="display: inline!important;">
                                {{$categories->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-2">
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
                text: "This category will no longer exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete category!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-category/"+ id;

                } else {
                    swal("Cancelled", "The category still exist :", "error");
                }
            });
        });
    </script>


    <script>
        $('.delete-cat2').click(function(){
            var id = $(this).attr('rel');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Are you sure?",
                text: "This main category will no longer exist!. All sub categories will be deleted as well. You can move them to another category " +
                "before performing this action",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete category!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-category/"+ id;

                } else {
                    swal("Cancelled", "The category still exist :", "error");
                }
            });
        });
    </script>
@endsection

