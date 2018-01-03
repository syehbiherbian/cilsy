@extends('web.app')
@section('title','Ubah Kata Sandi | ')
@section('content')
<div id="sign-container">

    <div class="tab-content">
        <h2>Ganti Password</h2>

        @if (Session::has('error'))
        <div class="alert alert-success">
          <strong>Well done!</strong> {{ Session::get('success') }}.
        </div>
        @endif
            <form action="{{ url('member/change') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputFile">Password Lama :</label>
                    <input type="password" class="form-control" name="password" id="password-field">
                    <span title="Click here to show/hide password" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password Baru :</label>
                    <input type="password" class="form-control" name="password" id="password1">
                    <span title="Click here to show/hide password" toggle="#password1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Konfirmasi Password :</label>
                    <input type="password" class="form-control" name="retypepassword" id="password2">
                    <span title="Click here to show/hide password" toggle="#password2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <button type="submit" class="btn btn-primary">Ganti Password</button>
            </form>

    </div>
</div>
<script type="text/javascript">
    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
</script>
@endsection
