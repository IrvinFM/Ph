USE [master]
GO
/****** Object:  Database [StratRooms]    Script Date: 03/07/2025 06:11:58 p. m. ******/
CREATE DATABASE [StratRooms]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'StratRooms', FILENAME = N'C:\SQL2022\SQLap\Data\StratRooms.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'StratRooms_log', FILENAME = N'C:\SQL2022\SQLap\Data\StratRooms_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [StratRooms] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [StratRooms].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [StratRooms] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [StratRooms] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [StratRooms] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [StratRooms] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [StratRooms] SET ARITHABORT OFF 
GO
ALTER DATABASE [StratRooms] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [StratRooms] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [StratRooms] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [StratRooms] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [StratRooms] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [StratRooms] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [StratRooms] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [StratRooms] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [StratRooms] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [StratRooms] SET  ENABLE_BROKER 
GO
ALTER DATABASE [StratRooms] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [StratRooms] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [StratRooms] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [StratRooms] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [StratRooms] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [StratRooms] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [StratRooms] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [StratRooms] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [StratRooms] SET  MULTI_USER 
GO
ALTER DATABASE [StratRooms] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [StratRooms] SET DB_CHAINING OFF 
GO
ALTER DATABASE [StratRooms] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [StratRooms] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [StratRooms] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [StratRooms] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [StratRooms] SET QUERY_STORE = ON
GO
ALTER DATABASE [StratRooms] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [StratRooms]
GO
/****** Object:  Table [dbo].[Cursos]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Cursos](
	[idCurso] [int] IDENTITY(1,1) NOT NULL,
	[idMateria] [int] NULL,
	[idProfesor] [int] NULL,
	[idSede] [int] NULL,
	[nombreCurso] [varchar](100) NOT NULL,
	[descripcionCurso] [text] NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idCurso] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Entregas]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Entregas](
	[idEntrega] [int] IDENTITY(1,1) NOT NULL,
	[idTarea] [int] NULL,
	[idAlumno] [int] NULL,
	[fechaTareaEntregada] [datetime] NULL,
	[archivoEntrega] [varchar](255) NULL,
	[calificacionEntrega] [decimal](5, 2) NULL,
	[comentarioProfesorEntrega] [text] NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idEntrega] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Inscripcions]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Inscripcions](
	[idInscripcion] [int] IDENTITY(1,1) NOT NULL,
	[idCurso] [int] NULL,
	[idAlumno] [int] NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idInscripcion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Materia]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Materia](
	[idMateria] [int] IDENTITY(1,1) NOT NULL,
	[nombreMateria] [varchar](100) NOT NULL,
	[descripcionMateria] [text] NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idMateria] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Sedes]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Sedes](
	[idSede] [int] IDENTITY(1,1) NOT NULL,
	[nombreSede] [varchar](100) NOT NULL,
	[direccionSede] [varchar](200) NOT NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
	[telefonoSede] [varchar](20) NOT NULL,
	[emailSede] [varchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idSede] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SequelizeMeta]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SequelizeMeta](
	[name] [varchar](255) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Tareas]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Tareas](
	[idTarea] [int] IDENTITY(1,1) NOT NULL,
	[idCurso] [int] NULL,
	[tituloTarea] [varchar](100) NOT NULL,
	[descripcionTarea] [text] NOT NULL,
	[fechaSubidaTarea] [datetime] NULL,
	[fechaEntregaTarea] [datetime] NOT NULL,
	[estadoTarea] [varchar](10) NULL,
	[archivoTarea] [varchar](255) NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idTarea] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Usuarios]    Script Date: 03/07/2025 06:11:59 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Usuarios](
	[idUsuario] [int] IDENTITY(1,1) NOT NULL,
	[tipoUsuario] [varchar](20) NOT NULL,
	[idSede] [int] NULL,
	[nombreUsuario] [varchar](50) NOT NULL,
	[apePaterno] [varchar](50) NOT NULL,
	[apeMaterno] [varchar](50) NULL,
	[password] [varchar](255) NOT NULL,
	[imgUrlUsuario] [varchar](255) NULL,
	[createdAt] [datetime] NOT NULL,
	[updatedAt] [datetime] NOT NULL,
	[email] [varchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idUsuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Cursos] ON 

INSERT [dbo].[Cursos] ([idCurso], [idMateria], [idProfesor], [idSede], [nombreCurso], [descripcionCurso], [createdAt], [updatedAt]) VALUES (1, 4, 52, 3, N'Leteratura I', N'Introducción a la literatura contemporánea.', CAST(N'2025-05-19T13:18:58.760' AS DateTime), CAST(N'2025-05-19T17:27:41.207' AS DateTime))
INSERT [dbo].[Cursos] ([idCurso], [idMateria], [idProfesor], [idSede], [nombreCurso], [descripcionCurso], [createdAt], [updatedAt]) VALUES (2, 2, 11, 1, N'Matematicas II', N'Continuación del curso de matematicas avanzadas.', CAST(N'2025-05-19T13:14:41.513' AS DateTime), CAST(N'2025-05-19T17:28:44.100' AS DateTime))
INSERT [dbo].[Cursos] ([idCurso], [idMateria], [idProfesor], [idSede], [nombreCurso], [descripcionCurso], [createdAt], [updatedAt]) VALUES (3, 2, 51, 30, N'Matematicas I', N'Introduccion a las matematicas avanzadas.', CAST(N'2025-04-20T17:25:55.233' AS DateTime), CAST(N'2025-05-20T16:24:29.333' AS DateTime))
INSERT [dbo].[Cursos] ([idCurso], [idMateria], [idProfesor], [idSede], [nombreCurso], [descripcionCurso], [createdAt], [updatedAt]) VALUES (4, 10, 18, 33, N'Fisica II', N'Continuación del curso de fisica cuantica.', CAST(N'2025-04-20T17:27:13.180' AS DateTime), CAST(N'2025-05-20T16:24:35.153' AS DateTime))
SET IDENTITY_INSERT [dbo].[Cursos] OFF
GO
SET IDENTITY_INSERT [dbo].[Inscripcions] ON 

INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (1, 1, 12, CAST(N'2025-04-20T19:20:40.563' AS DateTime), CAST(N'2025-04-20T19:20:40.563' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (2, 2, 12, CAST(N'2025-04-20T19:28:35.647' AS DateTime), CAST(N'2025-04-20T19:28:35.647' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (3, 10, 12, CAST(N'2025-05-19T14:53:56.740' AS DateTime), CAST(N'2025-05-19T14:53:56.740' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (4, 10, 53, CAST(N'2025-05-19T14:54:06.620' AS DateTime), CAST(N'2025-05-19T14:54:06.620' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (5, 2, 22, CAST(N'2025-05-19T17:39:09.190' AS DateTime), CAST(N'2025-05-19T17:39:09.190' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (6, 11, 22, CAST(N'2025-05-19T17:41:55.937' AS DateTime), CAST(N'2025-05-19T17:41:55.937' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (7, 11, 12, CAST(N'2025-05-19T17:41:58.803' AS DateTime), CAST(N'2025-05-19T17:41:58.803' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (8, 1, 22, CAST(N'2025-05-19T17:42:22.487' AS DateTime), CAST(N'2025-05-19T17:42:22.487' AS DateTime))
INSERT [dbo].[Inscripcions] ([idInscripcion], [idCurso], [idAlumno], [createdAt], [updatedAt]) VALUES (9, 1, 53, CAST(N'2025-05-20T17:47:19.493' AS DateTime), CAST(N'2025-05-20T17:47:19.493' AS DateTime))
SET IDENTITY_INSERT [dbo].[Inscripcions] OFF
GO
SET IDENTITY_INSERT [dbo].[Materia] ON 

INSERT [dbo].[Materia] ([idMateria], [nombreMateria], [descripcionMateria], [createdAt], [updatedAt]) VALUES (1, N'Matemáticas Avanzadas', N'Curso avanzado de cálculo y álgebra lineal', CAST(N'2025-04-20T11:48:27.473' AS DateTime), CAST(N'2025-05-16T18:57:28.530' AS DateTime))
INSERT [dbo].[Materia] ([idMateria], [nombreMateria], [descripcionMateria], [createdAt], [updatedAt]) VALUES (2, N'Literatura Contemporánea', N'Análisis de obras literarias del siglo XX y XXI.', CAST(N'2025-04-20T11:52:21.620' AS DateTime), CAST(N'2025-05-16T18:58:14.567' AS DateTime))
INSERT [dbo].[Materia] ([idMateria], [nombreMateria], [descripcionMateria], [createdAt], [updatedAt]) VALUES (3, N'Física Cuántica', N'Introducción a la mecánica cuántica', CAST(N'2025-05-16T18:58:41.403' AS DateTime), CAST(N'2025-05-16T18:58:41.403' AS DateTime))
SET IDENTITY_INSERT [dbo].[Materia] OFF
GO
SET IDENTITY_INSERT [dbo].[Sedes] ON 

INSERT [dbo].[Sedes] ([idSede], [nombreSede], [direccionSede], [createdAt], [updatedAt], [telefonoSede], [emailSede]) VALUES (1, N'Sede Central México Norte', N'Av. Reforma 234, Col. Juárez, CDMX', CAST(N'2025-04-20T08:55:35.860' AS DateTime), CAST(N'2025-07-02T21:19:26.830' AS DateTime), N'+52 5592039401', N'sede.norte@instituto.edu.mx')
INSERT [dbo].[Sedes] ([idSede], [nombreSede], [direccionSede], [createdAt], [updatedAt], [telefonoSede], [emailSede]) VALUES (2, N'Campus Guadalajara', N'Av. Américas 1589, Providencia, Guadalajara', CAST(N'2025-04-20T08:53:41.073' AS DateTime), CAST(N'2025-05-16T18:55:26.827' AS DateTime), N'+52 3387654321', N'gdl@instituto.edu.mx')
INSERT [dbo].[Sedes] ([idSede], [nombreSede], [direccionSede], [createdAt], [updatedAt], [telefonoSede], [emailSede]) VALUES (3, N'Sede Monterrey', N'Blvd. García 567, San Pedro Garza García', CAST(N'2025-05-16T18:56:15.440' AS DateTime), CAST(N'2025-05-16T18:56:15.440' AS DateTime), N'+52 8123456789', N'mty@instituto.edu.mx')
INSERT [dbo].[Sedes] ([idSede], [nombreSede], [direccionSede], [createdAt], [updatedAt], [telefonoSede], [emailSede]) VALUES (4, N'Sede Poniente', N'Av Rio de los remedios 401', CAST(N'2025-05-13T19:17:43.907' AS DateTime), CAST(N'2025-07-02T22:20:52.727' AS DateTime), N'+53 34544345', N'easdaW@fdsc.com')
SET IDENTITY_INSERT [dbo].[Sedes] OFF
GO
INSERT [dbo].[SequelizeMeta] ([name]) VALUES (N'20250411224133-replace-usuarioTag-email.cjs')
INSERT [dbo].[SequelizeMeta] ([name]) VALUES (N'20250412004147-rename-contraseña-to-password.cjs')
INSERT [dbo].[SequelizeMeta] ([name]) VALUES (N'20250420143915-add-telefono-email-remove-logo.cjs')
GO
SET IDENTITY_INSERT [dbo].[Usuarios] ON 

INSERT [dbo].[Usuarios] ([idUsuario], [tipoUsuario], [idSede], [nombreUsuario], [apePaterno], [apeMaterno], [password], [imgUrlUsuario], [createdAt], [updatedAt], [email]) VALUES (1, N'ADMINISTRADOR', NULL, N'Luis Antonio', N'Moreno', N'Trejo', N'admin123', N'https://images.pexels.com/photos/3016462/pexels-photo-3016462.jpeg', CAST(N'2025-04-12T08:58:06.597' AS DateTime), CAST(N'2025-05-16T16:44:37.140' AS DateTime), N'admin@admin.com')
INSERT [dbo].[Usuarios] ([idUsuario], [tipoUsuario], [idSede], [nombreUsuario], [apePaterno], [apeMaterno], [password], [imgUrlUsuario], [createdAt], [updatedAt], [email]) VALUES (2, N'PROFESOR', 3, N'Carlos', N'Roman', NULL, N'$2b$10$KY8qXWkjtvRAnve5AeXlCOvb4Xu4PMag6PDMgj8Af.JSnDdK/CMgy', N'https://images.pexels.com/photos/4342401/pexels-photo-4342401.jpeg', CAST(N'2025-04-20T16:11:53.807' AS DateTime), CAST(N'2025-05-16T19:01:10.053' AS DateTime), N'croma294.ht@gmail.com')
INSERT [dbo].[Usuarios] ([idUsuario], [tipoUsuario], [idSede], [nombreUsuario], [apePaterno], [apeMaterno], [password], [imgUrlUsuario], [createdAt], [updatedAt], [email]) VALUES (3, N'ALUMNO', 2, N'Francisco', N'Cisneros', N'Martinez', N'$2b$10$n..t7DyC23m35EaObPnF1uPK2WunzDSoQI0uDAyYfilSdOm0SM1O6', N'https://images.pexels.com/photos/7503525/pexels-photo-7503525.jpeg', CAST(N'2025-04-20T16:16:11.260' AS DateTime), CAST(N'2025-07-03T13:01:30.177' AS DateTime), N'froncisneros420@gmail.com')
INSERT [dbo].[Usuarios] ([idUsuario], [tipoUsuario], [idSede], [nombreUsuario], [apePaterno], [apeMaterno], [password], [imgUrlUsuario], [createdAt], [updatedAt], [email]) VALUES (5, N'alumno', 4, N'Irving', N'Fuentes', N'Martinez', N'$2y$10$sAA1Au/ECvsxdiC7Z/R52u6TTudM7NbsYvYLvE8GxSlm1/f2mgNDu', NULL, CAST(N'2025-07-03T13:16:00.000' AS DateTime), CAST(N'2025-07-03T13:54:53.397' AS DateTime), N'prueba@prueba.com')
SET IDENTITY_INSERT [dbo].[Usuarios] OFF
GO
ALTER TABLE [dbo].[Tareas] ADD  DEFAULT ('PENDIENTE') FOR [estadoTarea]
GO
USE [master]
GO
ALTER DATABASE [StratRooms] SET  READ_WRITE 
GO
