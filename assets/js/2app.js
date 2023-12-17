$(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
  document.getElementById("scrollbar").classList.add("h-100")
  new SimpleBar(document.getElementById('scrollbar'));

  window.onscroll = function () {
    const mybutton = document.getElementById("back-to-top");
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ?
      mybutton.style.display = "block" :
      mybutton.style.display = "none"
  };
  document.querySelector("#topnav-hamburger-icon").addEventListener("click", toggleMenu)
  document.querySelector(".light-dark-mode").addEventListener("click", () => {
    const theme = localStorage.getItem("data-topbar") || 'light'
    if (theme === 'light') {
      localStorage.setItem("data-topbar", 'dark')
      changeTheme('dark')
    } else {
      localStorage.setItem("data-topbar", 'light')
      changeTheme('light')
    }
  });
  document.querySelector("[data-toggle=\"fullscreen\"]").addEventListener("click", () => {
    if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
    } else if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  });
  function toggleMenu() {
    var e = document.documentElement.clientWidth;
    767 < e && document.querySelector(".hamburger-icon").classList.toggle("open"), "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")), "vertical" === document.documentElement.getAttribute("data-layout") && (e <= 1025 && 767 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm")) : 1025 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg")) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))), "semibox" === document.documentElement.getAttribute("data-layout") && (767 < e ? "show" == document.documentElement.getAttribute("data-sidebar-visibility") ? "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg") : (document.getElementById("sidebar-visibility-show").click(), document.documentElement.setAttribute("data-sidebar-size", document.documentElement.getAttribute("data-sidebar-size"))) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))), "twocolumn" == document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : document.body.classList.add("twocolumn-panel"))
  }

  /**
   * Generate two column menu
   */
  function twoColumnMenuGenerate() {
    var isTwoColumn = document.documentElement.getAttribute("data-layout");
    var isValues = sessionStorage.getItem("defaultAttribute");
    var defaultValues = JSON.parse(isValues);

    if (defaultValues && (isTwoColumn == "twocolumn" || defaultValues["data-layout"] == "twocolumn")) {
      if (document.querySelector(".navbar-menu")) {
        document.querySelector(".navbar-menu").innerHTML = navbarMenuHTML;
      }
      var ul = document.createElement("ul");
      ul.innerHTML = '<a href="#" class="logo"><img src="build/images/logo-sm.png" alt="" height="22"></a>';
      Array.from(document.getElementById("navbar-nav").querySelectorAll(".menu-link")).forEach(function (item) {
        ul.className = "twocolumn-iconview";
        var li = document.createElement("li");
        var a = item;
        a.querySelectorAll("span").forEach(function (element) {
          element.classList.add("d-none");
        });

        if (item.parentElement.classList.contains("twocolumn-item-show")) {
          item.classList.add("active");
        }
        li.appendChild(a);
        ul.appendChild(li);

        a.classList.contains("nav-link") ? a.classList.replace("nav-link", "nav-icon") : "";
        a.classList.remove("collapsed", "menu-link");
      });
      var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
      currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
      if (currentPath) {
        // navbar-nav
        var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');

        if (a) {
          var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
          if (parentCollapseDiv) {
            parentCollapseDiv.classList.add("show");
            parentCollapseDiv.parentElement.children[0].classList.add("active");
            parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
            if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
              parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
              if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
                parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
              if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show");
                if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) {
                  parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
                }
              }
            }
          }
        }
      }
      // add all sidebar menu icons
      document.getElementById("two-column-menu").innerHTML = ul.outerHTML;

      // show submenu on sidebar menu click
      Array.from(document.querySelector("#two-column-menu ul").querySelectorAll("li a")).forEach(function (element) {
        var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
        currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
        element.addEventListener("click", function (e) {
          if (!(currentPath == "/" + element.getAttribute("href") && !element.getAttribute("data-bs-toggle")))
            document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : "";
          document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide");
          document.querySelector(".hamburger-icon").classList.remove("open");
          if ((e.target && e.target.matches("a.nav-icon")) || (e.target && e.target.matches("i"))) {
            if (document.querySelector("#two-column-menu ul .nav-icon.active") !== null)
              document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active");
            e.target.matches("i") ? e.target.closest("a").classList.add("active") : e.target.classList.add("active");

            var twoColumnItem = document.getElementsByClassName("twocolumn-item-show");

            twoColumnItem.length > 0 ? twoColumnItem[0].classList.remove("twocolumn-item-show") : "";

            var currentMenu = e.target.matches("i") ? e.target.closest("a") : e.target;
            var childMenusId = currentMenu.getAttribute("href").slice(1);
            if (document.getElementById(childMenusId))
              document.getElementById(childMenusId).parentElement.classList.add("twocolumn-item-show");
          }
        });

        // add active class to the sidebar menu icon who has direct link
        if (currentPath == "/" + element.getAttribute("href") && !element.getAttribute("data-bs-toggle")) {
          element.classList.add("active");
          document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide");
          if (document.querySelector(".hamburger-icon")) {
            document.querySelector(".hamburger-icon").classList.add("open");
          }
        }
      });

      var currentLayout = document.documentElement.getAttribute("data-layout");
      if (currentLayout !== "horizontal") {
        var simpleBar = new SimpleBar(document.getElementById("navbar-nav"));
        if (simpleBar) simpleBar.getContentElement();

        var simpleBar1 = new SimpleBar(
          document.getElementsByClassName("twocolumn-iconview")[0]
        );
        if (simpleBar1) simpleBar1.getContentElement();
      }
    }
  }

  // Two-column menu activation
  function initTwoColumnActiveMenu() {
    feather.replace();
    // two column sidebar active js
    var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
    currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
    if (currentPath) {
      if (document.body.className == "twocolumn-panel") {
        document.getElementById("two-column-menu").querySelector('[href="' + currentPath + '"]').classList.add("active");
      }
      // navbar-nav
      var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');
      if (a) {
        a.classList.add("active");
        var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
        if (parentCollapseDiv && parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
          parentCollapseDiv.classList.add("show");
          parentCollapseDiv.parentElement.children[0].classList.add("active");
          parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show");
          if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
            var menuIdSub = parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").getAttribute("id");
            parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show");
            parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.remove("twocolumn-item-show");
            if (document.getElementById("two-column-menu").querySelector('[href="#' + menuIdSub + '"]'))
              document.getElementById("two-column-menu").querySelector('[href="#' + menuIdSub + '"]').classList.add("active");
          }
          var menuId = parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown").getAttribute("id");
          if (document.getElementById("two-column-menu").querySelector('[href="#' + menuId + '"]'))
            document.getElementById("two-column-menu").querySelector('[href="#' + menuId + '"]').classList.add("active");
        } else {
          a.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show");
          var menuId = parentCollapseDiv.getAttribute("id");
          if (document.getElementById("two-column-menu").querySelector('[href="#' + menuId + '"]'))
            document.getElementById("two-column-menu").querySelector('[href="#' + menuId + '"]').classList.add("active");
        }
      } else {
        document.body.classList.add("twocolumn-panel");
      }
    }
  }

  // two-column sidebar active js
  function initActiveMenu() {
    var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
    currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
    if (currentPath) {
      // navbar-nav
      var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');
      if (a) {
        a.classList.add("active");
        var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
        if (parentCollapseDiv) {
          parentCollapseDiv.classList.add("show");
          parentCollapseDiv.parentElement.children[0].classList.add("active");
          parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
          if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
            parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
            if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
              parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");

            if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
              parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show");
              if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) {

                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
                if ((document.documentElement.getAttribute("data-layout") == "horizontal") && parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse")) {
                  parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")
                }
              }
            }
          }
        }
      }
    }
  }

  function twoColumnMenuGenerate() {
    var isTwoColumn = document.documentElement.getAttribute("data-layout");
    var isValues = sessionStorage.getItem("defaultAttribute");
    var defaultValues = JSON.parse(isValues);

    if (defaultValues && (isTwoColumn == "twocolumn" || defaultValues["data-layout"] == "twocolumn")) {
      if (document.querySelector(".navbar-menu")) {
        document.querySelector(".navbar-menu").innerHTML = navbarMenuHTML;
      }
      var ul = document.createElement("ul");
      ul.innerHTML = '<a href="#" class="logo"><img src="build/images/logo-sm.png" alt="" height="22"></a>';
      Array.from(document.getElementById("navbar-nav").querySelectorAll(".menu-link")).forEach(function (item) {
        ul.className = "twocolumn-iconview";
        var li = document.createElement("li");
        var a = item;
        a.querySelectorAll("span").forEach(function (element) {
          element.classList.add("d-none");
        });

        if (item.parentElement.classList.contains("twocolumn-item-show")) {
          item.classList.add("active");
        }
        li.appendChild(a);
        ul.appendChild(li);

        a.classList.contains("nav-link") ? a.classList.replace("nav-link", "nav-icon") : "";
        a.classList.remove("collapsed", "menu-link");
      });
      var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
      currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
      if (currentPath) {
        // navbar-nav
        var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');

        if (a) {
          var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
          if (parentCollapseDiv) {
            parentCollapseDiv.classList.add("show");
            parentCollapseDiv.parentElement.children[0].classList.add("active");
            parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
            if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
              parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
              if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
                parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
              if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show");
                if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) {
                  parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
                }
              }
            }
          }
        }
      }
      // add all sidebar menu icons
      document.getElementById("two-column-menu").innerHTML = ul.outerHTML;

      // show submenu on sidebar menu click
      Array.from(document.querySelector("#two-column-menu ul").querySelectorAll("li a")).forEach(function (element) {
        var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
        currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
        element.addEventListener("click", function (e) {
          if (!(currentPath == "/" + element.getAttribute("href") && !element.getAttribute("data-bs-toggle")))
            document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : "";
          document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide");
          document.querySelector(".hamburger-icon").classList.remove("open");
          if ((e.target && e.target.matches("a.nav-icon")) || (e.target && e.target.matches("i"))) {
            if (document.querySelector("#two-column-menu ul .nav-icon.active") !== null)
              document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active");
            e.target.matches("i") ? e.target.closest("a").classList.add("active") : e.target.classList.add("active");

            var twoColumnItem = document.getElementsByClassName("twocolumn-item-show");

            twoColumnItem.length > 0 ? twoColumnItem[0].classList.remove("twocolumn-item-show") : "";

            var currentMenu = e.target.matches("i") ? e.target.closest("a") : e.target;
            var childMenusId = currentMenu.getAttribute("href").slice(1);
            if (document.getElementById(childMenusId))
              document.getElementById(childMenusId).parentElement.classList.add("twocolumn-item-show");
          }
        });

        // add active class to the sidebar menu icon who has direct link
        if (currentPath == "/" + element.getAttribute("href") && !element.getAttribute("data-bs-toggle")) {
          element.classList.add("active");
          document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide");
          if (document.querySelector(".hamburger-icon")) {
            document.querySelector(".hamburger-icon").classList.add("open");
          }
        }
      });

      var currentLayout = document.documentElement.getAttribute("data-layout");
      if (currentLayout !== "horizontal") {
        var simpleBar = new SimpleBar(document.getElementById("navbar-nav"));
        if (simpleBar) simpleBar.getContentElement();

        var simpleBar1 = new SimpleBar(
          document.getElementsByClassName("twocolumn-iconview")[0]
        );
        if (simpleBar1) simpleBar1.getContentElement();
      }
    }
  }

  function init() {
    twoColumnMenuGenerate();
  }

  init();
});

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

