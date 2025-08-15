<?php
// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de JSON-gegevens van de JavaScript-fetch-aanvraag
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Ontvang de gegevens van het contactformulier
    $naam = htmlspecialchars(trim($data['name']));
    $email = htmlspecialchars(trim($data['email']));
    $bericht = htmlspecialchars(trim($data['message']));

    // Stel de ontvanger en het onderwerp in
    $ontvanger = "jouw_email@voorbeeld.nl"; // VERVANG DIT MET JE EIGEN E-MAILADRES
    $onderwerp = "Nieuw bericht via contactformulier van " . $naam;

    // Controleer of de verplichte velden zijn ingevuld
    if (empty($naam) || empty($email) || empty($bericht)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Vul alle verplichte velden in.']);
        exit;
    }

    // Stel de e-mailinhoud op
    $email_body = "Je hebt een nieuw bericht ontvangen:\n\n";
    $email_body .= "Naam: " . $naam . "\n";
    $email_body .= "E-mail: " . $email . "\n";
    $email_body .= "Bericht:\n" . $bericht . "\n";

    // Stel de headers in voor de e-mail
    $headers = "From: " . $naam . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    // Verstuur de e-mail
    if (mail($ontvanger, $onderwerp, $email_body, $headers)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Het versturen van de e-mail is mislukt.']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Ongeldige aanvraagmethode.']);
}
?>