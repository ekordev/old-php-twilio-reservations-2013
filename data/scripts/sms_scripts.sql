USE [tt_ireserv_it]
GO
/****** Object:  UserDefinedTableType [dbo].[JSONHierarchy]    Script Date: 10/24/2013 6:38:25 AM ******/
CREATE TYPE [dbo].[JSONHierarchy] AS TABLE(
	[element_id] [int] NOT NULL,
	[parent_ID] [int] NULL,
	[Object_ID] [int] NULL,
	[NAME] [nvarchar](2000) NULL,
	[StringValue] [nvarchar](max) NOT NULL,
	[ValueType] [varchar](10) NOT NULL,
	PRIMARY KEY CLUSTERED 
(
	[element_id] ASC
)WITH (IGNORE_DUP_KEY = OFF)
)
GO
/****** Object:  StoredProcedure [dbo].[get_keywordSmsSteps]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:	James Van Leuven
-- Create date: 6/04/2013 .7:10 PM
-- Description:	return the specific keyword steps by keyword
-- =============================================
CREATE PROCEDURE [dbo].[get_keywordSmsSteps]
	@keyword NVARCHAR(100)
AS
	BEGIN
		SELECT * 
		FROM
			dbo.view_keywordProcess
		WHERE
			( LOWER(LTRIM(RTRIM(keyword))) = LOWER(LTRIM(RTRIM(@keyword))) )
		ORDER BY 
			order_id
	END

GO
/****** Object:  StoredProcedure [dbo].[get_keywordSteps]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:	James Van Leuven
-- Create date: 5/31/2013 10:42:11 AM
-- Description:	return the specific keyword steps
-- =============================================
CREATE PROCEDURE [dbo].[get_keywordSteps]
	@keyword_id INT
AS
	BEGIN
		SELECT * 
		FROM
			dbo.view_keywordProcess
		WHERE
			(keyword_id = @keyword_id)
		ORDER BY 
			order_id
	END

GO
/****** Object:  StoredProcedure [dbo].[get_SMS_Keywords]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:	James Van Leuven
-- Create date: 5/31/2013 5:55:58 AM
-- Description:	return the SMS Keywords Dictionary
-- =============================================
CREATE PROCEDURE [dbo].[get_SMS_Keywords]
	@domain_id INT
AS
	BEGIN
		SELECT * 
		FROM
			dbo.view_sms_Keywords
		WHERE
			(domain_id = @domain_id)
	END

GO
/****** Object:  StoredProcedure [dbo].[get_SMS_Keywords_List]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:	James Van Leuven
-- Create date: 5/31/2013 5:55:58 AM
-- Description:	return the SMS Keywords List
-- =============================================
CREATE PROCEDURE [dbo].[get_SMS_Keywords_List]
	@domain NVARCHAR(255)
AS
	BEGIN
		SELECT sms_keyword 
		FROM
			dbo.view_sms_Keywords
		WHERE
			(LTRIM(RTRIM(app)) = LTRIM(RTRIM(@domain)) )
	END

GO
/****** Object:  UserDefinedFunction [dbo].[CMN_FmtPhone]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
    CREATE FUNCTION [dbo].[CMN_FmtPhone]  
    (  
        @PhoneNumber varchar(15)  
    )  
    RETURNS varchar (15)  
    AS  
    BEGIN  
        Declare @returnValue as Varchar(15)  
      
        SELECT @returnValue =    
                CASE   
                WHEN LEN(LTRIM(RTRIM(@PhoneNumber))) = 10   
                    THEN '(' + SUBSTRING(@PhoneNumber, 1, 3) + ')'   
                            + ' ' + SUBSTRING(@PhoneNumber, 4, 3)   
                            + '-' + SUBSTRING(@PhoneNumber, 7, 4)   
                WHEN LEN(LTRIM(RTRIM(@PhoneNumber))) > 10   
                    THEN '(' + SUBSTRING(@PhoneNumber, 1, 3) + ')'   
                            + ' ' + SUBSTRING(@PhoneNumber, 4, 3) + '-'   
                            + SUBSTRING(@PhoneNumber, 7, 4)   
                            + ' Ext: ' + SUBSTRING(@PhoneNumber, 11, 5)   
                END  
      
        RETURN @returnValue;  
      
    END  
GO
/****** Object:  UserDefinedFunction [dbo].[fnSplit]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
	CREATE FUNCTION [dbo].[fnSplit](
		@sInputList VARCHAR(8000)
		, @sDelimiter VARCHAR(8000) = ','
	) RETURNS @List TABLE (item VARCHAR(8000))
	BEGIN
		DECLARE @sItem VARCHAR(8000)
		WHILE CHARINDEX(@sDelimiter,@sInputList,0) > 0
		BEGIN
			SELECT @sItem=RTRIM(LTRIM(SUBSTRING(@sInputList,1,CHARINDEX(@sDelimiter,@sInputList,0)-1))),
			@sInputList=RTRIM(LTRIM(SUBSTRING(@sInputList,CHARINDEX(@sDelimiter,@sInputList,0)+LEN(@sDelimiter),LEN(@sInputList))))

		IF LEN(@sItem) > 0
			INSERT INTO @List SELECT @sItem
		END
		IF LEN(@sInputList) > 0
			INSERT INTO @List SELECT @sInputList
		RETURN
	END
GO
/****** Object:  UserDefinedFunction [dbo].[ToJSON]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE FUNCTION [dbo].[ToJSON] 
(
	-- Add the parameters for the function here
	@Hierarchy JSONHierarchy READONLY
)
RETURNS NVARCHAR(MAX)--JSON documents are always unicode.
AS
BEGIN
  DECLARE
    @JSON NVARCHAR(MAX),
    @NewJSON NVARCHAR(MAX),
    @Where INT,
    @ANumber INT,
    @notNumber INT,
    @indent INT,
    @CrLf CHAR(2)--just a simple utility to save typing!
      
  --firstly get the root token into place 
  SELECT @CrLf=CHAR(13)+CHAR(10),--just CHAR(10) in UNIX
         @JSON = CASE ValueType WHEN 'array' THEN '[' ELSE '{' END
            +@CrLf+ '@Object'+CONVERT(VARCHAR(5),OBJECT_ID)
            +@CrLf+CASE ValueType WHEN 'array' THEN ']' ELSE '}' END
  FROM @Hierarchy 
    WHERE parent_id IS NULL AND valueType IN ('object','array') --get the root element
/* now we simply iterat from the root token growing each branch and leaf in each iteration. This won't be enormously quick, but it is simple to do. All values, or name/value pairs withing a structure can be created in one SQL Statement*/
  WHILE 1=1
    begin
    SELECT @where= PATINDEX('%[^[a-zA-Z0-9]@Object%',@json)--find NEXT token
    if @where=0 BREAK
    /* this is slightly painful. we get the indent of the object we've found by looking backwards up the string */ 
    SET @indent=CHARINDEX(char(10)+char(13),Reverse(LEFT(@json,@where))+char(10)+char(13))-1
    SET @NotNumber= PATINDEX('%[^0-9]%', RIGHT(@json,LEN(@JSON+'|')-@Where-8)+' ')--find NEXT token
    SET @NewJSON=NULL --this contains the structure in its JSON form
    SELECT @NewJSON=COALESCE(@NewJSON+','+@CrLf+SPACE(@indent),'')
      +COALESCE('"'+NAME+'" : ','')
      +CASE valuetype 
        WHEN 'array' THEN '  ['+@CrLf+SPACE(@indent+2)
           +'@Object'+CONVERT(VARCHAR(5),OBJECT_ID)+@CrLf+SPACE(@indent+2)+']' 
        WHEN 'object' then '  {'+@CrLf+SPACE(@indent+2)
           +'@Object'+CONVERT(VARCHAR(5),OBJECT_ID)+@CrLf+SPACE(@indent+2)+'}'
        WHEN 'string' THEN '"'+dbo.JSONEscaped(StringValue)+'"'
        ELSE StringValue
       END 
     FROM @Hierarchy WHERE parent_id= SUBSTRING(@JSON,@where+8, @Notnumber-1)
     /* basically, we just lookup the structure based on the ID that is appended to the @Object token. Simple eh? */
    --now we replace the token with the structure, maybe with more tokens in it.
    Select @JSON=STUFF (@JSON, @where+1, 8+@NotNumber-1, @NewJSON)
    end
  return @JSON
