<div class="container mt-5">
  <div class="card shadow-lg mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h3 class="mb-0"><i class="bi bi-clipboard-check"></i> Permintaan — Menunggu</h3>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-hover">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Pemohon</th>
            <th>Tgl Masak</th>
            <th>Menu</th>
            <th>Porsi</th>
            <th>Created</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if(!empty($permintaan)): ?>
          <?php foreach($permintaan as $i=>$p): ?>
            <tr>
              <td><?= $i+1 ?></td>
              <!-- show pemohon_name from join -->
              <td class="fw-bold text-primary"><?= esc($p['pemohon_name']) ?></td>
              <td><?= esc($p['tgl_masak']) ?></td>
              <td><?= esc($p['menu_makan']) ?></td>
              <td><span class="badge bg-success"><?= esc($p['jumlah_porsi']) ?></span></td>
              <td><?= esc($p['created_at']) ?></td>
              <td class="text-center">
                <a href="/permintaan/view/<?= $p['id'] ?>" class="btn btn-info btn-sm">
                  <i class="bi bi-eye"></i> Detail
                </a>

                <form method="post" action="/permintaan-admin/approve/<?= $p['id'] ?>" 
                      style="display:inline-block" 
                      onsubmit="return confirm('Setujui permintaan ini dan kurangi stok sesuai jumlah?')">
                  <?= csrf_field() ?>
                  <button class="btn btn-success btn-sm">
                    <i class="bi bi-check2-circle"></i> Setujui
                  </button>
                </form>

                <button class="btn btn-danger btn-sm btn-reject" data-id="<?= $p['id'] ?>">
                  <i class="bi bi-x-circle"></i> Tolak
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center text-muted p-3">Tidak ada permintaan menunggu</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Reject reason modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="rejectForm" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alasan Penolakan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Alasan</label>
            <textarea name="alasan" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
          <button type="submit" class="btn btn-danger">Tolak</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.btn-reject').forEach(btn => {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    const form = document.getElementById('rejectForm');
    form.action = '/permintaan-admin/reject/' + id;
    // show modal
    new bootstrap.Modal(document.getElementById('rejectModal')).show();
  });
});
</script>
