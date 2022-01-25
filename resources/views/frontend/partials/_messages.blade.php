<style>
    .notify-alert {
        -webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23)!important;, 0 3px 5px rgba(0, 0, 0, 0.16);
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23)!important;, 0 3px 5px rgba(0, 0, 0, 0.16);
        border: 0 !important;
        max-width: 400px;
        color: #FFF;
        font-size: .9em!important;
        padding:6px!important;
        position:absolute!important;
        z-index:1!important;

    }

    .notify-alert.alert-success {
        background-color: #28a745;
    }

    .notify-alert.alert-info {
        background-color: #17a2b8;
    }

    .notify-alert.alert-warning {
        background-color: #ffce3a;
    }

    .notify-alert.alert-danger {
        background-color: #e04b59;
    }

    .notify-alert button[data-notify="dismiss"] {
        margin-left: 5px;
        outline: none !important;
    }

</style>
<script src="{{asset('js/frontend/js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/frontend/js/bootstrap-notify.min.js')}}"></script>




@if(Session::has('success'))
    <script type="text/javascript">
        $(document).ready(function(){
            $.notify({
                title: "Success : ",
                message: "{{ Session::get('success')}}",
                icon: 'fa fa-check'
            },{
                type: "success"
            });
        });
    </script>
@endif


@if(Session::has('failure'))
    <script type="text/javascript">
        $(document).ready(function(){
            $.notify({
                title: "Failure : ",
                message: "{{ Session::get('failure')}}",
                icon: 'fa fa-close'
            },{
                type: "danger"
            });
        });
    </script>
@endif




@if(Session::has('deleted'))
    <script>

        $(document).ready(function(){
            swal({
                title: "Deleted",
                text: "{{ Session::get('deleted')}}",
                type: "success",
                confirmButtonText: "Ok",
                closeOnConfirm: true,
            });
        });
    </script>
@endif




@if(Session::has('done'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        swal('Success!',"Item Removed From Cart",'success');
    </script>
@endif





<script>
    $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(20000, 0).slideUp(20000, function(){
                $(this).remove();
            });
        }, 20000);
    });
</script>
