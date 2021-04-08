-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2021 a las 16:13:49
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
  `preguntas` text NOT NULL,
  `calculos_1` text,
  `estandar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `tabla`, `contenido`, `preguntas`, `calculos_1`, `estandar`) VALUES
(1, 'clientes', 'compromiso con el cliente', '1. Una visión omnicanal está en ejecución en todas las operaciones orientadas al cliente.|\r\n2. Los clientes pueden acceder a soporte e información y herramientas para auto- configuración del servicio disponibles a través de todos los canales.|\r\n3. La experiencia del cliente y el uso de datos se recopilan rutinariamente a través de todos los canales y se comparten a través de las funciones organizacionales (p.e. gestión de producto, soporte al cliente, operaciones de red).|\r\n4. El cliente puede combinar nuevos servicios digitales con servicios tradicionales.|\r\n5. La gestión de la experiencia del cliente se ha movido de reactiva a proactiva e incluye acciones automatizadas (p.e. la siguiente mejor acción, ofertas personalizadas).|\r\n6. La analítica de datos está siendo extensamente usada para mejorar el valor del cliente, incluyendo el desarrollo de ofertas de nuevos servicios, ofertas y marca).|\r\n7. Las herramientas digitales y los sistemas están habilitando la personalización de servicios incluyendo productos de terceros.|\r\n8. El cliente participa activamente en el diseño de nuevos productos/servicios a través de plataformas de innovación abierta.', '26.67', 30),
(2, 'clientes', 'experiencia del cliente', '1. Herramientas básicas de intercambio de información de interés (p.e. portales en línea, herramientas de seguimiento de tickets, chat, entre otros) están disponibles para los clientes.|\r\n2. Se están realizando pilotos iniciales de nuevas herramientas digitales tales como aplicaciones de auto-servicio, soporte remoto, servicios basados en ubicación, entre otros.|\r\n3. Se han identificado iniciativas y requerimientos para expandir la interacción con los clientes más allá aplicaciones básicas basadas en auto-soporte.|\r\n4. Se ha articulado completamente una visión omnicanal (no necesariamente está ejecutada completamente).|\r\n5. Se han empezado a adaptar las herramientas de gestión y soporte tecnológico (incluye generación de reportes) a entornos móviles de forma segura.|\r\n6. Se están implementando nuevas facilidades en las herramientas digitales para incentivar la participación del cliente como configurador de productos y servicios basados en la web.|\r\n7. La experiencia del cliente y el uso de datos se recopilan y utilizan activamente para asistir la atención al cliente y las mejoras de servicios.|\r\n8. Están disponibles nuevos servicios digitales (típicamente de terceros) para clientes, aunque todavía no como parte de un servicio integral \"multiproducto\".', '22.86', 35),
(3, 'clientes', 'conocimiento del cliente y comportamiento', '1. La analítica de datos está siendo extensamente usada para mejorar el valor del cliente, incluyendo el desarrollo de ofertas de nuevos servicios, ofertas y marca).|\r\n2. Las herramientas digitales y los sistemas están habilitando la personalización de servicios incluyendo productos de terceros.|\r\n3. El cliente participa activamente en el diseño de nuevos productos/servicios a través de plataformas de innovación abierta.|\r\n4. Se realizan investigaciones de mercado para identificar segmentos de clientes digitales|\r\n5. Se utiliza la etnografía para identificar patrones de comportamiento, aspectos culturales en clientes que puedan estar impactando en su comportamiento de ventas|\r\n6. Se conoce la recurrencia en compras de productos y servicios de los clientes y cuales de ellos se generan a través de canales digitales|\r\n7. Se han definido buyers personas y también B2B ', '35', 20),
(4, 'clientes', 'Confianza y percepción del cliente', '1. Se están usando precios dinámicos para maximizar el valor del cliente mediante la completa personalización y flexibilidad de los productos/servicios.|\r\n2. Están siendo usadas herramientas avanzadas como machine learning entre otras para identificar tendencias de consumos y desarrollar nuevos servicios y estrategias de precios que son enteramente nuevos para el sector.|\r\n3. Nuevos servicios digitales (incluyendo telecomunicaciones no tradicionales) están siendo desarrolladas basadas en un conocimiento profundo del cliente (p.e. analítica avanzada) y son integrados completamente desde el comienzo, a través de todos los puntos de contacto (p.e. una pantalla/aplicación/cobro por todos los servicios).|\r\n4. Se mide la percepción del cliente a través de instrumentos digitales permitan obtener datos para establecer contenidos, campañas, e inciativas de marketing ', '26.67', 15),
(5, 'estrategia', 'Gestión de la marca', '1. ¿Qué hace que su negocio se distinga de los demás?|2. ¿Quiénes son sus competidores directos e indirectos, conoce cómo es su experiencia digital?|3. ¿Cómo se están promocionando actualmente en los canales digitales?|4. La Marca presenta la misma consistencia en todos los canales digitales|5. ¿Su audiencia es principalmente masculina o femenina?|6. ¿Cuándo realizan contenidos promocionales tienen en cuenta factores psociodemográficos|7. ¿Cuáles son los atributos de su marca? Y cómo se comunican digitalmente en la actualidad ', '46.67', 15),
(6, 'estrategia', 'Gestión de ecosistemas', '1. Se han comenzado proyectos o iniciativas para experimentar herramientas digitales al interior de la empresa.|2. Existe una estrategia digital promovida por el Gerente de la empresa.|3. Existe un liderazgo digital enfocado en la transformación.|4. Se han implementado iniciativas digitales a lo largo de la empresa (incluye proyectos entre áreas).', '80', 5),
(7, 'estrategia', 'Finanzas e inversiones, cartera', '1. Se han aprobado inversiones formales alineadas a la estrategia digital.|2. Se han definido objetivos digitales en el presupuesto.|3. Se han aprobado inversiones para iniciativas de transformación digital.|4. Se realiza una medición de los ingresos por productos digitales.|5. La empresa capitaliza su inversión previa y genera nuevos ingresos basados en capacidades digitales y modelos de negocio digitales.|6. Los ingresos por negocios digitales permiten una inversión constante en nuevas iniciativas digitales.|7. Los servicios digitales superan el 10% de los ingresos totales de la empresa.', '70', 10),
(8, 'estrategia', 'Clientes & mercados', '1. ¿Cómo plantean la creación de nuevos modelos de negocio para ayudar a acelerar la entrada a nuevos mercados digitales y para acceder a nuevos clientes?|2. ¿Qué experiencia de vida tienen los clientes al usar los producto o servicios?|3.  ¿En realidad qué significan los producto o servicio de la empresa para la gente?|4. ¿Cuáles son los productos que generan más ingresos?|5. ¿Los clientes, comparten sus experiencias con la marca, en redes sociales?|6. ¿Se determinan los criterios que se deben evaluar para incursionar en nuevos mercados?|7. ¿Se han establecido perfiles de clientes acordes a las necesidades del negocio?, cuales son sus características|8. ¿Se realiza investigación de mercados?|9. ¿Se conoce el costo de captar y gestionar un cliente nuevo y de fidelizar actuales?|10. ¿Cuáles son los segmentos de clientes y la rentabilidad de los clientes por cada segmento?', '100', 10),
(9, 'estrategia', 'Portafolio, ideación e innovación', '1. Los nuevos servicios digitales superan el 5% de los ingresos totales de la empresa.|2. ¿Tu producto o servicio crea valor para los clientes, empleados. cómo?|3. ¿Analizamos regularmente nuestro modelo de negocio para buscar oportunidades de mejora e innovación?|4. ¿Analizamos regularmente nuestra curva de valor para buscar oportunidades de innovación y diferenciación?|5. ¿El equipo comercial trabaja en la búsqueda de oportunidades o generación de ideas de innovación aplicables a productos, servicios o soluciones?|6. ¿Dentro de las iniciativas de innovación se ha trabajado en el desarrollo y sofisticación de productos o servicios?|7. ¿La empresa cuenta con un sistema de gestión de innovación?', '46.67', 15),
(10, 'estrategia', 'Gestión de partes interesadas', '1. La estrategia digital es compartida por todos los empleados de la empresa.|2. Existe un roadmap de servicios digitales en asociación con proveedores digitales.|3. La estrategia digital es compartida y revisada por todos los interesados internos y externos.|4. La estrategia digital es parte inherente de las actividades de toda la empresa.', '26.67', 15),
(11, 'estrategia', 'Gestión estratégica', '1. La empresa tiene una visión digital inicial, aunque el enfoque sigue siendo la mejora operacional.|2. Se definen indicadores, métricas y objetivos digitales para toda la empresa.|3. La estrategia digital está bien desarrollada e integrada a la estrategia corporativa.|4. Lo digital está en el centro de la empresa.|5. Los nuevos modelos de negocio se implementan con elementos completamente digitales.|6. La estrategia digital ha impulsado la toma de decisiones y la gestión.|7. La estrategia de negocios se encuentra articulada con la digital ', '23.33', 30),
(12, 'tecnología', 'Aplicaciones', '1. Se implementan herramientas de integración para reducir tiempo y costos de integración con servicios de terceros.|2. La arquitectura digital soporta la agilidad del negocio a través de herramientas flexibles y apoyan los procesos.|3. Se implementaron y se utilizan herramientas que usan tecnologías como Machine Learning a lo largo de la empresa para actividades predictivas que soportan la innovación de negocios digitales.|4. ¿Qué herramientas se utilizan para asegurar una eficaz y ágil atención al cliente?|5 ¿Cómo recopilan datos acerca de los movimientos y características de los clientes para generar propuestas enfocadas a ellos?|6 ¿Cómo los clientes realizan el seguimiento a sus pedidos?|7 ¿Qué medios de pago se han habilitado para clientes?|8 ¿En qué medida se encuentran implantadas las herramientas de Big Data, a nivel de manufactura en la organización?|9. ¿La empresa ha implementado alguna de las siguientes soluciones: ERP, CRM y permiten interacción desde la nube?', '45', 20),
(13, 'tecnología', 'Cosas conectadas', '1. Se están desplegando plataformas para soportar servicios digitales (p.e. Plataforma de IoT).|2. ¿La arquitectura empresarial de la entidad permite asumir los retos de\r\nla transformación digital y la implementación de tecnologías\r\nemergentes?|3. ¿Involucran a los clientes en el desarrollo de nuevos productos o servicios?|4. ¿Se ha adecuado el catálogo de productos y servicios a la nueva realidad digital?|5. ¿Se analizan los datos con una herramienta de Inteligencia de negocio?|6. ¿La organización cuenta con RPA?|7. ¿ Se ha pensado en implementar soluciones de tipo IoT en productos?', '70', 10),
(14, 'tecnología', 'Analiticas & datos', '1. Se están implementado tecnologías analíticas para facilitar la recolección y compartición de datos a través de las funciones.|2. Se están usando tecnologías analíticas para la optimización de procesos y servicios.|3. Las tecnologías como el análisis avanzado de datos respaldan los procesos de innovación en toda la empresa, desde el desarrollo de nuevos servicios hasta la garantía del servicio y la atención al cliente.|4. Los sistemas de información actuales (de gestión y relaciones con el cliente) permiten obtener información en tiempo real y conectada con otras plataformas para agilizar operaciones|5. ¿Qué datos e información recopilan en la actualidad acerca del desempeño de los procesos y del comportamiento de los clientes?|6. ¿Se depuran o realiza la limpieza de los datos antes de ser utilizados?|7. ¿Cómo se aseguran que no exista información duplicada o incompleta en relación con los datos de clientes o de resultados de procesos?', '28', 25),
(15, 'tecnología', 'Políticas de entregas', '1. Se están implementando sistemas de soporte para apoyar servicios digitales (p.e. facturación y recaudo).|2. Los servicios de terceros están siendo integrados y soportados por la arquitectura IT digital y herramientas relacionadas.|3. Está siendo usada la automatización de procesos con procesamiento de datos en tiempo real para tomar decisiones de forma proactiva en la empresa.', '60', 5),
(16, 'tecnología', 'Red', '1. Los procesos a lo largo de la empresa están alineados a la arquitectura digital.|2. La automatización en toda la empresa impulsa un rendimiento superior comparada con otros pares de la industria.|3. ¿Cómo es la estructura y configuración de la red actual a nivel de datos?|4. ¿La compañía cuenta con herramientas que permitan el trabajo remoto sin interrumpir operaciones?|5. ¿Cuántos equipos de computo existen en la empresa? Manejan celulares corporativos? La fuerza de ventas tiene acceso a lineas corporativas|6. ¿La fuerza comercial tiene acceso a los sistemas de información por fuera de la oficina física?, en qué consiste', '60', 10),
(17, 'tecnología', 'Seguridad', '1. Se ha definido una API integral y una estrategia de seguridad para soportar servicios de terceros.|2. ¿La entidad cumple con el Marco de Seguridad y Privacidad de la Información?|3. ¿La entidad cuenta con protocolos de intercambio de documentos y expedientes electrónicos?|4. ¿La entidad cuenta con protocolos y mecanismos de protección frente a incidentes cibernéticos?|5. ¿La entidad cuenta con procedimientos para la recuperación frente a posibles desastres cibernéticos?|6. ¿Se Cuenta con un plan de prevención de riesgos informáticos?', '40', 15),
(18, 'tecnología', 'Arquitectura tecnológica', '1. Se está definiendo una arquitectura IT digital específica.|2. Han comenzado los esfuerzos para definir la transformación de la arquitectura IT requerida.|3. Se ha definido una arquitectura IT digital específica y los cambios requeridos están en ejecución para alcanzar la arquitectura objetivo. Los planes de inversión en IT están alineados con la arquitectura objetivo.|4. Hay un proceso para evaluar las inversiones en IT basado en su alineación con la estrategia digital de la empresa.|5. Se ha implementado en gran parte la arquitectura IT digital, incluyendo la consolidación de sistemas en plataformas para soportar omni-canales y servicios de terceros.|6. Se están implementado procesos end-to-end que soportan servicios digitales mediante el aprovechamiento de la arquitectura IT digital.', '40', 15),
(19, 'operaciones', 'Gestión ágil del cambio', '1. Se ha articulado la necesidad de la empresa por la Transformación Digital para ser ágil e innovadora.|\r\n2. Se están haciendo algunos cambios iniciales a la forma en que los servicios digitales son desplegados con un enfoque en mejoras incrementales por ahora.|\r\n3.La  empresa  comienza  a  trabajar  en  alcanzar  una  estructura  de  liderazgo distribuido y fomentar el trabajo colaborativo.|\r\n4. Hay comunicación continua desde la Gerencia acerca de la estrategia digital y los avances en su implementación.|\r\n5.  Se  han  organizado  equipos  multifuncionales  bajo  la  guía  de  líderes  que establecen las pautas de alto nivel que se pueden aplicar.|\r\n6. Los sistemas de rendimiento y de compensación incorporan elementos digitales a través de la empresa.|\r\n7. Se permite a los empleados ejercer un rol de liderazgo para tomar decisiones significativas de forma transparente.|\r\n8. La colaboración con otros socios está bien establecida, la generación de innovación de servicios está por delante de la competencia.|\r\n9. La empresa es flexible y se adapta fácilmente a los cambios en el mercado de una manera más ágil que sus competidores priorizando la experiencia del cliente.\r\n\r\n', '60', 15),
(20, 'operaciones', 'Gestión automatizada de recursos', '1. Se están ubicando recursos (p.e. personas y fondos) para desarrollar un plan hacia la transformación digital.|\r\n2. La empresa tiene una visión de la transformación digital que busca la mano de obra digitalmente inteligente.\r\n', '20', 10),
(21, 'operaciones', 'Gestión de servicios integrados', '1. Se identifican rápidamente proyectos que tienen potencial real de agregación de valor para el cliente.|\r\n2. Los nuevos servicios digitales son soportados por personal específico.|\r\n3. Los procesos están en su lugar para soportar la integración de servicios digitales de terceros.|\r\n4. La red, el cliente y otros datos de uso se recopilan y combinan para proporcionar visibilidad de los procesos de extremo a extremo en toda la empresa.', '40', 10),
(22, 'operaciones', 'Analíticas e información en tiempo real', '1. Se ha empezado a utilizar tecnologías como analítica de datos para alimentar las métricas y KPI que apoyan el proceso de toma de decisiones.|\r\n2. Los indicadores clave de rendimiento para las ventas ahora son impulsados principalmente por los servicios digitales.|\r\n3. La toma de decisiones se hace basada en datos analizados en tiempo-real, se acepta el riesgo y se trabaja de forma colaborativa bajo un liderazgo distribuido.|\r\n4.  Los  servicios  digitales  y  tradicionales  comparten  procesos  y  se  están implementado métricas y KPI específicos.', '26.67', 15),
(23, 'operaciones', 'Procesos inteligentes y adaptables', '1. La estrategia digital dirige el cambio de la estructura organizacional y los indicadores claves.|\r\n2. El liderazgo de la empresa tiene suficiente conocimiento y habilidad para dirigir la estrategia digital.|\r\n3. Se han identificado iniciativas para actualizar los procesos claves del negocio para soportar servicios digitales.|\r\n4. Están siendo evaluadas las inversiones para automatizar procesos claves que soporten servicios digitales.|\r\n5.  Se  han  estado  identificado  activos  claves  (p.e.  personas,  plataformas tecnológicas) que formarán la base para la transformación digital.|\r\n6.  Se  están  implementando  procesos  para  soportar  y  automatizar  servicios digitales.|\r\n7. Están siendo desplegados procesos para recopilar y analizar datos de uso del cliente.|\r\n8. Se están diseñando e implementando procesos y políticas para soportar mejor los servicios digitales en algunas áreas claves de la empresa.|\r\n9. Las inversiones en integración de capacidades se están haciendo para facilitar los procesos de forma rápida y eficiente.|\r\n10. Los procesos apalancan el flujo de datos a través de toda la empresa para la optimización de servicios/productos.|\r\n11. La red en tiempo real, el cliente y otros datos de uso están siendo combinados y analizados para optimizar la confiabilidad del servicio y los procesos claves.|\r\n12. Se reduce el tiempo de comercialización de nuevas propuestas de servicios mediante procesos bien establecidos.|\r\n13. Los procesos son maduros y comienzan a producir innovaciones en productos y servicios digitales.|\r\n14. La empresa se enfoca en mejorar continuamente los procesos a través de la innovación y la tecnología.', '46.67', 30),
(24, 'operaciones', 'Estándares y automatización de procesos', '1. Se está implementando automatización de procesos end-to-end para soportar servicios digitales.|\r\n2. Los procesos automatizados están siendo optimizados para mejorar la eficiencia y reducir costos de diseño, aprovisionamiento, y soporte de servicios digitales, incluyendo servicios de socios.|\r\n3. Los procesos end-to-end automatizados garantizan flujos de datos en tiempo real a través de funciones para mejorar la planificación y la toma de decisiones.|\r\n4. ¿La empresa cuenta con procesos o estándares de trabajo en entornos digitales?|\r\n5. ¿En qué medida los sistemas de información de su organización generan datos a tiempo real, a lo largo de los procesos de manufactura (información proveniente de maquinaria o de los procesos)?|\r\n6. ¿Cómo se gestionan los datos generados por el proceso de transformación?|\r\n7. ¿En qué medida, la organización es capaz de contar con algoritmos de predicción de demanda en el proceso comercial?|\r\n8. ¿En qué medida, los recursos involucrados en el proceso productivo cuentan con un sistema capaz de capturar datos y enviarlos para ser almacenados, procesados y analizados para la toma de decisiones ?|\r\n9. ¿En qué medida la organización es capaz de trasladar los datos digitalizados de la operación de manufactura, a un software de simulación?|\r\n10. ¿ La empresa cuenta con procesos documentados accesibles a toda la fuerza laboral?', '50', 20),
(25, 'cultura', 'Cultura', '1. Se definió una estrategia enfocada en el desarrollo de una cultura ágil, centrada en el cliente y en la innovación.|\r\n2. Lo digital está plenamente integrado en la cultura corporativa.|\r\n3. La empresa se centra en la innovación digital y todos los empleados ejecutan la estrategia digital.', '15', 20),
(26, 'cultura', 'Liderazgo & Gobierno', '1. Se usa la co-creación con los clientes y socios en la creación de nuevos servicios para reducir costos de desarrollo y avanzar en la innovación.|\r\n2. Está en marcha una estrategia de desarrollo de personal bien definida, incluso para entrenar, externalizar, o adquirir competencias digitales.|\r\n3. El personal tiene un alto compromiso y empoderamiento para moverse de forma rápida y ágil para la consecución de los objetivos digitales de la empresa.', '12', 25),
(27, 'cultura', 'Gestión del talento & Diseño organizacional', '1. Se han hecho inversiones iniciales para desarrollar competencias digitales incluyendo programas de formación.|\r\n2. Se ha iniciado el reclutamiento de personal experto para desarrollar capacidades, aunque en equipos separados.|\r\n3. Están en marcha las inversiones en el desarrollo de competencias digitales en el personal.|\r\n4. Se  están adaptando  esquemas  de compensación  y formación para alinearse  a la estrategia digital.|\r\n5. Las iniciativas digitales incorporan personas de diferentes áreas y funciones internos y externos.|\r\n6. Se están haciendo inversiones en integración y desarrollo de capacidades no sólo para habilitar, sino para acelerar y reducir los costos de la creación de servicios digitales.|\r\n7. Las competencias digitales están bien  desarrollados y las asociaciones se forman continuamente para acceder a nuevas competencias.|\r\n8. Las competencias digitales están embebidas en toda la empresa y hace la diferencia de sus competidores.', '26.67', 30),
(28, 'cultura', 'Habilitación de la fuerza laboral', '1. Se ha identificado la necesidad de desarrollar competencias digitales y se está definiendo un plan general para ello.|\r\n2. Se han empezado a crear equipos digitales para explorar oportunidades digitales.|\r\n3. La empresa está integrando servicios y capacidades de socios para mejorar los productos existentes.|\r\n4. Los datos (incluyendo servicio, cliente y uso) son compartidos a lo largo de la empresa (y socios) para ser usados en el desarrollo de las nuevas capacidades digitales.|\r\n5. Se  usan  herramientas  digitales  para  promover  la  innovación,  la  colaboración  y  la movilidad de los empleados.', '20', 25);

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
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuestas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
