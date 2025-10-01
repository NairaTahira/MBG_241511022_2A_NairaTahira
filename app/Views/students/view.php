<div class="container mt-5">

  <!-- Student Detail -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded">
      <h4 class="mb-0"><i class="bi bi-person"></i> Student Detail</h4>
    </div>
    <div class="card-body">
      <p><b>Name:</b> <?= esc($student['name']) ?></p>
      <p><b>NIM:</b> <?= esc($student['nim']) ?></p>
      <p><b>Email:</b> <?= esc($student['email']) ?></p>
    </div>
  </div>

  <!-- Enrolled Courses -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <div class="p-3 bg-success text-white rounded-top">
        <h5 class="mb-0"><i class="bi bi-journal-bookmark"></i> Enrolled Courses</h5>
      </div>
      <table class="table table-hover mb-0">
        <thead style="background: linear-gradient(90deg, #4b6cb7, #182848); color: #fff;">
          <tr>
            <th>#</th>
            <th>Course Code</th>
            <th>Course Title</th>
            <th>Credits</th>
            <?php if(session()->get('role') === 'admin'): ?>
              <th class="text-center">Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $i => $c): ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($c['course_code']) ?></td>
                <td><?= esc($c['course_name']) ?></td>
                <td><span class="badge bg-success"><?= esc($c['credits']) ?></span></td>
                <?php if(session()->get('role') === 'admin'): ?>
                  <td class="text-center">
                    <a href="/takes/delete/<?= $c['enrollment_id'] ?>"
                    onclick="return confirm('Remove this enrollment?')"
                    class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                    </a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="<?= session()->get('role') === 'admin' ? 5 : 4 ?>" class="text-center text-muted py-4">
                <i class="bi bi-exclamation-circle"></i> No courses enrolled
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
