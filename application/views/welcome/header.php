<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- My Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">

  <!-- My CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css") ?> ">
  <!-- Ionicons -->

  <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">

  <title>Siperpus</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">Siperpus FH UB</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link active" href="<?= base_url('welcome') ?>">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="<?= base_url('welcome/books') ?>">Books</a>
          <a class="nav-item nav-link" href="#">About</a>
          <a class="nav-item btn btn-primary tombol_b" href="<?= base_url('auth') ?>">Log in</a>
        </div>

      </div>
    </div>
  </nav>
  <!-- akhir navbar -->