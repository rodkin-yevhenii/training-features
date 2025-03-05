document.addEventListener("DOMContentLoaded", (event) => {
  // Make sure that the page hasn't been opened accidentally.
  setTimeout(() => {
    const formData = new URLSearchParams();

    formData.append("action", "add_new_view");
    formData.append("nonce", bppa_ajax.nonce);
    formData.append("post_id", bppa_ajax.post_id);

    fetch(bppa_ajax.ajax_url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: formData.toString()
    })
      .catch(error => console.error('Error: ', error));
  }, 5000)
});
