document.addEventListener("DOMContentLoaded", () => {
  // ===== Delete/Drop Confirmation =====
  document.querySelectorAll(".delete-enroll").forEach(btn => {
    btn.addEventListener("click", function (e) {
      const course = this.dataset.course;
      const credits = this.dataset.credits;
      if (!confirm(`Drop course: ${course}\nCredits: ${credits}?`)) {
        e.preventDefault();
      }
    });
  });

  // ===== Example Async with setTimeout =====
  setTimeout(() => {
    console.log("Async check: Enrollment UI loaded");
  }, 1000);
});
