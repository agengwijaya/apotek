<table class="table table-bordered" style="width: 100%">
  <thead>
    <tr style="background:#ddd">
      <th class="text-center" style="width: 20%">Nama Barang</th>
      <th class="text-center" style="width: 10%">Satuan</th>
      <th class="text-center" style="width: 15%">Harga</th>
      <th class="text-center" style="width: 15%">Qty</th>
      <th class="text-center" style="width: 15%">Jenis Diskon</th>
      <th class="text-center" style="width: 15%">Diskon</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <select data-init-plugin="select2" class="form-control" name="barang_id" id="barang_id_edit" required>
          <option selected disabled value="">pilih</option>
          @foreach ($barang as $item)
            <option {{ $data->barang_id == $item->id ? 'selected' : '' }} data-satuan={{ $item->t_satuan_barang->kode_nama }} value="{{ $item->id }}">{{ $item->nama }}</option>
          @endforeach
        </select>
      </td>
      <td>
        <input type="text" class="form-control" value="{{ $data->barang->t_satuan_barang->kode_nama }}"ss name="satuan_barang" id="satuan_barang_edit" autocomplete="off" readonly required>
      </td>
      <td><input type="text" class="form-control" name="harga" value="{{ number_format($data->harga, 0, ',', '.') }}" onkeyup="input_rupiah('harga_edit')" id="harga_edit" placeholder="Harga" autocomplete="off" required></td>
      <td><input type="text" class="form-control" name="qty" value="{{ $data->qty }}" id="qty" placeholder="Qty" autocomplete="off" required></td>
      <td>
        <select data-init-plugin="select2" class="form-control" name="jenis_diskon" id="jenis_diskon_edit" required>
          <option selected value="">pilih</option>
          <option {{ $data->jenis_diskon == 1 ? 'selected' : '' }} value="1">Harga Presentase</option>
          <option {{ $data->jenis_diskon == 2 ? 'selected' : '' }} value="2">Barang</option>
          <option {{ $data->jenis_diskon == 3 ? 'selected' : '' }} value="3">Harga Nominal</option>
        </select>
      </td>
      <td><input type="text" class="form-control" {{ $data->jenis_diskon == null ? 'disabled' : '' }} name="diskon" value="{{ $data->diskon }}" id="diskon_edit" placeholder="Diskon" autocomplete="off" required></td>
    </tr>
  </tbody>
</table>
<script>
  $('#barang_id_edit').on('change', function() {
    let val = $(this).find(':selected').data('satuan');
    $('#satuan_barang_edit').val(val)
  })
  $('#jenis_diskon_edit').on('change', function() {
    let val = $(this).val();
    if (val != '') {
      $('#diskon_edit').attr('disabled', false);
    } else {
      $('#diskon_edit').val('');
      $('#diskon_edit').attr('disabled', true);
    }
  })
</script>
