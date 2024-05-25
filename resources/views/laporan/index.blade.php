@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Transaksi Pembelian</a></li>
            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
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
                  <h5 class="card-title">Data Stok Barang</h5>
                  <div class="row">
                    <div class="col-md-2 mb-2">
                      <div class="form-group">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ date('Y-m-01') }}">
                      </div>
                    </div>
                    <div class="col-md-2 mb-2">
                      <div class="form-group">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ date('Y-m-d') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table id="transaksi" class="nowrap table table-bordered display" style="width: 100%; color: black">
                        <thead style="background-color: #ddd;">
                          <tr>
                            <th class="text-center" style="width: 10px">
                              No
                            </th>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
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

  <script>
    $(function() {
      let table = $('#transaksi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('laporan/list') }}",
          type: 'GET',
          data: function(d) {
            d.from = $('#start_date').val();
            d.to = $('#end_date').val();
          },
        },
        order: [
          [1, 'desc']
        ],
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
            data: 'nama',
            name: 'nama',
            className: 'text-center'
          },
          {
            data: function(item) {
              return number_format(item.stok);
            },
            name: 'stok',
            className: 'text-end'
          },
          {
            data: 'action',
            name: 'action',
            className: 'text-center',
            orderable: false,
            searchable: false
          },
        ],
        scrollX: true
      });

      $('#start_date, #end_date').on('change', function() {
        let from = $("#start_date").val();
        let to = $("#end_date").val();
        console.log(from);
        console.log(to);
        if (from && to) {
          table.draw();
        }
      });

      let detailRows = [];

      $('#transaksi tbody').on('click', 'tr button.details-control', function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let idx = detailRows.indexOf(tr.attr('id'));

        if (row.child.isShown()) {
          tr.removeClass('details');
          row.child.hide();

          detailRows.splice(idx, 1);
        } else {
          tr.addClass('details');
          row.child(format(row.data())).show();

          if (idx === -1) {
            detailRows.push(tr.attr('id'));
          }
        }
      });
    })

    function format(data) {
      let all = data.stoks;
      let html = '';
      let no = 1;
      let total = 0;
      let total_array = [];
      all.forEach(function(element, index) {
        let bg_color = '';
        let text = '';
        if (element.jenis == 1) {
          bg_color = 'bg-success';
          text = 'Masuk';
        } else if (element.jenis == 2) {
          bg_color = 'bg-info';
          text = 'Keluar (FIFO)';
        } else if (element.jenis == 3) {
          bg_color = 'bg-warning';
          text = 'Keluar (LIFO)';
        }

        html += `
            <tr>
              <td class="text-center">${no++}</td>
              <td>${date_convert(element.tanggal_transaksi)}</td>
              <td class="text-end">${number_format(element.stok_awal)}</td>
              <td class="text-end">${number_format(element.masuk)}</td>
              <td class="text-end">${number_format(element.keluar)}</td>
              <td class="text-end">${number_format(element.stok_akhir)}</td>
              <td class="text-center"><div class="badge ${bg_color} p-2 rounded">${text}</div></td>
            </tr>`
      });

      return (`
        <table style="width: 50%;">
          <thead>
            <tr style="background: #ddd;">
              <th class="text-center">Id</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Stok Awal</th>
              <th class="text-center">Masuk</th>
              <th class="text-center">Keluar</th>
              <th class="text-center">Stok Akhir</th>
              <th class="text-center">Status</th>
            </tr>
            ${html}
          </thead>
        </table>
      `);
    };



    function number_format(angka, prefix) {
      let number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function date_convert(datetime) {
      let created_on = datetime.split(' ')
      let date = new Date(created_on[0]).toString().split(' ')
      return date[2] + ' ' + date[1] + ' ' + date[3];
    }
  </script>
@endsection
