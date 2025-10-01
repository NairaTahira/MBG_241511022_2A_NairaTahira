document.addEventListener("DOMContentLoaded", () => {
  // ===== Validation for Create/Edit Course Form =====
  const courseForm = document.getElementById("courseForm");
  if (courseForm) {
    courseForm.addEventListener("submit", function (e) {
      let valid = true;
      ["course_code", "course_name", "credits"].forEach(field => {
        const input = document.getElementById(field);
        if (input.value.trim() === "") {
          input.classList.add("is-invalid");
          valid = false;
        } else {
          input.classList.remove("is-invalid");
        }
      });
      if (!valid) {
        e.preventDefault();
        alert("Please fill in all required fields!");
      }
    });
  }

  // ===== Delete Confirmation =====
  document.querySelectorAll(".delete-course").forEach(btn => {
    btn.addEventListener("click", function (e) {
      const course = this.dataset.course;
      const credits = this.dataset.credits;
      if (!confirm(`Delete course: ${course}\nCredits: ${credits}?`)) {
        e.preventDefault();
      }
    });
  });
});
