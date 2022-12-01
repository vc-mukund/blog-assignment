<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="/admin/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<title>Laravel-Assignment</title>

	<link href="/admin/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
        @include('backend.admin.include.sidebar')
        <div class="main">
            @include('backend.admin.include.header')
            @yield('main-content')
            @include('backend.admin.include.footer')
        </div>
    </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="/admin/js/blog.js"></script>
	{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
	<script src="/admin/js/app.js"></script>
	<script src="/admin/js/bar-chart"></script>
	<script src="/admin/js/date"></script>
	<script src="/admin/js/map"></script>
	<script src="/admin/js/script"></script>

	<script src="/admin/js/jquery.dataTables.min.js"></script>
    <script src="/admin/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/js/datatable-basic.min.js"></script>
    


</body>

</html>