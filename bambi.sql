/*
 Navicat Premium Data Transfer

 Source Server         : localss
 Source Server Type    : SQL Server
 Source Server Version : 16001000 (16.00.1000)
 Source Host           : localhost:1433
 Source Catalog        : bambi
 Source Schema         : dbo

 Target Server Type    : SQL Server
 Target Server Version : 16001000 (16.00.1000)
 File Encoding         : 65001

 Date: 06/10/2024 21:34:36
*/


-- ----------------------------
-- Table structure for tbl_saham
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[tbl_saham]') AND type IN ('U'))
	DROP TABLE [dbo].[tbl_saham]
GO

CREATE TABLE [dbo].[tbl_saham] (
  [saham_id] int  IDENTITY(1,1) NOT NULL,
  [idx_saham] varchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS  NOT NULL,
  [nama_perusahaan] varchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS  NOT NULL,
  [harga_ipo] numeric(18) DEFAULT 0 NOT NULL
)
GO

ALTER TABLE [dbo].[tbl_saham] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of tbl_saham
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[tbl_saham] ON
GO

INSERT INTO [dbo].[tbl_saham] ([saham_id], [idx_saham], [nama_perusahaan], [harga_ipo]) VALUES (N'1', N'GOTO', N'Gojek Tokopedia', N'500'), (N'2', N'BBCA', N'Bank Central Asia', N'5000')
GO

SET IDENTITY_INSERT [dbo].[tbl_saham] OFF
GO

COMMIT
GO


-- ----------------------------
-- Table structure for tbl_transaction
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[tbl_transaction]') AND type IN ('U'))
	DROP TABLE [dbo].[tbl_transaction]
GO

CREATE TABLE [dbo].[tbl_transaction] (
  [transaction_id] int  IDENTITY(1,1) NOT NULL,
  [idx_saham] varchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS  NOT NULL,
  [topen] numeric(18) DEFAULT 0 NOT NULL,
  [thigh] numeric(18) DEFAULT 0 NOT NULL,
  [tlow] numeric(18)  NOT NULL,
  [tclose] numeric(18) DEFAULT 0 NOT NULL,
  [t_time] datetime2(7)  NULL,
  [saham_id] int  NOT NULL
)
GO

ALTER TABLE [dbo].[tbl_transaction] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of tbl_transaction
-- ----------------------------
BEGIN TRANSACTION
GO

SET IDENTITY_INSERT [dbo].[tbl_transaction] ON
GO

INSERT INTO [dbo].[tbl_transaction] ([transaction_id], [idx_saham], [topen], [thigh], [tlow], [tclose], [t_time], [saham_id]) VALUES (N'1', N'GOTO', N'500', N'530', N'495', N'495', N'2024-10-04 09:00:00.0000000', N'1'), (N'2', N'GOTO', N'505', N'530', N'495', N'500', N'2024-10-04 09:05:00.0000000', N'1'), (N'3', N'GOTO', N'510', N'530', N'495', N'505', N'2024-10-04 09:10:00.0000000', N'1'), (N'4', N'GOTO', N'515', N'530', N'495', N'510', N'2024-10-04 09:15:00.0000000', N'1'), (N'5', N'GOTO', N'520', N'530', N'495', N'515', N'2024-10-04 09:20:00.0000000', N'1'), (N'6', N'GOTO', N'525', N'530', N'495', N'520', N'2024-10-04 09:25:00.0000000', N'1'), (N'7', N'GOTO', N'520', N'530', N'495', N'515', N'2024-10-04 09:30:00.0000000', N'1'), (N'8', N'GOTO', N'525', N'530', N'495', N'520', N'2024-10-04 09:35:00.0000000', N'1'), (N'9', N'GOTO', N'530', N'530', N'495', N'525', N'2024-10-04 09:40:00.0000000', N'1'), (N'10', N'GOTO', N'515', N'530', N'495', N'530', N'2024-10-04 09:45:00.0000000', N'1'), (N'11', N'GOTO', N'520', N'530', N'495', N'515', N'2024-10-04 09:50:00.0000000', N'1'), (N'12', N'GOTO', N'505', N'530', N'495', N'520', N'2024-10-04 09:55:00.0000000', N'1'), (N'13', N'GOTO', N'500', N'530', N'495', N'505', N'2024-10-04 10:00:00.0000000', N'1'), (N'14', N'GOTO', N'500', N'530', N'495', N'500', N'2024-10-04 10:05:00.0000000', N'1'), (N'15', N'GOTO', N'500', N'530', N'495', N'500', N'2024-10-04 10:10:00.0000000', N'1'), (N'16', N'GOTO', N'495', N'530', N'495', N'500', N'2024-10-04 10:15:00.0000000', N'1'), (N'17', N'GOTO', N'495', N'530', N'495', N'495', N'2024-10-04 10:20:00.0000000', N'1'), (N'18', N'GOTO', N'495', N'530', N'495', N'495', N'2024-10-04 10:25:00.0000000', N'1'), (N'19', N'GOTO', N'500', N'530', N'495', N'495', N'2024-10-04 10:30:00.0000000', N'1'), (N'20', N'GOTO', N'500', N'530', N'495', N'500', N'2024-10-04 10:35:00.0000000', N'1'), (N'21', N'GOTO', N'510', N'530', N'495', N'500', N'2024-10-04 10:40:00.0000000', N'1'), (N'22', N'GOTO', N'505', N'530', N'495', N'510', N'2024-10-04 10:45:00.0000000', N'1'), (N'27', N'BBCA', N'5000', N'5500', N'5000', N'4500', N'2024-10-06 21:29:34.0000000', N'2'), (N'28', N'BBCA', N'5500', N'5500', N'4500', N'6000', N'2024-10-06 21:29:58.0000000', N'2')
GO

SET IDENTITY_INSERT [dbo].[tbl_transaction] OFF
GO

COMMIT
GO


-- ----------------------------
-- Auto increment value for tbl_saham
-- ----------------------------
DBCC CHECKIDENT ('[dbo].[tbl_saham]', RESEED, 2)
GO


-- ----------------------------
-- Primary Key structure for table tbl_saham
-- ----------------------------
ALTER TABLE [dbo].[tbl_saham] ADD CONSTRAINT [PK__tbl_saha__19CFBC2D294C12E8] PRIMARY KEY CLUSTERED ([saham_id], [idx_saham])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO


-- ----------------------------
-- Auto increment value for tbl_transaction
-- ----------------------------
DBCC CHECKIDENT ('[dbo].[tbl_transaction]', RESEED, 28)
GO


-- ----------------------------
-- Primary Key structure for table tbl_transaction
-- ----------------------------
ALTER TABLE [dbo].[tbl_transaction] ADD CONSTRAINT [PK__tbl_tran__85C600AF2E208580] PRIMARY KEY CLUSTERED ([transaction_id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO

