<div class="container mt-5">
  <!-- Page Header -->
  <div class="card shadow-lg mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h3 class="mb-0"><i class="bi bi-journal-text"></i> Daftar Permintaan</h3>
      <a href="/permintaan/create" class="btn btn-light text-success fw-bold shadow-sm">
        <i class="bi bi-plus-circle"></i> Create Permintaan
      </a>
    </div>
  </div>

  <!-- Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Pemohon</th>
            <th>Tanggal Masak</th>
            <th>Menu</th>
            <th>Porsi</th>
            <th>Status</th>
            <th>Alasan</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($permintaan)): ?>
            <?php foreach($permintaan as $i=>$p): ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($p['pemohon_name']) ?></td>
                <td><?= esc($p['tgl_masak']) ?></td>
                <td><?= esc($p['menu_makan']) ?></td>
                <td><span class="badge bg-success"><?= esc($p['jumlah_porsi']) ?></span></td>
                <td>
                  <?php if($p['status']=='menunggu'): ?>
                    <span class="badge bg-warning text-dark">Menunggu</span>
                  <?php elseif($p['status']=='disetujui'): ?>
                    <span class="badge bg-success">Disetujui</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Ditolak</span>
                  <?php endif; ?>
                </td>
                <td><?= esc($p['alasan']) ?></td>
                <td><?= esc($p['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-center text-muted">Tidak ada permintaan</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
