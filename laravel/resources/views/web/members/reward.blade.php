@extends('web.app')
@section('title','Reward | ')
@section('content')

<style media="screen">
.category-sliders .description{
    position: absolute;
    top: 10%;
    width: 100%;
    color: #fff;

}
.catalog .description{
  position: absolute;
  top: 5%;
  text-align: center;
  width: 100%;
  color: #fff;
}
.profile .description{
    position: absolute;
    top: 2%;
    width: 100%;
    color: #fff;
    text-align: center;
    left: 0px;
}

.profile .icon{
    position: absolute;
    top: 75%;
    width: 100%;
    color: #fff;
    text-align: center;
    left: 10%
}
/*.profile .description img{
    filter: invert(100%);
}*/

.blue{
    background: #2ba8e2;
    color: #fff;
}

.btn{
    border-radius: 20px!important;
    padding: 5px 20px!important;
    font-size: 10px;
    text-decoration: none;
    color: #fff !important;
    position: relative;
    display: inline-block;
}
.rounded-circle{
    padding:0px 0px 0px 0px;
    padding: 5px;
    height: 95px;
    width: 95px !important;
    -moz-border-radius:47px;
    -webkit-border-radius:47px;
    border-radius:47px;
    margin-left: 10px;
    margin-right: 10px;
}
.rounded-circle p{
  font-size: 10px;
  margin: 1px;
  text-align: center;
}
.owl-prev{
    position: absolute;
    top: 45%;
    /* color: transparent; */
    margin-left: 10px;
    font-size: 15px;
    background: #fff;
    /* padding: 5px; */
    padding-left: 5px;
    padding-right: 6px;
    padding-top: 4px;
    padding-bottom: 4px;
    border-radius: 50px;
}
.owl-next{
    position: absolute;
    top: 45%;
    /* color: transparent; */
    margin-right: 10px;
    font-size: 15px;
    background: #fff;
    /* padding: 5px; */
    padding-left: 5px;
    padding-right: 6px;
    padding-top: 4px;
    padding-bottom: 4px;
    border-radius: 50px;
    right: 0px;
}
</style>

<div id="table-section">

<div class="container" style="margin-top:20px;">
<div class="row">

  <div class="col-md-12">
        @if($errors->all())
         <div class="alert\ alert-danger">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
             @foreach($errors->all() as $error)
             <?php echo $error."</br>";?>
             @endforeach
         </div>
         @endif
         @if(Session::has('success'))
             <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                 {{ Session::get('success') }}
             </div>
         @endif

        @if(Session::has('success-delete'))
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
              {{ Session::get('success-delete') }}
          </div>
        @endif
        @if(Session::has('no-processing'))
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
              {{ Session::get('no-processing') }}
          </div>
        @endif

        <div class="col-md-5">
            <div class="col-md-12" style="padding-bottom:10px;">
                <h3>Point Saya</h3>
            </div>
            <div class="col-md-12 profile" >
                <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="{{asset('template/kontributor/background/bg-reward.jpg')}}"></a>
                <div class="description">
                    <div class="col-md-12">
                        <img class="photo" src="{{asset('template/kontributor/img/icon/Akun.png')}}" height="110px" width="110px" style="object-fit:scale-down;border-radius: 100%;filter: invert(100%);">
                        <h4  style="padding-bottom:0px;">{{$contrib->username}}</h4>
                        <h4  style="padding-bottom:5px;">{{$contrib->points}} Pts</h4>

                    </div>
                </div>
                <div class="icon">
                    <div class="col-md-4 rounded-circle" style="background:#1cc327;">
                            <img class="photo" src="{{asset('template/web/icon/bertanya.png')}}" height="30px" width="30px" style="object-fit:scale-down;">
                            <p>Bertanya</p>
                            <p>{{$contrib->asked_point}} Pts</p>
                    </div>
                    <div class="col-md-4 rounded-circle" style="background:#2798cc;">
                            <img class="photo" src="{{asset('template/web/icon/menjawab.png')}}" height="30px" width="30px" style="object-fit:scale-down;">
                            <p>Menjawab Pertanyaan</p>
                            <p>{{$contrib->reply_point}} Pts</p>
                    </div>
                    <div class="col-md-4 rounded-circle" style="background:#a238b9;">
                            <img class="photo" src="{{asset('template/web/icon/menyelesaikan.png')}}" height="30px" width="30px" style="object-fit:scale-down;">
                            <p>Menyelesaikan Totorial</p>
                            <p>{{$contrib->complete_point}} Pts</p>
                    </div>
                </div>

            </div>
            <div class="col-md-12" style="margin-top:60px;text-align: center;">
                <a class="btn blue" href="#">Pelajari lebih lanjut tentang point</a>
                <p style="margin-top:20px; font-size:18px;">Point akan berubah atau bertambah dalam waktu 24 jam</p>
            </div>
            <?php if (count($myreward)> 0): ?>
                <div class="col-md-12" style="margin-top:30px;">
                    <h3>Reward Saya</h3>
                </div>
            <?php endif; ?>

         <?php foreach ($myreward as $key => $value): ?>
           <div class="col-md-12 catalog">
              <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="{{$value->image}}"></a>
              <div class="description">
                  <div class="col-md-12">
                      <h4  style="padding-bottom:10px;">{{$value->name}}</h4>
                      <p  style="padding-bottom:10px;"><?php echo nl2br($value->description); ?></p>
                      <h4  style="padding-bottom:10px;">{{$value->poin}} Pts</h4>
                      <a class="btn blue" href="{{url('member/rewards/'.$value->myid.'/detail')}}">Lihat</a>
                  </div>
              </div>
           </div>
         <?php endforeach; ?>


        </div>
        <div class="col-md-7">
            <div class="col-md-12" style="padding-bottom:10px;">
                <h3>Reward</h3>
            </div>
              <?php foreach ($category as $key => $cat): ?>
                <div class="col-md-12" style="padding-bottom:15px;">
                    <div class="owl-carousel owl-theme category-sliders" id="category-sliders" style="text-align:center;">
                        <?php foreach ($reward as $key => $value): ?>
                          <?php if ($cat->id == $value->category_id): ?>
                          <div class="item" style="border-radius:0px;height:230px;background:url('{{ $value->image }}');background-position: center;background-repeat: no-repeat;background-size: cover;">

                             <div class="description">
                                 <div class="col-md-12">
                                     <h4  style="padding-bottom:10px;">{{$value->name}}</h4>
                                     <p  style="padding-bottom:10px;"><?php echo nl2br($value->description); ?></p>
                                     <h4  style="padding-bottom:10px;">{{$value->poin}} Pts</h4>
                                     <a class="btn blue" href="{{url('member/rewards/'.$value->slug.'/change')}}">Tukar</a>
                                 </div>
                             </div>
                          </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
              <?php endforeach; ?>
        </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
    $('.category-sliders').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
    })
</script>
@endsection()
