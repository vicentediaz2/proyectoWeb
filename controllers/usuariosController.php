<?php
use models\Usuario;
use models\Role;

class usuariosController extends Controller
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
        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Lista de Usuarios');
        $this->_view->assign('mensaje','No hay Usuarios disponibles');
        $this->_view->assign('usuarios', Usuario::with('role')->orderBy('id','desc')->get());
        $this->_view->render('index');
    }

    public function create()
    {
        //metodo para crear un nuevo registro
        $this->vallidateInAdmin();
        $this->getMessages();

        $this->_view->assign('pagina','create');

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Nuevo Usuarios');
        $this->_view->assign('process','usuarios/store');
        $this->_view->assign('roles', Role::select('id', 'nombre')->get());
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
    }

    public function store()
    {
        //metodo para validar un nuevo registro 
        //valida create
        $this->vallidateInAdmin();

        $this->validateForm('usuarios/create',[         
            'nombre' => Filter::getText('nombre'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'passw' => Filter::getSql('passw'),
            'rol' => Filter::getText('rol')
        ]);

        $usuario = Usuario::select('id')
            ->where('email', Filter::getPostParam('email'))
            ->first();

        if($usuario){
            Session::set('msg_error','El usuario ingresado ya existe... intente con otro');
            $this->redirect('usuarios/create');
        }
        if (Filter::getSql('repassw') != Filter::getSql('passw')) {
            Session::set('msg_error','Las contraseñas ingresadas no coinciden');
            $this->redirect('usuarios/create');
        }

        $usuario = new Usuario;
        $usuario->nombre = Filter::getText('nombre');
        $usuario->email = Filter::getPostParam('email');
        $usuario->activo = 1;
        $usuario->passw = Helper::encryptPassword(Filter::getSql('passw'));
        $usuario->role_id = Filter::getInt('rol');
        $usuario->save();

        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('usuarios');
    }
    public function edit($id = null)
    {
        // metodo para editar un registro
        $this->vallidateInAdmin();
        Validate::validateModel(Usuario::class, $id, 'error/error');
        $this->getMessages();

        $this->_view->assign('pagina','edit');

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Editar Usuario');
        $this->_view->assign('usuario',Usuario::find(Filter::filterInt($id)));
        $this->_view->assign('roles', Role::select('id', 'nombre')->get());        
        $this->_view->assign('process',"usuarios/update/{$id}");
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit'); 
    } 

    public function update($id = null)
    {
        //metodo para validar la edicion de un nuevo registro 
        //valida edit
        $this->vallidateInAdmin();

        $this->validatePUT();
        $this->validateForm('usuarios/create',[         
            'nombre' => Filter::getText('nombre'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'activo' => Filter::getText('activo'),
            'rol' => Filter::getText('rol')
        ]);

        $usuario = Usuario::find(Filter::filterInt($id));
        $usuario->nombre = Filter::getText('nombre');
        $usuario->email = Filter::getPostParam('email');
        $usuario->activo = Filter::getText('activo');
        $usuario->role_id = Filter::getText('rol');
        $usuario->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha modificado correctamente');
        $this->redirect('usuarios/show/' . $id);
        
    }

    public function show($id = null)
    {
        //metodo para ver un registro espesifico
        $this->vallidateInAdmin();
        $this->getMessages();

        $this->_view->assign('title','Usuario');
        $this->_view->assign('asunto','Ver Usuario');
        $this->_view->assign('process','usuarios/store');
        $this->_view->assign('mensaje','No hay usuarios disponibles');
        $this->_view->assign('usuario', Usuario::select('id', 'nombre','email','passw','activo','role_id','created_at','updated_at')->find($id));
        $this->_view->assign('role', Role::select('id', 'nombre')->find($id));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('show');         
    }


}