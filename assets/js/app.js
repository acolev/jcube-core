$(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();

  document.getElementById("scrollbar").classList.add("h-100")
  new SimpleBar(document.getElementById('scrollbar'));
})

// select-2 init
$('.select2-basic').select2();
$('.select2-multi-select').select2();
$(".select2-auto-tokenize").select2({
  tags: true,
  tokenSeparators: [',']
});


var mybutton = document.getElementById("back-to-top");

function scrollFunction() {
  100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? mybutton.style.display = "block" : mybutton.style.display = "none"
}

function topFunction() {
  document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}

mybutton && (window.onscroll = function () {
  scrollFunction()
});


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

document.getElementById("topnav-hamburger-icon").addEventListener("click", toggleMenu)

function toggleMenu() {
  var e = document.documentElement.clientWidth;
  767 < e && document.querySelector(".hamburger-icon").classList.toggle("open"), "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")), "vertical" === document.documentElement.getAttribute("data-layout") && (e <= 1025 && 767 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm")) : 1025 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg")) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))), "semibox" === document.documentElement.getAttribute("data-layout") && (767 < e ? "show" == document.documentElement.getAttribute("data-sidebar-visibility") ? "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg") : (document.getElementById("sidebar-visibility-show").click(), document.documentElement.setAttribute("data-sidebar-size", document.documentElement.getAttribute("data-sidebar-size"))) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))), "twocolumn" == document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : document.body.classList.add("twocolumn-panel"))
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
