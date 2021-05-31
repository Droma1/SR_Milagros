-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2021 a las 00:49:50
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sr_milagros`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_r` (IN `codigo_u` VARCHAR(20), IN `titulo_u` VARCHAR(100), IN `id_det` INT(11), IN `formate` VARCHAR(100))  BEGIN
	set @id_rec = null;
    select id_recurso into @id_rec from det_recurso where id_det_recurso = id_det;
    
    if (formate = "") then 
    update recursos set cod_recurso = codigo_u where id_recurso = @id_rec;
    update det_recurso set titulo = titulo_u where id_det_recurso = id_det;
    else 
    update recursos set cod_recurso = codigo_u, formato_recurso = formate where id_recurso = @id_rec;
    update det_recurso set titulo = titulo_u where id_det_recurso = id_det;
    end if;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `curso` ()  BEGIN
select * from cursos,grado where cursos.id_grado = grado.id_grado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `grado_seccion` ()  BEGIN
select * from grado,seccion where seccion.id_grado = grado.id_grado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `greado_seccion` ()  BEGIN
select * from grado,seccion where seccion.id_grado = grado.id_grado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `user_` VARCHAR(50))  BEGIN
	set @codigo=null;
	if exists (select cod_docente from docente,persona where docente.id_persona = persona.id_persona and usuario = user_)then 
		select cod_docente into @codigo from docente,persona where docente.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_alumno from persona,alumno where alumno.id_persona = persona.id_persona and usuario = user_) then
		select cod_alumno into @codigo from persona,alumno where alumno.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_admi from persona,administrador where  administrador.id_persona = persona.id_persona and usuario = user_)then
		select cod_admi into @codigo from persona,administrador where  administrador.id_persona = persona.id_persona and usuario = user_;
	end if;

	select @codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_alumno` (IN `nombre_p` VARCHAR(40), IN `apellido_p` VARCHAR(50), IN `usuario_p` VARCHAR(40), IN `clave_` VARCHAR(25), IN `date_r` DATE, IN `telefono_` INT, IN `dni_` INT, IN `direccion_p` VARCHAR(100), IN `genero_` VARCHAR(20), IN `edad_` INT, IN `cod_grado` VARCHAR(10), IN `letra_secc` VARCHAR(10))  BEGIN
set @id_pe = null;
set @id_se = null;
set @id_gr = null;
set @cont = null;
insert into persona(nombre_persona,apellido_persona,usuario,clave,fecha_registro,telefono,dni,direccion,genero,edad)
values(nombre_p,apellido_p,usuario_p,clave_,date_r,telefono_,dni_,direccion_p,genero_,edad_);
select LAST_INSERT_ID() INTO @id_pe;
select id_grado into @id_gr from grado where codigo_grado = cod_grado;
select id_seccion into @id_se from seccion where letra_seccion = letra_secc and id_grado = @id_gr;
select count(*) into @cont from persona;
insert into alumno(cod_alumno,rol_alumno,id_persona,id_grado,id_seccion) 
values(concat("AL-",@cont),"Estudiante",@id_pe,@id_gr,@id_se);


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_admi` (IN `nombre_p` VARCHAR(40), IN `apellido_p` VARCHAR(50), IN `usuario_p` VARCHAR(40), IN `clave_` VARCHAR(25), IN `date_r` DATE, IN `telefono_` INT, IN `dni_` INT, IN `direccion_p` VARCHAR(100), IN `genero_` VARCHAR(20), IN `edad_` INT)  BEGIN
set @id_pe = null;
set @cont = null;
insert into persona(nombre_persona,apellido_persona,usuario,clave,fecha_registro,telefono,dni,direccion,genero,edad)
values(nombre_p,apellido_p,usuario_p,clave_,date_r,telefono_,dni_,direccion_p,genero_,edad_);
select LAST_INSERT_ID() INTO @id_pe;
select count(*) into @count   from persona;
insert into administrador(cod_admi,id_persona)
values(concat("AD-",@count),@id_pe);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_docente` (IN `nombre_p` VARCHAR(40), IN `apellido_p` VARCHAR(50), IN `usuario_p` VARCHAR(40), IN `clave_` VARCHAR(25), IN `date_r` DATE, IN `telefono_` INT, IN `dni_` INT, IN `direccion_p` VARCHAR(100), IN `genero_` VARCHAR(20), IN `edad_` INT, IN `id_c` INT, IN `espe_` VARCHAR(50), IN `nivel` VARCHAR(10))  BEGIN
set @id_pe = null;
set @cont = null;
insert into persona(nombre_persona,apellido_persona,usuario,clave,fecha_registro,telefono,dni,direccion,genero,edad)
values(nombre_p,apellido_p,usuario_p,clave_,date_r,telefono_,dni_,direccion_p,genero_,edad_);
select LAST_INSERT_ID() INTO @id_pe;
select count(*) into @cont   from persona;
insert into docente(cod_docente,nivel_academico,especialidad,id_curso,id_persona,rol_docente)
values(concat("DC-",@cont),nivel,espe_,id_c,@id_pe,"Docente");

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_recurso` (IN `code_user` VARCHAR(20), IN `code_recurso` VARCHAR(20), IN `format_l` VARCHAR(100), IN `title` VARCHAR(100), IN `fecha_s` VARCHAR(20), IN `grado` INT(11))  BEGIN
	set @id_user=null;
    set @id_r = null;
	if exists (select id_persona from docente where cod_docente = code_user)then 
		select id_persona into @id_user from docente where cod_docente = code_ser;
	elseif exists (select id_persona from alumno where cod_alumno = code_user) then
		select id_persona into @id_user from alumno where cod_alumno = code_user;
	elseif exists (select id_persona from administrador where cod_admi = code_user)then
		select id_persona into @id_user from administrador where cod_admi = code_user;
	end if;

    insert into recursos(cod_recurso,formato_recurso,id_grado,id_persona) values(code_recurso,format_l,grado,@id_user);
    select LAST_INSERT_ID() INTO @id_r;
    insert into det_recurso(titulo,fecha_publicacion,fecha_subida,estado,id_recurso) value(title,fecha_s,fecha_s,"Publicado",@id_r);
    select @id_r;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `type_user` (IN `user_` VARCHAR(50))  BEGIN
	set @codigo=null;
	if exists (select cod_docente from docente,persona where docente.id_persona = persona.id_persona and usuario = user_)then 
		select cod_docente into @codigo from docente,persona where docente.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_alumno from persona,alumno where alumno.id_persona = persona.id_persona and usuario = user_) then
		select cod_alumno into @codigo from persona,alumno where alumno.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_admi from persona,administrador where  administrador.id_persona = persona.id_persona and usuario = user_)then
		select cod_admi into @codigo from persona,administrador where  administrador.id_persona = persona.id_persona and usuario = user_;
	end if;

	select @codigo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admi` int(11) NOT NULL,
  `cod_admi` varchar(10) NOT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admi`, `cod_admi`, `id_persona`) VALUES
