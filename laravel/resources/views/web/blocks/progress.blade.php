@push('css')


@endpush
<style>
@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
  .item {
    padding: 25px;
    border-bottom: 1px solid #eee;
  }
  .item a{
    color: #666;
  }
.card {
    margin-bottom: 15px;
    border-radius: 5px;
    
    
}
.card:hover {
    text-decoration: none;
    -webkit-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    -moz-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
}
.card a {
    text-decoration: none;
}
.card-img {
    width: 100%;
    height: 150px;
    background-size: cover;
    background-position: center center;
}
.card-body {
    height: 180px;
    padding: 15px;
    padding-bottom: 15px;
    background-color: #FAFAFA;
}
.card-info {
    padding-bottom: 15px;
    position: absolute;
    left: 20;
    bottom: 0;
}
</style>
<div class="container section-content">
  <div class="col-sm-12">
      <h4>Tutorial Terakhir Ditonton</h4>
        <div class="item">
          
            <div class="row">
            <div class="col-md-4">
                <img src="{{ $last->image }}" alt="" class="img-responsive">
              </div>
              <div class="col-sm-8">
                <p><strong><h3>{{ $last->title }}</h3></strong></p>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{number_format($progress)}}"
                  aria-valuemin="0" aria-valuemax="100" style="width:{{number_format($progress)}}%; background-color: #3CA3E0;">
                    {{number_format($progress)}}%
                  </div>
                </div>
                <p><a href="{{ url('dashboard/'.$last->slug) }}" class="btn btn-primary btn-lg pull-right" style="color :white; background-color: #3CA3E0; border-color: #3CA3E0; margin-top: 100px;">Lanjutkan Tutorial</a></p>
                </p>
              </div>
            </div>
          
        </div>
    </div>
</div>
