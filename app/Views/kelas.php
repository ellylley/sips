<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include Bootstrap CSS and JS for modal functionality -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        .disabled-field {
    pointer-events: none;
    background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
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
    <h4 class="card-title">KELAS</h4>
    <div class="d-flex align-items-center">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Kelas">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">Tambah</button>
    </div>
</div>
                    <div class="card-content">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($elly as $gou) {
                                        if ($gou->isdelete == 0) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $gou->nama_kelas ?></td>
                                        <td><?= !empty($gou->jurusan) ? $gou->jurusan : 'Tidak memiliki jurusan' ?></td>

                                        <td><?= $gou->nama_user ?></td>
                                        <td>
                                            <!-- Dropdown button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editKelasModal" data-id="<?= $gou->id_kelas_kelas ?>" data-nama="<?= $gou->nama_kelas ?>"data-jurusan="<?= $gou->jurusan ?>"data-wali="<?= $gou->id_user ?>">Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('home/hapuskelas/' . $gou->id_kelas_kelas) ?>">Hapus</a></li>
                                                    <?php if (isset($backup_kelas[$gou->id_kelas_kelas])): ?>
                                                    <li>
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#undoEditModal" data-id="<?= $backup_kelas[$gou->id_kelas_kelas]->id_kelas ?>" data-nama="<?= $backup_kelas[$gou->id_kelas_kelas]->nama_kelas ?>"data-jurusan="<?= $backup_kelas[$gou->id_kelas_kelas]->jurusan ?>"data-wali="<?= $backup_kelas[$gou->id_kelas_kelas]->id_user ?>">
                                                            Undo Edit
                                                        </button>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Kelas -->
    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_tambah_kelas') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="kelas">Nama Kelas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="kelas" class="form-control" name="kelas" placeholder="Nama Kelas" required>
                                </div>
                                <div class="col-md-4">
    <label for="jurusan">Jurusan</label>
</div>
<div class="col-md-8 form-group">
    <select id="jurusan" class="form-control" name="jurusan" >
        <option value="" >Pilih Jurusan</option>
        <option value="RPL">RPL</option>
        <option value="BDP">BDP</option>
        <option value="AKL">AKL</option>
    </select>
</div>

<div class="col-md-4">
    <label for="wali">Wali Kelas</label>
</div>
<div class="col-md-8 form-group">
    <select id="wali" class="form-control" name="wali" required>
    <option value="" >Pilih Wali Kelas</option>
                        <?php foreach($guru as $wali){ ?>
                            <option value="<?=$wali->id_user?>"><?=$wali->nama_user?></option>
                        <?php } ?>
    </select>
</div>

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Kelas -->
    <div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_edit_kelas') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit-nama-kelas">Nama Kelas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="edit-nama-kelas" class="form-control" name="kelas" placeholder="Nama Kelas" required>
                                    <input type="hidden" id="edit-id-kelas" name="id">
                                </div>
                                <div class="col-md-4">
                                    <label for="edit-jurusan-kelas">Jurusan</label>
                                </div>
                                  <div class="col-md-8 form-group">
                                      <select id="edit-jurusan-kelas" class="form-control" name="jurusan" >
                                          <option value="">Pilih Jurusan</option>
                                          <option value="RPL">RPL</option>
                                          <option value="BDP">BDP</option>
                                          <option value="AKL">AKL</option>
                                      </select>
                                  </div>

                                  <div class="col-md-4">
    <label for="edit-wali-kelas">Wali Kelas</label>
</div>
<div class="col-md-8 form-group">
    <select id="edit-wali-kelas" class="form-control" name="wali" required>
    <option value="">Pilih Wali Kelas</option>
                        <?php foreach($guru as $wali){ ?>
                            <option value="<?=$wali->id_user?>"><?=$wali->nama_user?></option>
                        <?php } ?>
    </select>
</div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Undo Edit Kelas -->
    <div class="modal fade" id="undoEditModal" tabindex="-1" aria-labelledby="undoEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="undoEditModalLabel">Undo Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_unedit_kelas') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="undoKelasId" name="id">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="undoNama">Nama Kelas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="undoNama" class="form-control disabled-field" name="kelas" placeholder="Nama Kelas" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="undoJurusan">Jurusan</label>
                                </div>
                                  <div class="col-md-8 form-group">
                                      <select id="undoJurusan" class="form-control disabled-field" name="jurusan" >
                                          <option value="" disabled selected>Pilih Jurusan</option>
                                          <option value="RPL">RPL</option>
                                          <option value="BDP">BDP</option>
                                          <option value="AKL">AKL</option>
                                      </select>
                                  </div>

                                  <div class="col-md-4">
    <label for="undowali">Wali Kelas</label>
</div>
<div class="col-md-8 form-group">
    <select id="undowali" class="form-control disabled-field" name="wali" required>
    <option value="" disabled selected hidden>Pilih Wali Kelas</option>
                        <?php foreach($guru as $wali){ ?>
                            <option value="<?=$wali->id_user?>"><?=$wali->nama_user?></option>
                        <?php } ?>
    </select>
</div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Undo Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Script to handle the editing of Kelas
        $('#editKelasModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var nama = button.data('nama');
            var jurusan = button.data('jurusan');
            var wali = button.data('wali');

            var modal = $(this);
            modal.find('#edit-id-kelas').val(id);
            modal.find('#edit-nama-kelas').val(nama);
            modal.find('#edit-jurusan-kelas').val(jurusan);
            modal.find('#edit-wali-kelas').val(wali);
        });

        // Script to handle the Undo Edit of Kelas
        $('#undoEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var nama = button.data('nama');
            var jurusan = button.data('jurusan');
            var wali = button.data('wali');
            var modal = $(this);
            modal.find('#undoKelasId').val(id);
            modal.find('#undoNama').val(nama);
            modal.find('#undoJurusan').val(jurusan);
            modal.find('#undowali').val(wali);
        });

        function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const kelasCell = rows[i].getElementsByTagName("td")[1];
            const jurusanCell = rows[i].getElementsByTagName("td")[2];
            const waliCell = rows[i].getElementsByTagName("td")[3];
            const kelasText = kelasCell ? kelasCell.textContent.toLowerCase() : "";
            const jurusanText = jurusanCell ? jurusanCell.textContent.toLowerCase() : "";
            const waliText = waliCell ? waliCell.textContent.toLowerCase() : "";

            if (kelasText.includes(searchInput) || jurusanText.includes(searchInput) || waliText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
    </script>
</body>
</html>
