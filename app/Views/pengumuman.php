<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .disabled-field {
            pointer-events: none;
            background-color: #e9ecef;
        }

        .img-circle {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        
    </style>
</head>

<body data-user-level="<?= session()->get('level') ?>">
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
    <h4 class="card-title">PENGUMUMAN</h4>
    <div class="d-flex align-items-center">
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari Pengumuman...">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
           
        </div>
        <button class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah</button>
    </div>
</div>

                    <div class="card-content">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dibuat Pada</th>
                                        <th>Pengumuman</th>
                                        <th>Aksi</th>
                                        <th>Share</th> <!-- Tombol Share -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($elly as $gou) {
                                        if ($gou->isdelete == 0) {
                                            // Mencari nama kelas berdasarkan ID kelas dari pengumuman
                                            $nama_kelas = '';
                                            foreach ($kelas as $k) {
                                                if ($k->id_kelas == $gou->id_kelas) {
                                                    $nama_kelas = $k->nama_kelas;
                                                    break;
                                                }
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $gou->created_at ?></td>
                                                <td><?= $gou->judul ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Aksi
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                                            <li>
                                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="<?= $gou->id_pengumuman ?>"  data-judul="<?= $gou->judul ?>" data-isi="<?= $gou->isi_pengumuman ?>" data-file="<?= $gou->file ?>">
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li><a class="dropdown-item" href="<?= base_url('home/hapuspengumuman/' . $gou->id_pengumuman) ?>">Hapus</a></li>

                                                            <?php if (isset($backup_pengumuman[$gou->id_pengumuman])) : ?>
                                                                <li>
                                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#undoEditModal" data-id="<?= $backup_pengumuman[$gou->id_pengumuman]->id_pengumuman ?>"  data-judul="<?= $backup_pengumuman[$gou->id_pengumuman]->judul ?>" data-isi="<?= $backup_pengumuman[$gou->id_pengumuman]->isi_pengumuman ?>" data-file="<?= $backup_pengumuman[$gou->id_pengumuman]->file ?>">
                                                                        Undo Edit
                                                                    </button>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </td>

                                                <td>
                                                    <!-- Tombol Share -->
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#shareModal" data-id="<?= $gou->id_pengumuman ?>" data-kelas="<?= $gou->id_kelas ?>" data-judul="<?= $gou->judul ?>">
                                                        Share
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
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
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Pengumuman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('home/aksi_tambah_pengumuman') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label>Judul</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul">
                                </div>
                                <div class="col-md-4">
                                    <label>Isi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea class="form-control" name="isi"  rows="20"  placeholder="Isi"></textarea>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>PDF</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" class="form-control" name="file" placeholder="File">
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

        <!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <form action="<?= base_url('home/aksi_share_pengumuman') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <label>Jenjang</label>
            </div>
            <div class="col-md-8 form-group" id="jenjangContainer">
                <div class="d-flex">
                    <select class="form-select" name="jenjang[]">
                        <option>Pilih Jenjang</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMK">SMK</option>
                    </select>
                    <button type="button" class="btn btn-primary ms-2" id="addJenjang">+</button>
                </div>
            </div>

            <div class="col-md-4">
    <label>Jurusan</label>
</div>
<div class="col-md-8 form-group" id="jurusanContainer">
    <div class="d-flex">
        <select class="form-select" name="jurusan[]">
            <option>Pilih Jurusan</option>
            <option value="RPL">RPL</option>
            <option value="BDP">BDP</option>
            <option value="AKL">AKL</option>
        </select>
        <button type="button" class="btn btn-primary ms-2" id="addJurusan">+</button>
    </div>
</div>

            <div class="col-md-4">
                <label>Kelas</label>
            </div>
            <div class="col-md-8 form-group" id="kelasContainer">
                <div class="d-flex">
                    <select class="form-select" name="kelas[]">
                        <option>Pilih Kelas</option>
                        <?php foreach ($kelas as $gou) { ?>
                            <option value="<?= $gou->id_kelas ?>"><?= $gou->nama_kelas ?></option>
                        <?php } ?>
                    </select>
                    <button type="button" class="btn btn-primary ms-2" id="addKelas">+</button>
                </div>
            </div>

            <input type="hidden" id="shareId" name="id">

            <div class="col-md-12 form-group">
                <label>
                    <input type="checkbox" name="send_to_email" value="1"> Share to Email
                </label>
            </div>
            <div class="col-md-12 form-group">
                <label>
                    <input type="checkbox" name="send_to_whatsapp" value="1"> Share to WhatsApp
                </label>
            </div>

            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Share</button>
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
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_pengumuman') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-md-4">
                                <label>Judul</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="editjudul" class="form-control" name="judul" placeholder="Judul">
                            </div>
                            <div class="col-md-4">
                                <label>isi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="editisi" class="form-control" name="isi"  rows="20" placeholder="Isi"></textarea>
                            </div>
                            <div class="col-md-4">
    <label>File</label>
</div>
<div class="col-md-8 form-group">
    <input type="file" id="editfile" class="form-control" name="file" placeholder="File">
    <div id="existingFileContainer" class="mt-2">
        <!-- Tautan file akan ditampilkan di sini jika ada file -->
    </div>
</div>
                            
                            

                           

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
        <h5 class="modal-title" id="undoEditModalLabel">Undo Edit Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="undoEditForm" action="<?= base_url('home/aksi_unedit_pengumuman') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="undoUserId" name="id">
            <div class="row">
                
                <div class="col-md-4">
                    <label>Judul</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="undojudul" class="form-control disabled-field" name="judul" placeholder="Judul">
                </div>
                
                <div class="col-md-4">
                    <label>Isi</label>
                </div>
                <div class="col-md-8 form-group">
                    <textarea id="undoisi" class="form-control disabled-field" name="isi"  rows="20" placeholder="Isi"></textarea>
                </div>

                <div class="col-md-4">
    <label>File</label>
</div>
<div class="col-md-8 form-group">
    <div id="existingFileContainerundo"></div> <!-- Menampilkan link file yang ada -->
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
<script>
    // Script asli yang sudah ada sebelumnya untuk show.bs.modal
    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var judul = button.getAttribute('data-judul');
        var isi = button.getAttribute('data-isi');
        var file = button.getAttribute('data-file');

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#editjudul').value = judul;
        modal.querySelector('#editisi').value = isi;
        var existingFileContainer = modal.querySelector('#existingFileContainer');
    existingFileContainer.innerHTML = ''; // Kosongkan elemen saat modal dibuka

    if (file) {
        var fileUrl = "<?= base_url() ?>" + '/' + file;
        existingFileContainer.innerHTML = `<a href="${fileUrl}" target="_blank">Lihat PDF</a>`;
    }

        var modal = document.getElementById('undoEditModal');
        modal.querySelector('#undoUserId').value = id;
        modal.querySelector('#undojudul').value = judul;
        modal.querySelector('#undoisi').value = isi;
        var existingFileContainerundo = modal.querySelector('#existingFileContainerundo');
    existingFileContainerundo.innerHTML = ''; // Kosongkan elemen saat modal dibuka

    if (file) {
    var fileUrl = "<?= base_url() ?>" + '/' + file;
    existingFileContainerundo.innerHTML = `<a href="${fileUrl}" target="_blank">Lihat File</a>`;
} else {
    existingFileContainerundo.innerHTML = 'Tidak memiliki PDF'; // Tampilkan pesan jika tidak ada file
}



        var modal = document.getElementById('shareModal');
        modal.querySelector('#shareId').value = id;
    });

    // Fungsi untuk menambahkan dropdown jenjang
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('addJenjang').addEventListener('click', function () {
            var jenjangContainer = document.getElementById('jenjangContainer');
            var newJenjang = document.createElement('div');
            newJenjang.className = 'd-flex mt-2';
            newJenjang.innerHTML = `
                <select class="form-select" name="jenjang[]">
                    <option>Pilih Jenjang</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMK">SMK</option>
                </select>
                <button type="button" class="btn btn-danger ms-2 removeJenjang">-</button>
            `;
            jenjangContainer.appendChild(newJenjang);

            // Fungsi untuk menghapus dropdown jenjang
            newJenjang.querySelector('.removeJenjang').addEventListener('click', function () {
                jenjangContainer.removeChild(newJenjang);
            });
        });

        // Fungsi untuk menambahkan dropdown kelas
        document.getElementById('addKelas').addEventListener('click', function () {
            var kelasContainer = document.getElementById('kelasContainer');
            var newKelas = document.createElement('div');
            newKelas.className = 'd-flex mt-2';
            newKelas.innerHTML = `
                <select class="form-select" name="kelas[]">
                    <option>Pilih Kelas</option>
                    <?php foreach ($kelas as $gou) { ?>
                        <option value="<?= $gou->id_kelas ?>"><?= $gou->nama_kelas ?></option>
                    <?php } ?>
                </select>
                <button type="button" class="btn btn-danger ms-2 removeKelas">-</button>
            `;
            kelasContainer.appendChild(newKelas);

            // Fungsi untuk menghapus dropdown kelas
            newKelas.querySelector('.removeKelas').addEventListener('click', function () {
                kelasContainer.removeChild(newKelas);
            });
        });


        document.getElementById('addJurusan').addEventListener('click', function () {
    var jurusanContainer = document.getElementById('jurusanContainer');
    var newJurusan = document.createElement('div');
    newJurusan.className = 'd-flex mt-2';
    newJurusan.innerHTML = `
        <select class="form-select" name="jurusan[]">
            <option>Pilih Jurusan</option>
            <option value="RPL">RPL</option>
            <option value="BDP">BDP</option>
            <option value="AKL">AKL</option>
        </select>
        <button type="button" class="btn btn-danger ms-2 removeJurusan">-</button>
    `;
    jurusanContainer.appendChild(newJurusan);

    // Fungsi untuk menghapus dropdown jurusan
    newJurusan.querySelector('.removeJurusan').addEventListener('click', function () {
        jurusanContainer.removeChild(newJurusan);
    });
});
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan level user dari body
    var userLevel = document.body.getAttribute('data-user-level');

    // Cek apakah user level adalah 5
    if (userLevel === '5') {
        // Disable semua dropdown di form share
        document.querySelectorAll('#shareModal select').forEach(function (selectElement) {
            selectElement.disabled = true;
        });

        // Disable tombol tambah jenjang, jurusan, kelas
        document.querySelectorAll('#addJenjang, #addJurusan, #addKelas').forEach(function (button) {
            button.disabled = true;
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
        var searchButton = document.getElementById('searchButton'); // Ambil tombol Cari
        searchButton.addEventListener('click', filterTable); // Panggil filterTable saat tombol diklik
    });

    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const tglCell = rows[i].getElementsByTagName("td")[1];
            const judulCell = rows[i].getElementsByTagName("td")[2];
            
            const tglText = tglCell ? tglCell.textContent.toLowerCase() : "";
            const judulText = judulCell ? judulCell.textContent.toLowerCase() : "";
            

            if (tglText.includes(searchInput) || judulText.includes(searchInput) ) {
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
