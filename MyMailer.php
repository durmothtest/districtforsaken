<?
require_once '../PHPMailer/PHPMailerAutoload.php';
class MyMailer {
    
    public function sendMail($mailBetreff, $mailText, $mailAdresse){
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0; // 0=nix, 3=verbose
        $mail->isSMTP();
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.strato.de";
        $mail->Port = 587; // 465 ist veraltet!
        $mail->SMTPAuth = true;
        $mail->Username = "mail@fritz-schmude.de";
        $mail->Password = "My69Mail";
        
        $mail->From = "verify@districtforsaken.de";
        $mail->FromName = "District Forsaken";
        
        $mail->addAddress($mailAdresse);
        
        //$mailer->AddBCC('mail@fritz-schmude.de'); // zur Kontrolle
        $mail->Subject = $mailBetreff;
        $mail->Body = $mailText;
        
        /*
        echo 'betreff = "'.$mailBetreff.'"<br>';
        echo 'text = "'.$mailText.'"<br>';        
        echo 'adresse = "'.$mailAdresse.'"<br>';
        */
        
        // abschicken
        if (!$mail->send()) {
            $ret = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $ret = 'ok';
        }
        
        return $ret;
    }
    
    public function validateAddress($eadr) {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]{2,4}|museum))$/i';
        $regex = '/^[_a-z0-9-\.]+@[_a-z0-9-\.]+\.[a-z]{2,}$/i';
        $b_ok = preg_match($regex, $eadr);
        return $b_ok;
    }
}
