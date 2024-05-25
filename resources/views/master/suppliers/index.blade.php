@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data Suppliers</a></li>
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
                      <h5 class="card-title">Data Suppliers</h5>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#modalAddSupplier"><i class="fa fa-plus"></i> Tambah Supplier</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="transaksi" class="nowrap table table-bordered display" style="width: 100%; color: black;">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Kota</th>
                            <th class="text-center">Telpon</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($suppliers as $item)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $item->KdSuplier }}</td>
                              <td>{{ $item->NmSuplier }}</td>
                              <td>{{ $item->Alamat }}</td>
                              <td>{{ $item->Kota }}</td>
                              <td>{{ $item->Telpon }}</td>
                              <td class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-danger btn-xs" id="btn_delete" data-bs-target="#modalDeleteConfirm" data-bs-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-warning btn-xs" id="btn_edit" data-bs-target="#modalEdit" data-bs-toggle="modal" data-data='{{ $item }}'><i class="fa fa-pencil"></i></button>
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
  <div class="modal fade" id="modalAddSupplier" tabindex="-1" aria-labelledby="modalAddSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('data-master/data-suppliers') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddSupplierLabel">Form Tambah Data Supplier</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="KdSuplier" name="KdSuplier" value="{{ $code }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="NmSuplier" name="NmSuplier" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea rows="6" class="form-control" id="Alamat" name="Alamat" autocomplete="off" required></textarea>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Kota</label>
                  <input type="text" class="form-control" id="Kota" name="Kota" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="no_hp" class="form-label">Telpon</label>
                  <input type="number" class="form-control" id="Telpon" name="Telpon" autocomplete="off" required>
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
  </div>

  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_edit">
          @method('put')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Edit Data Supplier</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="KdSuplier_edit" name="KdSuplier" value="{{ $code }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="NmSuplier_edit" name="NmSuplier" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea rows="6" class="form-control" id="Alamat_edit" name="Alamat" autocomplete="off" required></textarea>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="nama" class="form-label">Kota</label>
                  <input type="text" class="form-control" id="Kota_edit" name="Kota" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="no_hp" class="form-label">Telpon</label>
                  <input type="number" class="form-control" id="Telpon_edit" name="Telpon" autocomplete="off" required>
                </div>
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
          @method('delete')
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
      $('#form_edit').attr('action', "{{ url('data-master/data-suppliers/') }}" + '/' + data.id);
      $('#KdSuplier_edit').val(data.KdSuplier);
      $('#NmSuplier_edit').val(data.NmSuplier);
      $('#Alamat_edit').val(data.Alamat);
      $('#Kota_edit').val(data.Kota);
      $('#Telpon_edit').val(data.Telpon);
    })

    $('#transaksi').on('click', 'tbody td #btn_delete', function() {
      let id = $(this).attr('data-id');
      $('#form_delete').attr('action', "{{ url('data-master/data-suppliers/') }}" + '/' + id);
    })

    $(function() {
      let table = $('#transaksi').DataTable({
        scrollX: true
      });

      $('#filter').on('click', function() {
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
