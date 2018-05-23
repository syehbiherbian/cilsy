@extends('web.app')

@section('content')


<section class="member-main pt-25 pb-25" style="margin:160px;">
  <div class="container">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav">
            <li><a href="{{ url('member/profile') }}">Informasi Personal</a></li>
            <li><a href="{{ url('member/change-password') }}">Ubah Password</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-body">
            @yield('member-content')
        </div>
      </div>
    </div>
  </div>



</section>


@endsection
