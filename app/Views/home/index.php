<div class="container mt-5">

  <!-- Welcome Card -->
  <div class="card shadow-lg border-0">
    <div class="card-body text-center py-5">
      <h2 class="fw-bold text-primary">
        <i class="bi bi-person-circle"></i> Welcome, <?= esc(session()->get('username')) ?>!
      </h2>
      <p class="text-muted">You are logged in as <b><?= esc(session()->get('role')) ?></b>.</p>
      <p class="lead">Use the navigation menu above or the quick links below to get started.</p>
    </div>
  </div>

  <!-- Quick Actions / Feature Highlights -->
  <div class="row mt-4">
    
    <?php if(session()->get('role') === 'gudang'): ?>
      <!-- Manage Courses -->
      <div class="col-md-6 mb-4">
        <div class="card text-center shadow-sm h-100 border-0">
          <div class="card-body">
            <i class="bi bi-journal-text display-4 text-primary"></i>
            <h5 class="mt-3">Kelola Bahan Baku</h5>
            <p class="text-muted">Modify, Create, or Stock Up the Raw Materials </p>
            <a href="/bahanbaku" class="btn btn-outline-primary btn-sm">Go</a>
          </div>
        </div>
      </div>
      <!-- Process Dapur Requests -->
      <div class="col-md-6 mb-4">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <i class="bi bi-clipboard-check display-4 text-success"></i>
            <h5 class="mt-3">Process Dapur Requests</h5>
            <p class="text-muted">ACC/ Reject material request.</p>
            <a href="/permintaan" class="btn btn-outline-success btn-sm">Go</a>
          </div>
        </div>
      </div>

    <?php elseif(session()->get('role') === 'dapur'): ?>
      <!-- Browse Courses -->
      <div class="col-md-6 mb-4">
        <div class="card text-center shadow-sm h-100 border-0">
          <div class="card-body">
            <i class="bi bi-book display-4 text-primary"></i>
            <h5 class="mt-3">Request Materials</h5>
            <p class="text-muted">Send out requested materials for cooking</p>
            <a href="/courses" class="btn btn-outline-primary btn-sm">Go</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <i class="bi bi-list-task display-4 text-success"></i>
            <h5 class="mt-3">View Request Status</h5>
            <p class="text-muted">Monitor the status of your request</p>
            <a href="/permintaan" class="btn btn-outline-success btn-sm">Monitor</a>
          </div>
        </div>
      </div>

      
    <?php endif; ?>
    

  </div>
</div>
