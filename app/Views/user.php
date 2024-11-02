<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .disabled-field {
    pointer-events: none;
    background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
}
.img-circle {
    border-radius: 50%;
    width: 150px; /* Sesuaikan ukuran yang diinginkan */
    height: 150px; /* Sesuaikan ukuran yang diinginkan */
    object-fit: cover;
}

        </style>
</head>
<body>
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title">USER</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari User">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah</button>
    </div>
</div>

                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach($elly as $gou){
                                    if ($gou->isdelete == 0) {  
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?=$gou->nama_user?></td>
                                    <td>
                                        <?php 
                                            switch($gou->level){
                                                case 1: echo "Admin"; break;
                                                case 2: echo "Kepala Sekolah"; break;
                                                case 3: echo "Wakil Kepala Sekolah"; break;
                                                case 4: echo "Kesiswaan"; break;
                                                case 5: echo "Guru"; break;
                                                case 6: echo "Murid"; break;
                                                case 7: echo "Orang Tua"; break;
                                            }
                                        ?>
                                    </td>
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal"
                    data-id="<?= $gou->id_user ?>"
                    data-nama="<?= $gou->nama_user ?>"
                    data-email="<?= $gou->email ?>"
                    data-nohp="<?= $gou->nohp ?>"
                    data-jk="<?= $gou->jk ?>"
                    data-lahir="<?= $gou->tgl_lhr ?>"
                    data-level="<?= $gou->level ?>"
                    data-nis="<?= $gou->nis ?>"
                    data-nisn="<?= $gou->nisn ?>"
                    data-nuptk="<?= $gou->nuptk ?>"
                    data-nik="<?= $gou->nik ?>"
                    data-kelas="<?= $gou->id_kelas ?>"
                    data-foto="<?= $gou->foto ?>"
                   
                    data-password="<?= $gou->password ?>">
                    Edit
                </button>
            </li>
            <li><a class="dropdown-item" href="<?= base_url('home/hapususer/' . $gou->id_user) ?>">Hapus</a></li>
            <li><a class="dropdown-item" href="<?= base_url('home/aksi_reset/' . $gou->id_user) ?>">Reset Password</a></li>
            <?php if (isset($backup_users[$gou->id_user])): ?>
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#undoEditModal"
                    data-id="<?= $backup_users[$gou->id_user]->id_user ?>"
                    data-nama="<?= $backup_users[$gou->id_user]->nama_user ?>"
                    data-email="<?= $backup_users[$gou->id_user]->email ?>"
                    data-nohp="<?= $backup_users[$gou->id_user]->nohp ?>"
                    data-jk="<?= $backup_users[$gou->id_user]->jk ?>"
                    data-lahir="<?= $backup_users[$gou->id_user]->tgl_lhr ?>"
                    data-level="<?= $backup_users[$gou->id_user]->level ?>"
                    data-nis="<?= $backup_users[$gou->id_user]->nis ?>"
                    data-nisn="<?= $backup_users[$gou->id_user]->nisn ?>"
                    data-nuptk="<?= $backup_users[$gou->id_user]->nuptk ?>"
                    data-nik="<?= $backup_users[$gou->id_user]->nik ?>"
                    data-kelas="<?= $backup_users[$gou->id_user]->id_kelas ?>"
                    data-foto="<?= $backup_users[$gou->id_user]->foto ?>"
                    >
                    Undo Edit
                </button>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</td>


                                </tr>
                                <?php
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_tambah_user') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col-md-4">
                                <label>Level</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="level" name="level" onchange="toggleKelas()">
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala Sekolah</option>
                                    <option value="3">Wakil Kepala Sekolah</option>
                                    <option value="4">Kesiswaan</option>
                                    <option value="5">Guru</option>
                                    <option value="6">Murid</option>
                                    <option value="7">Orang Tua</option>

                                  
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Foto</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="file" id="foto" class="form-control" name="foto">
                            </div>
                            <div class="col-md-4">
                                <label>Nama User</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="first-name" class="form-control" name="nama" placeholder="Nama User">
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-4">
    <label>Nomor Telepon</label>
</div>
<div class="col-md-8 form-group">
    <input type="text" id="nohp" class="form-control" name="nohp" placeholder="Nomor Telepon" value="62">
</div>

                            <div class="col-md-4">
                                <label>Password</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="col-md-4">
    <label>Jenis Kelamin</label>
</div>
<div class="col-md-8 form-group">
    <select id="jk" class="form-control" name="jk">
        <option value="">Pilih</option>
        <option value="Perempuan">Perempuan</option>
        <option value="Laki-laki">Laki-laki</option>
    </select>
</div>
<div class="col-md-4">
                                <label>Tanggal Lahir</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="lahir" class="form-control" name="lahir" placeholder="Tanggal Lahir">
                            </div>
                           
                            <!-- Kelas Selection -->
                            
                            
                            
                            <div class="col-md-4">
                                <label id="kelasLabel" style="display:none;">Kelas</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="kelas" name="kelas" style="display:none;">
                                <option value="">Pilih</option>
                                    <?php foreach($kelas as $gou){ ?>
                                        <option value="<?=$gou->id_kelas?>"><?=$gou->jurusan . ' ' . $gou->nama_kelas?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label id="nisLabel" style="display:none;">NIS</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nis" class="form-control" name="nis" placeholder="NIS" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label id="nisnLabel" style="display:none;">NISN</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nisn" class="form-control" name="nisn" placeholder="NISN" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label id="nikLabel" style="display:none;">NIK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nik" class="form-control" name="nik" placeholder="NIK" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label id="nuptkLabel" style="display:none;">NUPTK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nuptk" class="form-control" name="nuptk" placeholder="NUPTK" style="display:none;">
                            </div>

                            

                           

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_user') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">

                        <div class="col-md-4">
                                <label>Level</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="editLevel" name="level" onchange="toggleEditKelas()">
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala Sekolah</option>
                                    <option value="3">Wakil Kepala Sekolah</option>
                                    <option value="4">Kesiswaan</option>
                                    <option value="5">Guru</option>
                                    <option value="6">Murid</option>
                                    <option value="7">Orang Tua</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Profile</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <img id="editProfileImg" src="<?php echo base_url('images/'.$satu->foto) ?>" class="profile-img img-circle mb-3" alt="Profile Picture">
                                <input type="file" id="foto" class="form-control" name="foto">
                                <input type="hidden" id="old_foto" name="old_foto">
                            </div>
                            <div class="col-md-4">
                                <label>Nama User</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama User">
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editemail" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Telepon</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editnohp" class="form-control" name="nohp" placeholder="Nomor Telepon">
                            </div>
                            
                            <div class="col-md-4">
    <label>Jenis Kelamin</label>
</div>
<div class="col-md-8 form-group">
    <select id="editjk" class="form-control" name="jk">
        <option value="">Pilih</option>
        <option value="Perempuan">Perempuan</option>
        <option value="Laki-laki">Laki-laki</option>
    </select>
</div>
<div class="col-md-4">
                                <label>Tanggal Lahir</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="editlahir" class="form-control" name="lahir" placeholder="Tanggal Lahir">
                            </div>
                            
                            <div class="col-md-4">
                                <label id="editKelasLabel" style="display:none;">Kelas</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="editKelas" name="kelas" style="display:none;">
                                <option value="">Pilih</option>
                                    <?php foreach($kelas as $gou){ ?>
                                        <option value="<?=$gou->id_kelas?>"><?=$gou->jurusan . ' ' . $gou->nama_kelas?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            

                            <div class="col-md-4">
                                <label id="editNisLabel" style="display:none;">NIS</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editNis" class="form-control" name="nis" placeholder="NIS" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label id="editNisnLabel" style="display:none;">NISN</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editNisn" class="form-control" name="nisn" placeholder="NISN" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label id="editNikLabel" style="display:none;">NIK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editNik" class="form-control" name="nik" placeholder="NIK" style="display:none;">
                            </div>


                            <div class="col-md-4">
                                <label id="editNuptkLabel" style="display:none;">NUPTK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editNuptk" class="form-control" name="nuptk" placeholder="NUPTK" style="display:none;">
                            </div>


                            
                            

                            <!-- Hidden Password Field -->
                            <input type="hidden" id="editPassword" name="password">
                            <input type="hidden" id="editId" name="id">

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Undo Edit Modal -->
    <div class="modal fade" id="undoEditModal" tabindex="-1" aria-labelledby="undoEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="undoEditModalLabel">Undo Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="undoEditForm" action="<?= base_url('home/aksi_unedit_user') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="undoUserId" name="id">
            <div class="row">
            <div class="col-md-4">
                    <label>Level</label>
                </div>
                <div class="col-md-8 form-group">
                    <select class="form-select disabled-field" id="undoLevel" name="level">
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala Sekolah</option>
                                    <option value="3">Wakil Kepala Sekolah</option>
                                    <option value="4">Kesiswaan</option>
                                    <option value="5">Guru</option>
                                    <option value="6">Murid</option>
                                    <option value="7">Orang Tua</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Profile</label>
                </div>
                <div class="col-md-8 form-group">
                    <img id="undoProfileImg" src="" class="profile-img img-circle mb-3" alt="Profile Picture">
                </div>
                <div class="col-md-4">
                    <label>Nama User</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undoNama" class="form-control disabled-field" name="nama" placeholder="Nama User">
                </div>
                
                <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="undoemail" class="form-control disabled-field"name="email" placeholder="Email">
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Telepon</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="undonohp" class="form-control disabled-field" name="nohp" placeholder="Nomor Telepon">
                            </div>

                <div class="col-md-4">
    <label>Jenis Kelamin</label>
</div>
<div class="col-md-8 form-group">
    <select id="undojk" class="form-control disabled-field" name="jk">
        <option value="">Pilih</option>
        <option value="Perempuan">Perempuan</option>
        <option value="Laki-laki">Laki-laki</option>
    </select>
</div>
<div class="col-md-4">
                                <label>Tanggal Lahir</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="undolahir" class="form-control disabled-field" name="lahir" placeholder="Tanggal Lahir">
                            </div>
                
               

                <!-- Kelas Selection -->


              

                <div class="col-md-4">
                    <label id="undoKelasLabel" style="display:none;">Kelas</label>
                </div>
                <div class="col-md-8 form-group">
                    <select class="form-select disabled-field" id="undoKelas" name="kelas" style="display:none;">
                    <option value="" disabled selected hidden>Pilih Kelas</option>
                        <?php foreach($kelas as $gou){ ?>
                            <option value="<?=$gou->id_kelas?>"><?=$gou->jurusan . ' ' . $gou->nama_kelas?></option>
                        <?php } ?>
                    </select>
                </div>

              
                
                <div class="col-md-4">
                    <label id="undoNisLabel" style="display:none;">NIS</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undoNis" class="form-control disabled-field" name="nis" placeholder="NIS" style="display:none;">
                </div>

                <div class="col-md-4">
                    <label id="undoNisnLabel" style="display:none;">NISN</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undoNisn" class="form-control disabled-field" name="nisn" placeholder="NISN" style="display:none;">
                </div>

                <div class="col-md-4">
                    <label id="undoNikLabel" style="display:none;">NIK</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undoNik" class="form-control disabled-field" name="nik" placeholder="NIK" style="display:none;">
                </div>
                
                <div class="col-md-4">
                    <label id="undoNuptkLabel" style="display:none;">NUPTK</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undoNuptk" class="form-control disabled-field" name="nuptk" placeholder="NUPTK" style="display:none;">
                </div>

                

                
                <div class="col-sm-12 d-flex justify-content-end">
                    
                    <button type="submit" class="btn btn-primary me-1 mb-1">Undo Edit</button>
                </div>
                
            </div>
        </form>
      </div>
    </div>
  </div>
</div>



</div>

<!-- Script to populate edit modal with existing data -->
<script>
    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        var email = button.getAttribute('data-email');
        var nohp = button.getAttribute('data-nohp');
        var jk = button.getAttribute('data-jk');
        var lahir = button.getAttribute('data-lahir');
        var level = button.getAttribute('data-level');
        var nis = button.getAttribute('data-nis');
        var nisn = button.getAttribute('data-nisn');
        var nuptk = button.getAttribute('data-nuptk');
        var nik = button.getAttribute('data-nik');
        var kelas = button.getAttribute('data-kelas');
        var foto = button.getAttribute('data-foto');
       
        var password = button.getAttribute('data-password');

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#editNama').value = nama;
        modal.querySelector('#editemail').value = email;
        modal.querySelector('#editnohp').value = nohp;
        modal.querySelector('#editjk').value = jk;
        modal.querySelector('#editlahir').value = lahir;
        modal.querySelector('#editLevel').value = level;
        modal.querySelector('#editNis').value = nis;
        modal.querySelector('#editNisn').value = nisn;
        modal.querySelector('#editNuptk').value = nuptk;
        modal.querySelector('#editNik').value = nik;
        modal.querySelector('#editKelas').value = kelas;
       
        modal.querySelector('#old_foto').value = foto;
        modal.querySelector('#editPassword').value = password;
        modal.querySelector('#editProfileImg').src = "<?= base_url('images/')?>" + '/' + foto;

        var modal = document.getElementById('undoEditModal');
    modal.querySelector('#undoUserId').value = id;
    modal.querySelector('#undoNama').value = nama;
    modal.querySelector('#undoemail').value = email;
    modal.querySelector('#undonohp').value = nohp;
    modal.querySelector('#undojk').value = jk;
    
    modal.querySelector('#undolahir').value = lahir;
    modal.querySelector('#undoLevel').value = level;
    modal.querySelector('#undoNis').value = nis;
    modal.querySelector('#undoNisn').value = nisn;
    modal.querySelector('#undoNuptk').value = nuptk;
    modal.querySelector('#undoNik').value = nik;
    modal.querySelector('#undoKelas').value = kelas;
    modal.querySelector('#undoProfileImg').src = "<?= base_url('images/')?>" + '/' + foto;


        // Toggle Kelas, NIS, and NISN visibility based on level
        toggleEditKelas();
        toggleUndoKelas();
    });

    function toggleEditKelas() {
    var level = document.getElementById('editLevel').value;
    var kelasField = document.getElementById('editKelas');
    var nisField = document.getElementById('editNis');
    var nisnField = document.getElementById('editNisn');
    var nuptkField = document.getElementById('editNuptk');
    var nikField = document.getElementById('editNik');

    var kelasLabel = document.getElementById('editKelasLabel');
    var nisLabel = document.getElementById('editNisLabel');
    var nisnLabel = document.getElementById('editNisnLabel');
    var nuptkLabel = document.getElementById('editNuptkLabel');
    var nikLabel = document.getElementById('editNikLabel');

    // Menampilkan kelas hanya untuk level 6 dan 7
    if (level == 6 || level == 7) {
        kelasField.style.display = 'block';
        kelasLabel.style.display = 'block';
    } else {
        kelasField.style.display = 'none';
        kelasLabel.style.display = 'none';
    }

    // Menampilkan NIK hanya untuk level 1
    if (level == 1) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
    } else {
        nikField.style.display = 'none';
        nikLabel.style.display = 'none';
    }

    // Menampilkan NIK dan NUPTK untuk level 2, 3, 4, 5
    if (level == 2 || level == 3 || level == 4 || level == 5) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
        nuptkField.style.display = 'block';
        nuptkLabel.style.display = 'block';
    } else {
        nuptkField.style.display = 'none';
        nuptkLabel.style.display = 'none';
    }

    // Menampilkan NIS dan NISN hanya untuk level 6
    if (level == 6) {
        nisField.style.display = 'block';
        nisLabel.style.display = 'block';
        nisnField.style.display = 'block';
        nisnLabel.style.display = 'block';
    } else {
        nisField.style.display = 'none';
        nisLabel.style.display = 'none';
        nisnField.style.display = 'none';
        nisnLabel.style.display = 'none';
    }
}



