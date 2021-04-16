ALTER TABLE `usuario` ADD `observaciones` TEXT NULL DEFAULT NULL AFTER `nit`;

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



INSERT INTO `administradores` (`id_admin`, `usuario`, `clave`) VALUES (1, 'Dexcon', 'Demo2021');