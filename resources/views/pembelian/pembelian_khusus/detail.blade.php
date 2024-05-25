<table style="width: 80%">
  <tbody>
    <tr style="background:#ddd">
      <th class="text-center" style="width: 10%">No</th>
      <th class="text-center" style="width: 20%">Nama Barang</th>
      <th class="text-center" style="width: 10%">Satuan</th>
      @can('pembelian.pembelian-khusus.harga')
        <th class="text-center" style="width: 15%">Harga</th>
      @endcan
      <th class="text-center" style="width: 15%">Qty</th>
      @can('pembelian.pembelian-khusus.harga')
        <th class="text-center" style="width: 15%">Nominal</th>
        <th class="text-center" style="width: 15%">Nominal PPN</th>
        <th class="text-center" style="width: 15%">Nominal PPH</th>
        <th class="text-center" style="width: 15%">Nominal Total</th>
      @endcan
    </tr>
    @foreach ($data as $item)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $item->barang->nama }}</td>
        <td>{{ $item->barang->t_satuan_barang->nama }}</td>
        @can('pembelian.pembelian-khusus.harga')
          <td>
            <div class="d-flex justify-content-between">
              <div class="col text-start">Rp</div>
              <div class="col text-end">{{ number_format($item->harga, 2, ',', '.') }}</div>
            </div>
          </td>
        @endcan
        <td class="text-end">{{ number_format($item->qty, 0, ',', '.') }}</td>
        @can('pembelian.pembelian-khusus.harga')
          <td class="text-end">
            <div class="d-flex justify-content-between gap-2">
              <div class="col text-start">Rp</div>
              <div class="col text-end">{{ number_format($item->qty * $item->harga, 2, ',', '.') }}</div>
            </div>
          </td>
          <td class="text-end">
            <div class="d-flex justify-content-between gap-2">
              <div class="col text-start">Rp</div>
              <div class="col text-end">{{ number_format(($item->qty * $item->harga * $item->transaksi_pembelian->nilai_ppn) / 100, 2, ',', '.') }}</div>
            </div>
          </td>
          <td class="text-end">
            <div class="d-flex justify-content-between gap-2">
              <div class="col text-start">Rp</div>
              <div class="col text-end">{{ number_format(($item->qty * $item->harga * $item->transaksi_pembelian->nilai_pph) / 100, 2, ',', '.') }}</div>
            </div>
          </td>
          <td class="text-end">
            <div class="d-flex justify-content-between gap-2">
              <div class="col text-start">Rp</div>
              <div class="col text-end">{{ number_format($item->qty * $item->harga + ($item->qty * $item->harga * $item->transaksi_pembelian->nilai_ppn) / 100 + ($item->qty * $item->harga * $item->transaksi_pembelian->nilai_pph) / 100, 2, ',', '.') }}</div>
            </div>
          </td>
        @endcan
      </tr>
    @endforeach
  </tbody>
</table>
