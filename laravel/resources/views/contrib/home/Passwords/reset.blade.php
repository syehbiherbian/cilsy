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

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $error->has('email')? 'has-error':'' }}">
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

    <div class="form-group {{ $error->has('password') ? 'has-error':''}}">
        <label for="password" class="col-md-4 control-label">Password</label>
    
    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}">
            @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{$errors->first('password')}}</strong>
            </span>
            @endif
            </div>
            </div>

        <div class="form-group {{ $error->has('password_confirmation') ? 'has-error':''}}">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password-confirm" value="{{old('password-confirm')}}">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation')}}</strong>
                </span>
            @endif
            </div>
            </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offsett-4">
                <button type="submit" class="btn btn-primary">
                Reset Password
                </button>
            </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
@endsection