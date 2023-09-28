<?php
use models\Usuario;

class loginController extends Controller
{
    public function __construct()
    {
	
		parent::__construct();
	}
    
    public function index()
    {
        $this->getMessages();
        $title = 'Login';
        $asunto = 'Acceso Usuario';
        $process = 'login/store';
        $send = $this->encrypt($this->getForm());

        $this->_view->load('login/index',compact('title','asunto','process','send'));
    }
    public function store()
    {
        $this->validateForm('login/index',[
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'passw' => Filter::getSql('passw')
        ]);

        $usuario = Usuario::with('role')
            ->where('email', Filter::getPostParam('email'))
            ->where('passw', Helper::encryptPassword(Filter::getPostParam('passw')))
            ->where('activo', 1)
            ->first();

        if (!$usuario) {
            Session::set('msg_error','El correo o la contraseña no están registrados');
            $this->redirect();
        }

        Session::set('autenticate', true);
        Session::set('user_id', $usuario->id);
        Session::set('user_nombre', $usuario->nombre);
        Session::set('user_email', $usuario->email);
        Session::set('user_role', $usuario->role->nombre);
        Session::set('time', time());

        Session::set('msg_success','Bienvenid@ ' . Session::get('user_nombre'));
        $this->redirect('index');
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect();
    }

}