(1, 'AD-1', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `cod_alumno` varchar(10) NOT NULL,
  `rol_alumno` varchar(20) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `cod_alumno`, `rol_alumno`, `id_persona`, `id_grado`, `id_seccion`) VALUES
(1, 'AL-1', 'Estudiante', 1, 3, 1),
(2, 'AL-2', 'Estudiante', 3, 5, 1),
(3, 'AL-6', 'Estudiante', 27, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(100) DEFAULT NULL,
  `codigo_curso` varchar(10) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre_curso`, `codigo_curso`, `id_grado`) VALUES
(1, 'Matematicas', 'MT-1ro', 1),
(2, 'Matematicas', 'MT-2do', 2),
(3, 'Matematicas', 'MT-3ro', 3),
(4, 'Matematicas', 'MT-4ro', 4),
(5, 'Matematicas', 'MT-5ro', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_recurso`
--

CREATE TABLE `det_recurso` (
  `id_det_recurso` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `fecha_publicacion` varchar(20) DEFAULT NULL,
  `fecha_subida` varchar(20) DEFAULT NULL,
  `fecha_bajada` varchar(20) DEFAULT NULL,
  `estado` varchar(20) NOT NULL,
  `id_recurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `det_recurso`
--

INSERT INTO `det_recurso` (`id_det_recurso`, `titulo`, `fecha_publicacion`, `fecha_subida`, `fecha_bajada`, `estado`, `id_recurso`) VALUES
(2, 'Comprensión Lectora  5to', '2021-02-10', '2021-02-10', NULL, 'Observado', 2),
(3, 'Portafolio alumno', '2021-02-10', '2021-02-10', NULL, 'Publicado', 3),
(4, 'Problemas', '2021-02-10', '2021-02-10', NULL, 'Publicado', 4),
(5, 'solucionario', '2021-02-10', '2021-02-10', NULL, 'Publicado', 5),
(6, 'examen', '2021-02-10', '2021-02-10', NULL, 'Observado', 6),
(7, 'examen', '2021-02-10', '2021-02-10', NULL, 'Publicado', 7),
(8, 'examen', '2021-02-10', '2021-02-10', NULL, 'Observado', 8),
(9, 'Comprensión Lectora', '2021-02-10', '2021-02-10', NULL, 'Observado', 9),
(10, 'Comprensión Lectora', '2021-02-10', '2021-02-10', NULL, 'Publicado', 10),
(11, 'Comprensión Lectora', '2021-02-10', '2021-02-10', NULL, 'Observado', 11),
(12, 'Comprensión Lectora', '2021-02-10', '2021-02-10', NULL, 'Observado', 12),
(13, 'Desarrollo personal Introducción', '2021-02-11', '2021-02-11', NULL, 'Publicado', 13),
(14, 'Niveles de Gobierno', '2021-02-11', '2021-02-11', NULL, 'Publicado', 14),
(15, 'Introduccion de formatos', '2021-02-11', '2021-02-11', NULL, 'Publicado', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `cod_docente` varchar(10) NOT NULL,
  `nivel_academico` varchar(10) DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `rol_docente` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `cod_docente`, `nivel_academico`, `especialidad`, `id_curso`, `id_persona`, `rol_docente`) VALUES
(1, 'DC-1', 'Magister', 'Educacion secundaria', 3, 2, 'Tutor'),
(2, 'DC-5', 'Licenciado', 'Matemáticas', 4, 24, 'Docente'),
(3, 'DC-7', 'niceles', 'niveles', 3, 28, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `codigo_grado` varchar(10) DEFAULT NULL,
  `nro_grado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `codigo_grado`, `nro_grado`) VALUES
(1, 'Primero', '1'),
(2, 'Segundo', '2'),
(3, 'Tercero', '3'),
(4, 'Cuarto', '4'),
(5, 'Quinto', '5');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_admin`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_admin` (
`nombre_persona` varchar(40)
,`apellido_persona` varchar(50)
,`usuario` varchar(40)
,`fecha_registro` date
,`telefono` int(9)
,`dni` int(9)
,`direccion` varchar(100)
,`genero` varchar(20)
,`edad` int(2)
,`cod_admi` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_alumno`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_alumno` (
`nombre_persona` varchar(40)
,`apellido_persona` varchar(50)
,`usuario` varchar(40)
,`fecha_registro` date
,`telefono` int(9)
,`dni` int(9)
,`direccion` varchar(100)
,`genero` varchar(20)
,`edad` int(2)
,`cod_alumno` varchar(10)
,`rol_alumno` varchar(20)
,`nro_grado` varchar(10)
,`letra_seccion` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_docente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_docente` (
`nombre_persona` varchar(40)
,`apellido_persona` varchar(50)
,`usuario` varchar(40)
,`fecha_registro` date
,`telefono` int(9)
,`dni` int(9)
,`direccion` varchar(100)
,`genero` varchar(20)
,`edad` int(2)
,`cod_docente` varchar(10)
,`nivel_academico` varchar(10)
,`especialidad` varchar(50)
,`nombre_curso` varchar(100)
,`codigo_grado` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre_persona` varchar(40) DEFAULT NULL,
  `apellido_persona` varchar(50) DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `clave` varchar(25) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `dni` int(9) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `edad` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre_persona`, `apellido_persona`, `usuario`, `clave`, `fecha_registro`, `fecha_modificacion`, `telefono`, `dni`, `direccion`, `genero`, `edad`) VALUES
(1, 'Yuri Christian', 'Lopez Palomino', 'ylopezp@unamad.edu.pe', 'yurico123', '2021-02-08', '0000-00-00', 987654321, 71256839, 'La joya', 'Masculino', 23),
(2, 'Cesar', 'Lino Arias', 'clinoa@unamad.edu.pe', 'lino123', '2021-02-08', '0000-00-00', 987654221, 71456839, 'los nogales', 'Masculino', 23),
(3, 'Fernando', 'Flores Condori', 'ffloresc@unamad.edu.pe', 'fer123', '2021-02-09', '0000-00-00', 987644221, 75206432, 'los nogales', 'Masculino', 22),
(4, 'Enrike', 'Perez loayza', 'diko@gmail.com', 'diko123', '2021-02-09', '0000-00-00', 984644221, 75406432, 'los nogales', 'Masculino', 25),
(24, 'Fernando', 'Flores Condori', 'nando.rex333@gmail.com', 'nando123', '2021-02-11', NULL, 931119479, 75256032, 'Upiz. Nueva Zarsuela Km 6.300', 'Masculino', 23),
(27, 'Fernando', 'Condori', 'fernando@gmail.com', 'fernando123', '2021-02-11', NULL, 931119479, 741852963, 'Upiz. Nueva Zarsuela Km 6.300', 'Masculino', 20),
(28, 'pedro', 'lares', 'asd@asd.com', 'asd123', '2021-02-11', NULL, 9561234, 41632879, 'av. rst', 'Masculino', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id_recurso` int(11) NOT NULL,
  `cod_recurso` varchar(10) NOT NULL,
  `formato_recurso` varchar(100) DEFAULT NULL,
  `id_grado` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id_recurso`, `cod_recurso`, `formato_recurso`, `id_grado`, `id_persona`) VALUES
(2, 'CM-5to', 'dia-1-compresion-lectora1.pdf', 5, 4),
(3, 'MT-5to', 'portafolio-secundaria.pdf', 5, 4),
(4, 'MT-5to', 'dia-4-resolvamos-problemas5.pdf', 5, 4),
(5, 'MT-5to', 'dia-3-solucion-matematica.pdf', 5, 4),
(6, 'CM-5to', 'examenSIC.pdf', 5, 4),
(7, 'CM-5to', 'examen.pdf', 4, 4),
(8, 'CM-5to', 'examen.pdf', 4, 4),
(9, 'CM-5to', 'examenSIC.pdf', 5, 4),
(10, 'CM-5to', 'examenSIC.pdf', 4, 4),
(11, 'CM-5to', 'examenSIC.pdf', 4, 4),
(12, 'CM-5to', 'examenSIC.pdf', 4, 4),
(13, 'DP-2do', 'dia-1y5-dpcc2.pdf', 2, 4),
(14, 'DP-2do', 's7-2-sec-desarrollo-personal-ciudadania-y-civica-2.pdf', 2, 4),
(15, 'IG-1ro', 's18-a1-guia-ingles.pdf', 1, 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `recurso_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `recurso_view` (
`nombre_persona` varchar(40)
,`apellido_persona` varchar(50)
,`cod_recurso` varchar(10)
,`formato_recurso` varchar(100)
,`codigo_grado` varchar(10)
,`titulo` varchar(100)
,`fecha_publicacion` varchar(20)
,`fecha_subida` varchar(20)
,`estado` varchar(20)
,`id_det_recurso` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `letra_seccion` varchar(10) DEFAULT NULL,
  `cant_alumnos` int(2) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `letra_seccion`, `cant_alumnos`, `id_grado`, `id_docente`) VALUES
(1, 'A', 20, 3, 1),
(2, 'A', 20, 2, 1),
(3, 'A', 20, 1, 1),
(4, 'A', 20, 4, 1),
(5, 'A', 20, 5, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_admin`
--
DROP TABLE IF EXISTS `perfil_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_admin`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `persona`.`usuario` AS `usuario`, `persona`.`fecha_registro` AS `fecha_registro`, `persona`.`telefono` AS `telefono`, `persona`.`dni` AS `dni`, `persona`.`direccion` AS `direccion`, `persona`.`genero` AS `genero`, `persona`.`edad` AS `edad`, `administrador`.`cod_admi` AS `cod_admi` FROM (`persona` join `administrador`) WHERE `administrador`.`id_persona` = `persona`.`id_persona` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_alumno`
--
DROP TABLE IF EXISTS `perfil_alumno`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_alumno`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `persona`.`usuario` AS `usuario`, `persona`.`fecha_registro` AS `fecha_registro`, `persona`.`telefono` AS `telefono`, `persona`.`dni` AS `dni`, `persona`.`direccion` AS `direccion`, `persona`.`genero` AS `genero`, `persona`.`edad` AS `edad`, `alumno`.`cod_alumno` AS `cod_alumno`, `alumno`.`rol_alumno` AS `rol_alumno`, `grado`.`nro_grado` AS `nro_grado`, `seccion`.`letra_seccion` AS `letra_seccion` FROM (((`persona` join `alumno`) join `grado`) join `seccion`) WHERE `alumno`.`id_persona` = `persona`.`id_persona` AND `alumno`.`id_grado` = `grado`.`id_grado` AND `alumno`.`id_seccion` = `seccion`.`id_seccion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_docente`
--
DROP TABLE IF EXISTS `perfil_docente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_docente`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `persona`.`usuario` AS `usuario`, `persona`.`fecha_registro` AS `fecha_registro`, `persona`.`telefono` AS `telefono`, `persona`.`dni` AS `dni`, `persona`.`direccion` AS `direccion`, `persona`.`genero` AS `genero`, `persona`.`edad` AS `edad`, `docente`.`cod_docente` AS `cod_docente`, `docente`.`nivel_academico` AS `nivel_academico`, `docente`.`especialidad` AS `especialidad`, `cursos`.`nombre_curso` AS `nombre_curso`, `grado`.`codigo_grado` AS `codigo_grado` FROM (((`persona` join `docente`) join `grado`) join `cursos`) WHERE `docente`.`id_persona` = `persona`.`id_persona` AND `cursos`.`id_grado` = `grado`.`id_grado` AND `docente`.`id_curso` = `cursos`.`id_curso` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `recurso_view`
--
DROP TABLE IF EXISTS `recurso_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recurso_view`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `recursos`.`cod_recurso` AS `cod_recurso`, `recursos`.`formato_recurso` AS `formato_recurso`, `grado`.`codigo_grado` AS `codigo_grado`, `det_recurso`.`titulo` AS `titulo`, `det_recurso`.`fecha_publicacion` AS `fecha_publicacion`, `det_recurso`.`fecha_subida` AS `fecha_subida`, `det_recurso`.`estado` AS `estado`, `det_recurso`.`id_det_recurso` AS `id_det_recurso` FROM (((`persona` join `recursos`) join `grado`) join `det_recurso`) WHERE `recursos`.`id_persona` = `persona`.`id_persona` AND `recursos`.`id_grado` = `grado`.`id_grado` AND `det_recurso`.`id_recurso` = `recursos`.`id_recurso` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admi`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `det_recurso`
--
ALTER TABLE `det_recurso`
  ADD PRIMARY KEY (`id_det_recurso`),
  ADD KEY `id_recurso` (`id_recurso`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id_recurso`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_docente` (`id_docente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `det_recurso`
--
ALTER TABLE `det_recurso`
  MODIFY `id_det_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);

--
-- Filtros para la tabla `det_recurso`
--
ALTER TABLE `det_recurso`
  ADD CONSTRAINT `det_recurso_ibfk_1` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `docente_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
