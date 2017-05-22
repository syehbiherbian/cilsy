@extends('admin.app')
@section('content')
    <section class="content">
    <div class="container-fluid">
        <!-- #END# Vertical Layout -->
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tambah Member
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{action('MemberController@store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="username" class="form-control">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" name="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control">
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
    </section>
@endsection