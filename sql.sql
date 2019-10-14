DROP DATABASE itv;
CREATE DATABASE itv;

USE itv;

CREATE TABLE tipoVehiculos(
    idTipo VARCHAR(3) NOT NULL,
    clase VARCHAR(10) NOT NULL UNIQUE,
    PRIMARY KEY (idTipo)
);

CREATE TABLE tarifas (
    idTarifa VARCHAR(3),
    costo NUMERIC(6,2) NOT NULL,
    idTipo VARCHAR(3),
    PRIMARY KEY (idTarifa),
    FOREIGN KEY (idTipo) REFERENCES tipoVehiculos (idTipo) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE personas (
    dni VARCHAR(9),
    nombre VARCHAR(15) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    telefono VARCHAR(12) NOT NULL,
    direccion VARCHAR(40) NOT NULL,
    aceptado ENUM("true", "false", "admin") NOT NULL,
    contrasenia VARCHAR(40) NOT NULL,
    PRIMARY KEY(dni)
);

CREATE TABLE vehiculos(
    matricula VARCHAR(10),
    marca VARCHAR(20) NOT NULL,
    aseptado ENUM("true", "false") NOT NULL,
    idPersona VARCHAR(9),
    idTipo VARCHAR(3),
    PRIMARY KEY(matricula),
    FOREIGN KEY(idPersona) REFERENCES personas(dni) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(idTipo) REFERENCES tipoVehiculos(idTipo) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE parqueaderos(
    idParqueadero VARCHAR(5),
    nombre VARCHAR(20) NOT NULL,
    ubicacion VARCHAR(30) NOT NULL,
    PRIMARY KEY(idParqueadero)
);

CREATE TABLE bahias(
    idBahia VARCHAR(5),
    idParqueadero VARCHAR(5),
    disponible ENUM("true", "false"),
    PRIMARY KEY (idBahia),
    FOREIGN KEY (idParqueadero) REFERENCES parqueaderos(idParqueadero) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE pagos(
    idPago VARCHAR(5),
    idBahia VARCHAR(5),
    idVehiculo VARCHAR(10),
    hora TIME NOT NULL,
    fecha DATE NOT NULL,
    costo NUMERIC(6,2) NOT NULL,
    PRIMARY KEY(idPago),
    FOREIGN KEY (idBahia) REFERENCES bahias(idBahia) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (idVehiculo) REFERENCES vehiculos(matricula) ON UPDATE CASCADE ON DELETE SET NULL
);
insert into tipovehiculos values ("privado", "1");
insert into tipovehiculos values ("publico", "2");
insert into personas values ("123456789", "123456789", "123456789","123456789","123456789","123456789", "false", "123456789");
insert into personas values ("111111111", "111111111", "111111111", "111111111", "111111111", "111111111", "true", "111111111");
insert into personas values ("222222222", "222222222", "222222222", "222222222", "222222222", "222222222", "true", "222222222");  
insert into vehiculos values ("1234QQQ", "Volvo", "true", "111111111", "publico");
insert into vehiculos values("1872HWN", "SEAT", "false", "123456789", "privado");
insert into parqueaderos values ("1", "nomb1", "Getafe");
insert into bahias values ("1", "1", "true");
insert into pagos values ("1", "1", "1872HWN", "22:10", "2019-10-11", "25.03");
