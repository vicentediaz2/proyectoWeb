<?php

use models\Producto;
use models\category;
use models\Img;
use models\Usuario;

class productosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->vallidateInSuperUser();
    }

    public function index()
    {
        $this->vallidateInSuperUser();
        $this->getMessages();

        $this->_view->assign('title','Productos');
        $this->_view->assign('asunto','Lista de Productos');
        $this->_view->assign('mensaje','No hay productos disponibles');
        $this->_view->assign('productos', Producto::with('category')->orderBy('id','desc')->get());
        $this->_view->render('index');
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInIlu();
        $this->getMessages();

        $this->_view->assign('pagina','create');

        $this->_view->assign('title','productos');
        $this->_view->assign('asunto','Nuevo productos');
        $this->_view->assign('process','productos/store');
        $this->_view->assign('categorias', category::select('id', 'nombre')->get());
        $this->_view->assign('usuarios', Usuario::select('id', 'nombre')->get());
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
    }

    public function store()
    {
        //metodo para validar un nuevo registro 
        //valida create
        $this->vallidateInIlu();

        $this->validateForm('productos/create',[         
            'nombre' => Filter::getText('nombre'),
            'descripcion' => Filter::getText('descripcion'),
            'precio' => Filter::getText('precio'),
            'stock' => Filter::getText('stock'),
            'category' => Filter::getText('category'),
            'usuario' => Filter::getText('usuario')
        ]);

        $producto = Producto::select('id')
            ->where('nombre', Filter::getPostParam('nombre'))
            ->first();

        if($producto){
            Session::set('msg_error','El producto ingresado ya existe... intente con otro');
            $this->redirect('productos/create');
        }

        $producto = new Producto;
        $producto->nombre = Filter::getText('nombre');
        $producto->descripcion = Filter::getText('descripcion');
        $producto->precio = Filter::getInt('precio');
        $producto->stock = Filter::getInt('stock');
        $producto->usuarios_id = Filter::getText('usuario');
        $producto->category_id = Filter::getInt('category');
        $producto->save();

        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('productos');
    }
    public function edit($id = null)
    {
        // metodo para editar un registro
        Validate::validateModel(Producto::class, $id, 'error/error');
        $this->vallidateInIlu();
        $this->getMessages();

        $this->_view->assign('pagina','edit');

        $this->_view->assign('title','productos');
        $this->_view->assign('asunto','Editar productos');
        $this->_view->assign('producto',Producto::find(Filter::filterInt($id)));
        $this->_view->assign('categorias', category::select('id', 'nombre')->get());   
        $this->_view->assign('usuario', Usuario::select('id', 'nombre')->get());     
        $this->_view->assign('process',"productos/update/{$id}");
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit'); 
    } 

    public function update($id = null)
    {
        //metodo para validar la edicion de un nuevo registro 
        //valida edit
        $this->vallidateInIlu();

        $this->validatePUT();
        $this->validateForm('productos/create',[         
            'nombre' => Filter::getText('nombre'),
            'descripcion' => Filter::getText('descripcion'),
            'precio' => Filter::getText('precio'),
            'stock' => Filter::getText('stock'),
        ]);

        $producto = Producto::find(Filter::filterInt($id));
        $producto->nombre = Filter::getText('nombre');
        $producto->descripcion = Filter::getText('descripcion');
        $producto->precio = Filter::getInt('precio');
        $producto->stock = Filter::getInt('stock');
        $producto->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha modificado correctamente');
        $this->redirect('productos/show/' . $id);
        
    }

    public function show($id = null)
    {
        //metodo para ver un registro espesifico
        $this->vallidateInSuperUser();
        $this->getMessages();

        $this->_view->assign('title','productos');
        $this->_view->assign('asunto','Ver productos');
        $this->_view->assign('process','productos/store');
        $this->_view->assign('mensaje','No hay usuarios disponibles');
        $this->_view->assign('producto', Producto::select('id', 'nombre','descripcion','usuarios_id','precio','stock','category_id','created_at','updated_at')->find($id));
        $this->_view->assign('role', category::select('id', 'nombre')->find($id));
        $this->_view->assign('usuario', Usuario::select('id', 'nombre')->find($id));
        $this->_view->assign('img', Img::select('id','nombre')->where('producto_id', $id)->first());
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('show');         
    }

    public function producto($id = null)
	{
		$this->getMessages();

		$this->_view->assign('producto', Producto::select('id', 'nombre','descripcion','usuarios_id','precio','stock','category_id','created_at','updated_at')->find($id));
		$this->_view->assign('img', Img::select('id','nombre')->where('producto_id', $id)->first());
		$this->_view->render('producto');

	}

}