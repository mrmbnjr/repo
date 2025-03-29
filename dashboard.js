// Side bar navigation
function toggleNav() {
  let sidebar = document.getElementById("mySidebar");
  let navbar = document.getElementById("navbar");
  let toggleBtn = document.getElementById("toggleBtn");

  if (sidebar.style.width === "250px") {
      sidebar.style.width = "0";
      navbar.style.marginLeft = "0";
  } else {
      sidebar.style.width = "250px";
      navbar.style.marginLeft = "250px";
  }
}
