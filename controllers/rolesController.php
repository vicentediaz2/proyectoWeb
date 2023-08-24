<?php
use models\Role;
class rolesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->vallidateInAdmin();
    }

    public function index()
    {
        $this->vallidateInAdmin();
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Lista de Roles');
        $this->_view->assign('mensaje','No hay roles disponibles');
        $this->_view->assign('roles', Role::select('id', 'nombre')->get());
        $this->_view->render('index');
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInAdmin();
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Nuevo Rol');
        $this->_view->assign('process','roles/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
    }

    public function store()
    {
        //metodo para validar un nuevo registro 
        //valida create
        $this->vallidateInAdmin();

        $this->validateForm('roles/create',[
            'nombre' => Filter::getText('nombre')
        ]);

        $rol = Role::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($rol){
            Session::set('msg_error','El rol ingresado ya existe... intente con otro');
            $this->redirect('roles/create');
        }

        $rol = new Role;
        $rol->nombre = Filter::getText('nombre');
        $rol->save();

        Session::set('msg_success','El rol se ha registrado correctamente');
        $this->redirect('roles');
    }
    public function edit($id = null)
    {
        // metodo para editar un registro
        $this->vallidateInAdmin();
        Validate::validateModel(Role::class, $id, 'error/error');
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Editar Roles');
        $this->_view->assign('roles',Role::find(Filter::filterInt($id)));
        $this->_view->assign('process',"roles/update/{$id}");
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit'); 
    } 

    public function update($id = null)
    {
        //metodo para validar la edicion de un nuevo registro 
        //valida edit
        $this->vallidateInAdmin();

        $this->validatePUT();
        $this->validateForm('roles/create',[
            'nombre' => Filter::getText('nombre')
        ]);

        $rol = Role::find(Filter::filterInt($id));
        $rol->nombre = Filter::getText('nombre');
        $rol->save();

        Session::destroy('data');
        Session::set('msg_success','El rol se ha modificado correctamente');
        $this->redirect('roles/show/' . $id);
        
    }

    public function show($id = null)
    {
        //metodo para ver un registro espesifico
        $this->vallidateInAdmin();
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Ver Rol');
        $this->_view->assign('process','roles/store');
        $this->_view->assign('mensaje','No hay roles disponibles');
        $this->_view->assign('role', Role::select('id', 'nombre','created_at','updated_at')->find($id));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('show');         
    }

}