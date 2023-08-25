<?php

return [
	'act' => 'PASS_RESET_DONE',
	'name' => 'Password - Reset - Confirmation',
	'subj' => 'You have reset your password',
	'email_body' => '<p style="font-family: Montserrat, sans-serif;">You have successfully reset your password.</p><p style="font-family: Montserrat, sans-serif;">You changed from&nbsp; IP:&nbsp;<span style="font-weight: bolder;">{{ip}}</span>&nbsp;using&nbsp;<span style="font-weight: bolder;">{{browser}}</span>&nbsp;on&nbsp;<span style="font-weight: bolder;">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style="font-weight: bolder;">{{time}}</span></p><p style="font-family: Montserrat, sans-serif;"><span style="font-weight: bolder;"><br></span></p><p style="font-family: Montserrat, sans-serif;"><span style="font-weight: bolder;"><font color="#ff0000">If you did not change that, please contact us as soon as possible.</font></span></p>',
	'sms_body' => 'Your password has been changed successfully',
	'shortcodes' => [
		'ip' => 'IP address of the user',
		'browser' => '"Browser of the user',
		'operating_system' => 'Operating system of the user',
		'time' => 'Time of the request',
	],
	'email_status' => 1,
	'sms_status' => 1,
];