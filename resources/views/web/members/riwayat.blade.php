@extends('web.members.master')
@section('title','Riwayat Pembelian | ')
@section('member-content')
<style>
    .borderless td, .borderless th, .borderless thead {
        border: none;
    }
</style>
<div class="col-md-12">
    <h4>Pembelian Dalam Proses</h4>
</div><br><br>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <h6>INV902090</h6>
            <p>23 September 2018</p>
        </div>
        <div class="col-md-6 ">
            <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " >
                Cara Pembayaran
            </a><br><br>
            <p class="pull-right">Total : Rp. 118.000</p>
        </div>
        <table class="table borderless">
                <thead>
                    <tr>
                    <th colspan="2">Rincian</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Tutorial Sayang kamu</td>
                        <td>Rp. 119.000</td>
                        <td>Kartu Kredit</td>
                        <td><i class="fa fa-checklist"></i> Selesai</td>
                    </tr>
                </tbody>
        </table>
    </div>
  </div>
  <div class="col-md-12">
        <h4>Pembelian Sebelumnya</h4>
    </div><br><br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-6">
                <h6>INV902090</h6>
                <p>23 September 2018</p>
            </div>
            <div class="col-md-6 ">
                <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " >
                    Download Invoice
                </a><br><br>
                <p class="pull-right">Total : Rp. 118.000</p>
            </div>
            <table class="table borderless">
                    <thead>
                        <tr>
                        <th colspan="2">Rincian</th>
                        <th>Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Tutorial Sayang kamu</td>
                            <td>Rp. 119.000</td>
                            <td>Kartu Kredit</td>
                            <td><i class="fa fa-checklist"></i> Selesai</td>
                        </tr>
                    </tbody>
            </table>
        </div>
      </div>

@endsection