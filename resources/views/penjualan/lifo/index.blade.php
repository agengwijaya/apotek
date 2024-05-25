@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item"><a href="#">Barang Keluar (LIFO)</a></li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <div class="content__boxed">
    <div class="content__wrap">
      <div class="row">
        @can('lifo.simpan')
          <div class="col-md-12">
            <div class="card h-100">
              <div class="card-body">
                @if ($mode_edit)
                  <a href="{{ url('lifo') }}" class="btn btn-warning btn-sm mb-3"><i class="fa fa-arrow-left me-2"></i>Kembali</a>
                @endif
                <h5 class="card-title">Formulir Barang Keluar (LIFO)</h5>
                <div class="row">
                  <div class="col-md-4">
                    <div class="card border-1 border-primary">
                      <div class="card-body">
                        <form action="{{ url('lifo') }}" method="POST" id="form_penjualan_khusus">
                          @csrf
                          <div class="row">
                            <div class="col-12 col-md-6 mb-2">
                              <label for="kode" class="form-label">Kode Transaksi</label>
                              <input id="kode" name="kode" type="text" value="{{ $code }}" readonly class="form-control">
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                              <label for="tanggal_transaksi" class="form-label">Tanggal
                                Transaksi</label>
                              <input name="tanggal_transaksi" id="tanggal_transaksi" type="date" value="{{ $tanggal_transaksi }}" class="form-control">
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                              <div class="form-group">
                                <label class="form-label" for="customer_id">Customer</label>
                                <select class="form-control" name="customer_id" id="customer_id" required data-init-plugin="select2">
                                  <option selected disabled value="">pilih</option>
                                  @foreach ($customer as $item)
                                    <option {{ $customer_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}"> {{ $item->nama }}</option>
                                  @endforeach
                                  <option value="tambah_customer">Tambah Customer ...</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8 mt-3 mt-md-0">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="detail_table" style="width: 100%">
                            <thead>
                              <tr style="background:#ddd">
                                <th class="text-center" style="min-width: 40px; max-width: 40px;">No</th>
                                <th class="text-center" style="min-width: 200px; max-width: 200px;">Barang</th>
                                <th class="text-center" style="min-width: 100px; max-width: 100px;">Satuan</th>
                                <th class="text-center" style="min-width: 100px; max-width: 100px;">Stok</th>
                                <th class="text-center" style="min-width: 80px; max-width: 80px;">Qty</th>
                                <th class="text-center" style="min-width: 100px; max-width: 100px;">Aksi</th>
                              </tr>
                            </thead>
                            <tbody id="table_detail">
                              @foreach ($detail_penjualan_khusus as $item)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->barang->nama }}</td>
                                  <td class="text-center">{{ $item->barang->t_satuan_barang->nama }} ({{ $item->barang->t_satuan_barang->kode_nama }})</td>
                                  <td class="text-end">{{ number_format($item->qty, 0, ',', '.') }}</td>
                                  <td class="text-end">{{ number_format($item->qty, 0, ',', '.') }}</td>
                                  <td class="d-flex gap-1 justify-content-center">
                                    <button type="button" class="btn btn-danger btn-xs" id="btn_delete_detail" data-bs-toggle="modal" onclick="modal_hapus({{ $item->id }}, '')" data-id='{{ $item->id }}' data-bs-target="#modalDeleteConfirm"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-warning btn-xs" id="btn_edit_detail" data-bs-toggle="modal" onclick="modal_edit({{ $item->id }})" data-id='{{ $item->id }}' data-bs-target="#modalEditDetail"><i class="fa fa-pencil"></i></button>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <form id="form-add-detail">
                              @csrf
                              <tr>
                                <td>#</td>
                                <td>
                                  <select data-init-plugin="select2" class="form-control" disabled name="barang_id" id="barang_id" required>
                                    <option selected disabled value="">pilih</option>
                                    @foreach ($barang as $item)
                                      <option data-satuan={{ $item->t_satuan_barang->kode_nama }} data-stok={{ $item->stok }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                    <option value="tambah_barang">Tambah Barang ...</option>
                                  </select>
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="satuan_barang" id="satuan_barang" placeholder="Satuan" autocomplete="off" readonly required>
                                </td>
                                <td><input type="number" class="form-control" name="stok" disabled id="stok" placeholder="Stok" autocomplete="off" required></td>
                                <td><input type="number" class="form-control" name="qty" disabled id="qty" placeholder="Qty" autocomplete="off" required></td>
                                <td>
                                  <button type="button" id="btn_submit_detail" class="btn btn-primary" disabled>Simpan</button>
                                </td>
                              </tr>
                            </form>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-4">
                        @if ($detail_penjualan_khusus->count())
                          <button type="button" id="btn_form_penjualan_khusus" class="btn btn-primary btn-block pull-right"><i class="fa fa-save"></i> {{ $mode_edit == true ? 'Update' : 'Simpan' }} transaksi</button>
                        @else
                          <button type="button" id="btn_form_penjualan_khusus" class="btn btn-primary btn-block pull-right" disabled><i class="fa fa-save"></i> {{ $mode_edit == true ? 'Update' : 'Simpan' }} transaksi</button>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endcan
        <div class="col-md-12">
          <div class="card mt-3">
            <div class="card-body">
              <h5 class="card-title">List Barang Keluar (LIFO)</h5>
              <div class="row">
                <div class="col-md-2 mb-2">
                  <div class="form-group">
                    <label class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" name="start_date" value="{{ date('Y-m-01') }}" id="start_date">
                  </div>
                </div>
                <div class="col-md-2 mb-2">
                  <div class="form-group">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" name="end_date" value="{{ date('Y-m-d') }}" id="end_date">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <table id="transaksi" class="nowrap table display table-bordered" style="width: 100%; color: black;">
                    <thead style="background-color: #ddd;">
                      <tr>
                        <th class="text-center" style="width: 10px">No</th>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Tgl Transaksi</th>
                        <th class="text-center">Customer</th>
                        <th class="text-center">Qty</th>
                        {{-- <th class="text-center">Nominal</th> --}}
                        <th class="text-center">Status</th>
                        <th class="text-center">Petugas</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot style="background-color: #ddd;">
                      <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        {{-- <th class="text-end"></th> --}}
                        <th class="text-end"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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

  @include('utils.modal_customer')
  @include('utils.modal_barang')

  <script>
    function modal_hapus(id, jenis) {
      $('#form_delete').attr('action', "{{ url('lifo/hapus?id=') }}" + id + '&jenis=' + jenis);
    }

    function modal_edit(id) {
      $.ajax({
        url: '{{ url('lifo/edit') }}' + '?id=' + id + '&customer_id=' + $('#customer_id').val(),
        method: "get",
        success: function(res) {
          $("#modal_edit_form").html(res);
        }
      })
      $('#form_edit_detail').attr('action', "{{ url('lifo') }}" + '/' + id);
    }

    $('#customer_id').on('change', function() {
      let val = $(this).val();

      if (val == 'tambah_customer') {
        $('#modalTambahCustomer').modal('show');
        $('#customer_id').val('');
      }
    })

    $('#form_penjualan_khusus :input').on('change', function() {
      if ($('#customer_id').val() == null) {
        $('#btn_submit_detail').attr('disabled', true);
        $('#barang_id').attr('disabled', true);
        $('#qty').attr('disabled', true);
      } else {
        $('#btn_submit_detail').attr('disabled', false);
        $('#barang_id').attr('disabled', false);
        $('#qty').attr('disabled', false);
      }
    });

    $('#barang_id').on('change', function() {
      let val = $(this).val();
      let satuan_barang = $(this).find(':selected').data('satuan');
      let stok = $(this).find(':selected').data('stok');
      $('#satuan_barang').val(satuan_barang);
      $('#stok').val(stok);

      if (val == 'tambah_barang') {
        $('#modalTambahBarang').modal('show');
        $('#barang_id').val('');
      }
    })

    $('#btn_form_penjualan_khusus').on('click', function() {
      for (const el of document.getElementById('form_penjualan_khusus').querySelectorAll("[required]")) {
        if (!el.reportValidity()) {
          return;
        }
      }
      $('#form_penjualan_khusus').submit();
    })

    $('#btn_submit_detail').on('click', function() {
      let qty = $('#qty').val();
      let stok = $('#stok').val();
      
      if (parseFloat(qty) > parseFloat(stok)) {
        alert('Qty yang dimasukkan melebihi stok barang yang ada!');
        return;
      }

      $.ajax({
        type: "POST",
        url: "{{ url('lifo/simpan-detail') }}",
        data: {
          _token: "{{ csrf_token() }}",
          kode: $('#kode').val(),
          tanggal_transaksi: $('#tanggal_transaksi').val(),
          customer_id: $('#customer_id').val(),
          barang_id: $('#barang_id').val(),
          qty: $('#qty').val(),
        },
        success: function(response) {
          if (response.status == true) {
            $.ajax({
              type: "GET",
              url: "{{ url('lifo/get-barang') }}",
              success: function(response) {
                $('#barang_id option').remove();
                let option = new Option(`pilih`, '');
                $('#barang_id').append(option);

                if (response.status == true) {
                  let data = response.data;
                  data.forEach(element => {
                    let option = new Option(`${element.kode} - ${element.nama}`, element.id);
                    option.setAttribute('data-satuan', element.t_satuan_barang.kode_nama);
                    option.setAttribute('data-stok', element.stok);
                    $('#barang_id').append(option);
                  })

                  option = new Option(`Tambah Barang ...`, 'tambah_barang');
                  $('#barang_id').append(option);
                }
              }
            })

            $.ajax({
              type: "GET",
              url: "{{ url('lifo/data-detail') }}",
              data: {
                kode: $('#kode').val()
              },
              success: function(response) {
                $('#table_detail tr').remove();
                $('#barang_id').val('').change();
                $('#jenis_diskon').val('').change();
                $('#form-add-detail').trigger('reset');
                let data = response.data;
                if (data.length) {
                  $('#btn_form_penjualan_khusus').attr('disabled', false);
                } else {
                  $('#btn_form_penjualan_khusus').attr('disabled', true);
                }
                let no = 1;
                let jenis_diskon = '';
                data.forEach(element => {
                  $('#table_detail').append(`
                    <tr>
                        <td>${no++}</td>
                        <td>${element.barang.nama}</td>
                        <td class="text-center">${element.barang.t_satuan_barang.nama} (${element.barang.t_satuan_barang.kode_nama})</td>
                        <td class="text-end">${number_format(element.qty)}</td>
                        <td class="text-end">${number_format(element.qty)}</td>
                        <td class="d-flex gap-1">
                            <button type="button" class="btn btn-danger btn-xs" id="btn_delete_detail" data-bs-toggle="modal" onclick="modal_hapus(${element.id}, '')" data-id='${element.id}' data-bs-target="#modalDeleteConfirm"><i class="fa fa-trash"></i></button>
                            <button type="button" class="btn btn-warning btn-xs" id="btn_edit_detail" data-bs-toggle="modal" onclick="modal_edit(${element.id})" data-id='${element.id}' data-bs-target="#modalEditDetail"><i class="fa fa-pencil"></i></button>
                        </td>
                    </tr>`);
                })
              }
            })
          }
        }
      });
    });
    $(function() {
      if ("{{ $detail_penjualan_khusus->count() }}" != 0) {
        $('#btn_submit_detail').attr('disabled', false);
        $('#barang_id').attr('disabled', false);
        $('#qty').attr('disabled', false);
      } else {
        $('#btn_submit_detail').attr('disabled', true);
        $('#barang_id').attr('disabled', true);
        $('#qty').attr('disabled', true);
      }
      let table = $('#transaksi').DataTable({
        footerCallback: function(row, data, start, end, display) {
          var api = this.api(),
            data;

          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,.]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };

          // var l = api
          //   .column(5)
          //   .data()
          //   .reduce(function(a, b) {
          //     return intVal(a) + intVal(b);
          //   }, 0);
          var k = api
            .column(4)
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          $(api.column(3).footer()).html('Total');
          // $(api.column(5).footer()).html(`
          // <div class="d-flex justify-content-between">
          //       <div class="col text-start">Rp</div>
          //       <div class="col text-end">${number_format(l)}</div>
          // </div> `);
          $(api.column(4).footer()).html(number_format(k));
        },
        order: [
          [1, 'desc']
        ],
        processing: true,
        serverSide: true,

        ajax: {
          url: "{{ url('lifo/data') }}",
          type: 'GET',
          data: function(d) {
            d.from = $('#start_date').val();
            d.to = $('#end_date').val();
            d.edit = "{{ $mode_edit }}";
          }
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            className: 'text-center'
          },
          {
            data: 'kode',
            name: 'kode',
            className: 'text-center'
          },

          {
            data: function(item) {
              return date_convert(item.tanggal_transaksi);
            },
            name: 'tanggal_transaksi',
            className: 'text-center'

          },
          {
            data: 'customer',
            name: 'customer'
          },

          {
            data: 'details_sum_qty',
            className: 'text-end',
            render: function(data, type, row) {
              return number_format(row.details_sum_qty);
            },
          },
          // {
          //   data: function(row) {
          //     return row.details_sum_nominal;
          //   },
          //   className: 'text-end',
          //   render: function(data, type, row) {
          //     return `
          //     <div class="d-flex justify-content-between">
          //       <div class="col text-start">Rp</div>
          //       <div class="col text-end">${number_format(row.details_sum_nominal)}</div>
          //     </div>
          //     `;
          //   },
          // },
          {
            data: 'status',
            name: 'status',
            className: 'text-center'
          },
          {
            data: 'user',
            name: 'user',
          },
          {
            data: 'action',
            name: 'action',
            className: 'text-center',
            orderable: true,
            searchable: true
          },
        ],
        scrollX: true
      });
      $('#start_date, #end_date').on('change', function() {
        let from = $("#start_date").val();
        let to = $("#end_date").val();
        if (from && to) {
          table.draw();
        }
      });
      let detailRows = [];

      $('#transaksi tbody').on('click', 'tr button.details-control', function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let idx = detailRows.indexOf(tr.attr('id'));
        let id = $(this).data('id');

        if (row.child.isShown()) {
          tr.removeClass('details');
          row.child.hide();

          detailRows.splice(idx, 1);
        } else {
          tr.addClass('details');
          row.child(format(id)).show();
          if (idx === -1) {
            detailRows.push(tr.attr('id'));
          }
        }
      });
    })

    function format(id) {
      var value = "<div id='detail" + id + "'></div>";
      $.ajax({
        url: '{{ url('lifo/table-detail') }}',
        data: {
          id: id
        },
        method: "get",
        success: function(res) {
          $("#detail" + id).html(res);
        }
      })
      return value;
    };
  </script>
@endsection
