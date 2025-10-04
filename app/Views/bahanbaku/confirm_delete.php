<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4>Konfirmasi Hapus Bahan</h4>
      <p>Anda akan menghapus bahan baku berikut:</p>

      <ul>
        <li><strong>Name:</strong> <?= esc($bahan['nama']) ?></li>
        <li><strong>Category:</strong> <?= esc($bahan['kategori']) ?></li>
        <li><strong>Jumlah:</strong> <?= esc($bahan['jumlah']) ?> <?= esc($bahan['satuan']) ?></li>
        <li><strong>Tanggal Kadaluarsa:</strong> <?= esc($bahan['tanggal_kadaluarsa']) ?></li>
        <li><strong>Status:</strong> <?= esc($bahan['status']) ?></li>
      </ul>

      <?php if($bahan['status'] !== 'kadaluarsa'): ?>
        <div class="alert alert-danger">Bahan ini <strong>tidak</strong> berstatus <em>kadaluarsa</em>. Penghapusan ditolak.</div>
        <a href="/bahanbaku" class="btn btn-secondary">Kembali</a>
      <?php else: ?>
        <form method="post" action="/bahanbaku/delete/<?= $bahan['id'] ?>">
          <?= csrf_field() ?>
          <button type="submit" class="btn btn-danger">Ya, hapus</button>
          <a href="/bahanbaku" class="btn btn-secondary">Batal</a>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>
