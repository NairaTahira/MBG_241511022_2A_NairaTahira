<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-primary text-white rounded">
      <h3 class="mb-0"><i class="bi bi-plus-circle"></i> Add Bahan baku</h3>
    </div>
  </div>

  <!-- Add Course Form -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form id="courseForm" method="post" action="/courses/store" novalidate>
        <div class="mb-3">
          <label class="form-label">Bahan Baku</label>
          <input type="text" class="form-control" name="nama" id="nama" required>
          <div class="invalid-feedback">Bahan Baku is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Category</label>
          <input type="text" class="form-control" name="kategori" id="kategori" required>
          <div class="invalid-feedback">Category is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" name="jumlah" id="jumlah" required>
          <div class="invalid-feedback">Total is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Satuan</label>
          <input type="text" class="form-control" name="satuan" id="satuan" required>
          <div class="invalid-feedback">Satuan is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Masuk	</label>
          <input type="text" class="form-control" name="tanggal_masuk" id="tanggal_masuk" required>
          <div class="invalid-feedback">Entry Date is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Kadaluarsa	</label>
          <input type="text" class="form-control" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" required>
          <div class="invalid-feedback">Expiry Date is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <input type="text" class="form-control" name="status" id="status" required>
          <div class="invalid-feedback">Status is required.</div>
        </div>

        <div class="mb-3">
          <label class="form-label">Created</label>
          <input type="text" class="form-control" name="created_at" id="created_at" required>
          <div class="invalid-feedback">Created Date is required.</div>
        </div>

        <button class="btn btn-success">Save</button>
      </form>


    <script src="/js/mission4.js"></script>

    </div>
  </div>

</div>
