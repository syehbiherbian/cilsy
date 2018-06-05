@extends('web.members.master')
@section('title','Ubah Password | ')
@section('member-content')

<h3>Ubah Password</h3>
@include('web.include.alerts')
<form class="form-horizontal" action="{{ url('member/change-password') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group @if ($errors->has('current_password')) has-error @endif">
    <label class="col-sm-3 control-label">Password Lama</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="current_password">
      @if ($errors->has('current_password')) <p class="help-block">{{ $errors->first('current_password') }}</p> @endif
    </div>
  </div>
  <div class="form-group  @if ($errors->has('password')) has-error @endif">
    <label class="col-sm-3 control-label">Password Baru</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password">
      @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    </div>
  </div>
  <div class="form-group  @if ($errors->has('password_confirmation')) has-error @endif">
    <label class="col-sm-3 control-label">Konfirmasi Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control"  name="password_confirmation">
      @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
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
