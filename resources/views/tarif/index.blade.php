<x-master-layout title="Tarif">
  <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tarif</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button class="btn btn-primary btn-sm mb-3" onclick="addForm()">tambah</button>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Daya</th>
            <th>Tarif per Kwh</th>
            <th>Opsi</th>
          </tr>
          </thead>
          @foreach ($tarif as $key => $item)
          <tbody>
            <td>{{ $key +1 }}</td>
            <td>{{ $item->daya }}</td>
            <td>{{ $item->tarifperkwh }}</td>
            <td> <button onclick="editForm('{{route('tarif.update', $item->id_tarif)}}')" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></button>
             </td>
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
    <!-- /.card -->
  </div>
  </div>
  @include('tarif.form')
  @push('scripts')
  <script>
    let table;
  $(function (){
   
  $.validator.setDefaults({
    // submitHandler: function(){
    //   $.ajax({
    //       url: $('#modalForm form').attr('action'),
    //       type: 'post',
    //       data: $('#modalForm form').serialize()
    //     })
    //     .done((response) =>{
    //       $("#modalForm").modal('hide');
    //       table.ajax.reload();
    //     })
    //     .fail((errors) => {
    //       alert('gagal input');
    //       return;
    //     });
    // }
  });
  $('#modalForm form').validate({
    rules:{
      daya:{
        required:true
      },
      tarifperkwh:{
        required:true
      },
    },
    messages:{
      daya:{
        required:"Tolong isi"
      },
      tarifperkwh:{
        required:"Perlu isi"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  });
  function addForm(url) {
          $("#modalForm").modal('show');
          $('#modalForm .modal-title').text('Tarif');

          $('#modalForm form')[0].reset();
          $('#modalForm form').attr('action', url);
          $('#modalForm [name=_method]').val('post');
          $('#modalForm [name=daya]').focus();
        }


    function editForm(url) {
      $("#modalForm").modal('show');
      $('#modalForm .modal-title').text('Edit Tarif');

      $('#modalForm form')[0].reset();
      $('#modalForm form').attr('action', url);
      $('#modalForm [name=_method]').val('put');
      $('#modalForm [name=daya]').focus();

      $.get(url)
        .done((response)=>{
        $('#modalForm [name=daya]').val(response.daya);
        $('#modalForm [name=tarifperkwh]').val(response.tarifperkwh);
        })
        .fail((errors)=>{
          alert('gagal!');
          return;
        });
    }

    function deleteData(url) {
        $.post(url,{
          '_method': 'delete',
          '_token': '{{ csrf_token() }}'
        })
          .done((response)=>{
            table.ajax.reload();
          })
          .fail((errors)=>{
            alert('tidak dapat dihapus');
            return;
          });
    }
  </script>
@endpush
  </x-master-layout>