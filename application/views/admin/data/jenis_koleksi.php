 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Data | Jenis koleksi</h1>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Data</a></li>
                         <li class="breadcrumb-item active">Jenis koleksi</li>
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
                             <h3 class="card-title">Data Jenis koleksi</h3>
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
                                         <th>Jenis koleksi</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <form action="<?= base_url('data/Jenis_koleksi/tambah') ?>" method="post">
                                             <td>#</td>
                                             <td><input type="text" class="form-control" name="nama_jenis" placeholder="masukan jenis.."></td>
                                             <td> <button type="submit" class=" btn btn-success ">Tambah Jenis Koleksi</button></td>
                                         </form>
                                     </tr>
                                     <?php $i = 1; ?>
                                     <?php foreach ($jenis_koleksi as $lp) : ?>
                                         <tr>
                                             <form action="<?= base_url('data/Jenis_koleksi/ubah/' . $lp['id_jenis']) ?>" method="post">
                                                 <td><?= $i++; ?></td>
                                                 <td>
                                                     <input type="text" class="form-control" name="nama_jenis" value="<?= $lp['nama_jenis'] ?>">
                                                 </td>
                                                 <td>
                                                     <button type="submit" class="btn btn-info">Edit</button>
                                                     <a href="<?= base_url('data/Jenis_koleksi/hapus/' . $lp['id_jenis']) ?>" class="btn btn-danger">Hapus</a>
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