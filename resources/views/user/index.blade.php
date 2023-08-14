@extends('layouts.user')
{{-- <x-user-layout title="Beranda"> --}}
  @section('konten')
  <div class="row">
    {{-- <div class="col-lg-4">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Online Store Visitors</h3>
            <a href="javascript:void(0);">View Report</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <p class="d-flex flex-column">
              <span class="text-bold text-lg">820</span>
              <span>Visitors Over Time</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
              <span class="text-success">
                <i class="fas fa-arrow-up"></i> 12.5%
              </span>
              <span class="text-muted">Since last week</span>
            </p>
          </div>
          <!-- /.d-flex -->
  
          <div class="position-relative mb-4">
            <canvas id="visitors-chart" height="200"></canvas>
          </div>
  
          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> This Week
            </span>
  
            <span>
              <i class="fas fa-square text-gray"></i> Last Week
            </span>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- /.col-md-6 -->
   <div class="col-lg-12">
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Histori Tagihan</h3>
        
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
            <td><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{$item->id_tagihan}}">detail</button></td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
   </div>
  {{-- modal --}}
  @foreach ($pembayaran as $item)
   <div class="modal fade" id="exampleModal{{$item->id_tagihan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel">Lunas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="row justify-content-center">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body p-5">
                    <h2 class="text-center">
                      Struk
                    </h2>
                    {{-- <p class="fs-sm">
                      This is the receipt for a payment of <strong>$312.00</strong> (USD) you made to Spacial Themes.
                    </p> --}}
        
                    <div class="border-top border-gray-200 pt-4 mt-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="text-muted mb-2">Id Pembayaran.</div>
                          <strong>#{{$item->id_pembayaran}}</strong>
                        </div>
                        <div class="col-md-6 text-md-end">
                          <div class="text-muted mb-2">Tanggal Pembayaran</div>
                          <strong>{{$item->tanggal_pembayaran}}</strong>
                        </div>
                        <div class="col-md-6">
                          <div class="text-muted mb-2">Virtual Account</div>
                          <strong>{{$item->virtual_account}}</strong>
                        </div>
                      </div>
                    </div>
        
                    <table class="table border-bottom border-gray-200 mt-3">
                      <thead>
                        <tr>
                          <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Detail</th>
                          <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="px-0">Listrik</td>
                          <td class="text-end px-0">Rp.{{$item->total_bayar - $item->biaya_admin}}</td>
                        </tr>
                        <tr>
                          <td class="px-0">Biaya Admin</td>
                          <td class="text-end px-0">Rp.{{$item->biaya_admin}}</td>
                        </tr>
                      </tbody>
                    </table>
        
                    <div class="mt-5">
                      {{-- <div class="d-flex justify-content-end">
                        <p class="text-muted me-3">Subtotal:</p>
                        <span>$390.00</span>
                      </div>
                      <div class="d-flex justify-content-end">
                        <p class="text-muted me-3">Discount:</p>
                        <span>-$40.00</span>
                      </div> --}}
                      <div class="d-flex justify-content-end mt-3">
                        <h5 class="me-3">Total:</h5>
                        <h5 class="text-success">Rp.{{$item->total_bayar}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  </div>
  @endsection
  {{-- </x-user-layout> --}}