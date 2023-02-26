<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 900px; margin:auto; border: 1px solid #CECECE;">
  <div style="font-family:'Brandon',Helvetica,Arial!important;font-size:16px;color:#30373b;background-color:#fff; margin: 25px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr height="50" valign="top" >
        <td  height="50">
          <table width="100%" border="0">
            <tr>
              <td style="text-align:center;font-family:Verdana;font-size:25px;color:#000;text-decoration:none;text-indent:10px;height: 25px;text-decoration: underline;"><b>STOCK PLATES</b></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><p style="text-align: center;">Order is being Processed(Manual)</p></td>
      </tr>

      <tr>
        <td style="padding:5px;"><table width="100%">
              <p style="text-align:center;">Hi <?php echo $first_name?> <?php echo $last_name?></p>
        </td>
      </tr>
      <tr>
        <td style="padding:5px;"><table width="100%">
              <p style="text-align:center;">Your order at Moonstone Plates is being processed for the following number plate:</p>
              <p style="text-align:center;font-size: 20px;"><b><?php echo $plate_number;?></b></p>
              <p style="text-align:center;">Order Number:<?php echo $order_number;?></p>
              <p style="text-align:center;">This is a <b>NO-REPLY</b> email.</p>
              <p style="text-align:center;"><b>*Please allow up to 3 weeks for your certificate to come*</b></p>
        </td>
      </tr>



      <?php if(isset($copyright) && !empty($copyright)) : ?>
      <tr>
        <td style="text-align:center;"><?=$copyright?></td>
      </tr>
      <?php endif; ?>
    </table>
  </div>
</div>
</body>
</html>
