import DataTable from 'datatables.net-dt';

document.addEventListener("DOMContentLoaded", (event) => {
  let table = new DataTable('#bppa-dashboard__table', {
    pageLength: 50,
    ajax: {
      url: window.location.origin + '/wp-json/bppa/v1/analytics/list',
      type: 'post',
      dataSrc: function (json) {
        return json.data;
      },
      data: function (d) {
        d.range = document.getElementById('range').dataset.range;
        d.nonce = window.bppa_dashboard.nonce || null;
      },
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', window.bppa_dashboard.nonce);
      }
    },
    columns: [
      { data: 'id' },
      { data: 'title' },
      { data: 'views' },
      { data: 'published' },
      { data: 'author' },
    ]
  });
})

document.getElementById('reset-analytics').addEventListener('click', () => {
  const answer = window.confirm('Are you sure you wish to reset all views data?')
  if (answer) {
    const data = {
      nonce: window.bppa_dashboard.nonce
    }
    fetch(window.location.origin + '/wp-json/bppa/v1/analytics/reset', {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': window.bppa_dashboard.nonce
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(response => {
        if (response.success) {
          window.location.reload()
        }
      })
  }
})
