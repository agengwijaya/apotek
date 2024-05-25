<table style="width: 50%">
  <tbody>
    <tr style="background:#ddd">
      <th class="text-center" style="width: 10%">No</th>
      <th class="text-center" style="width: 20%">Nama Barang</th>
      <th class="text-center" style="width: 10%">Satuan</th>
      {{-- <th class="text-center" style="width: 15%">Harga</th> --}}
      <th class="text-center" style="width: 15%">Qty</th>
      {{-- <th class="text-center" style="width: 15%">Nominal</th> --}}
    </tr>
    @foreach ($data as $item)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $item->barang->nama }}</td>
        <td>{{ $item->barang->t_satuan_barang->nama }}</td>
        {{-- <td>
          <div class="d-flex justify-content-between">
            <div class="col text-start">Rp</div>
            <div class="col text-end">{{ number_format($item->harga, 2, ',', '.') }}</div>
          </div>
        </td> --}}
        <td class="text-end">{{ number_format($item->qty, 0, ',', '.') }}</td>
        {{-- <td class="text-end">
          <div class="d-flex justify-content-between gap-2">
            <div class="col text-start">Rp</div>
            <div class="col text-end">{{ number_format($item->qty * $item->harga, 2, ',', '.') }}</div>
          </div>
        </td> --}}
      </tr>
    @endforeach
  </tbody>
</table>
