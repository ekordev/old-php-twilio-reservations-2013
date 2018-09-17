SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		James Van Leuven
-- Create date: October 17th, 2013
-- Description:	Insert a new Guest, GList, Etc
-- =============================================
CREATE PROCEDURE insert_GuestList(
	@guest_user_id INT = NULL OUT
	, @token_id NVARCHAR(MAX) /* json file unique identifier */
	, @session_id NVARCHAR(MAX) /* phpsessionid*/
	, @requested_by NVARCHAR(50) /* number received from */
	, @twilio_number NVARCHAR(50) /* twilio number sent to */
	, @domain NVARCHAR(150) /* domain requested to */
	, @raw_data NVARCHAR(MAX) /* the json object */
	, @request_name NVARCHAR(500) /* name of person requesting */
	, @request_email NVARCHAR(50) /* email requesting (it may be different than the number on file) */
	, @number_guests numeric(18, 0) /* integer of guests */
	, @request_date NVARCHAR(50) /* text based date of arrival */
	, @request_time NVARCHAR(50) /* text based time of arrival */
	, @request_reason NVARCHAR(MAX) /* reason for guest list */
	, @insert_date DATETIMEOFFSET(7) /* inserted as a recordset date */
)
AS
BEGIN
	/* STEP 1 - see if this is an employee request */
	IF EXISTS(
		SELECT a.contact_id AS [guest_user_id]
		FROM [dbo].[crm_contact_details] AS a
		WHERE(
			( LTRIM(RTRIM( a.contact_mobile )) = LTRIM(RTRIM( @requested_by )) )
		)
	)
	/* EXISTS */
	/* GOTO STEP 1.1 */
	IF NOT EXISTS
		/* NOT EXISTS */
		/* GOTO STEP 1.2 */
		(
			SELECT b.patron_id AS [guest_user_id]
			FROM [dbo].[crm_patron] AS b
			WHERE(
				( LTRIM(RTRIM( b.patron_mobile )) = LTRIM(RTRIM( @requested_by )) )
			)
		)
			INSERT INTO [dbo].[crm_patron] (
				patron_mobile
				, patron_name
				, patron_email
				, ttl_points
			) VALUES (
				LTRIM(RTRIM(@requested_by))
				, LTRIM(RTRIM(@request_name))
				, LTRIM(RTRIM(@request_email))
				, '100'
			)
END
GO
