<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 900px; margin:auto; border: 1px solid #CECECE;">
  <div style="font-family:'Brandon',Helvetica,Arial!important;font-size:16px;color:#30373b;background-color:#fff; margin: 25px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr height="80" valign="top" >
        <td  height="80"><table width="100%" border="0" bgcolor="#f1f1f1">
            <tr>
              <td><img src="<?=$site_url?>assets/frontend/images/logo.jpg" alt="<?=$project_name?>" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#0078a4" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b>Order has been cancelled due to unsuccessfull Paypal Transaction</b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
      <td><p style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-weight:bold;padding-left: 22px;font-size:12px">Dear <?=$name?> ,</p>
      <p style="font-family:Tahoma, Arial, Helvetica, sans-serif;padding-left: 22px;font-weight:bold;font-size:12px">We will honor your request and strive to serve you better.</p>
      <p style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-weight:bold;padding-left: 22px;font-size:12px">
            You can track your orders in your <a href="<?=$site_url?>order/get_orderview/<?=$order_no?>" style="color:#15c" target="_blank" >Account</a></p></td>
      </tr>
      <tr>
        <td style="padding:20px;"><table width="100%">
        	<tr>
              <td colspan="2"><b>Order details are as follows:</b></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
             <tr>
              <td width="30%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Order Id :</b></td>
              <td width="70%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$order_no?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Email Address :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$email?></td>
            </tr>
            <tr>
              <td  colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Currency :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$currency?></td>
            </tr>
            <tr>
              <td  colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Payment Status :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$status?></td>
            </tr>
            <tr>
              <td  colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Amount :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$total_price?></td>
            </tr>
            <tr>
              <td  colspan="2" height="10"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#0078a4" style="height: 25px;" >&nbsp;</td>
      </tr>
      <tr>
        <td  height="20"></td>
      </tr>
      <tr>
        <td style="text-align:center;"><?=$copyright?></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
