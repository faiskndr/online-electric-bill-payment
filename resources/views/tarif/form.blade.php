<div class="modal fade" id="modalForm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tarif.store') }}" method="post" id="quickForm">
          @csrf
          @method('')
          <div class="form-group">
            <label for="daya">Daya</label>
            <input type="text" class="form-control" id="daya" name="daya">
          </div>
          <div class="form-group">
            <label for="tarif">Tarif per kwh</label>
            <input type="text" class="form-control" id="tarif" name="tarifperkwh">
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>