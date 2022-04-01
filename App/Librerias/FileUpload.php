<?php

namespace App\Librerias;

class FileUpload
{
    private $ruta = '';
    private $file;
    private $name;
    private $tmp_name;
    private $error;
    private $size;

    //Tamaño máximo del archivo: 2MB.
    private $max_size = 2097152;

    public function __construct($file)
    {
        $this->file = $file;
        $this->name = $file['name'];
        $this->tmp_name = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];
    }

    /**Subir una imagen al servidor */
    public function subir_imagen($nombre_imagen = '', $carpeta = '')
    {
        $target_dir = "images\\" . $carpeta . "\\";

        //Obtener la extension del archivo
        $extension = pathinfo($this->name, PATHINFO_EXTENSION);

        $target_name = $nombre_imagen . '.' . $extension;

        $target_file = $target_dir . $target_name;

        //Comprobar que es una imagen
        if(!$this->isImage())
        {
            $this->error = 'El archivo no es una imagen';
            return false;
        }//Fin de la validacion de imagen

        //Validar el tamaño del archivo
        if ($this->size > $this->max_size) {
            $this->error = 'El archivo es demasiado grande';
            return false;
        }//Fin de la validacion de tamaño

        //Mover el archivo
        if ($this->move($target_file)) {
            return true;
        } else {
            $this->error = 'Error al subir el archivo';
            return false;
        }
    }

    /**Obtener el error que se genero al guardar el archivo */
    public function getError()
    {
        return $this->error;
    }

    /**Validar que el archivo sea una imagen */
    public function isImage()
    {
        $check = getimagesize($this->tmp_name);

        if ($check !== false) {
            $extension = $this->getExtension();
            return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
        }

        return false;
    }

    public function isSizeValid()
    {
        return $this->file['size'] <= 2000000;
    }

    public function isUploaded()
    {
        return is_uploaded_file($this->tmp_name);
    }

    /**Subir el archivo al servidor
     * @param $path Ruta donde se guardará el archivo
     */
    public function move($path)
    {
        $ruta = location($path);

        //Si el archivo existe, reemplazarlo
		if(file_exists($ruta))
        {
            unlink($ruta);
        }

        $this->name = $ruta;

        return move_uploaded_file($this->tmp_name, $ruta);
    }//Fin de la funcion para subir el archivo

    public function getExtension()
    {
        return strtolower(pathinfo($this->name, PATHINFO_EXTENSION));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->file['size'];
    }

    public function getType()
    {
        return $this->file['type'];
    }

    public function getErrorMessage()
    {
        return $this->error;
    }
}
