<?php
session_start();
class DBMaster {

    private $db_connection = null;
    public $info = "";
    public $pass = "";
    public $fechas = "";
    public $cuentas = "";
    public $subcuentas = "";
    public $adiciones = "";
    public $USUARIOs = "";
    public $categorias = "";
    public $actas = "";
    public $productos = "";

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

            // realizo la consulta para ver si el USUARIO existe
            $sql = "SELECT * FROM USUARIO where username = '" . $nit . "' AND password = '" . $password . "';";
            $result_of_login_check = $this->db_connection->query($sql);

            // si el USUARIO existe
            if ($result_of_login_check->num_rows == 1) {
                // convierto las fila en un objeto
                $result_row = $result_of_login_check->fetch_object();
                // guardo la info del USUARIO en variables de sesion
                $_SESSION['username'] = $result_row->nit;
                $_SESSION['nombre'] = $result_row->nombre;

                //verifico el tipo de USUARIO, si es admin o normal
                $tipoUsuario = $result_row->tipo;
                //es admin
                if ($tipoUsuario == 0) {
                    $_SESSION['estado'] = 1; // es admin                                           
                } //es normal 
                else {                    
                    $_SESSION['estado'] = 2; //es user 
                }
                header("location: dashboard.php");
            } else {
                $this->info = "Usuario y/o contraseña no coinciden.";
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }

    public function insertarUsuario($nombre, $apellido,$username, $password, $tipo) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }
        if (!$this->db_connection->connect_errno) {
            // realizo la insercion por parametos, para evitar inyecciones
            $sql = $this->db_connection->prepare("INSERT INTO USUARIO(nombre,apellido,username,password,tipo) VALUES (?,?,?,?,?);");
            $sql->bind_param("ssssi", $nombre, $apellido,$username,$password, $tipo);
            $respuesta = $sql->execute();
            if ($respuesta) {
                $this->info = "Usuario registrado correctamente.";
            } else {
                $this->info = "Error, ya existe un usuario con el mismo username";
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion
        $this->db_connection->close();
    }

    public function llenarComboFechas() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM FECHA;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($depto = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $depto['codigoFecha'] . "'>" . $depto['codigoFecha'] . ' * ' . $depto['nombreFecha'] . "</option>";
                }
                $this->fechas = $lista;
            }
        } else {
            $this->info = "Problema de conexión de base de datos.";
        }
        //cierro la conexion.
        $this->db_connection->close();
    }
    
    public function llenarComboCategorias() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM CATEGORIA;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($depto = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $depto['codCategoria'] . "'>" . $depto['codCategoria'] . ' - ' . $depto['nombreCategoria'] . "</option>";
                }
                $this->categorias = $lista;
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM CONTENEDOR where codigo_contenedor != -1;";
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
    
    
    public function llenarComboProductos() {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM PRODUCTO";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($add = $resultado->fetch_array()) {
                    $lista .=" <option value='" . $add['codigo_producto'] . "'>" . $add['codigo_producto'] . "</option>";
                }
                $this->productos = $lista;
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
            $sql = "SELECT * FROM PROYECTO WHERE estado != 0;";
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM USUARIO WHERE DEPARTAMENTO_codigo_departamento = $codigo ;";
            $resultado = $this->db_connection->query($sql);
            // si existen productos
            if ($resultado->num_rows > 0) {
                $lista = "";
                while ($us = $resultado->fetch_array()) {
                    $lista .= $us['nit'] . ' * ' . $us['nombre'] . ' ' . $us['apellido'] . ";";
                }
                $this->USUARIOs = $lista;
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT distinct * from ASIGNACION  WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
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
    
    public function obtenerActivosContenedor($codigoCertificacion) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM PRODUCTO WHERE CONTENEDOR_codigo_contenedor = '$codigoCertificacion';";
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
    
    public function obtenerActivosOrden($codigoCertificacion) {
        // verifico la codificacion
        if (!$this->db_connection->set_charset("utf8")) {
            $this->info = $this->db_connection->error;
        }

        // si la conexion no tiene errorres, hago la consulta
        if (!$this->db_connection->connect_errno) {
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM DETALLE_ORDEN WHERE ORDEN_codigo_orden = '$codigoCertificacion';";
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
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
            // realizo la consulta para obtener codigo y nombre del PRODUCTO.
            $sql = "SELECT * FROM PRODUCTO WHERE CONTENEDOR_codigo_contenedor = '$codigoAdicion';";
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
?>
