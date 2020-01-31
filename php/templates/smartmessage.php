<?php  
$message = '
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Smart forms - Email message template </title>    
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <center>
        <table style="padding:30px 10px;background:#F4F4F4;width:100%;font-family:arial" cellpadding="0" cellspacing="0">
                
                <tbody>
                    <tr>
                        <td>
                        
                            <table style="max-width:540px;min-width:320px" align="center" cellspacing="0">
                                <tbody>
                                
                                    <tr>
                                        <td style="background:#fff;border:1px solid #D8D8D8;padding:30px 30px" align="center">
                                        
                                            <table align="center">
                                                <tbody>
                                                
                                                    <tr>
                                                        <td style="border-bottom:1px solid #D8D8D8;color:#666;text-align:center;padding-bottom:30px">
                                                            
                                                            <table style="margin:auto" align="center">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="color:#005f84;font-size:30px;font-weight:bold;text-align:center;font-family:arial">
                                                                
                                                                          Website Contact Request
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <td style="border-bottom:1px solid #D8D8D8;color:#666;text-align:center;padding-bottom:30px;padding-top:30px;">
                                                            
                                                            <table style="margin:auto" align="center">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="color:#005f84;font-size:22px;font-weight:bold;text-align:center;font-family:arial">
                                                               
                                                                        Hi, you have received a website contact request, details can be found below:
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    <tr>
                                               <td style="color:#666;padding:15px; padding-bottom:0;font-size:14px;line-height:20px;font-family:arial;text-align:left">
                                    
                                                    <div style="font-style:normal;padding-bottom:15px;font-family:arial;line-height:20px;text-align:left">
                                                     
                                                           <p><span style="font-weight:bold;font-size:16px">Name:</span></p>
														                        <p style="margin-bottom:0;"> '.nl2br ($username).'</p>
                                                    
                                                        <p><span style="font-weight:bold;font-size:16px">Email Address:</span></p>
													                          	<p style="margin-bottom:0;"> '.nl2br ($emailaddress).'</p>
                                                      
                                                        <p><span style="font-weight:bold;font-size:16px">Telephone Number:</span></p>
												                          		<p style="margin-bottom:0;"> '.nl2br ($telephone).'</p>                                                          
                                                      
                                                        <p><span style="font-weight:bold;font-size:16px;">Message:</span> </p>
                                                        <p style="margin-bottom:0;"> '.nl2br($sendermessage).' </p>
                                                        
                                                      </div>
                                                            
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </td>
                                    </tr>
                                    
                                  
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    
                   
            </tbody>
        </table>
    </center>
</body>
</html>';
?>