<x-master-layout title="Tagihan">
  <div class="row">
    <div class="col-12">
      @if (\Session::has('failed'))
        <div class="alert alert-danger" role="alert">
          {!! \Session::get('failed') !!}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Tagihan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <button onclick="addForm()" class="btn btn-primary btn-sm mb-3">tambah</button>
          {{-- <form method="Post" action="{{ route('penggunaan.store') }}">
            <select class="custom-select mb-3" name="id_pelanggan">
              <option selected>Cari Pelanggan</option>
              @foreach ($pelanggan as $item)
                <option value="{{ $item->id_pelanggan }}">{{ $item->nama_pelanggan }}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form> --}}
        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
   <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Tagihan</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Id Tagihan</th>
            <th>Pelanggan</th>
            <th>Jumlah Meter</th>
            <th>Jumlah Tagihan</th>
            <th>Status</th>
            <th>Bulan</th>
          </tr>
          </thead>
          @foreach ($tagihan as $key => $item)
          <tbody>
            <td>{{ $key +1 }}</td>
            <td>{{ $item->id_tagihan }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{$item->jumlah_meter}}</td>
            <td>{{$item->total}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->bulan}}</td>
            {{-- <td> <button onclick="editForm('{{route('tarif.update', $item->id_tarif)}}')" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></button>
             </td> --}}
          </tbody>
          @endforeach
          <tfoot>
          {{-- <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            <th>CSS grade</th>
          </tr> --}}
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
   </div>
  </div>
  @include('penggunaan.form')
  @push('scripts')
      <script>
        function addForm() {
        $("#modalForm").modal('show');
      }
      </script>
  @endpush
  </x-master-layout>