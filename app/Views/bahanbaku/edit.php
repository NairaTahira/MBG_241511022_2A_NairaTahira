<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-warning text-dark rounded">
      <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Raw Material</h3>
    </div>
  </div>

  <!-- Edit Course Form -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form id="editCourseForm" method="post" action="/bahanbaku/update/<?= $bahan['id'] ?>" novalidate>
        <div class="mb-3">
          
          <label class="form-label">Raw Material</label>
          <input type="text" class="form-control" name="nama" 
                value="<?= esc($bahan['nama']) ?>" required>
          <div class="invalid-feedback">Bahan Baku is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Category</label>
          <input type="text" class="form-control" name="kategori" 
                value="<?= esc($bahan['kategori']) ?>" required>
          <div class="invalid-feedback">Category is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" name="jumlah" 
                value="<?= esc($bahan['jumlah']) ?>" required>
          <div class="invalid-feedback">Total is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Satuan</label>
          <input type="text" class="form-control" name="satuan" 
                value="<?= esc($bahan['satuan']) ?>" required>
          <div class="invalid-feedback">Satuan is required.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Masuk</label>
          <input type="date" class="form-control" name="tanggal_masuk" 
                value="<?= esc($bahan['tanggal_masuk']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Kadaluarsa</label>
          <input type="date" class="form-control" name="tanggal_kadaluarsa" 
                value="<?= esc($bahan['tanggal_kadaluarsa']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status" required>
            <option value="tersedia" <?= $bahan['status']=='tersedia'?'selected':'' ?>>Tersedia</option>
            <option value="segera_kadaluarsa" <?= $bahan['status']=='segera_kadaluarsa'?'selected':'' ?>>Segera Kadaluarsa</option>
            <option value="kadaluarsa" <?= $bahan['status']=='kadaluarsa'?'selected':'' ?>>Kadaluarsa</option>
            <option value="habis" <?= $bahan['status']=='habis'?'selected':'' ?>>Habis</option>
          </select>
        </div>

        <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
        <a href="/bahanbaku" class="btn btn-secondary">Back</a>
      </form>

    </div>
  </div>

</div>
