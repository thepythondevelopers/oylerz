<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Oylerz</title>
    <style type="text/css">
      @media screen and (max-width: 600px),
      screen and (max-device-width: 600px) {
        body {
          margin: 0 !important;
          padding: 0 !important;
        }
      }
      @media screen and (-webkit-min-device-pixel-ratio: 0) and (max-width: 600px) {
        body {
          margin: 0 !important;
          padding: 0 !important;
        }
      }
    </style>
  </head>
  <body style="margin: 0; padding: 0; border: 0;">
    <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" dir="ltr" style="background-color: rgb(242, 245, 247);">
      <tbody>
        <tr>
          <td align="center" valign="top" style="margin: 0; padding: 0px 15px 0px;">
            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="width: 600px;">
              <tbody>
                <tr>
                  <td align="center" valign="center" style="margin: 0;  background-size: cover; background-repeat: no-repeat; background: #242424; background-position: center center; padding: 50px 15px 60px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td valign="top" align="center" style="padding: 0px; margin: 0px;">
                            <a href="{{route('dashboard')}}"><img src="{{asset('frontend/images/logo.png')}}" width="150" style="border: none; font-weight: bold; height: auto; line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize; border-width: 0px; border-style: none; border-color: transparent; font-size: 12px; display: block;"></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" valign="top" style="margin: 0; padding: 0;">
                    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                      <tbody>
                        <tr>
                          <td align="left" valign="top" style="margin: 0px; padding: 30px 30px 10px 30px; background-color: rgb(255, 255, 255); font-size: 16px; font-family: 'Lato', Arial, Helvetica, sans-serif; line-height: 24px;">
                            <span style="font-family: 'Lato' ,Arial, Helvetica, sans-serif; color: #2e3233; font-size: 16px;">
<p style="margin:0px;">Hello, {{$name}} </p>
                        <p class="lead">Your account has been deactive by the admin. You will no longer be able to login in your account.</p>
                        <p>Thanks</p>
</span>
</td>
</tr>
                        <tr>
                          <td align="left" valign="top" style="margin: 0px; padding: 0 0px 5px 0px; background-color: rgb(255, 255, 255); font-size: 16px; font-family: 'Lato', Arial, Helvetica, sans-serif; line-height: 24px;">
                            

            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-spacing: 0; margin: 0; padding: 0; border-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; width: 100%">
              <tr>
                <td style="background-color: #ff9b41; background-size: cover; background-repeat: no-repeat; background-position: center center;">
             <table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td valign="top" align="center" style="padding: 30px 30px 20px 30px; font-family: 'Lato' ,Arial, Helvetica, sans-serif;  margin: 0px; font-size: 40px; color: #fff; font-weight: bold;">
                              <span>Thank You</span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="center" style="padding: 10px 30px 40px 30px; margin: 0px; font-size: 15px; line-height: 23px; color: #fff;">
                              <a href="{{route('dashboard')}}" style="padding: 10px 20px; color:#fff; font-size: 16px; font-family: 'Lato' ,Arial, Helvetica, sans-serif; color: #fff; background-color: #F77908; border-color: #F77908; text-decoration: none; border-radius: 4px;">Visit Website</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </table>
          </td>
        </tr>
        
        <tr>
          <td style="background:#242424;">
        <table width="600">
           @php 
                      $footer = \App\Models\CmsPage::where('slug','footer')->first();
                      @endphp 
        <tr>
          <td align="center" style="padding: 0px 0px 20px 0; background:#242424;">
            <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td align="center" valign="top" nowrap style="margin: 0px; padding: 0; font-size: 16px; font-family: 'Lato', Arial, Helvetica, sans-serif; line-height: 22px;">
                    <span style="font-family: 'Lato', Arial, Helvetica, sans-serif; color: #fff; font-size: 14px; white-space: nowrap;">
                      {{$footer->description5}}
                  </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
      </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
  </body>
</html>