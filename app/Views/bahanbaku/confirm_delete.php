<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4>Confirm Deleting Material</h4>
      <p>You will remove the following raw materials:</p>

      <ul>
        <li><strong>Name:</strong> <?= esc($bahan['nama']) ?></li>
        <li><strong>Category:</strong> <?= esc($bahan['kategori']) ?></li>
        <li><strong>Jumlah:</strong> <?= esc($bahan['jumlah']) ?> <?= esc($bahan['satuan']) ?></li>
        <li><strong>Tanggal Kadaluarsa:</strong> <?= esc($bahan['tanggal_kadaluarsa']) ?></li>
        <li><strong>Status:</strong> <?= esc($bahan['status']) ?></li>
      </ul>

      <?php if($bahan['status'] !== 'kadaluarsa'): ?>
        <div class="alert alert-danger">This material <strong>is not</strong> <em>expired</em>. Erasing Rejected.</div>
        <a href="/bahanbaku" class="btn btn-secondary">Return</a>
      <?php else: ?>
        <form method="post" action="/bahanbaku/delete/<?= $bahan['id'] ?>">
          <?= csrf_field() ?>
          <button type="submit" class="btn btn-danger">Yes, erase</button>
          <a href="/bahanbaku" class="btn btn-secondary">Cancel</a>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>
