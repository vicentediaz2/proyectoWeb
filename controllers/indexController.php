<?php

use models\Producto;
use models\Img;

class indexController extends Controller
{

	public function __construct(){
		// $this->verificarSession();
		// Session::tiempo();
		parent::__construct();
	}

	public function index()
	{
		$this->getMessages();

		$mensaje = "No hay productos disponibles";
		$productos = Producto::select('id', 'nombre','precio','stock','category_id')->orderBy('id','asc')->get();
		$imgs = Img::select('id','nombre','producto_id')->where('relevancia', 1)->get();
		$this->_view->load('index/index', compact('mensaje','productos','imgs'));
	}

	public function contacto()
	{
		$this->getMessages();

		$this->_view->load('index/contacto');
	}
}