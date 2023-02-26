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
             <td><img src="<?php echo base_url(); ?>assets/frontend/images/logo.jpg" alt="Moonstone" border="0"></td>
            </tr>
            <tr>
              <td bgcolor="#0078a4" style="text-align:right;font-family:Verdana;font-size:18px;color:#fff;text-decoration:none;text-indent:10px;height: 25px;"><b>Enquiry Received</b>&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:20px;"><table width="100%">
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:30%"><b>Name :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;width:70%"><?=$first_name?> <?=$last_name?></td>
            </tr>
            <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Email :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$email?></td>
            </tr>
             <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Phone Number :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$phone?></td>
            </tr>
             <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <?php if(isset($numberplate) && !empty($numberplate)) : ?>
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Number plate:</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$numberplate?></td>
            </tr>
             <tr>
              <td colspan="2" height="10"></td>
            </tr>
            <?php endif; ?>
            <?php if(isset($note) && !empty($note)) : ?>
              <tr>
                <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Note:</b></td>
                <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$note?></td>
              </tr>
               <tr>
                <td colspan="2" height="10"></td>
              </tr>
            <?php endif; ?>  
            <tr>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><b>Message :</b></td>
              <td style="font-family:Tahoma, Arial, Helvetica, sans-serif;font-size:12px;color:#292929;text-decoration:none;text-align:justify;line-height:16px;"><?=$message?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#0078a4" style="height: 25px;" >&nbsp;</td>
      </tr>
      <tr>
        <td  height="20"></td>
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
