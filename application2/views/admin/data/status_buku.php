 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Data | Status Buku</h1>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Data</a></li>
                         <li class="breadcrumb-item active">Status Buku</li>
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
                             <h3 class="card-title">Data Status Buku</h3>

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
                                         <th>Status Buku</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <form action="<?= base_url('data/Status_buku/tambah') ?>" method="post">
                                             <td>#</td>
                                             <td><input type="text" class="form-control" name="nama_status" placeholder="masukan Status Buku.."></td>
                                             <td> <button type="submit" class=" btn btn-success ">Tambah status buku</button></td>
                                         </form>
                                     </tr>
                                     <?php $i = 1; ?>
                                     <?php foreach ($data_status_buku as $lp) : ?>
                                         <tr>
                                             <form action="<?= base_url('data/Status_buku/ubah/' . $lp['id_status']) ?>" method="post">
                                                 <td><?= $i++; ?></td>
                                                 <td>
                                                     <input type="text" class="form-control" name="nama_status" value=" <?= $lp['nama_status'] ?>">
                                                 </td>
                                                 <td>
                                                     <?php if ($lp['id_status'] != 1 && $lp['id_status'] != 2) : ?>
                                                         <button type="submit" class="btn btn-info">Edit</button>
                                                         <a href="<?= base_url('data/Status_buku/hapus/' . $lp['id_status']) ?>" class="btn btn-danger">Hapus</a>
                                                     <?php endif; ?>
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