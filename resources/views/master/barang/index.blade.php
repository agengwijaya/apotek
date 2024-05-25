@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
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
                      <h5 class="card-title">List Obat</h5>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#modalAddBarang"><i class="fa fa-plus"></i> Tambah Obat</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="barang" class="nowrap table table-bordered display" style="width: 100%; color: black;">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Suplier</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($barang as $item)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $item->KdObat }}</td>
                              <td>{{ $item->NmObat }}</td>
                              <td>{{ $item->Jenis }}</td>
                              <td class="text-center">{{ $item->Satuan }}</td>
                              <td>{{ $item->HargaBeli }}</td>
                              <td>{{ $item->HargaJual }}</td>
                              <td>{{ $item->Stok }}</td>
                              <td>{{ $item->supplier->NmSuplier }}</td>
                              <td class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-danger btn-xs" id="btn_delete" data-bs-target="#modalDeleteConfirmBarang" data-bs-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-warning btn-xs" id="btn_edit" data-bs-target="#modalEditBarang" data-bs-toggle="modal" data-data='{{ $item }}'><i class="fa fa-pencil"></i></button>
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

  <div class="modal fade" id="modalAddBarang" tabindex="-1" aria-labelledby="modalAddBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('data-master/data-obat') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddBarangLabel">Form Tambah Data Obat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="KdObat" name="KdObat" readonly value="{{ $code_barang }}">
                </div>
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Suplier</label>
                <select class="form-select" name="KdSuplier" required>
                  <option value="" selected disabled>pilih</option>
                  @foreach ($supplier as $item)
                    <option value="{{ $item->KdSuplier }}">{{ $item->NmSuplier }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Obat</label>
                  <input type="text" class="form-control" id="NmObat" name="NmObat" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Jenis</label>
                  <input type="text" class="form-control" id="Jenis" name="Jenis" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Satuan</label>
                  <input type="text" class="form-control" id="Satuan" name="Satuan" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">HargaBeli</label>
                  <input type="text" class="form-control" id="HargaBeli" name="HargaBeli" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">HargaJual</label>
                  <input type="text" class="form-control" id="HargaJual" name="HargaJual" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Stok</label>
                  <input type="number" class="form-control" id="Stok" name="Stok" required>
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
  
  <div class="modal fade" id="modalEditBarang" tabindex="-1" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_edit_barang">
          @method('put')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddBarangLabel">Edit Data Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" class="form-control" id="KdObat_edit" name="KdObat" readonly value="{{ $code_barang }}">
                </div>
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Suplier</label>
                <select class="form-select" id="KdSuplier_edit" name="KdSuplier" required>
                  <option value="" selected disabled>pilih</option>
                  @foreach ($supplier as $item)
                    <option value="{{ $item->KdSuplier }}">{{ $item->NmSuplier }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Obat</label>
                  <input type="text" class="form-control" id="NmObat_edit" name="NmObat" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Jenis</label>
                  <input type="text" class="form-control" id="Jenis_edit" name="Jenis" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Satuan</label>
                  <input type="text" class="form-control" id="Satuan_edit" name="Satuan" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">HargaBeli</label>
                  <input type="text" class="form-control" id="HargaBeli_edit" name="HargaBeli" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">HargaJual</label>
                  <input type="text" class="form-control" id="HargaJual_edit" name="HargaJual" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="nama" class="form-label">Stok</label>
                  <input type="number" class="form-control" id="Stok_edit" name="Stok" required>
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

  <div class="modal fade" id="modalDeleteConfirmBarang" tabindex="-1" aria-labelledby="modalDeleteConfirmBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" id="form_delete_barang">
          @method('delete')
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteConfirmBarangLabel">Konfirmasi Hapus</h5>
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
    $('#barang').on('click', 'tbody td #btn_edit', function() {
      let data = $(this).data('data');
      $('#form_edit_barang').attr('action', "{{ url('data-master/data-obat/') }}" + '/' + data.id);
      $('#KdObat_edit').val(data.KdObat);
      $('#NmObat_edit').val(data.NmObat);
      $('#KdSuplier_edit').val(data.KdSuplier);
      $('#Jenis_edit').val(data.Jenis);
      $('#Satuan_edit').val(data.Satuan);
      $('#HargaBeli_edit').val(data.HargaBeli);
      $('#HargaJual_edit').val(data.HargaJual);
      $('#Stok_edit').val(data.Stok);
    })

    $('#barang').on('click', 'tbody td #btn_delete', function() {
      let id = $(this).attr('data-id');
      $('#form_delete_barang').attr('action', "{{ url('data-master/data-obat/') }}" + '/' + id);
    })

    $(function() {
      let table = $('#barang').DataTable({
        scrollX: true
      });
    })
  </script>
@endsection