function toggleUndoKelas() {
    var level = document.getElementById('undoLevel').value;
    var kelasField = document.getElementById('undoKelas');
    var nisField = document.getElementById('undoNis');
    var nisnField = document.getElementById('undoNisn');
    var nuptkField = document.getElementById('undoNuptk');
    var nikField = document.getElementById('undoNik');
    
    var kelasLabel = document.getElementById('undoKelasLabel');
    var nisLabel = document.getElementById('undoNisLabel');
    var nisnLabel = document.getElementById('undoNisnLabel');
    var nuptkLabel = document.getElementById('undoNuptkLabel');
    var nikLabel = document.getElementById('undoNikLabel');

    

    // Menampilkan kelas hanya untuk level 6 dan 7
    if (level == 6 || level == 7) {
        kelasField.style.display = 'block';
        kelasLabel.style.display = 'block';
    } else {
        kelasField.style.display = 'none';
        kelasLabel.style.display = 'none';
    }

    // Menampilkan NIK hanya untuk level 1
    if (level == 1) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
    } else {
        nikField.style.display = 'none';
        nikLabel.style.display = 'none';
    }

    // Menampilkan NIK dan NUPTK untuk level 2, 3, 4, 5
    if (level == 2 || level == 3 || level == 4 || level == 5) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
        nuptkField.style.display = 'block';
        nuptkLabel.style.display = 'block';
    } else {
        nuptkField.style.display = 'none';
        nuptkLabel.style.display = 'none';
    }

    // Menampilkan NIS dan NISN hanya untuk level 6
    if (level == 6) {
        nisField.style.display = 'block';
        nisLabel.style.display = 'block';
        nisnField.style.display = 'block';
        nisnLabel.style.display = 'block';
    } else {
        nisField.style.display = 'none';
        nisLabel.style.display = 'none';
        nisnField.style.display = 'none';
        nisnLabel.style.display = 'none';
    }
}


    function toggleKelas() {
    var level = document.getElementById('level').value;
    var kelasField = document.getElementById('kelas');
    var nisField = document.getElementById('nis');
    var nisnField = document.getElementById('nisn');
    var nuptkField = document.getElementById('nuptk');
    var nikField = document.getElementById('nik');

    var kelasLabel = document.getElementById('kelasLabel');
    var nisLabel = document.getElementById('nisLabel');
    var nisnLabel = document.getElementById('nisnLabel');
    var nuptkLabel = document.getElementById('nuptkLabel');
    var nikLabel = document.getElementById('nikLabel');

    // Menampilkan kelas hanya untuk Murid (level 5)
    

    // Menampilkan kelas hanya untuk level 6 dan 7
    if (level == 6 || level == 7) {
        kelasField.style.display = 'block';
        kelasLabel.style.display = 'block';
    } else {
        kelasField.style.display = 'none';
        kelasLabel.style.display = 'none';
    }

    // Menampilkan NIK hanya untuk level 1
    if (level == 1) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
    } else {
        nikField.style.display = 'none';
        nikLabel.style.display = 'none';
    }

    // Menampilkan NIK dan NUPTK untuk level 2, 3, 4, 5
    if (level == 2 || level == 3 || level == 4 || level == 5) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
        nuptkField.style.display = 'block';
        nuptkLabel.style.display = 'block';
    } else {
        nuptkField.style.display = 'none';
        nuptkLabel.style.display = 'none';
    }

    // Menampilkan NIS dan NISN hanya untuk level 6
    if (level == 6) {
        nisField.style.display = 'block';
        nisLabel.style.display = 'block';
        nisnField.style.display = 'block';
        nisnLabel.style.display = 'block';
    } else {
        nisField.style.display = 'none';
        nisLabel.style.display = 'none';
        nisnField.style.display = 'none';
        nisnLabel.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function() {
        const nohpInput = document.getElementById('nohp');
        const editnohpInput = document.getElementById('editnohp');
        
        // Menambahkan kode negara 62 jika field kosong
        if (nohpInput.value === "") {
            nohpInput.value = "62";
        }
        if (editnohpInput.value === "") {
            editnohpInput.value = "62";
        }
        
        // Menjaga agar pengguna tidak menghapus kode negara
        nohpInput.addEventListener("input", function() {
            if (nohpInput.value.length < 2) {
                nohpInput.value = "62";
            }
        });
        
        editnohpInput.addEventListener("input", function() {
            if (editnohpInput.value.length < 2) {
                editnohpInput.value = "62";
            }
        });
    });

    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const levelCell = rows[i].getElementsByTagName("td")[2];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || levelText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
