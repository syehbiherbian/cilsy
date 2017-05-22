@extends('web.app')
@section('content')
<title>Cilsy</title>
<div id="sign-container">
    <div class="tab-btn-container">
        <a href="{{ url('member/signup')}}" id="tab-1">Daftar</a>
        <a href="{{ url('member/signin')}}" id="tab-2" style="background-color: #ededed">Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content">
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

            <form action="{{ url('member/signup') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Pengguna :</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                </div>
                <div class="form-group">
                    <label >Email :</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label >Password :</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password :</label>
                    <input type="password" class="form-control" name="retype_password">
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
            </form>
        </div>
        <div id="tab-2-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="#"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form> -->
        </div>
    </div>
</div>

@endsection
