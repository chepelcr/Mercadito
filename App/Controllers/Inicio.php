<?php

/**
 * Descripción: Controlador para la entidad Rol
 */

namespace App\Controllers;

use App\Models\FeriasModel;
use App\Models\PuestosModel;

class Inicio extends BaseController
{
	/** Devolver el inicio de la pagina web */
	public function index()
	{
		return $this->inicio();
	} //Fin de la funcion index

	/** Funcion para mostrar el mercadito */
	public function mercadito()
	{
		/**Si hay un id de feria */
		if (getSegment(3)) {
			$id_feria = getSegment(3);
		} else {
			if (feria_activa())
				$id_feria = getSession('id_feria');

			else
				$id_feria = getEnt('app.id_feria');
		}

		$feriasModel = new FeriasModel();

		$feria = $feriasModel->obtener($id_feria);

		if (!$feria)
			return json_encode(array('error' => 'No se encontro la feria'));

		else
		{
			setSession('id_feria', $id_feria);
			setSession('feria', true);
			setSession('nombre_feria', $feria->nombre);
			setSession('fecha_inicio', $feria->fecha_apertura);
			setSession('fecha_fin', $feria->fecha_cierre);
			
			//Si se ha encontrado la feria
			if (getSegment(4)) {
				switch (getSegment(4)) {
					case 'listado':
						$puestosModel = new PuestosModel();
						$puestosModel->where('id_feria', $id_feria);

						$puestos = $puestosModel->obtener('activos');

						$dataView = array(
							'puestos' => $puestos,
						);

						return view('inicio/mercadito', $dataView);
						break;

					case 'inicio':
						return json_encode(array('success' => true));
						break;
				}
			}

			else
			{
				$script = '<!-- Cargar -->
						<script>
							$(document).ready(function(){
								cargar_feria(' . $id_feria . ');
							});
						</script>';

				$data = array(
					'script' => $script
				);

				return $this->inicio($data);
			}
		}
	} //Fin de la funcion

	/** Funcion para la pagina de contacto */
	public function contacto()
	{
		if (getSegment(3) == 'listado') {
			return view('inicio/contacto');
		} else {
			$script = '<!-- Contacto -->
				<script>
					$(document).ready(function(){
						cargar_listado("inicio", "contacto","' . baseUrl('inicio/contacto/listado') . '");
					});
				</script>';

			$data = array(
				'script' => $script
			);

			return $this->inicio($data);
		}
	} //Fin de la funcion

	/**Registrar un nuevo usuario en el sistema */
	public function quienes_somos()
	{
		if (getSegment(3) == 'listado') {
			return view('inicio/quienes_somos');
		} else {
			$script = '<!-- Quienes somos -->
				<script>
					$(document).ready(function(){
						cargar_listado("inicio", "quienes_somos","' . baseUrl('inicio/quienes_somos/listado') . '");
					});
				</script>';

			$data = array(
				'script' => $script
			);

			return $this->inicio($data);
		}
	} //Fin de la funcion

	public function salir()
	{
		setSession('feria', false);
		setSession('id_feria', null);

		return json_encode(array(
			'status' => true,
			'message' => 'Se ha cerrado la sesión correctamente'
		));
	}
}//Fin de la clase