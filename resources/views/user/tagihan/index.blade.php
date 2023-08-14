@extends('layouts.user')
{{-- <x-user-layout title="Tagihan"> --}}
  @section('konten')
  <div class="row mt-4" >
    <!-- /.col-md-6 -->
   <div class="col-lg-12">
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Tagihan Aktif</h3>
        {{-- <div class="card-tools">
          <a href="#" class="btn btn-tool btn-sm">
            <i class="fas fa-download"></i>
          </a>
          <a href="#" class="btn btn-tool btn-sm">
            <i class="fas fa-bars"></i>
          </a>
        </div> --}}
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
          <thead>
          <tr>
            <th>No</th>
            <th>Id Penggunaan</th>
            <th>Nama Pelanggan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah Meter</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($tagihan as $key => $item)
            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{ $item->id_penggunaan }}</td>
              <td>{{ $item->pelanggan->nama_pelanggan }}</td>
              <td>{{ $item->bulan }}</td>
              <td>{{ $item->tahun }}</td>
              <td>{{ $item->jumlah_meter }}</td>
              <td>{{ $item->status }}</td>
              <td><a href="{{route('pembayaran.show',$item->id_tagihan)}}" class="btn btn-success btn-sm">Bayar</a></td>
            </tr>
            @endforeach 
          </tbody>
        </table>
      </div>
    </div>
   </div>
    <!-- /.col-md-6 -->
  </div>
   
  @endsection
  {{-- </x-user-layout> --}}