<div class="container mt-5">
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body bg-success text-white rounded">
      <h3><i class="bi bi-plus-circle"></i> Create Permintaan Bahan</h3>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form id="permintaanForm" method="post" action="/permintaan/store">
        <div class="mb-3">
          <label class="form-label">Tanggal Masak</label>
          <input type="date" name="tgl_masak" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Menu Makanan</label>
          <input type="text" name="menu_makan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Porsi</label>
          <input type="number" name="jumlah_porsi" class="form-control" required>
        </div>

        <h5>Daftar Bahan</h5>
        <table class="table table-bordered" id="bahanTable">
          <thead>
            <tr>
              <th>Nama Bahan</th>
              <th>Jumlah</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select name="bahan_id[]" class="form-select">
                  <?php foreach($bahan as $b): ?>
                    <option value="<?= $b['id'] ?>"><?= $b['nama'] ?> (stok: <?= $b['jumlah'] ?> <?= $b['satuan'] ?>)</option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td>
                <input type="number" name="jumlah_diminta[]" class="form-control jumlah-input" 
                      min="1" step="1" required 
                      oninput="if(this.value < 1) this.value = 1;">
              </td>
              <td><button type="button" class="btn btn-danger remove-row"><i class="bi bi-trash"></i></button></td>
            </tr>
          </tbody>
        </table>
        <button type="button" class="btn btn-secondary" id="addRow"><i class="bi bi-plus"></i> Tambah Bahan</button>
        <br><br>
        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Permintaan</button>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById("addRow").addEventListener("click", () => {
  let row = document.querySelector("#bahanTable tbody tr").cloneNode(true);
  row.querySelector("input").value = "";
  document.querySelector("#bahanTable tbody").appendChild(row);
});

// Remove row
document.addEventListener("click", e => {
  if (e.target.closest(".remove-row")) {
    e.target.closest("tr").remove();
  }
});

// Confirm dialog
document.getElementById("permintaanForm").addEventListener("submit", e => {
  if (!confirm("Yakin membuat permintaan bahan ini?")) {
    e.preventDefault();
  }
});
</script>
