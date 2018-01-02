@extends('web.app')
@section('title','Masuk | ')
@section('content')
<div id="sign-container">
    <div class="tab-btn-container">
      <a href="{{ url('member/signup')}}" id="tab-1" style="background-color: #ededed">Daftar</a>
      <a href="{{ url('member/signin')}}" id="tab-2" >Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap :</label>
                    <input type="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Konfirmasi Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
            </form> -->
        </div>
        <div id="tab-2-content" >

            @if (Session::has('success'))
              <div class="alert alert-success">
                <strong>Well done!</strong> {{ Session::get('success') }}.
              </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('member/signin') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" name="email">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control" id="password-field" name="password">
                    <span title="Click here to show/hide password" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="{{ url('member/reset') }}"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form>
        </div>
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
