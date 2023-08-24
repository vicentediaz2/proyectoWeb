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

        $this->_view->assign('title','Login');
        $this->_view->assign('asunto','Acceso Usuario');
        $this->_view->assign('process','login/store');
        $this->_view->assign('send',$this->encrypt($this->getForm()));

        $this->_view->render('index');
    }
    public function store()
    {
        $this->validateForm('login/login',[
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
            $this->redirect('login');
        }

        Session::set('autenticate', true);
        Session::set('user_id', $usuario->id);
        Session::set('user_nombre', $usuario->nombre);
        Session::set('user_email', $usuario->email);
        Session::set('user_role', $usuario->role->nombre);
        Session::set('time', time());

        Session::set('msg_success','Bienvenid@ ' . Session::get('user_nombre'));
        $this->redirect();
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect();
    }

}