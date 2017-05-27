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
                            Edit Member
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/members/'.$members->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">


                            <legend>Account</legend>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="category_id">
                                        <option value="">-- Please select --</option>
                                        <option value="1" <?php if($members->status == '1'){echo "selected";} ?>>Active</option>
                                        <option value="0" <?php if($members->status == '0'){echo "selected";} ?>>Non Active</option>
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="username" class="form-control" value="{{ $members->username }}">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="email" name="email" class="form-control" value="{{ $members->email }}">
                                    <label class="form-label">Email</label>
                                </div>
                            </div>

                            <legend>Change Password</legend>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="retype_password" class="form-control">
                                    <label class="form-label">Retype Password</label>
                                </div>
                            </div>

                            <legend>Services</legend>
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Invoice</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>Period</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                      <td></td>
                                  </tr>
                                </tbody>
                            </table>


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
