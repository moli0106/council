<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url(); ?>/admin" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <style type="text/css">
    * { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65; }
    img { max-width: 100%; margin: 0 auto; display: block; }
    body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; padding:5px;}
    a { color: #71bc37; text-decoration: none; }
    a:hover { text-decoration: underline; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    .text-left { text-align: left; }
    .button { display: inline-block; color: white; background: #3399ff; border: solid #3399ff; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }
    .button:hover { text-decoration: none; }
    h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }
    h1 { font-size: 32px; }
    h2 { font-size: 28px; }
    h3 { font-size: 24px; }
    h4 { font-size: 20px; }
    h5 { font-size: 16px; }
    p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }
    .container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 800px !important; }
    .container table { width: 100% !important; border-collapse: collapse; }
    .container .masthead { padding: 30px 0; background: #3399ff ; color: white; }
    .container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }
    .container .content { background: #EEE;; padding: 30px 10px; }
    .container .content.footer { background: none; }
    .container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }
    .container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }
    .container .content.footer a:hover { text-decoration: underline; }
    
    .data_table table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    .data_table td, .data_table th {
    border: 1px solid #c5c5c5;
    text-align: left;
    padding: 8px;
    }

    .data_table tr:nth-child(even) {
    background-color: #dddddd;
    }

</style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">
                        <img src="<?php echo base_url('themes/adminlte/registration/img/ub-logo.png') ?>" alt="logo">
                        <h2>Utkarsh Bangla</h2>
                        <h3>Paschim Banga Society for Skill Development (PBSSD)</h3>
                    </td>
                </tr>
                <tr>
                   <?php echo $email_text; ?>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Karigari Bhawan, 2nd Floor,Plot No. B-7,AA-III, Newtown<br>Kolkata, West Bengal 700160</p>
                        <p><a href="mailto:">support.tetsd-wb@gov.in</a> | <a href="tel:+91-8697476496">+91-8697476496 </a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>