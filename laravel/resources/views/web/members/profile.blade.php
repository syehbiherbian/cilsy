@extends('web.members.master')
@section('member-content')

<h3>Profile</h3>
@include('web.include.alerts')
<form class="form-horizontal" action="{{ url('member/profile') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group @if ($errors->has('username')) has-error @endif">
    <label class="col-sm-3 control-label">Nama Pengguna</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" placeholder="Nama Pengguna" name="username" value="{{ old('username',$members->username) }}">
      @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
    </div>
  </div>
  <div class="form-group @if ($errors->has('email')) has-error @endif">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email',$members->email) }}">
      @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 text-right">
      <button type="reset" class="btn btn-danger">Batal</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

@endsection
