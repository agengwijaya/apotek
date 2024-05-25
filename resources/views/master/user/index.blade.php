@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data User</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="content__boxed">
      <div class="content__wrap">
        <section>
          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row row-cols-auto justify-content-between mb-3">
                    <div class="col">
                      <h5 class="card-title">List Data User</h5>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#modalAddUser"><i class="fa fa-plus"></i> Tambah User</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="transaksi" class="nowrap table display table-bordered" style="width: 100%; color: black;">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- @foreach ($users as $item)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->username }}</td>
                              <td class="text-center">
                                @foreach ($item->role as $role)
                                  <span class="badge bg-success p-2">{{ $role->name }}</span>
                                @endforeach
                              </td>
                              <td class="text-center">
                                <div class="badge bg-success p-2">Aktif</div>
                              </td>
                              <td>{{ $item->nama }}</td>
                              <td class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-danger btn-xs" id="btn_delete" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="fa fa-trash"></i></button>
                                <a href="{{ url('data-master-user/data-user') . '/' . $item->id }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                              </td>
                            </tr>
                          @endforeach --}}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('data-master-user/data-user') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddUserLabel">Form Tambah Data User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="username" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="username" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="email" class="form-label">Role</label>
                  <select class="form-select" name="role" required>
                    <option value="" selected disabled>pilih</option>
                    @foreach ($roles as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_delete">
          @method('delete')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah anda ingin menghapus data ini secara permanen?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $('#transaksi').on('click', 'tbody td #btn_delete', function() {
      let id = $(this).attr('data-id');
      $('#form_delete').attr('action', "{{ url('data-master-user/data-user/') }}" + '/' + id);
    })

    $(function() {
      let table = $('#transaksi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('data-master-user/data-user/data') }}",
          type: 'GET',
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center'
          },
          {
            data: 'name',
            name: 'name',
          },
          {
            data: 'username',
            name: 'username',
          },
          {
            data: 'role',
            name: 'role',
            className: 'text-center'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            className: 'text-center'
          },
        ],
        scrollX: true
      });
    })
  </script>
@endsection
