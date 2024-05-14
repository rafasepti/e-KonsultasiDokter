<script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>
@extends('layoutbootstrap')

@section('konten')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran Payment Gateway</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>

                    <!-- dapatkan nomor transaksi -->
                    <?php 
                        $no_transaksi = '';
                        $totaltagihan = 0;
                        
                        foreach($keranjang as $k):
                            $no_transaksi = $k->no_transaksi ;
                            $totaltagihan = $totaltagihan + $k->total ;
                            $id_penjualan = $k->id_penjualan ;
                        endforeach;
                    ?>

                    <!-- Awal Dari Input Form -->
                    <form action="{{ url('/midtrans/proses_bayar') }}" id="x-submit-form" method="post">
                        @csrf
                        <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{$id_penjualan}}">
                        <input type="hidden" id="x_json" name="x_json">
                        
                        <div class="mb-3"><label for="kodeperusahaanlabel">No Transaksi</label>
                        <input class="form-control form-control-solid" id="kode" name="kode" type="text" value="{{$no_transaksi}}" readonly></div>
                        
                        <div class="mb-3"><label for="namaperusahaanlabel">Isi Keranjang <b>(Rp {{number_format($totaltagihan)}})</b></label>
                            <ul class="list-group">
                            @foreach ($keranjang as $k)
                                <li class="list-group-item">
                                    <b>{{$k->jenis_pakaian}}</b> <br>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img width="150px" height="150px" id="x-2" src="{{url('gambar')}}/{{$k->gambar_dokumen}}" zn_id="79" title alt="ok">
                                        </div>
                                        <div class="col-sm-10" align="left">
                                            <table>
                                                <tr>
                                                    <td>
                                                    Harga per item
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">{{number_format($k->biaya)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    Jumlah Barang
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">{{number_format($k->jml_barang)}}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                     <hr>
                                                    </td>
                                                    
                                                </tr>
                                                <tr> 
                                                    <td>
                                                    Total Harga  
                                                    </td>
                                                    <td>=</td>
                                                    <td style="text-align:right">
                                                        {{number_format($k->total)}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </li>
                            @endforeach
                            </ul>
                        </div>

                        <br>
                        <!-- untuk tombol simpan -->
                        
                        <input class="col-sm-1 btn btn-success btn-sm" value="Bayar" id="pay-button">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('midtrans/bayar') }}" role="button">Batal</a>
                        
                    </form>
                    <!-- Akhir Dari Input Form -->
                </div>
            </div>
        </div>

        
    </div>

    
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Untuk Midtrans -->
<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        // window.snap.pay('TRANSACTION_TOKEN_HERE');
        window.snap.pay('{{$snap_token}}',
            {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        // alert("payment success!"); console.log(result);
                        isi_formulir(result);
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        // alert("wating your payment!"); console.log(result);
                        isi_formulir(result);
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        // alert("payment failed!"); console.log(result);
                        isi_formulir(result);
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
            }
        );
        // customer will be redirected after completing payment pop-up
      });

    //   fungsi untuk mengirim response call back
        function isi_formulir(result){
            document.getElementById('x_json').value = JSON.stringify(result);
            //alert(document.getElementById('x_json').value);
            $('#x-submit-form').submit();
        }
    </script>
@endsection