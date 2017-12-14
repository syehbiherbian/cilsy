
@if (Session::has('success'))
  <div class="alert alert-success">
    <strong>Selamat!</strong> {{ Session::get('success') }}.
  </div>
@endif

@if (Session::has('danger'))
  <div class="alert alert-danger">
    <strong>Error!</strong> {{ Session::get('danger') }}.
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
