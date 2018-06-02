@extends('web.app')
@foreach($categories as $object)
@section('title', 'Kategori | ')
@section('description', $object->meta_desc)
@endforeach
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
      <h4 style="text-align: center;">Kategori</h4>
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
          <a href="{{ url('lessons/browse/all') }}" style="text-decoration:none;">
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
            <div class="row">
            <div class="col-md-2">
                <a href="{{ url('lessons/'.$result->slug) }}" >
                <img src="{{ $result->image }}" alt="" class="img-responsive">
                 </a>
              </div>
              <div class="col-sm-8">
                <p><a href="{{ url('lessons/'.$result->slug) }}" style="text-decoration:none;"><strong>{{ $result->title }}</strong></a></p>
                <a href="{{ url('lessons/'.$result->slug) }}" style="text-decoration:none;">
                <p><small><?php echo nl2br($result->description); ?></small></p>
                </a>
                <p><div class="badge badge-default">{{ $result->category_title }}</div>
                  <?=date('d M Y H:i', strtotime($result->created_at));?>
                </p>
              </div>
              <div class="col-md-2">
                <p style="font-weight:bold;">Rp. {{ number_format($result->price, 0, ",", ".") }}</p>
                <p>
                <button type="button" class="btn btn-info" onclick="addToCart({{ $result->id }})"><i class="fa fa-shopping-cart"></i> Beli</button>
                </p>
              </div>
            </div>
          {{-- </a> --}}
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
<script type="text/javascript">

  function addToCart(id) {
      var datapost = {
        '_token'    : '{{ csrf_token() }}',
        'id': id
      };
      $.ajax({
          type    : 'POST',
          url     : '{{ url("/cart/add") }}',
          data    : datapost,
          success: function(data){
            if (typeof data !== 'null') {
              @if (!Auth::guard('members')->user())
                var cek = localStorage.getItem('cart');
                if (cek == null) {
                  var cart = [];
                  cart.push({
                    'id': data.id,
                    'image': data.image,
                    'title': data.title,
                    'price': data.price,
                  });
                } else {
                  var exist = false;
                  var cart = JSON.parse(cek);
                  if (cart.length >= 1) {
                    return swal({
                        title: "Tidak bisa menambahkan keranjang",
                        text: 'Silakan daftar/login terlebih dahulu untuk melanjutkan',
                        type: "error",
                        confirmButtonText: "Login"
                    }).then(function(isConfirm) {
                        if (isConfirm.value) {
                            window.location.href = '{{ url("member/signin") }}';
                        }
                    });
                  }
                  $.each(cart, function(k,v) {
                    if (v.id == data.id) {
                      exist = true;
                    }
                  })
                  if (!exist) {
                    cart.push({
                      'id': data.id,
                      'image': data.image,
                      'title': data.title,
                      'price': data.price,
                    });
                  }
                }
                
                localStorage.setItem('cart', JSON.stringify(cart));
              @endif

              swal({
                  title: "Menambahkan ke keranjang",
                  text: data.title,
                  type: "success",
                  showCancelButton: true,
                  cancelButtonText: 'Lihat keranjang',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: "Tutorial lainnya"
              }).then(function(isConfirm) {
                  if (isConfirm.value) {
                      window.location.href = '{{ url("lessons/browse/all") }}';
                  } else {
                      window.location.href = '{{ url("cart") }}';
                  }
              });
            } else {
                alert('Koneksi Bermasalah, Silahkan Ulangi');
                location.reload();
            }
          }
      })
  }
</script>
@endsection
