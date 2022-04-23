-- TABLA USUARIO
INSERT INTO `bibliotech_daw`.`user` (`username`, `email`, `name`, `password`, `role`) SELECT 'admin', 'admin@bibliotech.com', 'Administrador', SHA2('admin', 256), 'ADMIN';
INSERT INTO `bibliotech_daw`.`user` (`username`, `email`, `name`, `password`, `role`) SELECT 'user', 'user@bibliotech.com', 'Usuario', SHA2('user', 256), 'USER';

-- TABLA CATEGORÍA
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('art', 'Artes y humanidades');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('biography', 'Biografía');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('science', 'Ciencias e Informática');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('law', 'Ciencias Sociales y Derecho');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('communication', 'Comunicación');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('sport', 'Educación física');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('factory', 'Ingeniería, Industria y Construcción');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('languages', 'Idiomas');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('history', 'Historia');
INSERT INTO `bibliotech_daw`.`category`(`image`, `name`) VALUES ('health', 'Salud y Servicios Sociales');

-- TABLA LIBRO
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780132350884', 'Robert Martin', 'Clean Code', '40', '8', '3', '464', '2008-08-01 00:00:00', NULL, '2022-01-05 13:31:25');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780135957059', 'David Thomas', 'The Pragmatic Programmer: your journey to mastery', '43', '2', '3', '352', '2019-11-25 00:00:00', NULL, '2022-01-05 13:33:45');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780140455113', 'Plato', 'The Republic', '12', '3', '1', '480', '2007-09-14 00:00:00', NULL, '2022-01-05 13:27:51');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780486447988', 'William Strunk', 'The Elements of Style', '5', '1', '1', '105', '2013-09-23 00:00:00', NULL, '2022-01-05 13:25:05');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780538497817', 'James Stewart', 'Calculus', '86', '1', '3', '1194', '2011-01-01 00:00:00', NULL, '2022-01-05 13:26:22');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9780702052309', 'Susan Standring', 'Grays Anatomy: The Anatomical Basis of Clinical Practice', '165', '10', '10', '1584', '2015-09-25 00:00:00', NULL, '2022-01-05 11:54:45');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9781266244476', 'Sylvia S. Mader', 'Biology Laboratory Manual', '135', '2', '3', '1050', '2012-06-08 00:00:00', NULL, '2022-01-05 13:19:52');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9781861972781', 'Robert Greene', 'The 48 Laws Of Power', '22', '2', '4', '480', '2000-11-20 00:00:00', NULL, '2022-01-05 13:32:39');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9783836563376', 'Rhiannon Paget', 'Hokusai', '12', '2', '1', '96', '2021-03-27 00:00:00', NULL, '2022-01-05 13:34:50');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9788401337208', 'Patrick Rothfuss', 'El nombre del viento', '22.9', '2', '9', '880', '2021-09-22 00:00:00', NULL, '2021-09-22 00:00:00');
INSERT INTO `bibliotech_daw`.`book` VALUES ('9788490361030', 'Raymond Murphy', 'Essential Grammar in Use', '36', '5', '8', '328', '2016-06-15 00:00:00', NULL, '2022-01-05 13:30:23');

