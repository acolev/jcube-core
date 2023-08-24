const searchMenu = (query) => {
  const results = []
  $('.sidebar__menu-wrapper .nav-link').filter(function (idx, elem) {
    const item = $(elem);
    const data = item.data('search-query')
    const text = item.text()
    const parent = item.data('search-group') || $(elem).parents('.sidebar-menu-item.sidebar-dropdown').find('.menu-title').first().text() || `Main Menu`;

    if ((
      (data && data.toLowerCase().indexOf(query)) >= 0 ||
      (text && text.toLowerCase().indexOf(query)) >= 0 ||
      (parent && parent.toLowerCase().indexOf(query)) >= 0
    )) {

      results.push({
        group: parent,
        title: item.data('search-title') || item.text().trim(),
        url: item.attr('href') || '#',
      })
    }
  });
  return results.sort((a, b) => a.group - b.group);
}

const initSearch = (el) => {
  const query = $(el.currentTarget).val().toLowerCase();
  const search_result_pane = $('.search-list');
  $(search_result_pane).html('');

  if (query.length === 0) {
    search_result_pane.addClass('d-none');
    return;
  }
  search_result_pane.removeClass('d-none');
  const result = searchMenu(query)
  result.forEach(el => {
    $(search_result_pane).append(`
        <li>
          ${el.group}
          <a href="${el.url}" class="fw-bold text-color--3 d-block">${el.title}</a>
        </li>
      `);
  });
}

$('.navbar-search-field').on('input', initSearch);

let len = 0;
let clickLink = 0;
let search = null;
let process = false;
$('#searchInput').on('keydown', function (e) {
  var length = $('.search-list li').length;
  if (search != $(this).val() && process) {
    len = 0;
    clickLink = 0;
    $(`.search-list li:eq(${len}) a`).focus();
    $(`#searchInput`).focus();
  }
  //Down
  if (e.keyCode == 40 && length) {
    process = true;
    var contra = false;
    if (len < clickLink && clickLink < length) {
      len += 2;
    }
    $(`.search-list li[class="bg--dark"]`).removeClass('bg--dark');
    $(`.search-list li a[class="text--white"]`).removeClass('text--white');
    $(`.search-list li:eq(${len}) a`).focus().addClass('text--white');
    $(`.search-list li:eq(${len})`).addClass('bg--dark');
    $(`#searchInput`).focus();
    clickLink = len;
    if (!$(`.search-list li:eq(${clickLink}) a`).length) {
      $(`.search-list li:eq(${len})`).addClass('text--white');
    }
    len += 1;
    if (length == Math.abs(clickLink)) {
      len = 0;
    }
  }
  //Up
  else if (e.keyCode == 38 && length) {
    process = true;
    if (len > clickLink && len != 0) {
      len -= 2;
    }
    $(`.search-list li[class="bg--dark"]`).removeClass('bg--dark');
    $(`.search-list li a[class="text--white"]`).removeClass('text--white');
    $(`.search-list li:eq(${len}) a`).focus().addClass('text--white');
    $(`.search-list li:eq(${len})`).addClass('bg--dark');
    $(`#searchInput`).focus();
    clickLink = len;
    if (!$(`.search-list li:eq(${clickLink}) a`).length) {
      $(`.search-list li:eq(${len})`).addClass('text--white');
    }
    len -= 1;
    if (length == Math.abs(clickLink)) {
      len = 0;
    }
  }
  //Enter
  else if (e.keyCode == 13) {
    e.preventDefault();
    if ($(`.search-list li:eq(${clickLink}) a`).length && process) {
      $(`.search-list li:eq(${clickLink}) a`)[0].click();
    }
  }
  //Retry
  else if (e.keyCode == 8) {
    len = 0;
    clickLink = 0;
    $(`.search-list li:eq(${len}) a`).focus();
    $(`#searchInput`).focus();
  }
  search = $(this).val();
});


hotKeys.push({
  keys: ["ctr+k", "meta+k"],
  callback: (event) => {
    event.preventDefault();
    $('.navbar-search-field').focus();
  },
})
