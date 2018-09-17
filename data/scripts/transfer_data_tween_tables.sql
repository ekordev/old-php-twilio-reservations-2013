SET IDENTITY_INSERT [tt_ireserv_it].[dbo].[sms_steps] ON
INSERT INTO [tt_ireserv_it].[dbo].[sms_steps] (
	step_id
	, keyword_id
	, step
	, order_id
	, question
	, active
)
SELECT
	step_id
	, keyword_id
	, step
	, order_id
	, question
	, active
FROM [tt_cms].[dbo].[sms_steps]
SET IDENTITY_INSERT [tt_ireserv_it].[dbo].[sms_steps] OFF
/*
USE tt_ireserv_it
SELECT
	a.sms_id
	, a.domain_id
	, a.sms_text
	, a.sms_voice
	, a.active
INTO [dbo].[sms_controller_new]
FROM [tt_cms].[dbo].[sms_controller] AS a
*/