{{-- @extends('layouts.main') --}}
<x-master-layout title="Dashboard">
{{-- @section('konten') --}}
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$pelanggan->count('username')}}</h3>

        <p>Pelanggan</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-person"></i>
      </div>
      <a href="{{route('pelanggan.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$tagihanTotal->count('status')}}<sup style="font-size: 20px"></sup></h3>

        <p>Tagihan</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="{{route('tagihan.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$tagihanLunas->count('status')}}</h3>

        <p>Dibayar</p>
      </div>
      <div class="icon">
        <i class="ion ion-cash"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$tagihan->count('status')}}</h3>

        <p>Belum Bayar</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-close"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$tamu->count('status')}}</h3>

        <p>Konfirmasi Pelanggan</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{route('verify')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-7 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="ion ion-ios-paper"></i>
          Tagihan
        </h3>
        <div class="card-tools">
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>no</th>
              <th>id pelanggan</th>
              <th>id Tagihan</th>
              <th>Jumlah Meter</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tagihan as $key => $item)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$item->id_pelanggan}}</td>
                  <td>{{$item->id_tagihan}}</td>
                  <td>{{$item->jumlah_meter}}</td>
                  <td>{{$item->status}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- right col -->
  <section class="col-lg-5 connectedSortable">

    <!-- Map card -->
    {{-- <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">
          <i class="fas fa-map-marker-alt mr-1"></i>
          Visitors
        </h3>
      </div>
      <div class="card-body">
        <h5>{{$pembayaran->sum('total_bayar')}}</h5>
      </div>
      <!-- /.card-body-->
      <div class="card-footer bg-transparent">
      </div>
    </div> --}}
    
  </section>
  <!-- right col -->
</div>
<!-- /.row (main row) -->
</div>
</section>  
</div>

{{-- @endsection --}}
</x-master-layout>