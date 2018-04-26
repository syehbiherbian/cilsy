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
.progress {
  list-style: none;
  margin: 0;
  padding: 0;
  display: table;
  table-layout: fixed;
  width: 100%;
  color: #849397;
}
.progress > li {
  position: relative;
  display: table-cell;
  text-align: center;
  font-size: 0.8em;
}
.progress > li:before {
  content: attr(data-step);
  display: block;
  margin: 0 auto;
  background: #DFE3E4;
  width: 3em;
  height: 3em;
  text-align: center;
  margin-bottom: 0.25em;
  line-height: 3em;
  border-radius: 100%;
  position: relative;
  z-index: 1000;
}
.progress > li:after {
  content: '';
  position: absolute;
  display: block;
  background: #DFE3E4;
  width: 100%;
  height: 0.5em;
  top: 1.25em;
  left: 50%;
  margin-left: 1.5em\9;
  z-index: -1;
}
.progress > li:last-child:after {
  display: none;
}
.progress > li.is-complete {
  color: #2ECC71;
}
.progress > li.is-complete:before, .progress > li.is-complete:after {
  color: #FFF;
  background: #2ECC71;
}
.progress > li.is-active {
  color: #3498DB;
}
.progress > li.is-active:before {
  color: #FFF;
  background: #3498DB;
}

/**
 * Needed for IE8
 */
.progress__last:after {
  display: none !important;
}

/**
 * Size Extensions
 */
.progress--medium {
  font-size: 1.5em;
}

.progress--large {
  font-size: 2em;
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
                <ol class="progress">
                <li class="is-active" data-step="1">
                </li>
                <li data-step="2">
                </li>
                <li data-step="3" class="progress__last">
                </li>
                </ol>
                <p><a href="{{ url('dashboard/'.$last->slug) }}" class="btn btn-primary btn-lg pull-right" style="color :white; background-color: #3CA3E0; border-color: #3CA3E0; margin-top: 100px;">Lanjutkan Tutorial</a></p>
                </p>
              </div>
            </div>
          
        </div>
    </div>
</div>
