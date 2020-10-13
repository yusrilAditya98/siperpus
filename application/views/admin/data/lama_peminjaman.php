 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Data | Lama Peminjaman</h1>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Data</a></li>
                         <li class="breadcrumb-item active">Lama Peminjaman</li>
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
                             <h3 class="card-title">Data Lama Peminjaman</h3>

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
                                         <th>Lama Peminjaman</th>
                                         <th>Status</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <form action="<?= base_url('data/lama_peminjaman/tambah') ?>" method="post">
                                             <td>#</td>
                                             <td><input type="text" required class="form-control" name="durasi_peminjaman" placeholder="masukan Lama Peminjaman.."></td>
                                             <td>
                                                 <select class="form-control" required name="status_peminjaman">
                                                     <option>Pilih</option>
                                                     <option value="1">Pakai</option>
                                                     <option value="2">Tidak Di Pakai</option>
                                                 </select>
                                             </td>
                                             <td> <button type="submit" class=" btn btn-success ">Tambah Lama Peminjaman</button></td>
                                         </form>
                                     </tr>
                                     <?php $i = 1; ?>
                                     <?php foreach ($data_lama_peminjaman as $lp) : ?>
                                         <tr>
                                             <form action="<?= base_url('data/lama_peminjaman/ubah/' . $lp['id_lama_peminjaman']) ?>" method="post">
                                                 <td><?= $i++; ?></td>
                                                 <td>
                                                     <input type="text" class="form-control" name="durasi_peminjaman" value=" <?= $lp['durasi_peminjaman'] ?>">
                                                 </td>
                                                 <td>
                                                     <select class="form-control" name="status_peminjaman">
                                                         <?php if ($lp['status_peminjaman'] == 2) { ?>
                                                             <option value="2">Tidak Di Pakai</option>
                                                             <option value="1">Pakai</option>
                                                         <?php } else { ?>
                                                             <option value="1">Pakai</option>
                                                             <option value="2">Tidak Di Pakai</option>
                                                         <?php } ?>
                                                     </select>
                                                 </td>
                                                 <td>
                                                     <button type="submit" class="btn btn-info">Edit</button>
                                                     <a href="<?= base_url('data/lama_peminjaman/hapus/' . $lp['id_lama_peminjaman']) ?>" class="btn btn-danger">Hapus</a>
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