-- Create a new table called 'Note' in schema 'TutorialDb'
-- Drop the table if it already exists
IF OBJECT_ID('TutorialDb.Note', 'U') IS NOT NULL
DROP TABLE TutorialDb.Note
GO
-- Create the table in the specified schema
CREATE TABLE Note
(
    NoteId INT IDENTITY(1,1) PRIMARY KEY, -- primary key column
    Title [NVARCHAR](50) NOT NULL,
    DescNote [NVARCHAR](50) NOT NULL
    -- specify more columns here
);
GO

-- Drop the table 'Note' in schema 'SchemaName'
DROP TABLE dbo.Note
GO

-- Drop 'DescNote' from table 'TableName' in schema 'SchemaName'
ALTER TABLE Note
    DROP COLUMN DescNote
GO

-- Add a new column 'DescNote' to table 'TableName' in schema 'SchemaName'
ALTER TABLE Note
    ADD DescNote [TEXT] NULL
GO

-- Insert rows into table 'Note'
INSERT INTO dbo.Note ( [NoteId], [Title], [DescNote] )
VALUES
( 1, 'Join', 'Join Us On MyApp' ),
( 2, 'Jhon', 'Come on' )
-- add more rows here
GO

INSERT INTO dbo.Note ( [Title], [DescNote] )
VALUES
( 'Join', 'Join Us On MyApp' ),
( 'Jhon', 'Come on' )
-- add more rows here
GO

-- Update rows in table 'Note'
UPDATE Note
SET
    [Title] = 'Join 123',
    [DescNote] = 'Come On'
    -- add more columns and values here
WHERE 	[NoteId] = 1
GO

-- Delete rows from table 'Note'
DELETE FROM Note
WHERE 	[NoteId] = 2
GO

-- Select rows from a Table or View 'Note' in schema 'SchemaName'
SELECT * FROM Note
WHERE 	[Title] = 'Join'
GO

-- Select rows from a Table or View 'Note' in schema 'SchemaName'
SELECT * FROM Note
GO

