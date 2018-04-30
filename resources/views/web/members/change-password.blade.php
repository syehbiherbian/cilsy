@extends('web.members.master')
@section('title','Ubah Password | ')
@section('member-content')

<h3>Ubah Password</h3>
@include('web.include.alerts')
<form class="form-horizontal" action="{{ url('member/change-password') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group @if ($errors->has('old_password')) has-error @endif">
    <label class="col-sm-3 control-label">Password Lama</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="old_password">
      @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
    </div>
  </div>
  <div class="form-group  @if ($errors->has('password')) has-error @endif">
    <label class="col-sm-3 control-label">Password Baru</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password">
      @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    </div>
  </div>
  <div class="form-group  @if ($errors->has('retype_password')) has-error @endif">
    <label class="col-sm-3 control-label">Konfirmasi Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control"  name="retype_password">
      @if ($errors->has('retype_password')) <p class="help-block">{{ $errors->first('retype_password') }}</p> @endif
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
