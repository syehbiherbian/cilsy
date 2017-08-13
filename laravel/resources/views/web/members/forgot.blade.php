@extends('web.app')
@section('title','Ubah Kata Sandi | ')
@section('content')
<div id="sign-container">
        @if (Session::has('error'))
        <div class="alert alert-success">
          <strong>Email Sent! Check your email</strong> {{ Session::get('success') }}.
        </div>
        @endif
            <form action="{{action('Web\Members\AuthController@doforgotpassword')}}" method="post">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <label for="exampleInputFile"><i class="fa fa-envelope"></i> Masukkan Email Anda :</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>

</div>

@endsection
