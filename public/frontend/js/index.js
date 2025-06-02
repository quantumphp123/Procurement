fetch("footer.html")
    .then(res => res.text())
    .then(data => {
      document.getElementById("footer-placeholder").innerHTML = data;
    });
fetch("header.html")
    .then(res => res.text())
    .then(data => {
      document.getElementById("header").innerHTML = data;

      // Now safely attach event listeners AFTER the header is loaded
      const menuBtn = document.getElementById('menu-btn');
      const mobileMenu = document.getElementById('mobile-menu');

      if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });
      }

      const toggleBtn = document.getElementById("login-toggle-btn");
      const loginBox = document.getElementById("login-box");

      if (toggleBtn && loginBox) {
        toggleBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          loginBox.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
          const isClickInside = toggleBtn.contains(e.target) || loginBox.contains(e.target);
          if (!isClickInside) {
            loginBox.classList.add("hidden");
          }
        });
      }
    });

const select = document.getElementById("sort");

  select.addEventListener("change", function () {
    const selectedOption = select.options[select.selectedIndex];
    const color = selectedOption.getAttribute("data-color");

    select.classList.remove("text-white", "text-black");
    if (color === "white") {
      select.classList.add("text-white");
    } else {
      select.classList.add("text-black");
    }
  });

  // Set initial color
  select.dispatchEvent(new Event("change"));
  

  // Get current file name or default to index.html
  let currentPage = window.location.pathname.split("/").pop();
  if (!currentPage) currentPage = "index.html";
    console.log("🔍 Current page:", currentPage);

  // Select all nav links
  const links = document.querySelectorAll("nav .nav-link");
  console.log("🔗 Links found:", links.length);

  links.forEach(link => {
    const linkPage = link.getAttribute("href");
    console.log("🧪 Checking link:", linkPage);

    if (linkPage === currentPage) {
      console.log("✅ Match found:", linkPage);
      link.classList.remove("text-gray-500");
      link.classList.add("text-blue-600", "font-semibold");
    } else {
      link.classList.remove("text-blue-600", "font-semibold");
      link.classList.add("text-gray-500");
    }
  });
  
document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("login-toggle-btn");
  const loginBox = document.getElementById("login-box");

  if (!toggleBtn || !loginBox) return;

  const showLoginBox = () => loginBox.classList.remove("hidden");
  const hideLoginBox = () => loginBox.classList.add("hidden");

  toggleBtn.addEventListener("mouseenter", showLoginBox);
  loginBox.addEventListener("mouseenter", showLoginBox);

  toggleBtn.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!loginBox.matches(":hover")) hideLoginBox();
    }, 100);
  });

  loginBox.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!toggleBtn.matches(":hover")) hideLoginBox();
    }, 100);
  });
});
