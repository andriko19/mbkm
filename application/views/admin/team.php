<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- content -->
    <?= $this->session->flashdata('message');?>
    
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahTeam" >
            Tambah <?= $title;?> 
          </button> <br><br>
          <p class="card-title mb-0">Team</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Foto</th>
                  <th>Twitter</th>
                  <th>Facebook</th>
                  <th>Instagram</th>
                  <th>Linkedin</th>
                  <th>Aksi</th>
                </tr>  
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($team as $data): ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $data['nama']; ?></td>
                  <td><?= $data['jabatan']; ?></td>
                  <td><?= $data['twitter']; ?></td>
                  <td><?= $data['facebook']; ?></td>
                  <td><?= $data['instagram']; ?></td>
                  <td><?= $data['linkedin']; ?></td>
                  <td><img style="height: 60px; width:50px" src="<?= base_url(); ?>assets/backend/images/<?= $data['foto']; ?>"></td>
                  <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#UbahModal<?php echo $data['id_team'];?>">
                      <i class="ti-pencil"></i>
                    </button> <br><br>
                    <a href="" onclick="$('#modalHapus #formDelete').attr('action','<?= base_url() ;?>admin/hapus_team/<?= $data['id_team']; ?>')" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus"> 
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
    <div class="modal fade" id="tambahTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart('admin/tambah_team');?>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" name="jabatan" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Twitter</label>
              <input type="text" name="twitter" class="form-control">
            </div>
            <div class="form-group">
              <label>Facebook</label>
              <input type="text" name="facebook" class="form-control">
            </div>
            <div class="form-group">
              <label>Instagram</label>
              <input type="text" name="instagram" class="form-control">
            </div>
            <div class="form-group">
              <label>Linkedin</label>
              <input type="text" name="linkedin" class="form-control">
            </div>
            <div class="form-group">
              <label>Foto</label>
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
      foreach ($team as $data) : $no++; ?>
      <div class="modal fade" id="UbahModal<?php echo $data['id_team'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('admin/ubah_team');?>
              <input type="hidden" name="id_team" value="<?= $data['id_team'];?>">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama'];?>" required="">
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="<?= $data['jabatan'];?>" required="">
              </div>
              <div class="form-group">
                <label>Twitter</label>
                <input type="text" name="twitter" class="form-control" value="<?= $data['twitter'];?>">
              </div>
              <div class="form-group">
                <label>Facebook</label>
                <input type="text" name="facebook" class="form-control" value="<?= $data['facebook'];?>">
              </div>
              <div class="form-group">
                <label>Instagram</label>
                <input type="text" name="instagram" class="form-control" value="<?= $data['instagram'];?>">
              </div>
              <div class="form-group">
                <label>Linkedin</label>
                <input type="text" name="linkedin" class="form-control" value="<?= $data['linkedin'];?>">
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