end

GO
/****** Object:  UserDefinedFunction [dbo].[ToXML]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create FUNCTION [dbo].[ToXML]
(
/*this function converts a JSONhierarchy table into an XML document. This uses the same technique as the toJSON function, and uses the 'entities' form of XML syntax to give a compact rendering of the structure */
      @Hierarchy JSONHierarchy READONLY
)
RETURNS NVARCHAR(MAX)--use unicode.
AS
BEGIN
  DECLARE
    @XMLAsString NVARCHAR(MAX),
    @NewXML NVARCHAR(MAX),
    @Entities NVARCHAR(MAX),
    @Objects NVARCHAR(MAX),
    @Name NVARCHAR(200),
    @Where INT,
    @ANumber INT,
    @notNumber INT,
    @indent INT,
    @CrLf CHAR(2)--just a simple utility to save typing!
      
  --firstly get the root token into place 
  --firstly get the root token into place 
  SELECT @CrLf=CHAR(13)+CHAR(10),--just CHAR(10) in UNIX
         @XMLasString ='<?xml version="1.0" ?>
@Object'+CONVERT(VARCHAR(5),OBJECT_ID)+'
'
    FROM @hierarchy 
    WHERE parent_id IS NULL AND valueType IN ('object','array') --get the root element
/* now we simply iterate from the root token growing each branch and leaf in each iteration. This won't be enormously quick, but it is simple to do. All values, or name/value pairs within a structure can be created in one SQL Statement*/
  WHILE 1=1
    begin
    SELECT @where= PATINDEX('%[^a-zA-Z0-9]@Object%',@XMLAsString)--find NEXT token
    if @where=0 BREAK
    /* this is slightly painful. we get the indent of the object we've found by looking backwards up the string */ 
    SET @indent=CHARINDEX(char(10)+char(13),Reverse(LEFT(@XMLasString,@where))+char(10)+char(13))-1
    SET @NotNumber= PATINDEX('%[^0-9]%', RIGHT(@XMLasString,LEN(@XMLAsString+'|')-@Where-8)+' ')--find NEXT token
    SET @Entities=NULL --this contains the structure in its XML form
    SELECT @Entities=COALESCE(@Entities+' ',' ')+NAME+'="'
     +REPLACE(REPLACE(REPLACE(StringValue, '<', '&lt;'), '&', '&amp;'),'>', '&gt;')
     + '"'  
       FROM @hierarchy 
       WHERE parent_id= SUBSTRING(@XMLasString,@where+8, @Notnumber-1) 
          AND ValueType NOT IN ('array', 'object')
    SELECT @Entities=COALESCE(@entities,''),@Objects='',@name=CASE WHEN Name='-' THEN 'root' ELSE NAME end
      FROM @hierarchy 
      WHERE [Object_id]= SUBSTRING(@XMLasString,@where+8, @Notnumber-1) 
    
    SELECT  @Objects=@Objects+@CrLf+SPACE(@indent+2)
           +'@Object'+CONVERT(VARCHAR(5),OBJECT_ID)
           --+@CrLf+SPACE(@indent+2)+''
      FROM @hierarchy 
      WHERE parent_id= SUBSTRING(@XMLasString,@where+8, @Notnumber-1) 
      AND ValueType IN ('array', 'object')
    IF @Objects='' --if it is a lef, we can do a more compact rendering
         SELECT @NewXML='<'+COALESCE(@name,'item')+@entities+' />'
    ELSE
        SELECT @NewXML='<'+COALESCE(@name,'item')+@entities+'>'
            +@Objects+@CrLf++SPACE(@indent)+'</'+COALESCE(@name,'item')+'>'
     /* basically, we just lookup the structure based on the ID that is appended to the @Object token. Simple eh? */
    --now we replace the token with the structure, maybe with more tokens in it.
    Select @XMLasString=STUFF (@XMLasString, @where+1, 8+@NotNumber-1, @NewXML)
    end
  return @XMLasString
  end

