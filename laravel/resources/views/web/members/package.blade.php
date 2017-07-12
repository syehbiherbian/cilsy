@extends('web.app')
@section('content')
<title>Cilsy | Pilih Paket</title>

<div id="table-bg">


    <div class="intstruction-text">
        <p>Hampir Selesai, Piih Paket Langganan Yang Kamu Mau</p>
    </div>

    <div id="table-section">
      <form action="{{ url('member/package')}}" method="post">
        {{ csrf_field() }}

        <input type="hidden" name="packages_id" value="1">
        <table id="pricing-table" class="table table-striped">
            <col width="50%">
            <col width="25%">
            <col width="25%">
            <tbody>
                <tr>
                </tr>
                <tr class="no-bg-color">
                    <td class="no-bg-color"></td>
                    <td class="no-bg-color pro" onclick="select_package(1)"><p><?= $packages['0']->title;?></p></td>
                    <td class="no-bg-color premium" onclick="select_package(2)"><p><?= $packages['1']->title;?></p></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>Rp. <?= $packages['0']->price;?></td>
                    <td>Rp. <?= $packages['1']->price;?></td>
                </tr>
                <tr>
                    <td>Masa Aktif</td>
                    <td><?= $packages['0']->expired;?> Hari</td>
                    <td><?= $packages['1']->expired;?> Hari</td>
                </tr>
                <tr>
                    <td>Bebas Akses Ke 200 Lebih Video Tutorial</td>
                    <td>
                      <?php if ($packages['0']->access == 0){ ?>
                        Tidak
                      <?php } else if ($packages['0']->access == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($packages['1']->access == 0){ ?>
                        Tidak
                      <?php } else if ($packages['1']->access == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Update Hingga 50 Video Terbaru Setiap Bulan</td>
                    <td>
                      <?php if ($packages['0']->update == 0){ ?>
                        Tidak
                      <?php } else if ($packages['0']->update == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($packages['1']->update == 0){ ?>
                        Tidak
                      <?php } else if ($packages['1']->update == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Chat Dengan Trainer</td>
                    <td>
                      <?php if ($packages['0']->chat == 0){ ?>
                        Maksimal Dijawab Dalam 3x24 Jam
                      <?php }else if ($packages['0']->chat == 1) { ?>
                        Maksimal Dijawab Dalam 1x24 Jam
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($packages['1']->chat == 0){ ?>
                         3 x 24 jam
                      <?php }else if ($packages['1']->chat == 1) { ?>
                       
                        Maksimal Dijawab Dalam 1x24 Jam
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Download Seluruh Materi Video</td>
                    <td>
                      <?php if ($packages['0']->download == 0){ ?>
                        Tidak
                      <?php }else if ($packages['0']->download == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($packages['1']->download == 0){ ?>
                        Tidak
                      <?php }else if ($packages['1']->download == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Download Berkas Praktek</td>
                    <td>
                      <?php if ($packages['0']->download == 0){ ?>
                        Tidak
                      <?php }else if ($packages['0']->download == 1) { ?>
                        Segera
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($packages['1']->download == 0){ ?>
                        Tidak
                      <?php }else if ($packages['1']->download == 1) { ?>
                        Ya
                      <?php } ?>
                    </td>
                </tr>
                <tr class="no-bg-color">
                    <td></td>
                    <td colspan=2 class="no-bg-color">
                        <button type="submit" class="next-btn">Selanjutnya</button>
                    </td>
                </tr>
            </tbody>
        </table>
      </form>
    </div>
    <div class="intstruction-text">
        <p>Butuh Bantuan Untuk Bertanya? Telepon Kami di 089630713487</p>
    </div>
</div>

<script type="text/javascript">
  function select_package(id) {
    $('[name=packages_id]').val(id);
  }
</script>

<script>
fbq('track', 'CompleteRegistration', {
value: 25.00,
currency: 'USD'
});
</script>

@endsection
