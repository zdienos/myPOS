<!--?php defined('BASEPATH') OR exit('No direct script access allowed'); /** * CodeIgniter Email Helpers * * @package CodeIgniter * @subpackage Helpers * @category Helpers * @author EllisLab Dev Team * @link https://codeigniter.com/user_guide/helpers/email_helper.html */ // ------------------------------------------------------------------------ if ( ! function_exists('send_mail')) { /** * Validate email address * * @deprecated 3.0.0 Use PHP's filter_var() instead * @param string $email * @return bool */ function send_mail($data=array("")) { //$i = 0; //$EMAILTO = $data['EMAILTO']; require __DIR__ . '/vendor/autoload.php'; // require 'lib/SendGrid.php'; // (@__DIR__ == '__DIR__') &amp;&amp; define('__DIR__', realpath(dirname(__FILE__))); $email = new \SendGrid\Mail\Mail(); $email-&gt;setFrom($data['from'], 'Pandansari');&lt;br ?--> $email-&gt;setSubject($data['subject']);<br ?--> $email->addTo($data['to']);

$email->addContent(
"text/html&#8221;, $data['message']
);
$sendgrid = new \SendGrid($data['api_key']);
try {
$response = $sendgrid->send($email);

echo 'Caught exception: '. $e->getMessage() .&#8221;\n&#8221;;
}
}

}

?>