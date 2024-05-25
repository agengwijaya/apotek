@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Edit Data User</a></li>
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
                  <h5 class="card-title"><a href="{{ url('data-master-user/data-user') }}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> kembali </a> | Edit Data User</h5>
                  <form action="{{ url('data-master-user/data-user') . '/' . $user->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                      <div class="col-4">
                        <div class="mb-3">
                          <label for="name" class="form-label">Nama Lengkap</label>
                          <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" value="{{ $user->username }}" id="username" name="username" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" value="{{ $user->email }}" id="email" name="email" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password <small class="text-danger">(kosongi kalau tidak diubah)</small></label>
                          <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                        </div>
                        <div class="mb-3">
                          <label for="role" class="form-label">Role</label>
                          <select class="form-control" name="role" required>
                            <option value="">Pilih role</option>
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    $('#akses').on('change', function() {
      let id = parseInt($(this).val());
      if (id == 1) {
        $('#pegawai').attr('hidden', false);
        $('#mitra').attr('hidden', true);
      } else {
        $('#pegawai').attr('hidden', true);
        $('#mitra').attr('hidden', false);
      }
    })
  </script>
@endsection
