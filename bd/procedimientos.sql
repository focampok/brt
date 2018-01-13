DELIMITER $$
CREATE PROCEDURE obtenerTotalIngresos(OUT total float)
BEGIN
 SELECT sum(subtotal)
 INTO total
 FROM activo
 WHERE estado != 0;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerTotalAdicion(IN codAdicion varchar(45), OUT total float)
BEGIN
 SELECT sum(subtotal)
 INTO total
 FROM activo
 WHERE ADICION_codigo_adicion = codAdicion AND estado != 0;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerTotalActa(IN codActa varchar(45), OUT total float)
BEGIN
 SELECT sum(subtotal)
 INTO total
 FROM activo
 WHERE ACTA_codigo_acta = codActa;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerTotalCertificacion(IN codCertificacion varchar(45), OUT total float)
BEGIN
 SELECT sum(precio_unitario * cantidad_cert)
 INTO total
 FROM activo
 WHERE CERTIFICACION_codigo_certificacion = codCertificacion;
END$$
DELIMITER ;