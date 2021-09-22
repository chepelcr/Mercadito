<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/

namespace Core;

use \PDO;
use \Throwable;

use Core\Auditorias\Auditorias;
use Core\Config\Conexion;

class Model
{
	/** Nombre de la tabla del modelo */
	protected $nombreTabla;

    /**Nombre de la vista que usara la tabla */
    protected $vistaTabla;

    /** Nombre de la llave primaria */
	protected $pk_tabla = "id";

    /** Columnas que se deben ingresar al modelo */
    protected $camposTabla = [];

    /**Campos que solo se utilizan en la vista */
    protected $camposVista = [];

    /** Usar variables para almacenar la fecha de creacion y actualizacion */
    protected $useTimesnaps = false;

    /** Variable para la fecha de creacion */
    protected $CreatedAt = 'createdAt';

    /** Variable para la fecha de update */
    protected $UpdatedAt = 'updatedAt';

    /** Validar si debe ser autoincremental o no */
    protected $autoIncrement = false;

    /** Tipo de dato a retornar (Puede ser array o json) */
    protected $tipo = "array";

    /**Agrupar el resultado por nombre de campo */
    private $group = false;

    /**Ordenar el resultado de la ejecucion */
    private $order = false;

    /** Variable para los campos select */
    private $campos = array();

    /** Variable para el where de las sentencias sql */
    private $where = '';

    /** Valores que utilizara la sentencia en el where */
    private $camposWhere = array();

    /**Valores para la busqueda dinamica */
    private $camposLike = array();

    /** Campos para insertar en la tabla */
    private $camposInsert;

    /** Valores que se usaran en la sentencia de sql */
    private $valuesInsert;

    //Conexion a la base de datos
    private PDO $db;

    /**Valor para la seleccion del valor maximo de un campo */
    private $campoMax;

    /**Campos a actualizar en la base de datos */
    private $camposUpdate = array();

    /**Utilizar auditorias */
    protected $auditorias = false;
 
	//constructor de la clase
	function __construct()
    {
        //Intentar conexion a la base de datos
		try
        {
            $this->db = Conexion::getConnect();
        }
        
        catch (Throwable $th) {
            //throw $th;
        }
	}//Fin del constructor

    /**Setear los campos del update */
    private function setCamposUpdate($data)
    {
        $this->camposUpdate = $data;
        return $this;
    }//Fin del metodo para los campos del update

    /**Insertar un registro en la tabla de auditorias */
    public function insertAuditoria($data)
    {
        $auditorias = new Auditorias();
        $auditorias->insertAuditoria($data);
    }//Fin de la funcion

    /**Insertar un registro en la tabla de errores */
    public function insertError($ex)
    {
        $id_usuario = getSession('id_usuario');
                
        if(!$id_usuario)
            $id_usuario = 0;
                
        $code = $ex->getCode();
        $message = $ex->getMessage();
        $file = $ex->getFile();
        $line = $ex->getLine();

        $messagecomplet = "Error generado en el archivo $file, linea $line: [Codigo de error $code] $message";

        $data = array(
            'sentencia'=>$messagecomplet,
            'controlador'=>$this->nombreTabla,
            'id_usuario'=>$id_usuario
        );
        
        insertError($data);
    }//Fin de la funcion

