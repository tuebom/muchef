<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
class Emailsvc extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library("phpmailer_library");
    }
 
    function contact_us(){

        $name = $this->input->post('name') . ' ' . $this->input->post('surname');
        $toEmail = $this->input->post('emailto');
        $toEmailSender = $this->input->post('email');

        // subject of the email
        $subject = 'New message from '.$name;
            
        $emailText = "You have a new message from your contact form <br>";

        // array variable name => Text to appear in the email
        $fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'need' => 'Need', 'email' => 'Email', 'message' => 'Message');

        foreach ($_POST as $key => $value) {
            // If the field exists in the $fields array, include it in the email 
            if (isset($fields[$key])) {
                $emailText .= "$fields[$key]: $value<br>";
            }
        }
        
        $fromEmail = "webmaster@askitchen.com";
        // $isiEmail = "Isi email tulis disini";

        $mail = $this->phpmailer_library->load(); //new PHPMailer();
        $mail->IsHTML(true);       // set email format to HTML
        $mail->IsSMTP();           // we are going to use SMTP
        $mail->SMTPAuth   = true;  // enabled SMTP authentication
        $mail->SMTPSecure = "tls"; //"ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 587; //465;            // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // alamat email kamu
        $mail->Password   = "jimmyfallon5757";            // password GMail
        $mail->SetFrom('webmaster@askitchen.com', 'noreply');  //Siapa yg mengirim email
        $mail->Subject    = $subject;
        $mail->Body       = $emailText;
        // $toEmail = "aswin@askitchen.com"; // siapa yg menerima email ini
        // $toEmail = "marketing@askitchen.com"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
        $mail->AddAddress($toEmailSender);
       
        if(!$mail->Send()) {
            // echo "Error: ".$mail->ErrorInfo;
            $responseArray = array('type' => 'danger', 'message' => $errorMessage);
            // return FALSE;
        } else {
            // echo "Email berhasil dikirim";
            $responseArray = array('type' => 'success', 'message' => 'Submitted the form successfully!');
            // return TRUE;
        }
        echo json_encode($responseArray);
    }
     
    function tgl_indo($tanggal){
        
        $bulan = array (
            1 =>   'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );
        $pecah = explode('-', $tanggal);
        
        // variabel pecah 0 = tahun
        // variabel pecah 1 = bulan
        // variabel pecah 2 = tanggal
     
        return $pecah[2] . ' ' . $bulan[ (int)$pecah[1] ] . ' ' . $pecah[0];
    }
    
    function mail_order(){

        $mbr_name  = $this->input->post('first_name') . ' ' . $this->input->post('last_name');

        $fromEmail = "webmaster@askitchen.com";
        $toEmail   = 'marketing@askitchen.com';

        // subject of the email
        $subject = 'New order from '. $mbr_name;
            
        
        $emailText  = '<div>';
        $emailText .= '    <h2>Order #'.$_SESSION["order_id"].' details</h2>';
        $emailText .= '    <table style="width: 100%; max-width: 100%; margin-bottom: 20px; border: 1px solid #ddd;">';
        $emailText .= '        <tbody>';
        $emailText .= '            <tr style="border: 1px solid #ddd;">';
        $emailText .= '                <td style="border: 1px solid #ddd; padding: 7px;"><b>Date Created</b></td>';
        $emailText .= '                <td style="border: 1px solid #ddd; padding: 7px;">'. $this->tgl_indo(date('Y-m-d')) .'</td>';
        $emailText .= '            </tr>';

        $emailText .= '            <tr style="border: 1px solid #ddd;">';
        $emailText .= '                <td valign="top" style="border: 1px solid #ddd; padding: 7px;"><b>Customer</b></td>';
        $emailText .= '                <td style="border: 1px solid #ddd; padding: 7px;">'. $_SESSION["first_name"] .' '.$_SESSION["last_name"].'<br>';
        $emailText .= '                '. $_SESSION["address"].'<br>';
        $emailText .= '                '. $_SESSION["district"] .', '.$_SESSION["regency"].',<br>';
        $emailText .= '                '. $_SESSION["province"] .' - '.$_SESSION["post_code"].'<br><br>';

        $emailText .= '                Email address:<br>';
        $emailText .= '                '. $_SESSION["email"] .'<br><br>';

        $emailText .= '                Phone:<br>';
        $emailText .= '                '. $_SESSION["phone"] .'</td>';
        $emailText .= '            </tr>';

        $emailText .= '        <tbody>';
        $emailText .= '    </table>';

        $emailText .= '    <table style="width: 100%; max-width: 100%; margin-bottom: 20px; border: 1px solid #ddd;">';
        $emailText .= '        <thead>';
        $emailText .= '            <tr style="border: 1px solid #ddd;">';
        $emailText .= '                <th style="sborder: 1px solid #ddd; padding: 7px;">Item Code</th><th style="border: 1px solid #ddd;">Description</th><th style="text-align:right; border: 1px solid #ddd;">Qty</th>';
        $emailText .= '                <th style="text-align:right; border: 1px solid #ddd; padding: 7px;">Price</th><th style="text-align:right; border: 1px solid #ddd;">Total</th>';
        $emailText .= '            </tr>';
        $emailText .= '        </thead>';
        $emailText .= '        <tbody>';
                        
        $item_price  = 0;
        $total_price = 0;

        foreach ($_SESSION["cart_item"] as $item)
        {

            $item_price   = (float)$item["qty"]*$item["harga"];
            $total_price += $item_price;

            $emailText .= '            <tr style="border: 1px solid #ddd;">';
            $emailText .= '                <td style="border: 1px solid #ddd; padding: 7px;">'. $item["kdbar"] .'</td>';
            $emailText .= '                <td style="border: 1px solid #ddd; padding: 7px;">'. $item["nama"] .'</td>';
            $emailText .= '                <td style="text-align:right; border: 1px solid #ddd; padding: 7px;">'. $item["qty"] .'</td>';
            $emailText .= '                <td style="text-align:right; border: 1px solid #ddd; padding: 7px;">Rp'. number_format($item["harga"], 0, '.', ',') .'</td>';
            $emailText .= '                <td style="text-align:right; border: 1px solid #ddd; padding: 7px;">Rp'. number_format($item_price, 0, '.', ',') .'</td>';
            $emailText .= '            </tr>';
        
        }

        $emailText .= '        </tbody>';
        $emailText .= '    </table>';

        $emailText .= '    <table style="width: 100%; max-width: 100%; margin-bottom: 20px; border: 1px solid #ddd;">';
        $emailText .= '        <tbody>';
        $emailText .= '            <tr>';
        $emailText .= '                <td><b>Subtotal</b></td>';
        $emailText .= '                <td style="text-align:right;"><b>Rp'. number_format($total_price, 0, '.', ',') .'</b></td>';
        $emailText .= '            </tr>';
        $emailText .= '            <tr>';
        $emailText .= '                <td><b>Shipping</b></td>';
        $emailText .= '                <td style="text-align:right;"><b>0</b></td>';
        $emailText .= '            </tr>';
        $emailText .= '            <tr>';
        $emailText .= '                <td><b>Tax</b></td>';
        $emailText .= '                <td style="text-align:right;"><b>0</b></td>';
        $emailText .= '            </tr>';
        $emailText .= '            <tr>';
        $emailText .= '                <td><b>Total</b></td>';
        $emailText .= '                <td style="text-align:right;"><b>Rp'. number_format($total_price, 0, '.', ',') .'</b></td>';
        $emailText .= '            </tr>';
        $emailText .= '        </tbody>';
        $emailText .= '    </table>';
        $emailText .= '</div>';

        // remove session variabel
        
        $array_items = array('company', 'address', // 'first_name', 'last_name',
            'province', 'regency', 'district', 'post_code', 'phone', 'email', 'note');
        $this->session->unset_userdata($array_items);
        
        if(!empty($_SESSION["cart_item"])) {
	
            foreach($_SESSION["cart_item"] as $k => $v) {
                unset($_SESSION['cart_item'][$k]);
            }
        }
        $this->session->set_userdata('totqty', 0);
        $this->session->set_userdata('tot_price', 0);


        $mail = $this->phpmailer_library->load(); //new PHPMailer();
        $mail->IsHTML(true);                       // set email format to HTML
        $mail->IsSMTP();                           // we are going to use SMTP
        $mail->SMTPAuth   = true;                  // enabled SMTP authentication
        $mail->SMTPSecure = "tls"; //"ssl";        // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 587; //465;            // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;            // alamat email kamu
        $mail->Password   = "jimmyfallon5757";     // password GMail
        $mail->SetFrom('webmaster@askitchen.com', 'noreply');  //Siapa yg mengirim email
        $mail->Subject    = $subject;
        $mail->Body       = $emailText;
        // $toEmail = "aswin@askitchen.com";     // siapa yg menerima email ini
        // $toEmail = "marketing@askitchen.com"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
        
        if(!$mail->Send()) {
            // echo "Error: ".$mail->ErrorInfo;
            $responseArray = array('type' => 'danger', 'message' => $errorMessage);
            // return FALSE;
        } else {
            // echo "Email berhasil dikirim";
            $responseArray = array('type' => 'success', 'message' => 'Submitted the form successfully!');
            // return TRUE;
        }
        echo json_encode($responseArray);
    }
}

?>
