<?php

namespace App\Librerias;

class FileUpload
{
    private $ruta = "F:\\server\\htdocs\\universidad\\tcu\\mercadito\\Mercadito\\public\\files\\";
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

    public function subir_imagen($nombre_imagen = '', $ruta)
    {
        $target_dir = $this->ruta . "\\images\\" . $ruta . "\\";

        //Obtener la extension del archivo
        $extension = pathinfo($this->name, PATHINFO_EXTENSION);

        $target_name = $nombre_imagen . '.' . $extension;

        $this->name = $target_name;

        $target_file = $target_dir . $target_name;

        //Comprobar que es una imagen
        if(!$this->isImage())
        {
            $this->error = 'El archivo no es una imagen';
            return false;
        }

        // Check file size
        if ($this->size > $this->max_size) {
            $this->error = 'El archivo es demasiado grande';
            return false;
        }
        // Allow certain file formats
        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg"
            && $extension != "gif" && $extension != "JPG" && $extension != "PNG"
            && $extension != "JPEG" && $extension != "GIF") {
            $this->error = 'Solo se permiten archivos JPG, JPEG, PNG y GIF';
            return false;
        }

        //Si el archivo existe, reemplazarlo
		if(file_exists($target_file))
        {
            unlink($target_file);
        }
        
        //Mover el archivo
        if ($this->move($target_file)) {
            return true;
        } else {
            $this->error = 'Error al subir el archivo';
            return false;
        }
    }

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

    public function move($path)
    {
        return move_uploaded_file($this->tmp_name, $this->ruta . $path);
    }

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
