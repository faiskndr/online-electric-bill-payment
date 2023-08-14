<x-master-layout title="Bank">
  <div class="row">
    <div class="col-lg-12">
    
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Daftar Bank</h3>
        </div>
        <div class="card-body table-responsive">
          <button class="btn btn-primary btn-sm mb-3" onclick="addForm()">tambah</button>
          <table class="table table-striped table-valign-middle">
            <thead>
            <tr class="text-sm">
              <th>Id Admin</th>
              <th>Username</th>
              <th>Nama Admin</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($admin as $item)
                  <tr>
                    <td>{{ $item->id_admin}}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_admin}}</td>
                    <td>{{ $item->level->nama_level}}</td>
                    <td>
                      <button onclick="editForm('{{route('bank.update', $item->id_admin)}}')" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></button>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  @include('bank.form')
  @push('scripts')
      <script>
  $(function (){
        $('#modalForm form').validate({
    rules:{
      username:{
        required:true
      },
      password:{
        required:true
      },
    },
    messages:{
      username:{
        required:"Tolong isi"
      },
      password:{
        required:"Tolong isi"
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
    

          $('#modalForm form')[0].reset();
          $('#modalForm form').attr('action', url);
        }

  function editForm(url){
      $('#modalForm').modal('show');
      $('#modalForm form').attr('action', url);
      $('#modalForm [name=_method]').val('put');

      $.get(url)
        .done((response)=>{
        $('#modalForm [name=username]').val(response.username);
        $('#modalForm [name=namaAdmin]').val(response.nama_admin);
        })
        .fail((errors)=>{
          alert('gagal!');
          return;
        });
  }
      </script>
  @endpush
  </x-master-layout>