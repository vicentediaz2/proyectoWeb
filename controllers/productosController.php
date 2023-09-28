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
        // $this->vallidateInSuperUser();
    }

    public function index()
    {
        $this->vallidateInSuperUser();
        $this->getMessages();

        $title = 'Productos';
        $asunto = 'Lista de Productos';
        $mensaje = 'No hay productos disponibles';
        $productos = Producto::with('category')->orderBy('id','desc')->get();

        $this->_view->load('productos/index', compact('title', 'asunto', 'mensaje', 'productos'));
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInIlu();
        $this->getMessages();

        $pagina = 'create';
        $title = 'productos';
        $asunto = 'Nuevo productos';
        $process = 'productos/store';
        $categorias = category::select('id', 'nombre')->get();
        $usuarios = Usuario::select('id', 'nombre')->get();
        $send = $this->encrypt($this->getForm());

        $this->_view->load('productos/create', compact('pagina', 'title', 'asunto', 'process', 'categorias', 'usuarios', 'send'));
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

        $pagina = 'edit';
        $title = 'productos';
        $producto = Producto::find(Filter::filterInt($id));
        $categorias = category::select('id', 'nombre')->get();
        $usuario = Usuario::select('id', 'nombre')->get();
        $process = "productos/update/{$id}";
        $send = $this->encrypt($this->getForm());

        $this->_view->load('productos/edit', compact('pagina', 'title', 'producto', 'categorias', 'usuario', 'process', 'send')); 
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

        $title = 'productos';
        $asunto = 'Ver productos';
        $process = 'productos/store';
        $mensaje = 'No hay usuarios disponibles';
        $producto = Producto::select('id', 'nombre','descripcion','usuarios_id','precio','stock','category_id','created_at','updated_at')->find($id);
        $role = category::select('id', 'nombre')->find($id);
        $usuario = Usuario::select('id', 'nombre')->find($id);
        $imgs = Img::select('id','nombre')->where('producto_id', $id)->first();
        $send = $this->encrypt($this->getForm());

        $this->_view->load('productos/show', compact('title', 'asunto', 'process', 'mensaje', 'producto', 'role', 'usuario', 'imgs', 'send'));         
    }

    public function producto($id = null)
	{
		$this->getMessages();

        $producto = Producto::select('id', 'nombre','descripcion','usuarios_id','precio','stock','category_id','created_at','updated_at')->find($id);
        $img = Img::select('id','nombre')->where('producto_id', $id)->first();
		$this->_view->load('producto', compact('producto','imgs'));

	}

    public function detalleproducto($id = null)
    {
        $this->getMessages();

        $producto = Producto::select('id', 'nombre','descripcion','usuarios_id','precio','stock','category_id','created_at','updated_at')->find($id);
        $img = Img::select('id','nombre','relevancia')->where('producto_id', $id)->get();
        $this->_view->load('productos/detalleproducto', compact('producto','img'));
        
    }

}