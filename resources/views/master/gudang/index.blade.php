@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data Gudang</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="content__boxed">
      <div class="content__wrap">
        <section>
          <div class="row">
            <div class="col-md-12">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5 class="card-title">Data Gudang</h5>
                    </div>
                    <div class="col-md-2 mb-2 ms-auto mb-3">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#modalAddCustomer"><i class="fa fa-plus"></i> Tambah Gudang</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="transaksi" class="nowrap table display table-bordered" style="width: 100%; color: black;">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($customers as $item)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $item->kode }}</td>
                              <td>{{ $item->nama }}</td>
                              <td>{{ $item->alamat }}</td>
                              <td>{{ $item->keterangan }}</td>
                              <td class="text-center"><div class="badge bg-success p-2">Aktif</div></td>
                              <td class="d-flex gap-1 justify-content-center">
                                <button type="button" data-bs-toggle="modal" data-id="{{ $item->id }}" data-bs-target="#modalDeleteConfirm" class="btn btn-danger btn-xs btn_delete"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-warning btn-xs" id="btn_edit" data-bs-toggle="modal" data-data='{{ $item }}' data-bs-target="#modalEdit"><i class="fa fa-pencil"></i></button>
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
  <div class="modal fade" id="modalAddCustomer" tabindex="-1" aria-labelledby="modalAddCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('data-master/data-gudang') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddCustomerLabel">Form Tambah Data Gudang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="kode" name="kode" value="{{ $code }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea rows="6" class="form-control" id="alamat" name="alamat" autocomplete="off" required></textarea>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off">
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

  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_edit">
          @method('put')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Edit Data Gudang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="kode_edit" name="kode" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama_edit" name="nama" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea rows="6" class="form-control" id="alamat_edit" name="alamat" autocomplete="off" required></textarea>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan_edit" name="keterangan" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDeleteConfirm" tabindex="-1" aria-labelledby="modalDeleteConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_delete">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteConfirmLabel">Konfirmasi Hapus</h5>
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
    $('#transaksi').on('click', 'tbody td #btn_edit', function() {
      let data = $(this).data('data');
      $('#form_edit').attr('action', "{{ url('data-master/data-gudang') }}" + '/' + data.id);
      $('#kode_edit').val(data.kode);
      $('#nama_edit').val(data.nama);
      $('#alamat_edit').val(data.alamat);
      $('#keterangan_edit').val(data.keterangan);
    })

    $('#transaksi').on('click', 'tbody td .btn_delete', function() {
      let id = $(this).attr('data-id');
      $('#form_delete').attr('action', "{{ url('data-master/data-gudang') }}" + '/' + id);
    })

    $(function() {
      let table = $('#transaksi').DataTable({
        scrollX: true
      });

      $('#filter').on('click', function() {
        console.log(1);
        let from = $("#start_date").val();
        let to = $("#end_date").val();
        let supplier = $("#supplier_filter").val();
        if (from && to) {
          table.draw();
        }
      });
    })
  </script>
@endsection
