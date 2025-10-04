<div class="container mt-5">
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-info text-white rounded">
      <h3><i class="bi bi-eye"></i> Detail Permintaan</h3>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <p><b>Pemohon:</b> 
        <span class="fw-bold text-primary"><?= esc($permintaan['pemohon_name']) ?></span>
      </p>
      <p><b>Tanggal Masak:</b> <?= esc($permintaan['tgl_masak']) ?></p>
      <p><b>Menu:</b> <?= esc($permintaan['menu_makan']) ?></p>
      <p><b>Jumlah Porsi:</b> 
        <span class="badge bg-success"><?= esc($permintaan['jumlah_porsi']) ?></span>
      </p>
      <p><b>Status:</b>
        <?php if($permintaan['status']=='menunggu'): ?>
          <span class="badge bg-warning text-dark">Menunggu</span>
        <?php elseif($permintaan['status']=='disetujui'): ?>
          <span class="badge bg-success">Disetujui</span>
        <?php else: ?>
          <span class="badge bg-danger">Ditolak</span>
          <?php if(!empty($permintaan['alasan'])): ?>
            <br><small class="text-muted">Alasan: <?= esc($permintaan['alasan']) ?></small>
          <?php endif; ?>
        <?php endif; ?>
      </p>

      <h5 class="mt-4">Bahan Diminta</h5>
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Nama Bahan</th>
            <th>Jumlah Diminta</th>
          </tr>
        </thead>
        <tbody>
          <tbody>
          <?php if (!empty($details)): ?>
            <?php foreach ($details as $d): ?>
              <tr>
                <td><?= esc($d['nama_bahan']) ?></td>
                <td><?= esc($d['jumlah_diminta']) ?> <?= esc($d['satuan_bahan']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2" class="text-center text-muted p-3">
                No Materials Requested
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
