@extends('layouts.email')
@section('content')
<tr>
    <td class="sm-px-24" style="mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 16px; line-height: 24px; color: #626262;">
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;">Hey</p>
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;">{{ $name }}</p>
    
    
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-top: 24px; margin-bottom: 24px;">
        <span style="font-weight: 600;">S-Epayments</span>
        is the most developer friendly & highly customisable payment getway. 🤩
    </p>
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 18px; font-weight: 500;">How can you use S-Epayments for your next project?</p>
    <ul style="margin-bottom: 24px;">
        <li>
            S-Epayments provides you getting start pages 🚀 with different payment plateform, use the payment plateform as
            per your custom requirements and just change the branding, menu & content.
        </li>
        
    </ul>
    <table cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td style="mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #7367f0; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;">
                <a href="javascript:;" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;">Browse S-Epayments &rarr;</a>
            </td>
        </tr>
    </table>
    <table style="width: 100%;" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;">
                <div style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;">&zwnj;</div>
            </td>
        </tr>
    </table>
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;">
        Not sure why you received this email? Please
        <!--  -->
        <a href="mailto:support@example.com" class="hover-underline" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;">let us know</a>.
    </p>
    <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;">Thanks, <br>S-Epayments Team</p>
    </td>
</tr>
@endsection
