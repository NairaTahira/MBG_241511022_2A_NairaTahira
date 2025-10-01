document.addEventListener("DOMContentLoaded", () => {
  const authForm = document.querySelector("form");
  if (authForm) {
    authForm.addEventListener("submit", function (e) {
      let valid = true;
      const username = document.getElementById("username");
      const password = document.getElementById("password");

      if (username.value.trim() === "") {
        username.classList.add("is-invalid");
        valid = false;
      } else {
        username.classList.remove("is-invalid");
      }

      if (password.value.trim().length < 8) {
        password.classList.add("is-invalid");
        valid = false;
      } else {
        password.classList.remove("is-invalid");
      }

      if (!valid) {
        e.preventDefault();
        alert("Please fill in all fields correctly!");
      }
    });
  }
});
