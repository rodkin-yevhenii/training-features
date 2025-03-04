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
  const formData = new URLSearchParams();
  formData.append("action", "add_new_view");
  formData.append("nonce", bppa_ajax.nonce);
  formData.append("post_id", bppa_ajax.post_id);
  formData.append("ip", ip);

  fetch(bppa_ajax.ajax_url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: formData.toString()
  })
    .catch(error => console.error('Error: ', error));
}
