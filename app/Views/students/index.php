<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h2 class="mb-0"><i class="bi bi-people"></i> Students</h2>
      <?php if(session()->get('role')==='admin'): ?>
        <a href="/students/create" class="btn btn-light text-primary fw-bold shadow-sm">
          <i class="bi bi-person-plus"></i> Add Student
        </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Students Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead style="background: linear-gradient(90deg, #4b6cb7, #182848); color: #fff;">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>NIM</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($students)): ?>
            <?php foreach ($students as $i => $s): ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($s['name']) ?></td>
                <td><?= esc($s['nim']) ?></td>
                <td><?= esc($s['email']) ?></td>
                <td class="text-center">
                  <!-- Always visible -->
                  <a href="/students/view/<?= $s['id'] ?>" class="btn btn-info btn-sm">
                    <i class="bi bi-journal-text"></i> View Courses
                  </a>

                  <?php if(session()->get('role')==='admin'): ?>
                    <!-- Admin-only buttons -->
                    <a href="/students/edit/<?= $s['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="/students/delete/<?= $s['id'] ?>" 
                       class="btn btn-danger btn-sm delete-student"
                       data-student="<?= esc($s['name']) ?>">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted p-3">
                No students found
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Keep shared JavaScript -->
<script src="/js/mission4.js"></script>

<script>
// Confirmation for deleting students (similar to delete-course)
document.querySelectorAll(".delete-student").forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        let student = this.dataset.student;
        if (confirm(`Are you sure you want to delete student "${student}"?`)) {
            window.location.href = this.getAttribute("href");
        }
    });
});
</script>
