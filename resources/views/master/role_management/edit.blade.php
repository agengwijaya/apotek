@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data Edit User Role</a></li>
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

                  <div class="row">
                    <div class="card-title">
                      <h5>
                        Ubah Akses Role
                      </h5>
                    </div>

                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada Kesalahan Dalam Penginputan!.<br><br>
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <div class="container mt-4">
                      <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @method('patch')
                        @csrf
                        <div class="row">
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ $role->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                          </div>
                          @php
                            $modul = DB::table('module')->get();
                          @endphp
                          @foreach ($modul as $m)
                            <div class="col-md-4 mb-3">
                              <div class="card border-primary">
                                <div class="card-body">
                                  @php
                                    $permission = DB::table('permissions')
                                        ->where('module_id', $m->id)
                                        ->get();
                                  @endphp
                                  <div class="row">
                                    <div class="col-8 mb-3">
                                      <label for="permissions" class="form-label">{{ $m->nama }}</label>
                                    </div>
                                    <div class="col ms-auto text-end">
                                      <button type="button" data-bs-toggle="modal" data-id="{{ $m->id }}" data-bs-target="#modalTambahConfirm" class="btn btn-primary btn-xs btn_tambah"><i class="fa fa-plus"></i></button>
                                    </div>
                                  </div>

                                  <div class="table-responsive">
                                    <table id="transaksi" class="table table-bordered" id="detail_table" style="width: 100%">
                                      <thead>
                                        <tr style="background:#ddd">
                                          <th scope="col" width="1%"><input type="checkbox" id="all_permission{{ $m->id }}"></th>
                                          <th scope="col" width="90%">Name</th>
                                          <th scope="col" width="9%">Aksi</th>
                                        </tr>
                                      </thead>

                                      @foreach ($permission as $permission)
                                        <tr>
                                          <td>
                                            <input id="checkItem{{ $m->id }}" type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='checkItem{{ $m->id }} permission' {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                          </td>
                                          <td>{{ $permission->nama_aksi }}</td>
                                          <td><button type="button" data-bs-toggle="modal" data-id="{{ $permission->id }}" data-bs-target="#modalDeleteConfirm" class="btn btn-danger btn-xs btn_delete"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                      @endforeach

                                    </table>
                                  </div>
                                </div>

                              </div>
                            </div>
                            <script>
                              $('#all_permission{{ $m->id }}').click(function() {
                                console.log(1);
                                $(':checkbox.checkItem{{ $m->id }}').prop('checked', this.checked);
                              });
                            </script>
                          @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                      </form>
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
  <div class="modal fade" id="modalTambahConfirm" tabindex="-1" aria-labelledby="modalTambahConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_tambah">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahConfirmLabel">Tambah Permission</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="">Route Name</label>
                <input type="text" name="route_name" id="route_name" class="form-control">
              </div>
              <div class="col-md-12">
                <label for="">Nama Aksi</label>
                <input type="text" name="nama_aksi" id="nama_aksi" class="form-control">
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
  </div>
  <div class="modal fade" id="modalDeleteConfirm" tabindex="-1" aria-labelledby="modalDeleteConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_delete">
          @method('delete')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteConfirmLabel">Hapus Permission</h5>
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
    $('.btn_tambah').on('click', function() {
      let id = $(this).attr('data-id');
      $('#form_tambah').attr('action', "{{ url('roles/tambah') }}" + '/' + id);
    })
    $('.btn_delete').on('click', function() {
      let id = $(this).attr('data-id');
      $('#form_delete').attr('action', "{{ url('roles/hapus') }}" + '/' + id);
    })
  </script>
@endsection
