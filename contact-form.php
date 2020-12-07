<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
    // require_once 'phpmailer/PHPMailerAutoload.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])  && isset($_POST['message'])) {

    //check if any of the inputs are empty
    if (empty($_POST['name']) || empty($_POST['email']) ||empty($_POST['subject']) ||empty($_POST['message'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }

    //create an instance of PHPMailer
    // $mail = new PHPMailer();

    // $mail->From = $_POST['inputEmail'];
    // $mail->FromName = $_POST['inputName'];
    // $mail->AddAddress('ritesh.soni2898@gmail.com'); //recipient 
    // $mail->Subject = 'Enquiry from Ritesh Soni\'s Website';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
    $mail->SMTPSecure = 'tls';
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth   = true;
    $mail->Username   = "ritesh.soni2898@gmail.com";
    $mail->Password   = "Ritesh@281998";
    $mail->SetFrom('ritesh.soni2898@gmail.com', "Ritesh Soni");
    $mail->AddAddress("ritesh.soni2898@gmail.com", "Ritesh Soni");
    $mail->Subject = "Contacting From Website";
    $mail->IsHTML(true);
    $mail->Body = "Name: " . $_POST['name'] . "\r\n\r\nMessage: " . stripslashes($_POST['message']);

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }

    if(!$mail->send()) {
        $data = array('Message could not be sent. Mailer Error: contacts on soniritesh124@gmail.com' );
        echo json_encode($data);
        exit;
    }else{

    $data = array('Thanks! We have received your message. ): ');
    echo json_encode($data);
        
    }

} else {

    $data = array('Please fill out the form completely.');
    echo json_encode($data);

}