document.querySelector('.contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const message = document.querySelector('textarea[name="message"]').value;

    if (!name || !email || !message) {
        alert('Vul alsjeblieft alle verplichte velden in.');
        return;
    }

    // Dit is het deel dat je moet aanpassen
    const formUrl = '/pad-naar-jouw-server-script.php'; 

    fetch(formUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, email, message }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Bedankt voor je bericht! Ik neem zo snel mogelijk contact met je op.');
            this.reset();
        } else {
            alert('Er is een fout opgetreden. Probeer het later opnieuw.');
        }
    })
    .catch(error => {
        console.error('Fout bij het versturen van het formulier:', error);
        alert('Er is een netwerkfout opgetreden. Controleer je internetverbinding.');
    });
});