@extends('web.app')
@section('content')
<title>Cilsy</title>
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
    <div class="col-sm-3">
      <h4>Category</h4>
      <ul class="nav nav-pills nav-stacked">
        <?php foreach ($categories as $key => $category): ?>
          <li><a href="{{ url('lessons/category/'.$category->title)}}">{{ $category->title }}</a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="col-sm-9">
      <h4>Result</h4>
      <?php if(count($results) == 0){ echo "No Data Available";}?>
      <?php foreach ($results as $key => $result): ?>
        <div class="item">
          <a href="{{ url('lessons/'.$result->title) }}">
            <div class="row">
              <div class="col-sm-12">
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
          <div class="col-md-12">
              {{ $results->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
