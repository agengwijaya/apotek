<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-labelledby="modalTambahSupplierLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ url('data-master/data-suppliers') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahSupplierLabel">Form Tambah Data Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ $kode_supplier }}" readonly>
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
                <label for="no_hp" class="form-label">No HP</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" autocomplete="off" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea rows="6" class="form-control" id="alamat" name="alamat" autocomplete="off" required></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="no_rek" class="form-label">No Rekening</label>
                <input type="number" class="form-control" id="no_rek" name="no_rek" autocomplete="off" required>
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
