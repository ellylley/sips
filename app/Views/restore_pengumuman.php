<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">RESTORE PENGUMUMAN</h4>
                </div>
                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach ($elly as $gou) {
                                    if ($gou->isdelete == 1) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $gou->judul ?></td> 
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userDetailModal" data-judul="<?= htmlspecialchars($gou->judul, ENT_QUOTES, 'UTF-8') ?>" data-isi="<?= htmlspecialchars($gou->isi_pengumuman, ENT_QUOTES, 'UTF-8') ?>" onclick="showUserDetail(this)">Detail</button>
                                            <a href="<?= base_url('home/aksi_restore_pengumuman/'.$gou->id_pengumuman)?>">
                                                <button class="btn btn-danger btn-sm">Restore</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end of .card -->
        </div> <!-- end of .col-12 -->
    </div> <!-- end of .row -->
</div> <!-- end of .main-content container-fluid -->

<!-- Modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailModalLabel">Detail Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Judul:</strong> <span id="modalUserjudul"></span></p>
        <p><strong>Isi:</strong></p>
        <pre id="modalUserisi" style="white-space: pre-wrap; border: 1px solid #ccc; padding: 10px; border-radius: 5px;"></pre>
      </div>
    </div>
  </div>
</div>

<script>
function showUserDetail(button) {
    const judul = button.getAttribute('data-judul');
    const isi = button.getAttribute('data-isi');
    
    document.getElementById('modalUserjudul').textContent = judul;
    document.getElementById('modalUserisi').textContent = isi;
}
</script>
