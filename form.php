<?php
require_once 'Formr-master/class.formr.php';

// create our form object and use Bootstrap 4 as our form wrapper
$form = new Formr\Formr('bootstrap');

$data = [
    'text' => 'winetype,Wine type:,,winetype-id,choosen',
    'text' => 'fname,Full name:,,fullname-id,fname',
    'email' => 'email,Email:,,email-id,email',
    'phone' => 'phone,Phone:,,phone-id,phone',
    'text3' => 'address,Address:,,address-id,address',
    'text4' => 'zip,Zip/Postal Code:,,zip-id,zip',
    'number' => 'box,Number of boxes: (minimum 12 boxes),,box-id,box',
    'checkbox' => 'agree,I Agree to the terms and conditions,agree,agree,,',
    'hidden' => 'recaptcha_response,,,recaptchaResponse',
];
// make all fields required

$form->required = 'fname,email,phone,address,zip,wine,box,agree';
$form->required_indicator = '*';
$form->html_purifier = '/HTMLPurifier.standalone.php';
$form->sanitize_html = true;

// check if the form has been submitted
if($form->submitted())
{    
    $form->post('box','Number of boxes','less_than[500]|greater_than[11]');

    $form->post('email','Email','valid_email');

        // let's send the email
        $to = 'email@email.com';
        $from = 'email@email.com';
        $subject = 'Contact Form Submission';
        // this processes our form, cleans the input, and formats it into an HTML email
        
        $_POST['csrf_token'] = "" ;
        $_POST["recaptcha_response"] = "" ;
        if($form->send_email($to, $subject, 'POST', $from, 'HTML'))
        {   
            // email sent; print a thank you message
            $form->success_message('Thank you for filling out our form!');
            $_POST = array();

        }
        echo $form->messages(); 
        
    }
?>