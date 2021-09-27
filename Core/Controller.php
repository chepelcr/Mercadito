<?php
    namespace Core;
    
    class Controller
    {
        /** Archivos de ayuda creados por el usuario */
        protected $helpers = [];

        /**Archivos de ayuda predeterminados */
        private $base_helpers = ['auditorias', 'views', 'session'];

        public function __construct()
        {
            load_helpers($this->base_helpers);
            load_helpers($this->helpers, 'App');
        }//Fin del constructor
        
    }//Fin de la clase
