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
                            Edit Reward
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/reward/'.$data->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group ">
                              <label class="col-sm-3 form-label" style="padding-left:0px">Status</label>
                              <div class="col-sm-9">
                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" <?php if ($data->enable== 1){ echo 'checked';}?> name="enable" value="1"/>
                                <label for="basic_checkbox_2">Enable</label>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Code</label>
                                <div class="form-line">
                                   <input type="text" name="code" class="form-control" value="{{$data->code}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                   <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Value</label>
                                <div class="form-line">
                                   <input type="text" name="value" class="form-control" value="{{ $data->value}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Point</label>
                                <div class="form-line">
                                   <input type="text" name="poin" class="form-control" value="{{$data->poin}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Start</label>
                                <div class="form-line">
                                   <input type="date" name="start" class="form-control" value="{{$data->start}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">End</label>
                                <div class="form-line">
                                   <input type="date" name="end" class="form-control" value="{{$data->end}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Limit</label>
                                <div class="form-line">
                                   <input type="text" name="limit" class="form-control" value="{{$data->limit}}">
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
