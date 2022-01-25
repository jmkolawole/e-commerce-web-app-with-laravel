@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-user')
@section('page_title','Users')
@section('breadcrumbs')
    {!! Breadcrumbs::render('show.users') !!}
@endsection


<div class="row">

    <div class="col-md-12">
        <div class="tile">
            <a href="{{route('add.user')}}" class="btn btn-success btn-sm"
               style="float: right!important;margin-bottom: 10px;">
                Add New Admin <i class="fa fa-plus"></i>
            </a>
            <h3 class="tile-title">All Admins</h3>


                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="table">
                        <thead>
                        <tr>
                            <th><b>No:</b></th>
                            <th><b>Username</b></th>
                            <th colspan="3" style="text-align: center!important;"><b>Role(s)</b></th>
                            <th><b>Active</b></th>
                            <th><b>Action</b></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><b>User</b></th>
                            <th><b>Author</b></th>
                            <th><b>Admin</b></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $no = 0;?>

                        @foreach($users as $user)
                            <?php $no++;?>
                            <tr class="item{{$user->id}}">
                                <form action="{{ route('assign.user') }}" method="POST">
                                    {{csrf_field()}}
                                    <td>{{$no}}<input type="hidden" name="id" value="{{$user->id}}"></td>
                                    <td>{{$user->username}}</td>
                                    <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                                    <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                                    <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                                    <style>
                                        input[type="checkbox"][readonly]{pointer-events: none}
                                    </style>
                                    <td>
                                        <input type="checkbox" class="form-control" readonly
                                               @if($user->active == 1)
                                               checked ="checked"
                                                @endif>
                                    </td>


                                    <td>
                                        <button type="submit" class="btn btn-xs btn-secondary">Assign Role</button>
                                </form>
                                <a type="button" href="#show{{$user->id}}" class="btn btn-xs btn-success" data-toggle="modal"><span class="fa fa-eye"></span></a>

                                <div  class="modal fade" id="show{{$user->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">User Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-lg-10">


                                                        <div class="form-group">
                                                            <label for="">Username:</label>
                                                            <b>{{$user->username}}</b>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="">Email Address:</label>
                                                            <b>{{$user->email}}</b>
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="">Created:</label>
                                                            <b>{{$user->updated_at->diffForHumans()}}</b>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Last Updated:</label>
                                                            <b>{{$user->updated_at->diffForHumans()}}</b>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Roles:</label>
                                                            @foreach($user->roles as $level)
                                                                <b>{{$level->name}}</b>
                                                            @endforeach

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Status:</label>
                                                            @if($user->active == 1)
                                                                <b style="color: green!important;">Active</b>
                                                            @else
                                                                <b style="color: red!important;">Inactive</b>
                                                            @endif

                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-lg-2">
                                                        <style>
                                                            .user-avatar-md{
                                                                height: 70px;
                                                                width: 70px;
                                                            }

                                                        </style>
                                                        <img src="{{asset('images/backend/users/'.$user->image)}}" alt="" class="user-avatar-md rounded-circle">
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <a type="button" href="#edit{{$user->id}}" class="btn btn-xs btn-primary" data-toggle="modal"><span class="fa fa-edit"></span></a>
                                <div class="modal fade" id="edit{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit User</h4>
                                            </div>
                                            <div class="modal-body">

                                                <form class="form-horizontal" method="POST" role="form" action="{{route('edit.user')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="name" class="control-label">Username</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user->username}}"
                                                                   id="name" name="username">
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="name" class="control-label">Email</label>
                                                            <input type="email" class="form-control"
                                                                   value="{{$user->email}}"
                                                                   id="name" name="email">
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="custom-control custom-checkbox">

                                                                <input type="checkbox" @if($user->active == 1)checked @endif class="custom-control-input" name="active">
                                                                <span class="custom-control-label">Active</span>
                                                            </label>
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


                                    <button type= "button" class="btn btn-xs btn-danger d-inline-block deleteAdmin" rel="{{$user->id}}">
                                        <span class="fa fa-trash"></span></button>

                                </td>



                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>








        </div>
    </div>


</div>


@endsection


@section('script')
    <script type="text/javascript" src="{{asset('js/backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backend/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#table').DataTable();</script>

    <script>
        $('.deleteAdmin').click(function(){
            var id = $(this).attr('rel');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Are you sure?",
                text: "This user will no longer exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete user!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax(
                            {
                                url: "user/delete/"+id,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function (){
                                    $('.item'+id).remove();
                                    swal("Deleted!", "The user has been successfully deleted.", "success");
                                }
                            });

                } else {
                    swal("Cancelled", "The user still exist :", "error");
                }
            });
        });
    </script>
@endsection