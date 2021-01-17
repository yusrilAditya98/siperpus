 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Data | Kop Surat</h1>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Data</a></li>
                         <li class="breadcrumb-item active">Kop Surat</li>
                     </ol>
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <?php if ($this->session->flashdata('success')) : ?>
         <input type="hidden" class="toasterSuccess" value="<?= $this->session->flashdata('success')  ?>">
     <?php else : ?>
         <input type="hidden" class="toasterDanger" value="<?= $this->session->flashdata('danger')  ?>">
     <?php endif; ?>
     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">

             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Data Kop Surat</h3>

                             <div class="card-tools">
                                 <div class="input-group input-group-sm" style="width: 150px;">
                                     <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                     <div class="input-group-append">
                                         <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-sm-12">

                                 </div>
                             </div>
                             <table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Kop Surat</th>
                                         <th style="width:30%;">Image File</th>
                                         <th style="width:15%;">Status</th>
                                         <th style="width:10%;">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <form action="<?= base_url('data/Kop_surat/tambah') ?>" method="post" enctype="multipart/form-data">
                                             <td>#</td>
                                             <td><input type="text" class="form-control" name="nama_kop" placeholder="masukan nama kop_surat.."></td>
                                             <td>
                                                 <input type="file" class="form-control" name="nama_file">
                                                 <small>*format gambar berupa .jpg dengan ukuran maksimal 1MB</small>
                                             </td>
                                             <td>
                                                 <select class="form-control" name="status">
                                                     <option>Pilih Jenis Status</option>
                                                     <option value="1">di Pakai</option>
                                                     <option value="2">Tidak di Pakai</option>
                                                 </select>
                                             </td>
                                             <td> <button type="submit" class=" btn btn-success ">Tambah kop_surat</button></td>
                                         </form>
                                     </tr>
                                     <?php $i = 1; ?>
                                     <?php foreach ($data_kop_surat as $lp) : ?>
                                         <tr>
                                             <form action="<?= base_url('data/Kop_surat/ubah/' . $lp['id']) ?>" method="post" enctype="multipart/form-data">
                                                 <td><?= $i++; ?></td>
                                                 <td><input type="text" class="form-control" name="nama_kop" value="<?= $lp['nama_kop'] ?>"></td>
                                                 <td>
                                                     <div class="row">
                                                         <div class="col-lg-12">
                                                             <a href="<?= base_url('assets/img/kopSurat/' . $lp['nama_file']) ?>" target="_blank">
                                                                 <img src="<?= base_url('assets/img/kopSurat/' . $lp['nama_file']) ?>" class="img-thumbnail img-preview">
                                                             </a>
                                                             <input type="hidden" class="form-control" name="old_nama_file" value="<?= $lp['nama_file'] ?>">
                                                         </div>
                                                         <div class="col-lg-12">
                                                             <input type="file" class="form-control" name="nama_file">
                                                             <small>*format gambar berupa .jpg dengan ukuran maksimal 1MB</small>
                                                         </div>
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <select class="form-control" name="status">
                                                         <?php if ($lp['status'] == 1) : ?>
                                                             <option value="1">di Pakai</option>
                                                             <option value="2">Tidak di Pakai</option>
                                                         <?php else : ?>
                                                             <option value="2">Tidak di Pakai</option>
                                                             <option value="1">di Pakai</option>
                                                         <?php endif; ?>
                                                     </select>
                                                 </td>
                                                 <td>
                                                     <button type="submit" class="btn btn-info">Edit</button>
                                                     <a href="<?= base_url('data/Kop_surat/hapus/' . $lp['id']) ?>" class="btn btn-danger">Hapus</a>
                                                 </td>
                                             </form>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>
             </div>
             <!-- /.row -->


         </div>
         <!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>