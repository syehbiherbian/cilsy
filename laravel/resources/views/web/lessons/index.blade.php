@extends('web.app')
@section('title','Tutorial | ')
@section('content')
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
  .item:hover{
    background: #eee;
  }
</style>
<div class="container section-content">
  <div class="row">
    <div class="col-sm-12">
      <h4>Category</h4>
      <div id="category_carousel" class="owl-carousel owl-theme">
        <?php foreach ($categories as $key => $category): ?>
          <div class="item cat-img-container">
            <a href="{{ url('lessons/category/'.$category->title)}}">
              <img src="{{ $category->image }}" />
              <p>{{ $category->title }}</p>
            </a>
          </div>
        <?php endforeach; ?>
        <div class="item cat-img-container">
          <a href="{{ url('lessons/browse/all') }}">
            <img src="https://www.cilsy.id/assets/source/category/tutorial.png" alt=""></img>
            <p>Semua Tutorial</p>
          </a>
        </div>
      </div>

      <script type="text/javascript">
        $('#category_carousel').owlCarousel({
            loop:false,
            margin:0,
            nav:false,
            // items:1,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });
      </script>

    </div>
    <div class="col-sm-12">
      <h4>Result</h4>
      <?php if(count($results) == 0){ echo "No Data Available";}?>
      <?php foreach ($results as $key => $result): ?>
        <div class="item">
          <a href="{{ url('lessons/'.$result->slug) }}">
            <div class="row">
              <div class="col-md-4">
                <img src="{{ $result->image }}" alt="" class="img-responsive">
              </div>
              <div class="col-sm-8">
                <p><strong>{{ $result->title }}</strong></p>
                <p><small><?php echo nl2br($result->description);?></small></p>
                <p><div class="badge badge-default">{{ $result->category_title }}</div>
                  <?= date('d M Y H:i',strtotime($result->created_at));?>
                </p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
      <div class="row">
          <div class="col-md-12 text-center">
              {{ $results->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
<script>
fbq('track', 'Search');
</script>
@endsection
