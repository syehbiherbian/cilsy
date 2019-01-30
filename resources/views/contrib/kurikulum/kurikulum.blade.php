@extends('contrib.app')
@section('title','')
@section('breadcumbs')
@section('content')
  <!-- Main -->
      <main>
        
        <div class="alert alert-success">
          Sukses Membuat Projek
        </div>
        <!-- Container -->
        <div class="container">

          <!-- Nav -->
          <div class="row bg-white py-4">
            <div class="col-sm-4 col-xs-12">
              <h4 class="m-2">Bootcamp</h4>
            </div>
            <div class="col-sm-4 col-xs-8 text-center text-xs-left">
              <select  style="border:none;cursor: pointer;font-size: 16px;margin: 5px 0">
                <option value="">Linux Administrator</option>
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
              </select>
            </div>
            <div class="col-sm-4 col-xs-4 text-right">
              <button class="btn btn-green">+ Simpan</button>
            </div>
          </div>

          <div class="tabs-course">
            <!-- Nav Tabs -->
            <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link" id="pills-kurikulum-tab" data-toggle="pill" href="#pills-kurikulum" role="tab" aria-controls="pills-kurikulum" aria-selected="false">Kurikulum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-bulkuploader-tab" data-toggle="pill" href="#pills-bulkuploader" role="tab" aria-controls="pills-bulkuploader" aria-selected="false">Bulk Uploader</a>
              </li>
            </ul>

            <!-- Nav Content -->
            <div class="tab-content mt-5" id="pills-tabContent">
                <!-- Tab Kurikulum -->
                <div class="tab-pane fade active in" id="pills-kurikulum" role="tabpanel" aria-labelledby="pills-kurikulum-tab">
                  
                  <div class="row">
                    <div class="col-sm-4 col-xs-12 col-sm-push-8">
                      <div class="row">
                        <div class="col-xs-12">
                          <ul class="kurikulum-item" id="items">
                            <!-- Diisi Jquery -->
                          </ul>
                            <button class="btn btn-green w-100 mb-4" onClick="CreateLesson()">Tambah Lesson</button>
                          </div>
                        </div>
                    </div>
      
                    <div class="col-sm-8 col-xs-12 col-sm-pull-4">
                      <div id="contentItem">
                      </div>
                    </div>
                  </div>


                </div>

                <!-- Tab Bulk Uploader -->
                <div class="tab-pane fade" id="pills-bulkuploader" role="tabpanel" aria-labelledby="pills-bulkuploader-tab">
                  <!-- row Title  -->
                  <div class="box">
                      <div class="row">
                        <div class="col-xs-12 p-4">
                          <h4 class="text-inline">File Sebelah <i class="far fa-question-circle"></i></h4>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

          </div>

        </div>

      </main>

      <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/kontributor/js/jquery-ui.min.js')}}"></script>
    <script>
      var lastPositionSection = 0;
      
      $.getJSON("{{url('contributor/bootcamp/course/get/'.$course->id)}}", function (data) {
        var json = data;
        function sideBarRefresh(){
          var sideBarItem = "";
          for (var i=0;i<json.length;++i)
          {
            sideBarItem += `<li id="sideBarItem`+json[i].id+`">
                            <a class="linkcollapse collapsed" data-toggle="collapse" href="#collapse`+json[i].id+`" role="button">
                              <h4>
                                <i class="fa fa-bars"></i>
                                `+json[i].title+`
                              </h4>
                            </a>
                            <div class="collapse" id="collapse`+json[i].id+`">`;
    
            for (var o=0;o<=json[i].video_section.length;++o){
              if(json[i].video_section[o]!=null){
                sideBarItem += `<div class="box mb-2">
                                    <h5>
                                      <i class="fa fa-bars"></i> &nbsp;
                                      `+json[i].video_section[o].title+`
                                    </h5>
                                    <h5 class="text-muted pl-5"><i class="fa fa-`+json[i].video_section[o].type+`"></i> `+json[i].video_section[o].type+`</h5>
                                  </a>
                                </div>`;
              }
            }
            for (var o=0;o<=json[i].project_section.length;++o){
              if(json[i].project_section[o]!=null){
                sideBarItem += `<div class="box mb-2">
                                    <h5>
                                      <i class="fa fa-bars"></i> &nbsp;
                                      `+json[i].project_section[o].title+`
                                    </h5>
                                    <h5 class="text-muted pl-5"><i class="fa fa-`+json[i].project_section[o].type+`"></i> `+json[i].project_section[o].type+`</h5>
                                  </a>
                                </div>`;
              }
            }
              sideBarItem += `<div class="rowContentButton mb-4" id="rowContentButton`+json[i].id+`">
                                <a class="c-green px-4" onClick="createVideo(`+json[i].id+`)"><i class="fa fa-video"></i> Video</a>
                                <a class="c-green px-4" onClick="createProjek(`+json[i].id+`)"><i class="fa fa-file-alt"></i> Projek</a>
                              </div>
                              <button class="btn btn-outline-green" id="btnContentHide`+json[i].id+`" onClick="hideCreateContent(`+json[i].id+`)" style="display:none">Batalkan</button>
                              <button class="btn btn-green" id="btnContentShow`+json[i].id+`" onClick="showCreateContent(`+json[i].id+`)">+Tambahkan Kontent</button>
                              </div>
                            </li>`;
          }
          lastPositionSection = json.length + 1;
          $('#items').html("");
          $('#items').append(sideBarItem);
          $("#items").sortable({
            handle: ".fa-bars",
            cancel: ''
          });
        };
    
        sideBarRefresh();
      });
      
      function CreateLesson(){
        var contentItem = "";
          contentItem += `<h4>Tambah Lesson Baru</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form>
                                <div class="box mb-4">
                                  <div class="form-group">
                                    <label>Judul Lesson</label>
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengelanan">
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Lesson</label>
                                    <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Contoh: Tuliskan deskripsi atau learning objective">
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addLesson()">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);
      }
  
      function createVideo(id){
        var contentItem = "";
          contentItem += `<h4>Video</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form>
                                <div class="box mb-4">
                                  <div class="form-group">
                                    <label>Judul Video</label>
                                    <input type="hidden" id="type" value="video">
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengelanan">
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-xs-12 px-4">
                                        <div class="card">
                                          <ul class="list-unstyled p-2" id="file">
                                            <li class="text-muted text-center empty">No files uploaded.</li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div id="drop-area" class="dm-uploader p-4">
                                      <div class="btn btn-green pull-right pull-xs-none my-2">
                                          <span>Pilih Video</span>
                                          <input type="file" title="Click to add Files" name="file">
                                      </div>
                                      <i class="fa fa-image pull-left mr-4"></i>
                                      <h6 class="text-muted">All files should be at least 720p and less than 4.0 GB</h6>
                                      <h6 class="text-muted">Drag n Drop Cover disini</h6>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Video</label>
                                    <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Contoh: Deskripsi Video">
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addVideo(`+id+`)">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdowns</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);
      }
  
      function createProjek(id){
        var contentItem = "";
          contentItem += `<h4>Projek</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form>
                                <div class="box mb-4">
                                  <div class="form-group">
                                    <label>Nama Projek</label>
                                    <input type="hidden" id="type" value="file">
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengelanan">
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Projek</label>
                                    <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Tuliskan deskripsi disini">
                                  </div>
                                  <div class="form-group">
                                    <label>Instruksi Projek</label>
                                    <textarea class="form-control" type="text" name="value" id="value" cols="30" rows="10" placeholder="Tuliskan Instruksi Projek"></textarea>
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addProject(`+id+`)">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);
      }
      
      function removeItem(id){
        if (confirm('Yakin ingin menghapus?')) {
          $('#contentItem'+id).remove();
          $('#sideBarItem'+id).remove();
        }else{
          'OK';
        }
      };

      function addLesson(){
        var judul = $('#judul').val();
        var desk = $('#deskripsi').val();
        var dataform = new FormData();
        dataform.append( 'title', judul);
        dataform.append( 'desk', desk);
        dataform.append( 'course_id', '{{ $course->id}}');
        dataform.append('position', lastPositionSection)

        if (judul == '' || desk == '') {
          swal("Error", "Harap Isi data Form Yang dibutuhkan!", "error");
        }else {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/course/section-create") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                  swal({
                    title: "Membuat Course",
                    text: "Mohon Tunggu sebentar, Section sedang dibuat ",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                  window.location.href = '{{ url("contributor/login") }}';
                }else if (data.success == true) {
                  $('#judul').val('');
                  $('#desk').val('');

                  swal({
                    title: "Section Berhasil Dibuat !",
                    showConfirmButton: true,
                    timer: 3000
                  }, function(){ 
                    location.reload();
                  });
                }
              },
              error: function (e) {
                swal.close()
              }
          });
        }
      }
  
      function addProject(id){
        var judul = $('#judul').val();
        var desk = $('#deskripsi').val();
        var type = $('#type').val();
        var value = $('#value').val();
        dataform = new FormData();
        dataform.append('title', judul);
        dataform.append('desk', desk);
        dataform.append('type', type);
        dataform.append('value', desk);
        dataform.append('section_id', id);
        
        if (judul == '' || desk == '' || type == '' || value == '') {
          swal("Error", "Harap Isi data Form Yang dibutuhkan!", "error");
        }else {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/course/project-create") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                  swal({
                    title: "Membuat Course",
                    text: "Mohon Tunggu sebentar, Project sedang dibuat ",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                  window.location.href = '{{ url("contributor/login") }}';
                }else if (data.success == true) {

                  swal({
                    title: "Project Berhasil Dibuat Berhasil Dibuat !",
                    showConfirmButton: true,
                    timer: 3000
                  },
                  function(){ 
                    location.reload();
                  }
                  );
                }
              },
              error: function (e) {
                swal.close()
              }
          });
        }
          var temp = new Object();
              temp["judul"] = $('#judul').val();
              temp["deskripsi"] = $('#deskripsi').val();
              temp["type"] = $('#type').val();
              temp["value"] = $('#value').val();
    
          if(json[id].item === ""){
            json[id].item = array(temp);
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
            console.log(temp);
          }else if( json[id].item.push(temp) ){
            $('#contentItem').slideUp(500);
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
          }else{
            alert('error');
          }
    
          sideBarRefresh();
          console.log(json);
      }
  
      function hideContentItem(){
        $('#contentItem').slideUp(500);
      };
  
      function hideCreateContent(id){
        $('#rowContentButton'+id).slideUp(500);
        $('#btnContentShow'+id).show();
        $('#btnContentHide'+id).hide();
      }
  
      function showCreateContent(id){
        $('#rowContentButton'+id).slideDown(500);
        $('#btnContentHide'+id).show();
        $('#btnContentShow'+id).hide();
      }
    </script>

      <!-- dm-uploader.js : File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- dm-uploader.js : Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%title%%</strong>: %%message%%</li>
    </script>
@endsection()