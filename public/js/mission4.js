// ==============================
// Mission 4 - Frontend Enhancements
// ==============================

// ==============================
// Scope: Array of Objects
// ==============================
// Store student & courses data (JS demo)
let students = [];
let courses = [
  { id: 1, code: "21IF2014", name: "Linear Algebra", credits: 2 },
  { id: 2, code: "25IF2111", name: "Discrete Mathematics 2", credits: 3 },
  { id: 3, code: "25IF2112", name: "Introduction to Software Engineering", credits: 4 },
  { id: 4, code: "25IF2113", name: "Object-Oriented Programming", credits: 3 },
];

// ==============================
// DOM Helpers
// ==============================
function $(selector) { return document.querySelector(selector); }
function $all(selector) { return document.querySelectorAll(selector); }

// Render list of courses (JS demo mode)
function renderCourseCheckboxes() {
  const container = document.getElementById("courseCheckboxes");
  if (!container) return;
  container.innerHTML = "";

  courses.forEach(c => {
    const label = document.createElement("label");
    label.innerHTML = `
      <input type="checkbox" name="course_ids[]" value="${c.id}" data-credits="${c.credits}">
      ${c.code} - ${c.name} (${c.credits} Credits) <br>`;
    container.appendChild(label);
  });
}

// ==============================
// Menu Active State
// ==============================
$all("nav a").forEach(link => {
  link.addEventListener("click", function() {
    $all("nav a").forEach(l => l.classList.remove("active"));
    this.classList.add("active");
  });
});

// ==============================
// Form Validation + Enrollment (Student Demo Form)
// ==============================
function setupForm() {
  const form = document.getElementById("studentForm");
  if (!form) return;
  const totalEl = document.getElementById("totalCredits");

  // Calculate total credits when checkboxes change
  form.addEventListener("change", e => {
    if (e.target.name === "course_ids[]") {
      let total = 0;
      $all("input[name='course_ids[]']:checked").forEach(cb => {
        total += parseInt(cb.dataset.credits);
      });
      totalEl.textContent = total;
    }
  });

  // Validation & demo submit
  form.addEventListener("submit", e => {
    e.preventDefault();

    const name = $("#name");
    const nim = $("#nim");
    let errors = 0;

    // Validate name
    if (name.value.trim() === "") {
      $("#error-name").textContent = "Name required";
      name.classList.add("is-invalid");
      errors++;
    } else {
      $("#error-name").textContent = "";
      name.classList.remove("is-invalid");
    }

    // Validate NIM
    if (nim.value.trim() === "") {
      $("#error-nim").textContent = "Student ID (NIM) required";
      nim.classList.add("is-invalid");
      errors++;
    } else {
      $("#error-nim").textContent = "";
      nim.classList.remove("is-invalid");
    }

    if (errors > 0) return;

    // Get selected courses
    const selected = [];
    $all("input[name='course_ids[]']:checked").forEach(cb => {
      const course = courses.find(c => c.id == cb.value);
      if (course) selected.push(course);
    });

    // Prevent duplicate enrollments (unique NIM)
    if (students.some(s => s.nim === nim.value.trim())) {
      alert("Student with this NIM already enrolled!");
      return;
    }

    // Save demo data
    students.push({ name: name.value.trim(), nim: nim.value.trim(), courses: selected });

    form.reset();
    totalEl.textContent = "0";
    displayStudents();
  });
}

// ==============================
// Display Students (JS demo only)
// ==============================
function displayStudents() {
  const container = $("#studentsContainer");
  if (!container) return;
  container.innerHTML = "";
  students.forEach((s, index) => {
    const div = document.createElement("div");
    div.className = "student-card border p-2 mb-2";
    div.innerHTML = `
      <b>${s.name}</b> (${s.nim})<br>
      Courses: ${s.courses.map(c => c.name).join(", ") || "None"}<br>
      Total Credits: ${s.courses.reduce((sum,c)=>sum+c.credits,0)}
      <br><span class="delete-btn text-danger" style="cursor:pointer" onclick="deleteStudent(${index})">Delete</span>
    `;
    container.appendChild(div);
  });
}

// Delete confirmation (JS demo)
function deleteStudent(index) {
  const s = students[index];
  const total = s.courses.reduce((sum,c)=>sum+c.credits,0);
  if (confirm(`Delete ${s.name} (NIM: ${s.nim})?\nCourses: ${s.courses.map(c=>c.name).join(", ")}\nTotal Credits: ${total}`)) {
    students.splice(index, 1);
    displayStudents();
  }
}

// ==============================
// Async Demo (Sync vs Async)
// ==============================
setTimeout(() => {
  console.log("Async demo: Data could be fetched from API here.");
}, 2000);

// ==============================
// EXTRA: Form Validation (Admin - Course Form)
// & Delete Confirmation (Admin + Student)
// ==============================
document.addEventListener("DOMContentLoaded", () => {
  renderCourseCheckboxes();
  setupForm();

  // Validation for admin add/edit course form
  const courseForm = $("#courseForm");
  if (courseForm) {
    courseForm.addEventListener("submit", function(e) {
      let valid = true;
      ["course_code", "course_name", "credits"].forEach(field => {
        const input = $("#" + field);
        const error = $("#error-" + field);
        if (input && input.value.trim() === "") {
          if (error) error.textContent = field.replace("_", " ") + " required";
          input.classList.add("is-invalid");
          valid = false;
        } else {
          if (error) error.textContent = "";
          input.classList.remove("is-invalid");
        }
      });
      if (!valid) e.preventDefault();
    });
  }

  // Delete confirmation for admin & student
  $all(".delete-course, .delete-enroll").forEach(btn => {
    btn.addEventListener("click", function(e) {
      const course = this.dataset.course;
      const credits = this.dataset.credits;
      if (!confirm(`Delete course: ${course}\nCredits: ${credits}?\nThis action cannot be undone.`)) {
        e.preventDefault();
      }
    });
  });
});
