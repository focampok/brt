<?php

/**
  Clase encargada de conectarse a la bd.
 */
class DBMaster {

    private $db_connection = null;
    public $info = "";
    public $pass = "";
    public $departamentos = "";
    public $cuentas = "";
    public $subcuentas = "";
    public $adiciones = "";
    public $usuarios = "";
    public $certificaciones = "";
    public $actas = "";

    // el contructor de la clase... crea la conexion a la bd.
    public function __construct() {
        // creo la conexion a la base de datos con los datos de config/db.php
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function iniciarSesion($n, $p) {
        // create/read session, absolutely necessary
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {

            // obtengo el email y password
            $nit = $this->db_connection->real_escape_string($n);
            $password = $this->db_connection->real_escape_string($p);

            // realizo la consulta para ver si el usuario existe
            $sql = "SELECT * FROM usuario where nit = '" . $nit . "' AND password = '" . $password . "';";
            $result_of_login_check = $this->db_connection->query($sql);

            // si el usuario existe
            if ($result_of_login_check->num_rows == 1) {
                // convierto las fila en un objeto
                $result_row = $result_of_login_check->fetch_object();
                // guardo la info del usuario en variables de sesion
                $_SESSION['nit'] = $result_row->nit;
                $_SESSION['nombre'] = $result_row->nombre;
                $_SESSION['apellido'] = $result_row->apellido;
                $_SESSION['puesto'] = $result_row->puesto;

                //verifico el tipo de usuario, si es admin o normal
                $tipoUsuario = $result_row->tipo;
                //es admin
                if ($tipoUsuario == 0) {
                    $_SESSION['estado'] = 2; // es admin
                    header("location: admin.php");
                } //es normal 
                else {
                    $_SESSION['estado'] = 2; //es user
                    header("location: dashboard.php");
                }
            } else {
                $this->info = "Usuario y/o contraseña no coinciden.";
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function insertarUsuario($nit, $nombre, $apellido, $puesto, $password, $tipo, $codDepto) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            // realizo la insercion por parametos, para evitar inyecciones
            $sql = $this->db_connection->prepare("INSERT INTO usuario(nit,nombre,apellido,puesto,password,tipo,DEPARTAMENTO_codigo_departamento) VALUES (?,?,?,?,?,?,?);");
            $sql->bind_param("issssii", $nit, $nombre, $apellido, $puesto, $password, $tipo, $codDepto);
            $respuesta = $sql->execute();
            if ($respuesta) {
                $this->info = "Usuario registrado correctamente.";
            } else {
                $this->info = "Error, ya existe un usuario con el mismo N.I.T.";
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion
        $this->db_connection->close();
    }

    public function llenarComboDepartamentos() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM departamento;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($depto = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $depto['codigo_departamento'] . "'>" . $depto['codigo_departamento'] . ' - ' . $depto['nombre'] . "</option>";
                }
                $this->departamentos = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function llenarComboCuentas() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM cuenta;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($cuenta = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $cuenta['codigo_cuenta'] . "'>" . $cuenta['codigo_cuenta'] . ' - ' . $cuenta['nombre'] . "</option>";
                }
                $this->cuentas = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function llenarComboAdiciones() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM contenedor;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($add = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $add['codigo_contenedor'] . "'>" . $add['codigo_contenedor'] . ' - ' . $add['nombre_contenedor'] . "</option>";
                }
                $this->adiciones = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function llenarComboCertificaciones() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener certificaciones disponibles
            $sql = "SELECT * FROM proyecto WHERE estado != 0;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($cerf = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $cerf['codigo_proyecto'] . "'>" . $cerf['codigo_proyecto'] . "</option>";
                }
                $this->certificaciones = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function llenarComboActas() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener certificaciones disponibles
            $sql = "SELECT * FROM acta WHERE estado = 1;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($act = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $act['codigo_acta'] . "'>" . $act['codigo_acta'] . "</option>";
                }
                $this->actas = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function obtenerSubCuentas($codigo) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM subcuenta WHERE CUENTA_codigo_cuenta ='" . $codigo . "';";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($subcuenta = $resultado->fetch_array()) {
                    $lista .= $subcuenta['codigo_subcuenta'] . ' - ' . $subcuenta['nombre'] . ";";
                }
                $this->subcuentas = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function obtenerUsuarios($codigo) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM usuario WHERE DEPARTAMENTO_codigo_departamento = $codigo ;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($us = $resultado->fetch_array()) {
                    $lista .= $us['nit'] . ' * ' . $us['nombre'] . ' ' . $us['apellido'] . ";";
                }
                $this->usuarios = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function obtenerActivosCertificacion($codigoCertificacion) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM activo WHERE CERTIFICACION_codigo_certificacion = '$codigoCertificacion';";
            $resultado = $this->db_connection->query($sql);
            // si existen activos
            if ($resultado->num_rows > 0) {
                return $resultado;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function obtenerActivosActa($codigoActa) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM activo WHERE ACTA_codigo_acta = '$codigoActa';";
            $resultado = $this->db_connection->query($sql);
            // si existen activos
            if ($resultado->num_rows > 0) {
                return $resultado;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }
    
    public function obtenerActivosAdicion($codigoAdicion) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del producto.
            $sql = "SELECT * FROM activo WHERE ADICION_codigo_adicion = '$codigoAdicion';";
            $resultado = $this->db_connection->query($sql);
            // si existen activos
            if ($resultado->num_rows > 0) {
                return $resultado;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }
    
    

}