GO
/****** Object:  Table [dbo].[sms_controller]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sms_controller](
	[sms_id] [int] IDENTITY(1,1) NOT NULL,
	[domain_id] [int] NULL,
	[sms_text] [decimal](18, 0) NULL,
	[sms_voice] [decimal](18, 0) NULL,
	[active] [bit] NOT NULL,
 CONSTRAINT [PK_sms_controller] PRIMARY KEY CLUSTERED 
(
	[sms_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[sms_keywords]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sms_keywords](
	[keyword_id] [int] IDENTITY(1,1) NOT NULL,
	[keyword_word] [nvarchar](100) NULL,
	[keyword_description] [nvarchar](200) NULL,
	[keyword_shortcut] [nvarchar](max) NULL,
 CONSTRAINT [PK_sms_keywords] PRIMARY KEY CLUSTERED 
(
	[keyword_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[sms_mapping]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sms_mapping](
	[map_id] [int] IDENTITY(1,1) NOT NULL,
	[sms_id] [int] NULL,
	[keyword_id] [int] NULL,
 CONSTRAINT [PK_sms_mapping] PRIMARY KEY CLUSTERED 
(
	[map_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[sms_steps]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sms_steps](
	[step_id] [int] IDENTITY(1,1) NOT NULL,
	[keyword_id] [int] NULL,
	[step] [nvarchar](255) NULL,
	[order_id] [bigint] NULL,
	[question] [nvarchar](500) NULL,
	[active] [bit] NOT NULL,
 CONSTRAINT [PK_sms_steps] PRIMARY KEY CLUSTERED 
(
	[step_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  View [dbo].[view_keywordProcess]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_keywordProcess]
AS
SELECT        TOP (100) PERCENT a.keyword_id, LTRIM(RTRIM(a.keyword_word)) AS keyword, LTRIM(RTRIM(b.question)) AS step_question, LTRIM(RTRIM(b.step)) AS step_answer,
                          b.order_id
FROM            dbo.sms_keywords AS a RIGHT OUTER JOIN
                         dbo.sms_steps AS b ON a.keyword_id = b.keyword_id
WHERE        (b.active = 1)
ORDER BY a.keyword_id, b.order_id

GO
/****** Object:  View [dbo].[view_sms_Keywords]    Script Date: 10/24/2013 6:38:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_sms_Keywords]
AS
SELECT TOP (100) PERCENT 
	a.domain_id
	, a.sms_id
	, b.map_id
	, c.keyword_id
	, LTRIM(RTRIM(a.sms_text)) AS sms_number
	, LTRIM(RTRIM(c.keyword_word)) AS sms_keyword
	, LTRIM(RTRIM(c.keyword_description)) AS keyword_info
	, LTRIM(RTRIM(c.keyword_shortcut)) AS keyword_shortcut
	, LTRIM(RTRIM(d.domain_name)) AS domain
	, LTRIM(RTRIM(d.domain_application)) AS app
	, a.active
FROM
	dbo.crm_domains AS d 
	LEFT OUTER JOIN
	dbo.sms_controller AS a 
	ON d.domain_id = a.domain_id 
	RIGHT OUTER JOIN 
	dbo.sms_keywords AS c 
	LEFT OUTER JOIN 
	dbo.sms_mapping AS b 
	ON c.keyword_id = b.keyword_id 
	ON a.sms_id = b.sms_id
WHERE        (a.sms_id IS NOT NULL) AND (a.active = 1)
ORDER BY a.domain_id, a.sms_id, b.map_id, c.keyword_id

GO
ALTER TABLE [dbo].[sms_controller] ADD  CONSTRAINT [DF_sms_controller_active]  DEFAULT ((1)) FOR [active]
GO
ALTER TABLE [dbo].[sms_steps] ADD  CONSTRAINT [DF_sms_steps_active]  DEFAULT ((1)) FOR [active]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[39] 4[33] 2[7] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 162
               Right = 239
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "b"
            Begin Extent = 
               Top = 6
               Left = 277
               Bottom = 180
               Right = 447
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1560
         Width = 7485
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1365
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_keywordProcess'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_keywordProcess'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[51] 4[19] 2[8] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "d"
            Begin Extent = 
               Top = 49
               Left = 0
               Bottom = 240
               Right = 170
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 190
               Bottom = 178
               Right = 360
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "c"
            Begin Extent = 
               Top = 30
               Left = 618
               Bottom = 189
               Right = 819
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "b"
            Begin Extent = 
               Top = 30
               Left = 406
               Bottom = 142
               Right = 576
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1425
         Width = 1500
         Width = 1500
         Width = 2325
         Width = 2325
         Width = 2235
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 3270
         Alias = 1470
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_sms_Keywords'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_sms_Keywords'
GO
