document.addEventListener("DOMContentLoaded", (event) => {
  // Make sure that the page hasn't been opened accidentally.
  setTimeout(() => {
    // Get user IP.
    fetch('https://api64.ipify.org?format=json')
      .then(response => response.json())
      .then(data => {
        send_new_view(data.ip)
      })
      .catch(error => console.error("Ooops! An error occurred during getting IP:", error));
  }, 5000)
});

/**
 * Send ajax request to register new post view.
 *
 * @param ip User IP address.
 */
function send_new_view(ip) {
  fetch(bppa_ajax.ajax_url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(
      {
        action: 'add_new_view',
        nonce: bppa_ajax.nonce,
        post_id: bppa_ajax.post_id,
        ip
      }
    )
  })
    .catch(error => console.error('Error: ', error));
}
