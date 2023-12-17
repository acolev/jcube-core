  changeTheme(localStorage.getItem("data-topbar") || 'light');

function changeTheme(theme = 'light') {
  document.documentElement.setAttribute("data-bs-theme", theme)
}