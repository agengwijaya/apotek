@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data User Role</a></li>
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
                      <h5 class="card-title">List Data Role</h5>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary form-control"><i class="fa fa-plus"></i> Tambah Role</a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="transaksi" class="nowrap table display table-bordered" style="width: 100%; color: black;">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($roles as $item)
                            <tr>
                              <td  class="text-center">{{ $loop->iteration }}</td>
                              <td>{{ $item->name }}</td>
                              <td  class="text-center"><div class="badge bg-success p-2">Aktif</div></td>
                              <td class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                              </td>
                            </tr>
                          @endforeach
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
  {{-- <div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('data-master-user/data-user-role') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddRoleLabel">Form Tambah Data Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}

  <script>
    $(function() {
      let table = $('#transaksi').DataTable({
        scrollX: true
      });
    })
  </script>
@endsection
