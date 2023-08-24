<?php

use models\Producto;


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
		$this->_view->assign('productos', Producto::with('category')->orderBy('id','desc')->get());
		$this->_view->render('index');
	}

	public function contacto()
	{
		$this->getMessages();

		$this->_view->render('contacto');
	}

}