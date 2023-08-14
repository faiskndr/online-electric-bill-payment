{{-- @extends('layouts.main') --}}
<x-master-layout title="Konfirmasi Pembayaran">
  {{-- @section('konten') --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Pembayaran</h3>
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
            <tr class="text-sm">
              <th>Id Pembayaran</th>
              <th>Id Tagihan</th>
              <th>Id Pelanggan</th>
              <th>Tanggal Bayar</th>
              <th>Jumlah Meter</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($pembayaran as $item)
                  <tr>
                    <td>{{ $item->id_pembayaran}}</td>
                    <td>{{ $item->id_tagihan }}</td>
                    <td>{{ $item->id_pelanggan}}</td>
                    <td>{{ $item->tanggal_pembayaran }}</td>
                    <td>{{ $item->tagihan->jumlah_meter }}</td>
                   <td>{{ $item->tagihan->status }}</td>
                   <form action="{{ route('konfirmasi-pembayaran.update',$item->id_tagihan) }}" method="post">
                   @method('put')
                    @csrf
                    <td><button class="btn btn-sm btn-success">konfirmasi</button></td>
                  </form>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    {{-- <div class="col-lg-4">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Sales</h3>
            <a href="javascript:void(0);">View Report</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <p class="d-flex flex-column">
              <span class="text-bold text-lg">$18,230.00</span>
              <span>Sales Over Time</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
              <span class="text-success">
                <i class="fas fa-arrow-up"></i> 33.1%
              </span>
              <span class="text-muted">Since last month</span>
            </p>
          </div>
          <!-- /.d-flex -->
  
          <div class="position-relative mb-4">
            <canvas id="sales-chart" height="200"></canvas>
          </div>
  
          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> This year
            </span>
  
            <span>
              <i class="fas fa-square text-gray"></i> Last year
            </span>
          </div>
        </div>
      </div>
      <!-- /.card -->
  
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Online Store Overview</h3>
          <div class="card-tools">
            <a href="#" class="btn btn-sm btn-tool">
              <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-sm btn-tool">
              <i class="fas fa-bars"></i>
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
            <p class="text-success text-xl">
              <i class="ion ion-ios-refresh-empty"></i>
            </p>
            <p class="d-flex flex-column text-right">
              <span class="font-weight-bold">
                <i class="ion ion-android-arrow-up text-success"></i> 12%
              </span>
              <span class="text-muted">CONVERSION RATE</span>
            </p>
          </div>
          <!-- /.d-flex -->
          <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
            <p class="text-warning text-xl">
              <i class="ion ion-ios-cart-outline"></i>
            </p>
            <p class="d-flex flex-column text-right">
              <span class="font-weight-bold">
                <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
              </span>
              <span class="text-muted">SALES RATE</span>
            </p>
          </div>
          <!-- /.d-flex -->
          <div class="d-flex justify-content-between align-items-center mb-0">
            <p class="text-danger text-xl">
              <i class="ion ion-ios-people-outline"></i>
            </p>
            <p class="d-flex flex-column text-right">
              <span class="font-weight-bold">
                <i class="ion ion-android-arrow-down text-danger"></i> 1%
              </span>
              <span class="text-muted">REGISTRATION RATE</span>
            </p>
          </div>
          <!-- /.d-flex -->
        </div>
      </div>
    </div> --}}
    <!-- /.col-md-6 -->
  </div>
  {{-- @endsection --}}
  </x-master-layout>