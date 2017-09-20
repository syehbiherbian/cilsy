@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
                <li>Komentar</li>
		</ul>
</div>
@endsection
@section('content')
<style>
  #content{
    background: #f4f4f4;
  }
  #exTab1 .nav-pills{
      background: #fff;
  }
  #exTab1 .tab-content {

    background-color: #fff;
    padding : 5px 15px;
  }
  #exTab1 .nav-pills > li > a {
  border-radius: 0;
  background: #fff;
  color: #2BA8E2;
  }
  #exTab1 .nav-pills  .active{
    border-bottom: 2px solid #2BA8E2;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: none;
    border-bottom: 1px solid #ddd;
}
.table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: none;
  border: none;
}

.btn {
  border-radius: 10px;
  padding: 5px 20px;
  font-size: 10px;
  text-decoration: none;
  color: #fff;
  position: relative;
  display: inline-block;
}

.blue {
  background-color: #55acee;
}
.blue:hover {
  background-color: #fff;
  border-color: #55acee;
  color: #55acee;
}

.red {
  background-color: #e74c3c;
}
.red:hover{
  background-color: #fff;
  border-color: #e74c3c;
  color: #e74c3c;
}
</style>
<div class="row">
  <div class="col-md-12">
    <div class="container" style="background-color:#fff;padding-bottom:25px;">
        <div class="col-md-6">
            <h3>{{ $datalesson->title }}</h3>
            <hr>
            <img src="{{ $datalesson->image }}" class="img-responsive">
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="col-md-6">
            <h3>Pertanyaan</h3>
            <hr>

            <div class="content-reload">
                @foreach($datacomment as $comment)
                <div class="col-md-12" style="margin-bottom:30px;" id="row{{ $comment->id }}">
                    <strong>{{ $comment->username }}</strong> pada <strong><?= date('d/m/Y',strtotime($comment->created_at)) ?></strong>
                    <div class="col-md-12" style="margin-top:10px;padding-left:5%;">
                        {{ $comment->description }}
                        <br><br>
                        <?php
                        $getchild = DB::table('coments')
                            ->leftJoin('members','members.id','=','coments.member_id')
                            ->leftJoin('contributors','contributors.id','=','coments.contributor_id')
                            ->where('coments.lesson_id',$datalesson->id)
                            ->where('parent',$comment->id)
                            ->orderBy('coments.created_at','ASC')
                            ->select('coments.*','members.username as username','contributors.username as contriname')
                            ->get();

                        if (count($getchild) > 0) {
                            foreach ($getchild as $child) {
                        ?>
                            <strong>
                                <?php if(!empty($child->username)){ ?>
                                    {{ $child->username }}
                                <?php }else{ ?>
                                    {{ $child->contriname }}
                                <?php } ?>
                            </strong> pada <strong><?= date('d/m/Y',strtotime($child->created_at)) ?></strong>
                            <div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%;">
                                {{ $child->description }}
                            </div>
                            <div class="clearfix"></div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-12" id="balas{{ $comment->id }}" style="padding-top:10px;padding-left:5%;">
                        <a href="javascript:void(0)" class="label label-primary" onclick="formbalas({{ $comment->id }})">Balas</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function formbalas(comment_id){
        $('#balas'+comment_id).html('<label class="col-md-1" style="padding-left:0px;">Anda</label>'+
                                '<div class="col-md-11" style="padding-right:0px;">'+
                                '   <input type="text" class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan komentar/balasan" value="">'+
                                '</div>'+
                                '<a href="javascript:void(0)" class="label label-primary" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px;">Kirim</a>');
    }

    function dobalas(comment_id){
        var isi_balas = $('#input_balas'+comment_id).val();
        var lesson_id = '{{ $datalesson->id }}';
        // alert(comment_id+' = '+isi_balas);
        var datapost = {
            '_token'    : '{{ csrf_token() }}',
            'isi_balas' : isi_balas,
            'comment_id': comment_id,
            'lesson_id' : lesson_id
        }

        $.ajax({
            type    :'POST',
            url     :'{{ url("contributor/coments/postcomment") }}',
            data    :datapost,
            success:function(data){
                if (data == 1) {
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }else {
                    alert('Koneksi Bermasalah, Silahkan Ulangi');
                    location.reload();
                }
            }
        })
    }

    function loadcontent(){
        $(".content-reload").load(window.location.href + " .content-reload");
        console.log('reload');
    }

    // setInterval(function(){
    //     loadcontent()
    // }, 5000);
</script>

@endsection()
