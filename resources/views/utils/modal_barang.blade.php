<div class="modal fade" id="modalTambahJenisBarang" tabindex="-1" style="z-index: 99999" aria-labelledby="modalTambahJenisBarangLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ url('data-master/data-barang/store-jenis-barang') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahJenisBarangLabel">Form Tambah Jenis Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" readonly value="{{ $kode_jenis_barang }}">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Jenis Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
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

<div class="modal fade" id="modalTambahSatuanBarang" tabindex="-1" style="z-index: 999999" aria-labelledby="modalTambahSatuanBarangLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ url('data-master/data-barang/store-satuan-barang') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahSatuanBarangLabel">Form Tambah Data Satuan Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="kode_nama" class="form-label">Kode Nama Satuan</label>
                <input type="text" class="form-control" id="kode_nama" name="kode_nama" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Satuan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
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

<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ url('data-master/data-barang') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahBarangLabel">Form Tambah Data Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-6 mb-3">
              <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" readonly value="{{ $kode_barang }}">
              </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Jenis Barang</label>
              <select class="form-select" name="jenis_barang_id" id="utils_jenis_barang_id" required>
                <option value="" selected disabled>pilih</option>
                @foreach ($jenis_barang as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
                <option value="tambah_jenis_barang">Tambah Jenis ...</option>
              </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Satuan Barang</label>
              <select class="form-select" name="satuan_barang" id="utils_satuan_barang" required>
                <option value="" selected disabled>pilih</option>
                @foreach ($satuan_barang as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->kode_nama }})</option>
                @endforeach
                <option value="tambah_satuan_barang">Tambah Satuan ...</option>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
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

<script>
  $('#utils_jenis_barang_id').on('change', function() {
    let val = $(this).val();

    if (val == 'tambah_jenis_barang') {
      $('#modalTambahJenisBarang').modal('show');
      $('#utils_jenis_barang_id').val('');
    }
  })

  $('#utils_satuan_barang').on('change', function() {
    let val = $(this).val();

    if (val == 'tambah_satuan_barang') {
      $('#modalTambahSatuanBarang').modal('show');
      $('#utils_satuan_barang').val('');
    }
  })
</script>
