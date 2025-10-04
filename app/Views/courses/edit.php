<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-warning text-dark rounded">
      <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Course</h3>
    </div>
  </div>

  <!-- Edit Course Form -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form id="editCourseForm" method="post" action="/courses/update/<?= $course['id'] ?>" novalidate>
        <div class="mb-3">
          
          <label class="form-label">Bahan Baku</label>
          <input type="text" class="form-control" name="nama" 
                value="<?= esc($course['nama']) ?>" required>
          <div class="invalid-feedback">Bahan Baku is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Category</label>
          <input type="text" class="form-control" name="kategori" 
                value="<?= esc($course['kategori']) ?>" required>
          <div class="invalid-feedback">Category is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" name="jumlah" 
                value="<?= esc($course['jumlah']) ?>" required>
          <div class="invalid-feedback">Total is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Satuan</label>
          <input type="text" class="form-control" name="satuan" 
                value="<?= esc($course['satuan']) ?>" required>
          <div class="invalid-feedback">Satuan is required.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Masuk</label>
          <input type="text" class="form-control" name="tanggal_masuk" 
                value="<?= esc($course['tanggal_masuk']) ?>" required>
          <div class="invalid-feedback">Entry Date is required.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Kadaluarsa</label>
          <input type="text" class="form-control" name="tanggal_kadaluarsa" 
                value="<?= esc($course['tanggal_kadaluarsa']) ?>" required>
          <div class="invalid-feedback">Expiry Date is required.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <input type="text" class="form-control" name="status" 
                value="<?= esc($course['status']) ?>" required>
          <div class="invalid-feedback">Status is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Created</label>
          <input type="text" class="form-control" name="created_at" 
                value="<?= esc($course['created_at']) ?>" required>
          <div class="invalid-feedback">Created Date is required.</div>
        </div>

        <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
        <a href="/courses" class="btn btn-secondary">Back</a>
      </form>

    </div>
  </div>

</div>
