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
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password Baru :</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Konfirmasi Password :</label>
                    <input type="password" class="form-control" name="retypepassword">
                </div>
                <button type="submit" class="btn btn-primary">Ganti Password</button>
            </form>

    </div>
</div>

@endsection
