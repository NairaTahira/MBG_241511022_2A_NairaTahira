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
      <form id="bahanbakuForm" method="post" action="/bahanbaku/store" novalidate>
        <div class="mb-3">
          <label class="form-label">Raw Material</label>
          <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required>
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
          <input type="date" class="form-control" name="tanggal_masuk" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Kadaluarsa	</label>
          <input type="date" class="form-control" name="tanggal_kadaluarsa" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status" required>
            <option value="tersedia">Tersedia</option>
            <option value="segera_kadaluarsa">Segera Kadaluarsa</option>
            <option value="kadaluarsa">Kadaluarsa</option>
            <option value="habis">Habis</option>
          </select>
        </div>


        <button class="btn btn-success">Save</button>
      </form>


    <script src="/js/mission4.js"></script>

    </div>
  </div>

</div>
