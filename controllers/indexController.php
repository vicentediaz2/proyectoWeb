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

		$this->_view->assign('mensaje','No hay productos disponibles');
		$this->_view->assign('productos', Producto::select('id', 'nombre','precio','stock','category_id')->orderBy('id','asc')->get());
		$this->_view->assign('img', Img::select('id','nombre','producto_id')->where('relevancia', 1)->get());
		$this->_view->render('index');
	}

	public function contacto()
	{
		$this->getMessages();

		$this->_view->render('contacto');
	}

}