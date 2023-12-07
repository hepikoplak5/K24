<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>K24 Test Herrys A.R.</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('NiceAdmin/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  @include('layouts.header')
  @include('layouts.sidebar')
  @yield('content')
  @include('layouts.footer')

  <div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form action="/delete-profile" method="post">
          @csrf
              <div class="modal-content">
                  <div class="modal-body">
                  <div class="modal-title mb-3"><strong>Apakah anda yakin?</strong></div>
                  <p id="confirmation_delete"></p>
                  <input id="delete_profile" class="form-control" type="" name="id" hidden>
                  </div>
                  <div class="modal-footer">
                  <a href="" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</a>
                  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                  </div>
              </div>
              
          </form>
      
      </div>
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('NiceAdmin/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>

  <script>
    $(document).ready(function() {
    $('#example').DataTable({
        ajax: {
          url:"{{ route('DTuser') }}",
          dataSrc:""
        },
        columns : [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "noktp" },
            { "data": "nohp" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<a href="/profile/'+ data.id +'"><button class="delete-button btn btn-outline-warning">Edit</button></a> <a class="ml-1 btnid delete-button btn btn-outline-danger" onclick="myFunction(this)" data-id="'+ data.id +'" data-name="'+ data.name +'" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-small">Delete</a>';
                }
            }
        ]
    });
});
</script>
<script>
    function myFunction(element) {
        var dataId = element.getAttribute('data-id');
        var dataname = element.getAttribute('data-name');
        $("#modal-small #delete_profile").val( dataId );
        $("#modal-small #confirmation_delete").text( 'Apakah anda yakin untuk menghapus '+dataname+' ?' );
    }
</script>

</body>

</html>