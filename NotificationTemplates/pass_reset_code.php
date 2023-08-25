<?php

return [
	'act' => 'PASS_RESET_CODE',
	'name' => 'Password - Reset - Code',
	'subj' => 'Password Reset',
	'email_body' => '<div style="font-family: Montserrat, sans-serif;">We have received a request to reset the password for your account on&nbsp;<span style="font-weight: bolder;">{{time}} .<br></span></div><div style="font-family: Montserrat, sans-serif;">Requested From IP:&nbsp;<span style="font-weight: bolder;">{{ip}}</span>&nbsp;using&nbsp;<span style="font-weight: bolder;">{{browser}}</span>&nbsp;on&nbsp;<span style="font-weight: bolder;">{{operating_system}}&nbsp;</span>.</div><div style="font-family: Montserrat, sans-serif;"><br></div><br style="font-family: Montserrat, sans-serif;"><div style="font-family: Montserrat, sans-serif;"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size="6"><span style="font-weight: bolder;">{{code}}</span></font></div><div><br></div></div><div style="font-family: Montserrat, sans-serif;"><br></div><div style="font-family: Montserrat, sans-serif;"><font size="4" color="#CC0000">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size="4" color="#CC0000"><br></font></div>',
	'sms_body' => 'Your account recovery code is: {{code}}',
	'shortcodes' => [
		'code' => 'Verification code for password reset","ip":"IP address of the user","browser',
		'browser' => '"Browser of the user',
		'operating_system' => 'Operating system of the user',
		'time' => 'Time of the request',
	],
	'email_status' => 1,
	'sms_status' => 1,
];