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

        $this->_view->assign('title','Categorias');
        $this->_view->assign('asunto','Lista de Categorias');
        $this->_view->assign('mensaje','No hay Categorias disponibles');
        $this->_view->assign('categoria', Category::select('id', 'nombre')->get());
        $this->_view->render('index');
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInIlu();
        $this->getMessages();

        $this->_view->assign('title','Categorias');
        $this->_view->assign('asunto','Nuevo Categorias');
        $this->_view->assign('process','categories/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
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
        $this->redirect('categories');
    }
    
    public function edit($id = null)
    {
        // metodo para editar un registro
        Validate::validateModel(category::class, $id, 'error/error');

        $this->vallidateInIlu();
        $this->getMessages();

        $this->_view->assign('title','Categorias');
        $this->_view->assign('asunto','Editar Categorias');
        $this->_view->assign('categoria',Category::find(Filter::filterInt($id)));
        $this->_view->assign('process',"categories/update/{$id}");        
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit'); 
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

        $this->_view->assign('title','Categorias');
        $this->_view->assign('asunto','Ver Categorias');
        $this->_view->assign('process','categories/store');
        $this->_view->assign('mensaje','No hay Categorias disponibles');
        $this->_view->assign('categoria',Category::find(Filter::filterInt($id)));
        //$this->_view->assign('categoria', Category::select('id', 'nombre_categoria','created_at','updated_at')->find($id));
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        
        $this->_view->render('show');         
    }

}