    /**Actualizar un registro en la base de datos */
    public function update($data, $id=null)
    {
        try 
        {
            $db = $this->query();

            $this->setCamposUpdate($data);
            
            if($id)
                $this->where($this->pk_tabla, $id);

            $sql = $this->crearQuery('UPDATE');

            $update=$db->prepare($sql);

            foreach ($data as $campo => $valor) {
                $update->bindValue($campo, $valor);
            }

            
            if($id)
                $update->bindValue($this->pk_tabla, $id);

            $update->execute();

            /**Insertar auditoria */
            if($this->auditorias)
            {
                $id_usuario = getSession('id_usuario');

                if(!$id_usuario)
                    $id_usuario = 0;
                    
                $data = array(
                    'id_fila'=> $id,
                    'tabla'=>$this->nombreTabla,
                    'id_usuario'=>$id_usuario
                );

                $this->insertAuditoria($data);
            }

            return $id;
        }//Fin del try

        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion

            return 0;
        }//Fin del catch
  }//Fin del método

    /**Seleccionar una columna especifica de la tabla */
    public function select($nombreCampo)
    {
        $campos = $this->campos;

        $campos[] = $nombreCampo;

        $this->campos = $campos;

        return $this;
    }//Fin del select

    /**Crear la sentencia para seleccionar columnas especificas */
    private function sentenciaSelect()
    {
        $campos = $this->campos;

        if(empty($campos))
        {
            $campos = $this->generarCampos();
        }//Fin de la validacion

        if($campos[0]=='*')
            return $campos[0];
        
        $select = "`";

        $select .= implode("`, `", $campos);

        return $select."`";
    }//Fin de la funcion

    /**Asignar los campos para la sentencia del select */
    private function setCampo($campo = array())
    {
        $this->campos = $campo;
        return $this;
    }//Fin de setCampo

    private function sentenciaLike()
    {
        $camposLike = $this->camposLike;

        $sentencia = '`';

        if(empty($camposLike))
            return false;

        $i = 0;

        foreach ($camposLike as $columna => $valor) {
            if($i==0)
            {
                $sentencia.=$columna.'` LIKE :'.$columna;
                $i = $i+1;
            }
            
            else
            {
                $sentencia.=' AND `'.$columna.'` LIKE :'.$columna;
            }
        }//Fin del ciclo
        return $sentencia;
    }//Fin del metodo

    /** Funcion para crear la sentencia where */
    private function sentenciaWhere()
    {
        $camposWhere = $this->camposWhere;

        $sentencia = 'WHERE `';
        $i = 0;

        if(empty($camposWhere))
            return false;

        foreach ($camposWhere as $campo => $valor) 
        {
            if($i==0)
            {
                $sentencia = $sentencia.$campo."`=:".$campo;
                $i = $i + 1;
            }
    
            else
            {
                $sentencia = $sentencia." AND `".$campo."`=:".$campo;
            }//Fin del else
        }//Fin del ciclo

        return $sentencia;
    }//Fin de la funcion

    /**Filtrar una cunsulta en la base de datos */
    public function where(string $nombreCampo, string $valor)
    {
        $camposWhere = $this->camposWhere;

        $camposWhere[$nombreCampo] = $valor;

        $this->setCamposWhere($camposWhere);

        return $this;
    }//Fin del where

    /**Obtener las filas que contenga un valor en la columna especifica */
    public function like(string $columna, string $valor)
    {
        $camposLike = $this->camposLike;

        $camposLike[$columna] = '%'.$valor.'%';

        $this->camposLike = $camposLike;

        return $this;
    }//Fin de la funcion

    /**Asignar los campos para hacer el filtro de la consulta*/
    private function setCamposWhere(array $camposWhere)
    {
        $this->camposWhere = $camposWhere;
        return $this;
    }//Fin de setCamposWhere

    /**Generar los campos de la tabla del modelo */
    private function generarCampos()
    {
        $campos = $this->campos;

        //var_dump($campos);

        if(empty($campos))
        {
            $espacio = 0;

            $data = array();

            $pk_tabla = $this->pk_tabla;
            $camposTabla = $this->camposTabla;
            $camposVista = $this->camposVista;

            $data[$espacio] = $pk_tabla;

            foreach ($camposTabla as $campo) {
                $espacio = $espacio+1;

                $data[$espacio] = $campo;
            }//Fin del ciclo para llenar los campos

            if(isset($this->vistaTabla))
            {
                foreach ($camposVista as $campo) {
                    $espacio = $espacio+1;
        
                    $data[$espacio] = $campo;
                }//Fin del ciclo para llenar los campos de la vista
            }

            if($this->useTimesnaps)
            {
                $CreatedAt = $this->CreatedAt;
                $UpdatedAt = $this->UpdatedAt;

                $data[$espacio+1] = $CreatedAt;
                $data[$espacio+2] = $UpdatedAt;
            }//Fin del if

            return $data;
        }//Fin de campos vacios

        return $campos;
    }//Fin de generarCampos

    /**Agrupar los resultados de la bae de datos */
    public function groupBy($nombreCampo)
    {
        $this->group = $nombreCampo;

        return $this;
    }//Fin de la funcion

    /**Agrupar los resultados de la bae de datos */
    public function OrderBy($nombreCampo)
    {
        $this->order = $nombreCampo;
    }//Fin de la funcion

    /**Crear la sentencia de sql a utilizar en la ejecucion */
    private function crearQuery(string $tipo = "SELECT")
    {
        $tabla = $this->nombreTabla;
        $where = $this->sentenciaWhere();
        $like = $this->sentenciaLike();
        $group = $this->group;
        $order = $this->order;

        //Generar la sentencia de acuerdo al tipo solicitado
        switch ($tipo) 
        {
            case 'SELECT':
                $select = $this->sentenciaSelect();

                if($where)
                {
                    $sql = $tipo." ".$select." FROM ".$tabla." ".$where;

                    if($like)
                    {
                        $sql .= ' AND '.$like;
                    }
                }

                else
                {
                    $sql = $tipo." ".$select." FROM ".$tabla;

                    if($like)
                    {
                        $sql .= ' WHERE '.$like;
                    }
                }

                if($group)
                {
                    $sql .= " GROUP BY :group";
                }

                if($order)
                {
                    $sql .= " ORDER BY :order";
                }

                //var_dump($sql);

                break;
            
            case 'INSERT':
                $campos = $this->camposInsert;
                $values = $this->valuesInsert;

                $sql = $tipo." INTO ".$tabla.$campos." VALUES ".$values;
                break;

            case 'UPDATE':
                $sql = 'UPDATE '.$this->nombreTabla.' SET `' ;

                $data = $this->camposUpdate;

                $indice = 0;

                foreach ($data as $campo => $valor) {
                    if($indice == 0)
                    {
                        $sql .= $campo.'` = :'.$campo;
                        $indice= $indice + 1;
                    }//Fin del if

                    else
                    {
                        $sql .= ', `'.$campo.'` = :'.$campo;
                    }//Fin del else
                }//Fin del ciclo

                if($where)
                    $sql .= " ".$where;

                break;

            case 'DELETE':
                if($where)
                    $sql = $tipo." FROM ".$tabla." ".$where;

                else
                    $sql = $tipo." FROM ".$tabla;
                break;

            case 'MAX':
                $nombreCampo = $this->campoMax;

                $sql = 'SELECT MAX('.$nombreCampo.') FROM '.$this->nombreTabla;

                if($where)
                {
                    $sql .= " ".$where;
                    
                    if($like)
                    {
                        $sql .= ' AND '.$like;
                    }
                }
                    
                break;
        }//Fin del switch

        //Retornar la sentencia sql generada
        return $sql;
    }//Fin de crear query

    /** Validar si la llave primaria debe ser autoincremental o no */
    private function insertPk(array $data)
    {
        $pk = $this->pk_tabla;

        if($this->autoIncrement = true)
        {
            $data[$this->pk_tabla] = $this->max($this->pk_tabla) + 1;
        }//Fin del if

        return $data;
    }//Fin de insertPk

    /**Obtener la primera fila de la tabla */
    public function fila()
    {
        $db = $this->query();

        try 
        {
            //Si la conexion a la base de datos no es nula
            if($db!=null)
            {
                if(isset($this->vistaTabla))
                {
                    $this->table($this->vistaTabla);
                }
                
                //Crear la sentencia de ejecucion
                $sql = $this->crearQuery();

                //Preparar la conexion
                $select=$db->prepare($sql);
                
                $camposWhere = $this->camposWhere;

                foreach ($camposWhere as $campo => $valor) {
                    $select->bindValue($campo ,$valor);
                }

                $select->execute();

                $result = $select->fetch();

                if(!$result)
                {
                    return false;
                }//Fin del if

                //Limpiar las variables del sql
                $this->clean();

                $data = array();

                $camposTabla = $this->generarCampos();

                foreach ($camposTabla as $campoTabla) 
                {
                    $data[$campoTabla] = $result[$campoTabla];
                }//Fin del ciclo
                
                $data = json_encode($data);

                return json_decode($data);
            }//Fin del if
        } 
        
        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch

        return null;
    }//Fin de fila

    /** Determinar el tipo de objeto a retornar (array o json) */
    public function setType(string $tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }//Fin del metodo

    public function max($nombreCampo)
    {
        $db = $this->query();

        try 
        {
            $this->setMax($nombreCampo);

            $sql = $this->crearQuery('MAX');

            $max = $db->prepare($sql);

            $camposWhere = $this->camposWhere;

            foreach ($camposWhere as $campo => $valor) {
                $max->bindValue($campo, $valor);
            }

            $max -> execute();

            $result = $max->fetch();

            return $result[0];

        } 
        
        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch
    }//Fin de la funcion para seleccionar el valor maximo de una columna

    /**Agregar el campo para la seleccion del max */
    private function setMax($campoMax)
    {
        $this->campoMax = $campoMax;
        return $this;
    }//Fin de la funcion

    /** Contar la cantidad de filas de todo el modelo*/
    public function count()
    {
        $db = $this->query();

        //Si la conexion a la base de datos no es nula
        if($db!=null)
        {
            $objetos = $this->getAll();
            
            $dato = count($objetos);

            return $dato;
        }//Fin del if
    }//Fin de count

    private function camposInsert(array $data)
    {
        $pk = $this->pk_tabla;

        //Campos para la tabla
        $campos = "(".$pk;
        $camposTabla = $this->camposTabla;

        $values = "(:".$pk;

        $data = $this->insertPk($data);

        //Ciclo para crear la sentencia con los campos y valores que seran agregados a la tabla
        foreach ($data as $clave => $valor) 
        {
            //Ciclo para validar si el campo se encuentra en la tabla
            foreach ($camposTabla as $campo) {
                if($clave == $campo)
                {
                    $campos = $campos.", ".$clave;
                    $values = $values.", :".$clave;
                }
            }//Fin del ciclo de validacion
        }//Fin del ciclo

        if($this->useTimesnaps)
        {
            $CreatedAt = $this->CreatedAt;
            $UpdatedAt = $this->UpdatedAt;

            $campos = $campos.", ".$CreatedAt.", ".$UpdatedAt;
            $values = $values.", :".$CreatedAt.", :".$UpdatedAt;

            $data[$CreatedAt] = date("Y-m-d h:i:s");
            $data[$UpdatedAt] = date("Y-m-d h:i:s");
        }//Fin del if

        $campos = $campos.")";
        $values = $values.")";

        $this->camposInsert = $campos;
        $this->valuesInsert = $values;

        return $data;
    }//Fin de camposInsert

    /**  Insertar un registro en la base de datos */
    public function insert(array $data)
    {
        $db = $this->query();

        try 
        {
            //Si la conexion a la base de datos no es nula
            if($db!=null)
            {
                $data = $this->camposInsert($data);

                //Crear la sentencia de ejecucion
                $sql = $this->crearQuery("INSERT");

                //Preparar la conexion
                $insert = $db->prepare($sql);

                //Ciclo para terminar la preparacion de la ejecucion
                foreach ($data as $campo => $valor)
                {
                    $insert->bindValue($campo, $valor);
                }//Fin del ciclo

                if($insert->execute())
                {
                    /**Insertar auditoria */
                    if($this->auditorias)
                    {
                        $id_usuario = getSession('id_usuario');

                        if(!$id_usuario)
                            $id_usuario = 0;
                            
                        $audit = array(
                            'id_fila'=> $data[$this->pk_tabla],
                            'tabla'=>$this->nombreTabla,
                            'id_usuario'=>$id_usuario
                        );

                        $this->insertAuditoria($audit);
                    }//Fin de la insercion de auditoria

                    return $data[$this->pk_tabla];
                }//Fin de la ejecucion
                
                else
                {
                    return false;
                }
                    
            }//Fin del if
        } 
        
        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch
    }//Fin de la funcion
    
    /** Obtener todos los elementos de una tabla */
    public function getAll()
    {
        $db = $this->query();

        //Realizar intento
        try {
           //Si la conexion a la base de datos no es nula
            if($db!=null)
            {
                if(isset($this->vistaTabla))
                    $this->table($this->vistaTabla);
                
                //Crear la sentencia de ejecucion
                $sql = $this->crearQuery();

                //Preparar la conexion
                $select=$db->prepare($sql);

                $camposWhere = $this->camposWhere;
                $camposLike = $this->camposLike;

                foreach ($camposWhere as $campo => $valor) {
                    $select->bindValue($campo ,$valor);
                }

                foreach ($camposLike as $columna => $valor) {
                    $select->bindValue($columna, $valor);
                }

                $group = $this->group;

                if($group)
                {
                    $select->bindValue('group', $group);
                }

                $order = $this->order;

                if($group)
                {
                    $select->bindValue('order', $order);
                }

                $select->execute();

                $result = $select->fetchAll();

                //var_dump($result);

                //Limpiar las variables del sql
                //$this->clean();

                $camposTabla = $this->generarCampos();
                $objetos = [];

                foreach ($result as $objeto) {
                    $data = [];

                    //var_dump($camposTabla);
                    foreach ($camposTabla as $campoTabla) {
                        $data[$campoTabla] = $objeto[$campoTabla];
                    }
                    
                    $objetos[] = $data;
                }

                $objetos = json_encode($objetos);

                return json_decode($objetos);
            }//Fin de la base de datos no nula
        }//Fin del intento
        
        catch (\Exception $ex)
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch
    }//Fin de buscar

    /**Utilizar una tabla personalizada */
    public function table($nombreTabla)
    {
        $this->nombreTabla = $nombreTabla;
        
        return $this;
    }//Fin de la funcion

    //la función para obtener un objeto por el id
	public function getById($id)
    {
        $db = $this->query();

        try {
            //Si la conexion a la base de datos no es nula
            if($db!=null)
            {
                $this->where($this->pk_tabla, $id);
                
                $result = $this->fila();

                if(!$result)
                    return false;

                return $result;
            }//Fin del if
        }//Fin del intento
        
        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch
	}//Fin de getByID

    /**Eliminar un registro de la base de datos */
	public function delete($id)
    {
		$db = $this->query();

        try 
        {
            //Si la base de datos no es nula
            if($db!=null)
            {
                $this->where($this->pk_tabla, $id);
    
                $sql = $this->crearQuery('DELETE');
    
                $delete=$db->prepare($sql);
    
                $camposWhere = $this->camposWhere;
    
                //Llenar el array de los campos a borrar
                foreach ($camposWhere as $campo => $valor) {
                    $delete->bindValue($campo, $valor);
                }
    
                if($delete->execute())
                {
                    /**Insertar auditoria */
                    if($this->auditorias)
                    {
                        $id_usuario = getSession('id_usuario');
    
                        if(!$id_usuario)
                            $id_usuario = 0;
                            
                        $data = array(
                            'id_fila'=> $id,
                            'tabla'=>$this->nombreTabla,
                            'id_usuario'=>$id_usuario
                        );
    
                        $this->insertAuditoria($data);
                    }
    
                    return $id;
                }//Fin del if
    
                return false;
            }//Fin del if
        } 
        
        catch (\Exception $ex) 
        {
            if($this->auditorias)
            {
                $this->insertError($ex);
            }//Fin de validacion
        }//Fin del catch
	}//Fin de la funcion delete

    public function query()
    {
        return $this->db;
    }//Fin de la funcion

    private function clean()
    {
        $this->setCampo();
        $this->setCamposWhere(array());
    }//Fin de clean
}//Fin 
?>