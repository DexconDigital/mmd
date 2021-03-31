-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2021 a las 02:24:50
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dexcon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `tabla` text NOT NULL,
  `contenido` text NOT NULL,
  `preguntas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `tabla`, `contenido`, `preguntas`) VALUES
(1, 'clientes', 'compromiso con el cliente', '1. Una visión omnicanal está en ejecución en todas las operaciones orientadas al cliente.|2. Los clientes pueden acceder a soporte e información y herramientas para auto- configuración del servicio disponibles a través de todos los canales.|3. La experiencia del cliente y el uso de datos se recopilan rutinariamente a través de todos los canales y se comparten a través de las funciones organizacionales (p.e. gestión de producto, soporte al cliente, operaciones de red).|4. El cliente puede combinar nuevos servicios digitales con servicios tradicionales.|5. La gestión de la experiencia del cliente se ha movido de reactiva a proactiva e incluye acciones automatizadas (p.e. la siguiente mejor acción, ofertas personalizadas).|6. La analítica de datos está siendo extensamente usada para mejorar el valor del cliente, incluyendo el desarrollo de ofertas de nuevos servicios, ofertas y marca).|7. Las herramientas digitales y los sistemas están habilitando la personalización de servicios incluyendo productos de terceros.|8. El cliente participa activamente en el diseño de nuevos productos/servicios a través de plataformas de innovación abierta.'),
(2, 'clientes', 'experiencia del cliente', '1. Herramientas básicas de intercambio de información de interés (p.e. portales en línea, herramientas de seguimiento de tickets, chat, entre otros) están disponibles para los clientes.|2. Se están realizando pilotos iniciales de nuevas herramientas digitales tales como aplicaciones de auto-servicio, soporte remoto, servicios basados en ubicación, entre otros.|3. Se han identificado iniciativas y requerimientos para expandir la interacción con los clientes más allá aplicaciones básicas basadas en auto-soporte.|4. Se ha articulado completamente una visión omnicanal (no necesariamente está ejecutada completamente).|5. Se han empezado a adaptar las herramientas de gestión y soporte tecnológico (incluye generación de reportes) a entornos móviles de forma segura.|6. Se están implementando nuevas facilidades en las herramientas digitales para incentivar la participación del cliente como configurador de productos y servicios basados en la web.|7. La experiencia del cliente y el uso de datos se recopilan y utilizan activamente para asistir la atención al cliente y las mejoras de servicios.|8. Están disponibles nuevos servicios digitales (típicamente de terceros) para clientes, aunque todavía no como parte de un servicio integral \"multiproducto\".');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuestas` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuestas` text NOT NULL,
  `id_usuario` text NOT NULL,
  `fecha_guardado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `fecha_diligencia` date NOT NULL,
  `razon_social` text,
  `nit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuestas`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuestas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
