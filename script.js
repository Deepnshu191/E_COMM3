document.getElementById('payNow').addEventListener('click', function (e) {
    e.preventDefault(); // prevent actual form submission

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const mobile = document.getElementById('mobile').value;
    const address = document.getElementById('address').value;

    // Example POST request
    fetch('server-get.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, mobile, address })
    })
    .then(response => response.text())
    .then(data => {
        alert("Form submitted successfully!");
        window.location.href = "INDEX.html"; // redirect after submission
    })
    .catch(error => {
        console.error("Error submitting form:", error);
    });
});
