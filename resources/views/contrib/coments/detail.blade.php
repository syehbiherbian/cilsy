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
        <div class="col-md-12">
            <h3>{{ $datalesson->title }}</h3>
            <hr>
            <img src="{{ $datalesson->image }}" class="img-responsive">
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="col-md-12">
            <h3>Pertanyaan</h3>
            <hr>

            <div class="content-reload">
                @foreach($datacomment as $comment)
                <div class="col-md-12" style="margin-bottom:30px;" id="row{{ $comment->id }}">
                    <strong>{{ $comment->username }}</strong> pada <strong><?= date('d/m/Y',strtotime($comment->created_at)) ?></strong>
					<strong style="color:#ff5e10;">@if($comment->member_id !==null)  User @else ($comment->contributor_id  !==null)  Contributor @endif</strong>
					<div class="col-md-12" style="margin-top:10px;padding-left:5%; white-space:pre-line;">
                            {{ $comment->body }}
                    <?php if($comment->images) { ?>
                            <a id="firstlink" data-gall="myGallery" class="venobox" data-vbtype="iframe" href="{{ asset($comment->images) }}"><img src="{{ asset($comment->images) }}" alt="image alt" style="height:50px; width:50px; margin-left: 15px; margin-bottom: 20px;"/></a>
                    <?php } ?>
					</div>

                    
						<br><br>
						<?php
						$getchild = DB::table('comments')
							->leftJoin('members','members.id','=','comments.member_id')
							->leftJoin('contributors','contributors.id','=','comments.contributor_id')
							->where('comments.lesson_id',$datalesson->id)
							->where('parent_id',$comment->id)
							->orderBy('comments.created_at','ASC')
							->select('comments.*','members.username as username','contributors.username as contriname')
							->get();
						if (count($getchild) > 0) {
							foreach ($getchild as $child) {
						?>
						<div class="col-md-12" style="margin-top:10px;padding-left:5%;">
							<img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">
								<strong>
									<?php if($child->desc == 0){ ?>
										{{ $child->username }}
									<?php }else{ ?>
										{{ $child->contriname }}
									<?php } ?>
								</strong> pada <strong><?= date('d/m/Y',strtotime($child->created_at)) ?></strong>
								<strong style="color:#ff5e10;">@if($child->member_id !==null)  User @else ($child->contributor_id  !==null)  Contributor @endif</strong>
								<div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%; white-space: pre-line">
                                    {{ $child->body }}
								</div>
								<div class="clearfix"></div>
						</div>
                        <?php
                            }
                        }
                        ?>

                    <div class="col-md-12" id="balas{{ $comment->id }}" style="padding-top:10px;padding-left:5%; ">
                        <a href="javascript:void(0)" class="btn btn-info pull-right" onclick="formbalas({{ $comment->id }})" style="border-radius:3px;">Balas</a>
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
                                '   <textarea class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan komentar/balasan" value="" style="white-space: pre-line" rows="8" cols="80"></textarea>'+
                                '</div>'+
                                '<div class="fileUpload">'+
                                '<span class="custom-span">+</span>'+
                                '<p class="custom-para">Add Images</p>'+
                                '<input id="uploadBtn" type="file" class="upload" name="image" />'+
                                '</div>'+
                                '<input id="uploadFile" placeholder="0 files selected" disabled="disabled" />'+
                                '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px; border-radius:3px;">Kirim</a>');
    }

    function dobalas(comment_id){
        var token = '{{ csrf_token() }}';
        var isi_balas = $('#input_balas'+comment_id).val();
        var file_data = $('#uploadBtn').prop("files")[0];
        var lesson_id = '{{ $datalesson->id }}';
        var member_id = '{{ $comment->member_id}}';
        dataform = new FormData();
        dataform.append( '_token', token);
        dataform.append( 'image', file_data);
        dataform.append( 'body', isi_balas);
        dataform.append( 'lesson_id', lesson_id);
        dataform.append( 'member_id', member_id);
        dataform.append( 'comment_id', comment_id);
    
        if (isi_balas == '') {
          alert('Harap Isi Komentar !')
        }else {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/comments/postcomment") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                   swal({
                    title: "Sedang mengirim Komentar",
                    text: "Mohon Tunggu sebentar",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data == 1) {
                    swal({
                        title: "Anda Berhasil Membalas Komentar",
                        showConfirmButton: true,
                        icon: "success",
                        timer: 3000
                    });
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                    window.location.href = '{{url("contributor/login")}}';
                }else {
                            alert('Koneksi Bermasalah, Silahkan Ulangi');
                            location.reload();
                  }
                }
          });
        }
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
