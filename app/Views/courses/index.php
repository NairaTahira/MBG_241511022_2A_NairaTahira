<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h2 class="mb-0"><i class="bi bi-journal-text"></i> Bahan Baku</h2>
      <?php if(session()->get('role')==='admin'): ?>
        <a href="/courses/create" class="btn btn-light text-primary fw-bold shadow-sm">
          <i class="bi bi-plus-circle"></i> Add Bahan Baku
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Courses Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <?php if(session()->get('role')==='student'): ?>
        <form method="post" action="/enroll/submit" id="enrollForm">
      <?php endif; ?>

      <table class="table table-hover mb-0">
        <thead style="background: linear-gradient(90deg, #4b6cb7, #182848); color: #fff;">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Status</th>
            <th>Created</th>

            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($courses)): ?>
            <?php foreach ($courses as $i => $c): ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($c['nama']) ?></td>
                <td><?= esc($c['kategori']) ?></td> 
                <td><span class="badge bg-success"><?= esc($c['jumlah']) ?></span></td>
                <td><?= esc($c['satuan']) ?></td> 
                <td><?= esc($c['tanggal_masuk']) ?></td> 
                <td><?= esc($c['tanggal_kadaluarsa']) ?></td> 
                <td><?= esc($c['status']) ?></td> 
                <td><?= esc($c['created_at']) ?></td> 

                <td class="text-center">
                  <?php if(session()->get('role')==='admin'): ?>
                    <!-- Admin Buttons -->
                    <a href="/courses/edit/<?= $c['nama'] ?>" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="/courses/delete/<?= $c['nama'] ?>" 
                       class="btn btn-danger btn-sm delete-course"
                       data-nama="<?= esc($c['nama']) ?>"
                       data-kategori="<?= esc($c['kategori']) ?>">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  <?php elseif(session()->get('role')==='student'): ?>
                    <!-- Student Check / Badge -->
                    <?php if (in_array($c['id'], $enrolledIds)): ?>
                      <span class="badge bg-secondary">
                        <i class="bi bi-check-circle"></i> Already Enrolled
                      </span>
                    <?php else: ?>
                      <input type="checkbox" name="course_ids[]" value="<?= $c['id'] ?>">
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

            <?php if(session()->get('role')==='student'): ?>
              <!-- Total SKS & Submit Button only for Students -->
              <tr>
                <td colspan="5" class="text-center">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Enroll Selected
                  </button>
                </td>
              </tr>
            <?php endif; ?>

          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted p-3">
                No courses available
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <?php if(session()->get('role')==='student'): ?>
        </form>
      <?php endif; ?>
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

