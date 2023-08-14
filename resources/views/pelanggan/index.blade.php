{{-- @extends('layouts.main')
@section('konten') --}}
<x-master-layout title="Daftar Pelanggan">
<div class="row">
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pelanggan</h3>
    </div>
    <!-- /.card-header -->
    
    <div class="card-body">
      <div class="table-responsive p-0">
      {{-- <button onclick="addForm()" class="btn btn-primary btn-sm mb-3">tambah</button> --}}
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th width="5%">No</th>
          <th>Username</th>
          <th>Nomor kwh</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Daya</th>
          <th>Opsi</th>
        </tr>
        </thead>
        @foreach ($pelanggan as $key => $item) 
          <tbody>
            <td>{{$key + 1}}</td>
              <td>{{$item->username}}</td>
              <td>{{$item->nomor_kwh}}</td>
              <td>{{$item->nama_pelanggan}}</td>
              <td>{{$item->alamat}}</td>
              <td>{{$item->tarif->daya}}</td>
              @if ($item->status == 1)
                <td>
                  <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalForm{{ $item->id_pelanggan }}"><i class="fas fa-edit"></i></a>
                  {{-- <a class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a> --}}
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelItem{{ $item->id_pelanggan }}"><i class="fas fa-trash"></i></button>
                </td>
              @else
                  <td> <form method="post" action="{{route('pelanggan.update', $item->id_pelanggan)}}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                  </form>  </td>
              @endif
          
          </tbody>
          @endforeach
        <tfoot>
        
        </tfoot>
      </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</div>
@foreach ($pelanggan as $item)
<div class="modal fade" id="modalDelItem{{$item->id_pelanggan}}">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
              <h6 class="text-center">Delete
                  <span>{{ $item->username}} ?</span>
              </h6>
          </div>
          <div class="modal-footer">
            <form method="post" action="{{route('pelanggan.destroy', $item->id_pelanggan)}}">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>  
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
</div>
  @include('pelanggan.form')
@endforeach


{{-- @endsection --}}
{{-- @push('scripts')
    <script>
      $("#example1").DataTable({
        processing: true,
        autowidth:false,
        ajax:{
          url: '{{route('pelanggan.data')}}'
        },
        columns: [
            {data: 'DT_RowIndex', searchabel : false , sortable : false},
            {data:'username'},
            {data: 'nomor_kwh'},
            {data: 'nama_pelanggan'},
            {data: 'alamat'},
            {data: 'daya'},
            {data: 'tarifperkwh'},
            {data: 'opsi'},
          ]
      })

      function addForm() {
        $("#modalForm").modal('show');
      }

      function editForm(url){
        $('#modalForm').modal('show');

        $.get(url)
            .done((response)=>{
            $('#modalForm [name=username]').val(response.username);
            $('#modalForm [name=nama]').val(response.nama_pelanggan);
            $('#modalForm [name=alamat]').val(response.alamat);
            $('#modalForm [name=nomorkwh]').val(response.nomor_kwh);
            $('#modalForm [name=tarif]').val(response.tarifperkwh);
            })
            .fail((errors)=>{
              alert('gagal!');
              return;
            });
      }
    </script>
@endpush --}}
</x-master-layout>