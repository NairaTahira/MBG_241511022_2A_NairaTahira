<div class="container mt-5">
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-info text-white rounded">
      <h3><i class="bi bi-eye"></i> Detail Permintaan</h3>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <p><b>Tanggal Masak:</b> <?= esc($permintaan['tgl_masak']) ?></p>
      <p><b>Menu:</b> <?= esc($permintaan['menu_makan']) ?></p>
      <p><b>Jumlah Porsi:</b> <?= esc($permintaan['jumlah_porsi']) ?></p>
      <p><b>Status:</b> <?= esc($permintaan['status']) ?></p>

      <h5>Bahan Diminta</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama Bahan</th>
            <th>Jumlah Diminta</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($details as $d): ?>
            <tr>
              <td><?= esc($d['nama']) ?></td>
              <td><?= esc($d['jumlah_diminta']) ?> <?= esc($d['satuan']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
