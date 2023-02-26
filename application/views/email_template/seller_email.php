<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 900px; margin:auto; border: 1px solid #CECECE;">
   <div style="font-family:'Brandon',Helvetica,Arial!important;font-size:16px;color:#30373b;background-color:#fff; margin: 25px;">
    <table width="100%" border="0" cellspacing="0"  cellpadding="0" >
      <tr valign="top" >
        <td colspan="2" height="80" width="800"><table width="100%" border="0" bgcolor="#f1f1f1" >
            <tr>
              <td><img src="<?=$site_url?>assets/frontend/images/logo.jpg" alt="<?=$project_name?>" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#0078a4" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b>Your Order has been received </b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2" height="10"></td>
      </tr>
      <tr>
        <td colspan="2" style="padding:20px;"><table width="100%" border="0" >
            <tr>
              <td width="30%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Order Id :</b></td>
              <td width="70%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$order_no?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Name :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$name?></td>
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
           
           
           
          </table></td>
      </tr>
      <tr>
        <td valign="top" style="padding:0px 20px 0px 20px;" ><table width="100%" border="0">
            <tr>
              <td colspan="2" bgcolor="#0078a4" style="text-align:left; width:365px;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b>Billing Address</b>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td width="30%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Address :</b></td>
              <td width="70%" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$billaddress?></td>
              
            </tr>
           
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Phone Number :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$billmobile?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
          </table></td>
        
      </tr>
      <tr>
              <td colspan="2" style="padding: 20px 0px 0px 20px;">Products details are as follows:</td>
            </tr>
      <tr>
      <td colspan="2" style="padding:20px;">
      <table border="1" bordercolor="#d7d7d7" width="100%" style="border-collapse:collapse;"  cellpadding="10" cellspacing="10">
      
      <tr>
      <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:25px;"><b>Product Name</b></td>
      <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:right;line-height:25px;"><b>Price</b></td>
      <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:center;line-height:25px;"><b>Quantity</b></td>
      <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;line-height:25px; text-align:right;"><b>Total Price</b></td>
      </tr>
      <tr>
      <?=$products?>
      
      </tr>
      <tr>
              <td colspan="3" style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:right;line-height:25px;"><b>Total Price</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:right;line-height:16px;"><?=$total_amount?></td>
            </tr>
      </table>
      
      </td>
      
      
      </tr>
      <tr>
        <td colspan="2" bgcolor="#0078a4" height="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center; padding-top:25px;"><?=$copyright?></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