function fillForm(el, cb) {
  const target = el.dataset.target;
  const objId = document.querySelector(el.dataset.form);
  const obj = JSON.parse(objId.innerText);

  for (const key in obj) {
    const input = document.querySelectorAll(`${target} [name="${key}"],  ${target} [name="${key}[]"]`);
    input.forEach(elm => {
      switch (elm.tagName) {
        case "SELECT":
          $(elm).val(obj[key]).trigger('change');
          break
        case "INPUT":
          if (elm.getAttribute('type') === 'checkbox') {
            elm.checked = +obj[key] === 1;
          } else {
            if (elm.dataset.fill !== 'none')
              elm.value = obj[key];
          }
          break
      }
    })
  }
  cb(obj);
}

$(document).on('click', '.short-codes', function () {
  var text = $(this).text();
  var vInput = document.createElement("input");
  vInput.value = text;
  document.body.appendChild(vInput);
  vInput.select();
  document.execCommand("copy");
  document.body.removeChild(vInput);
  $(this).addClass('copied');
  setTimeout(() => {
    $(this).removeClass('copied');
  }, 1000);
});

// select-2 init
$('.select2-basic').select2();
$('.select2-multi-select').select2();
$(".select2-auto-tokenize").select2({
  tags: true,
  tokenSeparators: [',']
});


function genTrx(length = 12, characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789') {
  return Array.from({ length }, () => characters.charAt(Math.floor(Math.random() * characters.length))).join('');
}



