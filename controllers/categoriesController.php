<?php
use models\Category;
class categoriesController extends Controller
{ 
    public function __construct()
    {
        $this->vallidateInSuperUser();
        parent::__construct();
    }

    public function index()
    {
        $this->vallidateInSuperUser();
        $this->getMessages();

        $title = 'Categorias';
        $asunto = 'Lista de Categorias';
        $mensaje = 'No hay Categorias disponibles';
        $categoria = Category::select('id', 'nombre')->get();
        
        $this->_view->load('categories/index',compact('title','asunto','mensaje','categoria'));
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInIlu();
        $this->getMessages();

        $title = 'Categorias';
        $asunto = 'Nuevo Categorias';
        $process = 'categories/store';
        $send = $this->encrypt($this->getForm());

        $this->_view->load('categories/create',compact('title','asunto','process','send'));
    }

    public function store()
    {
        //metodo para validar un nuevo registro 
        //valida create
        $this->vallidateInIlu();

        $this->validateForm('categories/create',[
            'nombre' => Filter::getText('nombre')
        ]); //nombre se refiere al nombre del campo formulario definido en name=''

        $categoria = Category::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($categoria){
            Session::set('msg_error','La categoria ingresada ya existe... intente con otro');
            $this->redirect('categories/create');
        }

        $categoria = new category;
        $categoria->nombre = Filter::getText('nombre');
        $categoria->save();

        Session::set('msg_success','La categoria se ha registrado correctamente');
        $this->redirect('categories/index');
    }
    
    public function edit($id = null)
    {
        // metodo para editar un registro
        Validate::validateModel(category::class, $id, 'error/error');

        $this->vallidateInIlu();
        $this->getMessages();

        $title = 'Categorias';
        $asunto = 'Editar Categorias';
        $categoria = Category::find(Filter::filterInt($id));
        $process = "categories/update/{$id}";
        $send = $this->encrypt($this->getForm());

        $this->_view->load('categories/edit',compact('title','asunto','categoria','process','send')); 
    } 

    public function update($id = null)
    {
        //metodo para validar la edicion de un nuevo registro 
        //valida edit
        $this->vallidateInIlu();
        
        $this->validatePUT();
        $this->validateForm("categories/edit/{$id}",[
            'nombre' => Filter::getText('nombre')
        ]);

        $categoria = Category::find(Filter::filterInt($id));
        $categoria->nombre = Filter::getText('nombre');
        $categoria->save();

        Session::destroy('data');
        Session::set('msg_success','La Categoria se ha modificado correctamente');
        $this->redirect('categories/show/' . $id);
        
    }

    public function show($id = null)
    {
        //metodo para ver un registro espesifico
        $this->vallidateInSuperUser();
        $this->getMessages();

        Validate::validateModel(Category::class, $id, 'error/error');

        $title = 'Categorias';
        $asunto = 'Ver Categorias';
        $process = 'categories/store';
        $mensaje = 'No hay Categorias disponibles';
        $categoria = Category::find(Filter::filterInt($id));
        $send = $this->encrypt($this->getForm());
        
        $this->_view->load('categories/show',compact('title','asunto','process','mensaje','categoria','send'));         
    }

}