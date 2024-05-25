<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta name="description" content="APOTEK">
  <title> {{ !empty($title) ? $title . ' || ' : '' }}APOTEK</title>
  <link rel="icon" type="image/x-icon" href="{{ url('img/profile-photos/logo-agro.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/bootstrap.min.75a07e3a3100a6fed983b15ad1b297c127a8c2335854b0efc3363731475cbed6.css') }}">
  <link rel="stylesheet" href="{{ url('css/nifty.min.4d1ebee0c2ac4ed3c2df72b5178fb60181cfff43375388fee0f4af67ecf44050.css') }}">
  <link rel="stylesheet" href="{{ url('pages/wizard.2cb8d46f6d2ff6a321a0677cca0af2e3f1ee4cfdeda0935dd19bf9de8a0934f0.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ url('js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style type="text/css">
    .table {
      color: #000;
    }

    .nav-tabs .nav-link {
      background-color: #25476a;
    }

    .nav:not(.nav-pills) .nav-link.active {
      color: white;
      font-weight: 700;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
      color: green;
      background-color: green;
    }

    .nav-tabs .nav-link {
      background-color: #eee;
    }

    .nav-link {
      color: green;
      font-weight: 400;
    }

    .table tr:nth-child(even) {
      background-color: rgba(0, 128, 0, 0.089);
    }

    .table tr:hover {
      background-color: rgba(0, 128, 0, 0.288);
    }

    .table td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    .table th {
      border: 1px solid rgb(243, 242, 242);
      padding: 8px;
    }

    .table-1 tr:nth-child(even) {
      background-color: rgb(255, 255, 255);
    }

    .table-1 tr:hover {
      background-color: rgb(255, 255, 255);
    }

    .table-1 td {
      border: 1px solid transparent;
      padding: 8px;
    }

    .table-1 th {
      border: 1px solid transparent;
      padding: 8px;
    }

    .select2-selection__rendered {
      line-height: 35px !important;
    }

    .select2-container .select2-selection--single {
      height: 37px !important;
      border-radius: .4375rem;
    }

    .select2-container--default .select2-selection--single {
      border: 1px solid rgba(0, 0, 0, .07);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #75868f;
      line-height: 28px;
    }

    .select2-container--default .select2-selection--multiple {
      background-color: white;
      border: 1px solid rgba(0, 0, 0, .07);
      border-radius: 4px;
      cursor: text;
      padding-bottom: 0 !important;
      padding-right: 0 !important;
    }

    #grupp .select2-selection__rendered {
      line-height: 10px !important;
    }

    .select2-selection__arrow {
      height: 34px !important;
    }

    .select2-results__option--highlighted {
      color: white !important;
      background-color: #878b90 !important;
    }

    .dataTables_wrapper .dataTables_filter input {
      max-width: 100px;
    }

    .dataTables_wrapper .dataTables_filter {
      margin-bottom: 10px;
    }

    .lb-data .lb-close {
      display: block;
      position: absolute;
      right: 50px;
      top: 5px;
      /*float: right;*/
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>

<body class="jumping">
  <div id="root" class="root mn--max hd--expanded mn--sticky hd--sticky">
    <section id="content" class="content">

      @yield('content')

      <!-- FOOTER -->
      <footer class="content__boxed mt-auto">
        <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
          <nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto" style="row-gap: 0 !important;">
            {{-- <a class="nav-link px-0" href="#">Policy Privacy</a>
            <a class="nav-link px-0" href="#">Terms and conditions</a>
            <a class="nav-link px-0" href="#">Contact Us</a> --}}
          </nav>
        </div>
      </footer>
      <!-- END - FOOTER -->
    </section>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - CONTENTS -->
    <!-- HEADER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <header class="header">
      <div class="header__inner" style="height: 80px; margin-top: 0px">
        <!-- Brand -->
        <div class="header__brand bg-white rounded" style="height: 80px;">
          <div class="brand-wrap" style="right: 10px">

            <div class="brand-title">
              <span class="text-dark">APOTEK</span>
            </div>
          </div>
        </div>
        <div class="header__content">
          <div class="header__content-start">
            <div class="bg-white p-2 rounded d-md-none d-lg-none d-xl-none">
              <span class="text-dark">APOTEK</span>
            </div>
            <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
              <i class="demo-psi-view-list"></i>
            </button>

          </div>
        </div>
      </div>
    </header>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - HEADER -->
    <!-- MAIN NAVIGATION -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <nav id="mainnav-container" class="mainnav" style="background-color: green">
      <div class="mainnav__inner rounded" style="margin-top: 10px">
        <div class="mainnav__top-content scrollable-content pb-5">
          <div class="mainnav__profile mt-3 d-flex3">
            <div class="mt-2 d-mn-max"></div>
            <div class="mininav-toggle text-center py-2">
              <a href="{{ url('data-master-user/profil', auth()->user()->id) }}"><img class="mainnav__avatar img-md rounded-circle border" src="{{ url('img/profile-photos/1.png') }}" alt="Profile Picture"></a>
            </div>
            <div class="mininav-content collapse d-mn-max">
              <div class="d-grid">
                <!-- User name and position -->
                <button class="d-block btn shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                  <span class="d-flex justify-content-center align-items-center">
                    <h6 class="mb-0 me-3">
                      @auth
                        {{ auth()->user()->name }}
                      @endauth
                    </h6>
                  </span>
                  <small class="text-muted">
                    @auth
                      {{ Auth::user()->getRoleNames()[0] }}
                    @endauth
                  </small>
                </button>
              </div>
            </div>
          </div>

          @include('layouts.menu')

        </div>
    </nav>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - MAIN NAVIGATION -->
    <!-- SIDEBAR -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <aside class="sidebar">
      <div class="sidebar__inner scrollable-content">
        <!-- This element is only visible when sidebar Stick mode is active. -->
        <div class="sidebar__stuck align-item-center mb-3 px-4">
          <p class="m-0 text-danger">Close the sidebar =></p>
          <button type="button" class="sidebar-toggler btn-close btn-lg rounded-circle ms-auto" aria-label="Close"></button>
        </div>
        <!-- Sidebar tabs nav -->
        <div class="sidebar__wrap">
          <nav class="px-3">
            <div class="nav nav-callout nav-fill flex-nowrap" id="nav-tab" role="tablist">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-chat" type="button" role="tab" aria-controls="nav-chat" aria-selected="true">
                <i class="d-block demo-pli-speech-bubble-5 fs-3 mb-2"></i>
                <span>Chat</span>
              </button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-reports" type="button" role="tab" aria-controls="nav-reports" aria-selected="false">
                <i class="d-block demo-pli-information fs-3 mb-2"></i>
                <span>Reports</span>
              </button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings" aria-selected="false">
                <i class="d-block demo-pli-wrench fs-3 mb-2"></i>
                <span>Settings</span>
              </button>
            </div>
          </nav>
        </div>
        <!-- End - Sidebar tabs nav -->
        <!-- Sideabar tabs content -->
        <!-- End - Sidebar tabs content -->
      </div>
    </aside>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SIDEBAR -->
  </div>
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!-- END - PAGE CONTAINER -->
  <!-- SCROLL TO TOP BUTTON -->
  <div class="scroll-container">
    <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
  </div>
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!-- END - SCROLL TO TOP BUTTON -->
  <!-- BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div id="_dm-boxedBgContent" class="_dm-boxbg offcanvas offcanvas-bottom" data-bs-backdrop="false" data-bs-scroll="true" tabindex="-1">
    <div class="offcanvas-body p-4">
      <!-- Content Header -->
      <div class="offcanvas-header border-bottom p-0 pb-3">
        <div>
          <h4 class="offcanvas-title">Background Images</h4>
          <span class="text-muted">Add an image to replace the solid background color</span>
        </div>
        <button type="button" class="btn-close btn-lg text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <!-- End - Content header -->
      <!-- Collection Of Images -->
      <!-- End - Collection Of Images -->
    </div>
  </div>
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!-- END - BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->
  <!-- OFFCANVAS [ DEMO ] -->
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div id="_dm-offcanvas" class="offcanvas" tabindex="-1">
    <!-- Offcanvas header -->
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Offcanvas Header</h5>
      <button type="button" class="btn-close btn-lg text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- Offcanvas content -->
    <div class="offcanvas-body">
      <h5>Content Here</h5>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente eos nihil earum aliquam quod in dolor, aspernatur obcaecati et at. Dicta, ipsum aut, fugit nam dolore porro non est totam sapiente animi recusandae obcaecati dolorum, rem ullam cumque. Illum quidem reiciendis autem neque excepturi odit est accusantium, facilis provident molestias, dicta obcaecati itaque ducimus fuga iure in distinctio voluptate nesciunt dignissimos rem error a. Expedita officiis nam dolore dolores ea. Soluta repellendus delectus culpa quo. Ea tenetur impedit error quod exercitationem ut ad provident quisquam omnis! Nostrum quasi ex delectus vero, facilis aut recusandae deleniti beatae. Qui velit commodi inventore.</p>
    </div>
  </div>
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!-- END - OFFCANVAS [ DEMO ] -->
  <!-- JAVASCRIPTS -->
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!-- Bootstrap JS [ OPTIONAL ] -->

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

  @include('utils.alert')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="{{ url('js/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('js/bootstrap.min.bdf649e4bf3fa0261445f7c2ed3517c3f300c9bb44cb991c504bdc130a6ead19.js') }}" defer></script>
  <!-- Nifty JS [ OPTIONAL ] -->
  <script src="{{ url('js/nifty.min.b53472f123acc27ffd0c586e4ca3dc5d83c0670a3a5e120f766f88a92240f57b.js') }}" defer></script>
  {{-- <script src="{{ url('pages/wizard.min.8cfbf91140b2349da94fe3dcf0df6eb37ec3eaa598a2e740c5e69891b4836769.js') }}" defer></script> --}}
  <!-- Plugin scripts [ OPTIONAL ] -->
  {{-- <script src="{{ url('pages/dashboard-1.min.07239cfbfa13a684f5c4668d5282cf217c7793bc57557b4ec22c36740ffb5bf1.js') }}" defer></script> --}}
  {{-- <script src="{{ url('pages/chartjs.min.64aae01d4d2f34e7f5dc081951b13078149824ef7a444e06c2fa6f405e39825c.js') }}" defer></script> --}}

  @if (!empty(Session::get('success')) || !empty(Session::get('error')) || !empty(Session::get('warning')))
    <script>
      $(function() {
        const toast_id = $('#toast');
        const toast = new bootstrap.Toast(toast_id);
        toast.show();
      })
    </script>
  @endif

  <script>
    $(function() {
      $('[data-init-plugin="select2"]').select2({
        width: '100%',
      });

      // SETTING POPUP IMAGE
      lightbox.option({
        resizeDuration: 200,
        wrapAround: true
      })

      // FIX DROPDOWN IN DATATABLES
      let parents = [];
      let menus = [];

      // REMOVE BTN FILE IN TRIX EDITOR
      $(".trix-button-group--file-tools").remove();

      $(window).on('show.bs.dropdown', function(e) {

        let target = $(e.target);

        // save the parent
        parents.push(target.parent());

        // grab the menu
        let dropdownMenu = target.next();

        // save the menu
        menus.push(dropdownMenu);

        // detach it and append it to the body
        $('body').append(dropdownMenu.detach());

        // grab the new offset position
        let eOffset = target.offset();

        // make sure to place it where it would normally go (this could be improved)
        dropdownMenu.css({
          'display': 'block',
          'top': eOffset.top + target.outerHeight(),
          'left': eOffset.left
        });
      });

      // and when you hide it, reattach the drop down, and hide it normally
      $(window).on('hide.bs.dropdown', function(e) {

        menus.forEach(function(element, index) {
          let parent = parents[index];
          let dropdownMenu = element;

          parent.append(dropdownMenu.detach());
          dropdownMenu.hide();

          menus.splice(index, 1);
          parents.splice(index, 1);
        })
      });
    });

    function input_rupiah(id_html) {
      var tanpa_rupiah = document.getElementById(id_html);
      tanpa_rupiah.addEventListener('keyup', function(e) {
        tanpa_rupiah.value = format_rupiah(this.value);
      });
    }

    function format_rupiah(angka, prefix) {
      let string_angka = angka.toString();
      var number_string = string_angka.replace(/[^,\d]/g, '').toString(),
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

    function hanyaAngka(event) {
      let angka = (event.which) ? event.which : event.keyCode
      if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
        return false;
      return true;
    }

    const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
        // style: "currency",
        currency: "IDR",
        minimumFractionDigits: 2
      }).format(number);
    }

    function number_format_float(number) {
      let split = number.toString().split('.');
      if (split.length > 1) {
        return number_format(number.toFixed(0)) + ',' + split[1];
      } else {
        return number_format(number.toFixed(0));
      }
    }

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

    function number_format_coma(number, type = 1) {
      if (type == 1) {
        // dibelakang koma dibatasi 2 angka
        const parts = number.toFixed(2).split(".");
        const decimal = parts[1];
        let thousands = parts[0];

        thousands = thousands.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        const formattedNumber = thousands + "," + decimal;

        return formattedNumber;
      } else if (type = 2) {
        // dibelakang koma tidak dibatasi
        let decimalDigits = 0;
        if (Number.isInteger(number)) {
          // Jika angka tidak memiliki desimal
          decimalDigits = 0;
        } else {
          // Jika angka memiliki desimal
          decimalDigits = number.toString().split(".")[1].length;
        }

        const formattedNumber = number.toLocaleString("id-ID", {
          minimumFractionDigits: decimalDigits,
          maximumFractionDigits: decimalDigits
        });

        return formattedNumber;
      }
    }

    function date_convert(datetime) {
      if (datetime == null) return '-';
      let created_on = datetime.split(' ')
      let date = new Date(created_on[0]).toString().split(' ')
      return date[2] + ' ' + date[1] + ' ' + date[3];
    }
  </script>
</body>
<!-- Mirrored from themeon.net/nifty/v3.0.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Aug 2022 13:36:55 GMT -->

</html>
