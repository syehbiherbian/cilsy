<!-- Main Content -->

@section('content')
<div id="container">
    <div class="row">
      <div classs="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Reset Password Contributor</div>
            <div class="panel body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session ('status')}}
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{url('/contributor_password/email')}}">
                    {{csrf_field()}}

                    <div class="form-group{{ $error->has('email')? 'has-error':''}}">
                        <label for="email" class="col-md-4 control-label">E-mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}">

                            @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{$errors->first('email')}}</strong>
                            </span>
                            @endif
                            </div>
                        </div>


    <div class="form-group>
    <div classs="col-md-8 col-md-offset-2">
    <button type="submit" class="btn btn-primary">
            Send Password Reset Link
    </button>
     <div>
     </div>
     </form>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection