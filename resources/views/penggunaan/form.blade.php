<div class="modal fade" id="modalForm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <input class="mb-3 float-right" type="text" id="search" name="search">
          <div class="table-responsive p-0">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Nomor kwh</th>
              <th>Daya</th>
              <th>Opsi</th>
            </tr>
            </thead>
              <tbody>
              @foreach ($pelanggan as $item)
                <tr>
                  <td>{{$item->nama_pelanggan}}</td>
                  <td>{{$item->nomor_kwh}}</td>
                  <td>{{$item->tarif->daya}}</td>
                  {{-- @foreach ($item->penggunaan->first() as $penggunaan)
                  <td>{{$penggunaan}}</td>
                  @endforeach --}}
                  @if (!$item->penggunaan->last())
                      <td>new user</td>
                  @else
                    <td>{{$item->penggunaan->last()->created_at}}</td>
                  @endif
                  
                  <td><a href="{{ route('tagihan.show',$item->id_pelanggan )}}" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i></a></td>
                </tr>
              @endforeach
              </tbody>
            <tfoot>
          
            </tfoot>
          </table>
          </div>
        </div>
    </div>
  </div>
</div>
@push('scripts')
    <script>
      $('#search').on('keyup', function(){
        $value=$(this).val();

        $.ajax({
          type : 'get',
          url : '{{URL::to('search')}}',
          data :{'search':$value},
          success:function(data){
            $('tbody').html(data);
            }
        });

      })
    </script>
    <script>
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endpush