<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\BaseController;
use Paw\Core\Request;
use Exception;
use Paw\App\Models\Especialidad;
use Paw\Core\Controllers\PaginationController;
use Paw\App\Models\Profesional;

class RoutesController extends BaseController {

	private function getNoticias($amount) {
		$noticias = array();
		foreach (range(1, $amount) as $i) {
			$noticia = [
				"title" => "Titulo de la noticia",
				"url" => "url-a-la-noticia",
				"imageUrl" => "assets/images/image-placeholder.png",
				"date" => "18/05/2021",
				"description" => "Una descripción mas larga"
			];
			array_push($noticias, $noticia);
		}
		return $noticias;
	}


	public function index(Request $request) {
		$noticias = $this->getNoticias(3);
		$titulo = "UNLuPAW Medical Group";
		$especialidades = Especialidad::getAll();
		require $this->viewPath . '/home.view.php';
	}

	public function institucion(Request $request) {
		$titulo = "Institucion";
		require $this->viewPath . '/institucion.view.php';
	}
	public function listaDeTurnos(Request $request) {
		$titulo = "Lista de Turnos";
		require $this->viewPath . '/listaDeTurnos.view.php';
	}
	public function noticias(Request $request) {
		$titulo = "Noticias";
		$noticias = $this->getNoticias(40);
		$page = $request->getQueryField('page') ?? 1;
		$pagination = PaginationController::generatePagination(40, 5, $page);
		require $this->viewPath . '/noticias.view.php';
	}
}