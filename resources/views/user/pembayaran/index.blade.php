@extends('layouts.user')
{{-- <x-user-layout title="Tagihan"> --}}
@section('konten')
  <div class="row mt-4" >
 
   <div class="col-lg-12">
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Pembayaran Tagihan</h3>
      </div>
      <div class="card-body p-0">
 
          <div class="row p-3">
            <div class="form-group col-md-6">
              <label class="text-sm" for="id_tagihan">Id Tagihan</label>
              <input type="text" name="id_tagihan" class="form-control" id="id_tagihan" value="{{ $pembayaran->id_tagihan }}" readonly>
            </div>
            <div class="form-group col-md-6">
              <label class="text-sm" for="inputAddress">Nama</label>
              <input type="text" class="form-control" name="nama_pelanggan" id="inputAddress" value="{{ $pembayaran->pelanggan->nama_pelanggan }}" readonly>
            </div>
            
            <div class="form-group col-md-6">
              <label class="text-sm" for="totalMeter">Total Meter</label>
              <input type="text" class="form-control" name="jumlah_meter" id="totalMeter" value="{{ $pembayaran->tagihan->jumlah_meter }}" readonly>
            </div>

            <div class="form-group col-md-6">
              <label class="text-sm" for="date">Tanggal Pembayaran</label>
              <input type="text" class="form-control" name="tanggal_pembayaran" id="date" value="{{ $pembayaran->tanggal_pembayaran }}" readonly>
            </div>
          
            <div class="form-group col-md-6">
              <label class="text-sm" for="total">Total Bayar</label>
              <input type="text" class="form-control" name="total" id="total" value="{{ $pembayaran->total_bayar }}" readonly>
              <span><p>Sudah termasuk biaya admin Rp.2500</p></span>
            </div>
            <div class="form-group col-md-6">
              <label class="text-sm" for="total">Status</label>
              <input type="text" class="form-control" name="status" id="total" value="{{ $pembayaran->tagihan->status }}" readonly>
            </div>
            <div class="col-md-12 ">
              <button type="submit" class="btn btn-success float-right" id="pay-button">bayar</button>
            </div>
          </div>
      </div>
    </div>
  </div>
  </div>
  @push('scripts')
  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$token}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          // alert("payment success!");
          window.location.href = '{{route('beranda.index')}}' 
          console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
  @endpush
  @endsection

  {{-- </x-user-layout> --}}