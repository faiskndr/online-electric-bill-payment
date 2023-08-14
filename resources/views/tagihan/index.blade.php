<x-master-layout title="Tagihan">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Tagihan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" >
          <form action="{{ route('tagihan.store') }}" method="post" id="card">
            @csrf
              <div class="form-group col-md-6">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $pelanggan->nama_pelanggan }}">
              </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputAddress">Alamat</label>
                <input type="text" class="form-control" id="inputAddress" value="{{ $pelanggan->alamat }}">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="meterAwal">Meter Awal</label>
                <input type="number" class="form-control meterAwal" data-id="{{ $penggunaan->id_penggunaan }}" name="meterAwal" id="meterAwal" value="{{$penggunaan->meter_awal}}">
                <x-input-error :messages="$errors->get('meterAwal')" class="mt-2" />
              </div>
              <div class="form-group col-md-4">
                <label for="meterAkhir">Meter Akhir</label>
                <input type="number" class="form-control meterAkhir" data-id="{{$penggunaan->id_penggunaan}}" name="meterAkhir" id="meterAkhir" value="{{$penggunaan->meter_akhir}}">
                <x-input-error :messages="$errors->get('meterAkhir')" class="mt-2" />
              </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Simpan</button>
          </form>
          <form action="{{route('tagihan.destroy',$penggunaan->id_penggunaan)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger float-right">Batal</button>
          </form>
        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</x-master-layout>