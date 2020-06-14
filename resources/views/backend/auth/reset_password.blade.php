<!DOCTYPE html>
<html>
@include('backend.partials._head')
<style>
    .login-content .login-box {
        position: relative;
        min-height: 420px!important;}
</style>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Vali</h1>
    </div>
    <div class="login-box">
        <form class="login-form" action="{{route('reset.password')}}" method="POST">
            {{csrf_field()}}
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Change Password</h3>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="text" name="email" placeholder="Email" autofocus readonly value="{{$tokenData->email}}">
            </div>

            <input type="hidden" name="token" value="{{$tokenData->token}}">
            <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" type="password" placeholder="Password" name="password">
            </div>

            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation">
            </div>

            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Change</button>
            </div>
            <br>
            <br>
        </form>

    </div>
</section>

@include('backend.partials._javascript')

</body>
</html>