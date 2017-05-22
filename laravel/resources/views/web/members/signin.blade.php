@extends('web.app')
@section('content')
<title>Cilsy</title>
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
            <form action="{{ url('member/signin') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="#"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
