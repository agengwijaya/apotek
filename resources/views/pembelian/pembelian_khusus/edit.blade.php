<table class="table table-bordered" style="width: 100%">
  <thead>
    <tr style="background:#ddd">
      <th class="text-center" style="width: 20%">Nama Barang</th>
      <th class="text-center" style="width: 10%">Satuan</th>
      <th class="text-center" style="width: 15%">Harga</th>
      <th class="text-center" style="width: 15%">Qty</th>
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
      <td><input type="text" class="form-control" name="harga" onkeyup="input_rupiah('harga_edit')" value="{{ number_format($data->harga, 0, ',', '.') }}" id="harga_edit" placeholder="Harga" autocomplete="off" required></td>
      <td><input type="text" class="form-control" name="qty" value="{{ $data->qty }}" id="qty" placeholder="Qty" autocomplete="off" required></td>
      <input type="hidden" value="{{ $data->transaksi_pembelian->id }}" name="transaksi_pembelian_id">
    </tr>
  </tbody>
</table>
<script>
  $('#barang_id_edit').on('change', function() {
    let val = $(this).find(':selected').data('satuan');
    $('#satuan_barang_edit').val(val)
  })
</script>
