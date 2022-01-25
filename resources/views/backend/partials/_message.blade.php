<style>

</style>
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

<script>

</script>








<script>
    $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(20000, 0).slideUp(20000, function(){
                $(this).remove();
            });
        }, 20000);
    });
</script>