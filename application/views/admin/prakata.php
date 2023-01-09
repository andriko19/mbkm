<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- content -->
    <?= $this->session->flashdata('message');?>
    
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPrakata" >
            Tambah <?= $title;?> 
          </button> <br><br>
          <p class="card-title mb-0">Prakata</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul</th>
                  <th>Nama</th>
                  <th style="width: 10px!importan">Prakata</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>  
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($prakata as $data): ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $data['judul']; ?></td>
                  <td><?= $data['nama']; ?></td>
                  <td><?= $data['prakata']; ?></td>
                  <td><img style="height: 60px; width:50px" src="<?= base_url(); ?>assets/backend/images/<?= $data['foto']; ?>"></td>
                  <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#UbahModal<?php echo $data['id_prakata'];?>">
                      <i class="ti-pencil"></i>
                    </button> <br><br>
                    <a href="" onclick="$('#modalHapus #formDelete').attr('action','<?= base_url() ;?>admin/hapus_prakata/<?= $data['id_prakata']; ?>')" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus"> 
                      <i class="ti-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php $no++ ?>
                <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- modal tambah -->
    <div class="modal fade" id="tambahPrakata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart('admin/tambah_prakata');?>
            <div class="form-group">
              <label>Judul Prakata</label>
              <input type="text" name="judul" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Nama Rektor</label>
              <input type="text" name="nama" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Isi Prakata</label>
              <textarea name="prakata" class="form-control" required="" style="height: 250px"></textarea>
            </div>
            <div class="form-group">
              <label>Foto Rektor</label>
              <input type="file" name="foto" class="form-control" size="30" required="">
              <small class="text-danger"> Disarankan ukuran file max 2MB.</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            <button type="reset" class="btn btn-success">Reset</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
    <!-- and modal tambah -->
    
    <!-- modal ubah -->
    <?php $no = 0;
      foreach ($prakata as $data) : $no++; ?>
      <div class="modal fade" id="UbahModal<?php echo $data['id_prakata'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('admin/ubah_prakata');?>
              <input type="hidden" name="id_prakata" value="<?= $data['id_prakata'];?>">
              <div class="form-group">
                <label>Judul Prakata</label>
                <input type="text" name="judul" class="form-control" value="<?= $data['judul'];?>" required="">
              </div>
              <div class="form-group">
                <label>Nama Rektor</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama'];?>" required="">
              </div>
              <div class="form-group">
                <label>Isi Prakata</label>
                <textarea type="text" name="prakata" class="form-control" required="" style="height: 250px"><?= $data['prakata'];?></textarea>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <div class="row">
                  <div class="col-sm-4">
                    <img src="<?= base_url(); ?>assets/backend/images/<?= $data['foto']; ?>" class="img-thumbnail">
                  </div>
                  <div class="col-sm-8">
                    <input type="file" name="foto" class="form-control" size="30">
                    <small class="text-danger"> Disarankan ukuran file max 2MB.</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <!-- and modal ubah -->
    
    <!-- Modal hapus-->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Apakah anda ingin meghapus data ini?. Klik <strong>Ya</strong> jika ingin menghapusnya.</div>
          <div class="modal-footer">
            <form id="formDelete" action="" method="post">
              <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-danger" type="submit">Ya</button>
            </form>
            <!-- <a class="btn btn-primary" href="<?= base_url(); ?>admin/logout">Ya</a> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Modal hapus-->

    <!-- end content -->
  </div>