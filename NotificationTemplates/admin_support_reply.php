<?php

return [
	'act' => 'ADMIN_SUPPORT_REPLY',
	'name' => 'Support - Reply',
	'subj' => 'Reply Support Ticket',
	'email_body' => '<div><p><span data-mce-style="font-size: 11pt;" style="font-size: 11pt;"><span style="font-weight: bolder;">A member from our support team has replied to the following ticket:</span></span></p><p><span style="font-weight: bolder;"><span data-mce-style="font-size: 11pt;" style="font-size: 11pt;"><span style="font-weight: bolder;"><br></span></span></span></p><p><span style="font-weight: bolder;">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style="font-family: Montserrat, sans-serif;"></div>',
	'sms_body' => 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.',
	'shortcodes' => [
		'ticket_id' => 'ID of the support ticket',
		'ticket_subject' => 'Subject  of the support ticket',
		'reply' => 'Reply made by the admin',
		'link' => 'URL to view the support ticket',
	],
	'email_status' => 1,
	'sms_status' => 1,
];
