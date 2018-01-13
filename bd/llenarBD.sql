-- INSERTO LOS DEPARTAMENTOS
INSERT INTO DEPARTAMENTO(codigo_departamento,nombre) VALUES ('0','Sin asignar');
INSERT INTO DEPARTAMENTO(codigo_departamento,nombre) VALUES ('1','Recursos Humanos');
INSERT INTO DEPARTAMENTO(codigo_departamento,nombre) VALUES ('2','Inventario');
INSERT INTO DEPARTAMENTO(codigo_departamento,nombre) VALUES ('3','Financiero');

-- INSERTO LOS USUARIOS
-- ADMIN
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('admin','Francisco','Ocampo','Administrador','1',0,'1');
-- USUARIOS NORMALES
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('1','1','1','1','1',1,'1');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('4783902-9','Juan','Lopez','Practicante','user1',1,'1');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('2948509-3','Mario','Garcia','Contador','user2',1,'2');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('28394087','Laura','Sanchez','Programadora','user3',1,'2');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('29305873','Sara','Flores','Penalista','user4',1,'3');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('1285970-9','Carlos','Juarez','Secretario','user5',1,'3');
INSERT INTO USUARIO(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES ('23549098','Rodrigo','Gomez','Operador','user6',1,'3');

-- INSERTO LAS CUENTAS
INSERT INTO CUENTA(codigo_cuenta,nombre) VALUES ('122.5','Archivo');
INSERT INTO CUENTA(codigo_cuenta,nombre) VALUES ('123.3','Mobilario');
INSERT INTO CUENTA(codigo_cuenta,nombre) VALUES ('126.6','Vehiculos');

-- INSERTO LAS SUBCUENTAS
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1225.1','Archivo de 2 cajas','122.5');
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1225.2','Archivo de 4 cajas','122.5');
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1225.6','Archivo de 6 cajas','122.5');
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1233.4','Muebles de Madera','123.3');
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1233.8','Muebles de Hierro','123.3');
INSERT INTO SUBCUENTA(codigo_subcuenta,nombre,CUENTA_codigo_cuenta) VALUES ('1266.8','Vehiculos ecologicos','126.6');

-- INSERTO UNAS ADICIONES...
INSERT INTO ADICION(codigo_adicion,nombre_adicion) VALUES ('1','APARATOS E INSTRUMENTOS VARIOS');
INSERT INTO ADICION(codigo_adicion,nombre_adicion) VALUES ('2','MUEBLES Y UTILES DE OFICINA');
INSERT INTO ADICION(codigo_adicion,nombre_adicion) VALUES ('3','APARATOS E INSTRUMENTOS DE LABORATORIO');
INSERT INTO ADICION(codigo_adicion,nombre_adicion) VALUES ('4','APARATOS DE COMUNICACIONES ELECTRICAS');

-- ACTA
INSERT INTO ACTA(codigo_acta,fecha,hora,estado) VALUES ('-1','01/01/2000',NOW(),0);

-- CERTIFICACION
INSERT INTO CERTIFICACION(codigo_certificacion,fecha,estado) VALUES ('-1',NOW(),0);

-- INSERTO ALGUNOS ACTIVOS (CON CSV)
INSERT INTO ACTIVO(codigo_inventario,folio,fecha,CUENTA_codigo_cuenta,codigo_subcuenta,estado,cantidad,marca,modelo,serie,descripcion,precio_unitario,subtotal,DEPARTAMENTO_codigo_departamento,nit,nombre,ADICION_codigo_adicion,ACTA_codigo_acta,CERTIFICACION_codigo_certificacion,cantidad_cert)
 VALUES ('MEM-23-953-DS',662,NOW(),122.5,1225.1,1,1,'hp','2920-48G (J9728A)','SG55FLYMNK','SWITCH 48 PUERTOS MARCA HP, MODELO: 2920-48G (J9728A) SERIE: SG55FLYMNK',12430.00,12430.00,'1','4783902-9','Juan Lopez','1','-1','-1',0);






