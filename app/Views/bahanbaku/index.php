<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h2 class="mb-0"><i class="bi bi-box-seam"></i> Bahan Baku</h2>
      <?php if(session()->get('role')==='gudang'): ?>
        <a href="/bahanbaku/create" class="btn btn-light text-primary fw-bold shadow-sm">
          <i class="bi bi-plus-circle"></i> Add Bahan Baku
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Bahan Baku Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead style="background: linear-gradient(90deg, #4b6cb7, #182848); color: #fff;">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Status</th>
            <th>Created</th>
            <?php if(session()->get('role')==='gudang'): ?>
              <th class="text-center">Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($bahan_baku)): ?>
            <?php foreach ($bahan_baku as $i => $b): ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($b['nama']) ?></td>
                <td><?= esc($b['kategori']) ?></td> 
                <td><span class="badge bg-success"><?= esc($b['jumlah']) ?></span></td>
                <td><?= esc($b['satuan']) ?></td> 
                <td><?= esc($b['tanggal_masuk']) ?></td> 
                <td><?= esc($b['tanggal_kadaluarsa']) ?></td> 
                <td>
                  <?php if($b['status']==='tersedia'): ?>
                    <span class="badge bg-success">Tersedia</span>
                  <?php elseif($b['status']==='segera_kadaluarsa'): ?>
                    <span class="badge bg-warning text-dark">Segera Kadaluarsa</span>
                  <?php elseif($b['status']==='kadaluarsa'): ?>
                    <span class="badge bg-danger">Kadaluarsa</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">Habis</span>
                  <?php endif; ?>
                </td>
                <td><?= esc($b['created_at']) ?></td> 

                <?php if(session()->get('role')==='gudang'): ?>
                  <td class="text-center">
                    <a href="/bahanbaku/edit/<?= $b['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="/bahanbaku/delete/<?= $b['id'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus bahan ini?')">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="10" class="text-center text-muted p-3">
                Tidak ada data bahan baku
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- JS for credits counter -->
<script src="/js/mission4.js"></script>

<script>
document.getElementById("enrollForm")?.addEventListener("submit", async function(e) {
    e.preventDefault();

    let form = e.target;
    let formData = new FormData(form);

    let response = await fetch(form.action, {
        method: "POST",
        body: formData,
        headers: { "X-Requested-With": "XMLHttpRequest" }
    });

    let result = await response.json();

    if (result.status === "success") {
        // Update DOM without refresh
        result.added.forEach(cid => {
            let checkbox = document.querySelector(`input[value="${cid}"]`);
            if (checkbox) {
                let td = checkbox.closest("td");
                td.innerHTML = `<span class="text-muted"><i class="bi bi-check-circle"></i> Already Enrolled</span>`;
            }
        });

        alert(result.message);
    }
});
</script>

