<?php

// Define some constants
define( "RECIPIENT_NAME", "Paola Moro" );
define( "RECIPIENT_EMAIL", "fabio.pegorari@gmail.com" );

// Read the form values
$success = false;
$name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$subject = isset( $_POST['subject'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

$mail_subject = 'Richiesta di contatto inviato dal sito da parte di ' . $name;

$body = 'Name: '. $name . "\r\n";
$body .= 'Email: '. $senderEmail . "\r\n";


if ($subject) {$body .= 'Subject: '. $subject . "\r\n"; }

$body .= 'message: ' . "\r\n" . $message;



// If all values exist, send the email
if ( $name && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <" . $senderEmail . ">";  
  $success = mail( $recipient, $mail_subject, $body, $headers );
  echo "<div class='inner success'><p class='success'>Grazie per avermi contattato, risponderò al più presto</p></div><!-- /.inner -->";
}else {
	echo "<div class='inner error'><p class='error'>Si è verificato un'errore.</p></div><!-- /.inner -->";
}

?>