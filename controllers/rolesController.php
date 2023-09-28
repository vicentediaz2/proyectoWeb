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

        $title = 'Roles';
        $asunto = 'Lista de Roles';
        $mensaje = 'No hay roles disponibles';
        $roles = Role::select('id', 'nombre')->get();
        $this->_view->load('roles/index', compact('title', 'asunto', 'mensaje', 'roles'));
    }

    public function create()
    {

        //metodo para crear un nuevo registro
        $this->vallidateInAdmin();
        $this->getMessages();

        $title = 'Roles';
        $asunto = 'Nuevo Rol';
        $process = 'roles/store';
        $send = $this->encrypt($this->getForm());

        $this->_view->load('roles/create', compact('title', 'asunto', 'process', 'send'));
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

        $title = 'Roles';
        $asunto = 'Editar Roles';
        $roles = Role::find(Filter::filterInt($id));
        $process = "roles/update/{$id}";
        $send = $this->encrypt($this->getForm());

        $this->_view->load('roles/edit', compact('title', 'asunto', 'roles', 'process', 'send')); 
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

        $title = 'Roles';
        $asunto = 'Ver Rol';
        $process = 'roles/store';
        $mensaje = 'No hay roles disponibles';
        $role = Role::select('id', 'nombre','created_at','updated_at')->find($id);
        $send = $this->encrypt($this->getForm());

        $this->_view->load('roles/show', compact('title', 'asunto', 'process', 'mensaje', 'role', 'send'));         
    }

}