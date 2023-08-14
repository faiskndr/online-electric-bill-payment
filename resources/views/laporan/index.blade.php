{{-- @extends('layouts.main')
@section('konten') --}}
<x-master-layout title="Laporan Pelanggan">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Penggunaan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          {{-- <button onclick="addForm()" class="btn btn-primary btn-sm mb-3">tambah</button> --}}
          <table id="example1" class="table table-bordered table-striped">
            <div class="col-3 float-right">
              <div class="input-group mb-3">
                <form action="/laporan/print" class="form-inline">
                  <input type="text" class="form-control mr-sm-2" placeholder="cari username" name="username" id="search">
                  <button type="submit" class="btn btn-outline-primary">print</button>
                </form>
              </div>
            </div>
            <div>
              <button class="btn btn-primary btn-sm" onclick="searchByDate()">search by date</button>
              {{-- <a href="/laporan/print" class="btn btn-primary btn-sm">print</a> --}}
            </div>
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Username</th>
              <th>Id Penggunaan</th>
              <th>Bulan</th>
              <th>Tahun</th>
              <th>Meter Awal</th>
              <th>Meter Akhir</th>
              <th>Tanggal</th>
            </tr>
            </thead>
          
              <tbody id="penggunaan">
                @foreach ($penggunaan as $key => $item) 
                <tr>
                <td>{{$key + 1}}</td>
                  {{-- @if ($item->pelanggan == NULL)
                    <td>{{ $item->id_pelanggan}}</td>
                  @else --}}
                  <td>{{$item->username}}</td>
                  {{-- @endif --}}
                  <td>{{$item->id_penggunaan}}</td>
                  <td>{{$item->bulan}}</td>
                  <td>{{$item->tahun}}</td>
                  <td>{{$item->meter_awal}}</td>
                  <td>{{$item->meter_akhir}}</td>    
                  <td>{{$item->date}}</td>    
                </tr>    
                @endforeach
                
              </tbody>
              
            <tfoot>
            
            </tfoot>
          </table>
        @include('laporan.form')
        </div>
        <!-- /.card-body -->
        {{ $penggunaan->links('vendor.pagination.simple-bootstrap-4') }}
      </div>
      
      <!-- /.card -->
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Pembayaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
      
          <table id="example2" class="table table-bordered table-striped">
            <div>
              {{-- <button class="btn btn-primary btn-sm" onclick="searchByDate()">search by date</button> --}}
              {{-- <a href="/laporan/print" class="btn btn-primary btn-sm">print</a> --}}
            </div>
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Id Pembayaran</th>
              <th>Id Tagihan</th>
              <th>Id Pelanggan</th>
              <th>Username</th>
              <th>Biaya Admin</th>
              <th>Total</th>
              <th>Jumlah Meter</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Virtual Account</th>
            </tr>
            </thead>
          
              <tbody>
                @foreach ($pembayaran as $key => $item) 
                <tr>
                <td>{{$key + 1}}</td>
                  {{-- @if ($item->pelanggan == NULL)
                    <td>{{ $item->id_pelanggan}}</td>
                  @else --}}
                  <td>{{$item->id_pembayaran}}</td>
                  {{-- @endif --}}
                  <td>{{$item->id_tagihan}}</td>
                  <td>{{$item->id_pelanggan}}</td>
                  <td>{{$item->username}}</td>
                  <td>{{$item->biaya_admin}}</td>
                  <td>{{$item->total_bayar}}</td>
                  <td>{{$item->jumlah_meter}}</td>    
                  <td>{{$item->status}}</td>    
                  <td>{{$item->tanggal_pembayaran}}</td>    
                  <td>{{$item->virtual_account}}</td>    
                </tr>    
                @endforeach
                
              </tbody>
              
            <tfoot>
            
            </tfoot>
          </table>
          
        
        @include('laporan.form')
        </div>
      </div>
      
      <!-- /.card -->
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Tagihan</h3>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <div class="col-3 float-right">
              <div class="input-group mb-3">
                <form action="/laporan/tagihan/print" class="form-inline">
                  <input type="text" class="form-control mr-sm-2" placeholder="cari pelanggan" name="name" id="search2">
                  <button type="submit" class="btn btn-outline-primary ">print</button>
                </form>
              </div>
            </div>
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Id Tagihan</th>
              <th>Id Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th>Jumlah Meter</th>
              <th>Tagihan</th>
              <th>Status</th>
            </tr>
            </thead>
           
              <tbody id="tagihan">
                @foreach ($tagihan as $key => $item) 
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$item->id_tagihan}}</td>  
                  <td>{{$item->id_pelanggan}}</td>  
                  <td>{{$item->pelanggan->nama_pelanggan}}</td>  
                  <td>{{$item->jumlah_meter}}</td>  
                  <td>{{$item->jumlah_meter * $item->pelanggan->tarif->tarifperkwh}}</td>  
                  <td>{{$item->status}}</td>  
                </tr>    
                @endforeach
                
              </tbody>
              
            <tfoot>
            
            </tfoot>
          </table>
        </div>
      </div>
      
      <!-- /.card -->
    </div>
    
  </div>
  @push('scripts')
    <script>
      $('#search').on('keyup', function(){
        $value=$(this).val();
        $.ajax({
          type : 'get',
          url : '{{URL::to('laporan-search')}}',
          data :{'search':$value},
          success:function(data){
            $('#penggunaan').html(data);
            }
        });

      })

      $('#search2').on('keyup', function(){
        $value=$(this).val();
       
        $.ajax({
          type : 'get',
          url : '{{URL::to('laporan/tagihan/search')}}',
          data :{'search':$value},
          success:function(data){
            $('#tagihan').html(data);
            }
        });

      })


      function searchByDate(){
        $('#modalForm').modal('show');
        $('#filter').click(function(){
          $from = $('#first_date').val();
          $to = $('#last_date').val();

          $.ajax({
          type : 'get',
          url : '{{URL::to('laporan-search')}}',
          data :{'from':$from, 'to':$to},
          success:function(data){
            $('#modalForm').modal('toggle');
            $('tbody').html(data);
            }
        });

        }) 
      }
    </script>
    {{-- <script>
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script> --}}
@endpush
  </x-master-layout>