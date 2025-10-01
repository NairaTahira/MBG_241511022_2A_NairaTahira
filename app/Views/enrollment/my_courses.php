<div class="container mt-5">

  <!-- Page Header -->
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center text-white rounded"
         style="background: linear-gradient(90deg, #4b6cb7);">
      <h4 class="mb-0"><i class="bi bi-journal-bookmark"></i> My Courses </h4>
    </div>
  </div>

  <!-- My Courses Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead style="background: linear-gradient(90deg, #4b6cb7, #182848); color: #fff;">
          <tr>
            <th>#</th>
            <th>COURSE CODE</th>
            <th>COURSE</th>
            <th>CREDITS</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($courses)): ?>
            <?php 
              $totalSKS = 0; // counter
              foreach ($courses as $i => $c): 
                $totalSKS += $c['credits']; 
            ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td class="fw-bold text-primary"><?= esc($c['course_code']) ?></td>
                <td><?= esc($c['course_name']) ?></td>
                <td><span class="badge bg-primary"><?= esc($c['credits']) ?></span></td>
                <td class="text-center">
                </td>
              </tr>
            <?php endforeach; ?>

            <!-- Total SKS Row -->
            <tr>
              <td colspan="5" class="text-end pe-4">
                <strong>Total SKS: <?= $totalSKS ?></strong>
              </td>
            </tr>

          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-4">
                <i class="bi bi-exclamation-circle"></i> Empty, No Courses Have Been Enrolled!
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- JS -->
<script src="/js/enrollment.js"></script>
