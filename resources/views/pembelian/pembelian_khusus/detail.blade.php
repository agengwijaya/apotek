<table style="width: 80%">
  <tbody>
    <tr style="background:#ddd">
      <th class="text-center" style="width: 10%">No</th>
      <th class="text-center" style="width: 20%">Nama Obat</th>
      <th class="text-center" style="width: 15%">Harga</th>
      <th class="text-center" style="width: 15%">Qty</th>
    </tr>
    @foreach ($data as $item)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $item->barang->NmObat }}</td>
        <td>
          <div class="d-flex justify-content-between">
            <div class="col text-start">Rp</div>
            <div class="col text-end">{{ number_format($item->barang->HargaBeli, 2, ',', '.') }}</div>
          </div>
        </td>
        <td class="text-end">{{ number_format($item->Jumlah, 0, ',', '.') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
