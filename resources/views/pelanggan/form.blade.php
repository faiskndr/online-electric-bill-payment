<div class="modal fade" id="modalForm{{$item->id_pelanggan}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="{{route('pelanggan.update',$item->id_pelanggan)}}">
      @csrf
      @method('put')
      <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="{{$item->username}}">
            </div>
            <div class="form-group col-md-6">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{$item->nama_pelanggan}}">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Alamat</label>
            <input type="text" class="form-control" id="inputAddress" name="alamat" value="{{$item->alamat}}">
          </div>
          <div class="form-group">
            <label for="kwh">Nomor Kwh</label>
            <input type="text" class="form-control" id="kwh" name="nomor_kwh" value="{{$item->nomor_kwh}}">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputState">Tarif</label>
              <select id="inputState" class="form-control" name="id_tarif">
                @foreach ($tarif as $tar)
                  <option value="{{$tar->id_tarif}}" @if ($item->id_tarif == $tar->id_tarif) selected @endif>{{$tar->daya}}</option>
                @endforeach
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>