<?php
use models\Producto;
use models\img;

class imgController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->vallidateInSuperUser();
    }

    public function index()
    {
        $this->getMessages();
        $this->vallidateInSuperUser();

        $title = 'Imagenes';
        $asunto = 'Lista de Imagenes';
        $mensaje = 'No hay Imagenes disponibles';
        $imagenes = img::select('id','nombre','producto_id')->get();

        $this->_view->load('img/index', compact('title','asunto','mensaje','imagenes'));
    }

    public function create()
    {

        $this->getMessages();
        $this->vallidateInIlu();

        $title = 'Imagenes';
        $asunto = 'Nueva Imagen';
        $pagina = 'create';
        $process = 'img/store';
        $productos = Producto::select('id', 'nombre')->get();
        $send = $this->encrypt($this->getForm());

        $this->_view->load('img/create', compact('title','asunto','pagina','process','productos','send'));
    }

    public function store()
    {

        $this->vallidateInIlu();
        $this->validateForm('img/create',[
            'relevancia' => Filter::getText('relevancia'),
            'producto' => Filter::getText('producto'),
            'imagen' => $_FILES['imagen']['name'],
        ]);

        //consulta si hay otra imagen relacionada con el mismo producto y la misma relevancia
        $img = img::select('id')
        ->where('producto_id', Filter::getText('producto'))
        ->where('relevancia', Filter::getText('relevancia'))
        ->first();
        if($img){
            Session::set('msg_error',"la imagen " . Filter::filterInt('relevancia') . " del Producto: " . Filter::getText('producto') . "ya existe");
            $this->redirect('img/create');
        }
        
        //validar formato de imagen
        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        if (! in_array($_FILES['imagen']['type'], $extensiones) ) {
            Session::set('msg_error','El archivo ingresado no esta en el formato espesificado');
            $this->redirect('img/create');
        }

        //crea nombre para asignar a la imagen respecto al producto con que esta relacionada
        $extension = explode('.', $_FILES['imagen']['name']);
        $extension = end($extension);

        $nombre = "img" . Filter::getText('producto') . "_" . Filter::getText('relevancia') . "." . $extension;
        $_FILES['imagen']['name'] = $nombre;
        

        $upload = $_SERVER['DOCUMENT_ROOT'] . '/axiomaframe/public/img/';
        $fichero = $upload . basename($_FILES['imagen']['name']);
        
        /*echo $_FILES['imagen']['name'];
        echo $_FILES['imagen']['tmp_name'];
        echo $_FILES['imagen']['size'];
        echo $_FILES['imagen']['type'];*/
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero)) {
            $img = new img;
            $img->nombre = $nombre; //se definio el nombre en relacion a producto relacionado mas arriba
            $img->producto_id = Filter::getText('producto');
            $img->relevancia = Filter::getText('relevancia');
            $img->save();

            Session::set('msg_success','La imagen se ha registrado correctamente');
        }else{

            Session::set('msg_error', 'La imagen no se ha podido registrar... intente nuevamente');
        }

        Session::destroy('data');
        $this->redirect('img');
    }

    public function edit($id = null)
    {
        $this->vallidateInIlu();
        Validate::validateModel(Img::class, $id, 'error/error');
        $this->getMessages();

        $title = 'Imagenes';
        $asunto = 'Editar Imagen';
        $pagina = 'edit';
        $productos = Producto::select('id', 'nombre')->get();
        $imgs = Img::find(Filter::filterInt($id));
        $process = "img/update/{$id}";
        $send = $this->encrypt($this->getForm());

        $this->_view->load('img/edit', compact('title','asunto','pagina','productos','imgs','process','send'));
    }

    public function update($id = null)
    {
        $this->vallidateInIlu();
        
        $this->validatePUT();
        $this->validateForm('img/create',[
            'relevancia' => Filter::getText('relevancia'),
            'producto' => Filter::getText('producto'),
            'imagen' => $_FILES['imagen']['name'],
        ]);

        //consulta si hay otra imagen relacionada con el mismo producto y la misma relevancia
        $img = img::select('id')
        ->where('producto_id', Filter::getText('producto'))
        ->where('relevancia', Filter::getText('relevancia'))
        ->first();
        if($img){
            Session::set('msg_error',"la imagen " . Filter::filterInt('relevancia') . " del Producto: " . Filter::getText('producto') . "ya existe");
            $this->redirect('img/create');
        }
        
        //validar formato de imagen
        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        if (! in_array($_FILES['imagen']['type'], $extensiones) ) {
            Session::set('msg_error','El archivo ingresado no esta en el formato espesificado');
            $this->redirect('img/create');
        }

        //crea nombre para asignar a la imagen respecto al producto con que esta relacionada
        $extension = explode('.', $_FILES['imagen']['name']);
        $extension = end($extension);

        $nombre = "img" . Filter::getText('producto') . "_" . Filter::getText('relevancia') . "." . $extension;
        $_FILES['imagen']['name'] = $nombre;
        

        $upload = $_SERVER['DOCUMENT_ROOT'] . '/axiomaframe/public/img/';
        $fichero = $upload . basename($_FILES['imagen']['name']);
        
        /*echo $_FILES['imagen']['name'];
        echo $_FILES['imagen']['tmp_name'];
        echo $_FILES['imagen']['size'];
        echo $_FILES['imagen']['type'];*/
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero)) {
            $img = new img;
            $img->nombre = $nombre; //se definio el nombre en relacion a producto relacionado mas arriba
            $img->producto_id = Filter::getText('producto');
            $img->relevancia = Filter::getText('relevancia');
            $img->save();

            Session::set('msg_success','La imagen se ha registrado correctamente');
        }else{

            Session::set('msg_error', 'La imagen no se ha podido registrar... intente nuevamente');
        }

        Session::destroy('data');
        $this->redirect('img/show/' . $id);

    }

    public function destroy($id = null)
    {
        $this->vallidateInIlu();
        Validate::validateModel(img::class, $id, 'error/error');
        $this->validateDelete();

        $imagen = img::find(Filter::filterInt($id));
        $imagen->delete();

        Session::set('msg_success', 'La imagen se ha eliminado correctamente');
        $this->redirect('img');
    }


    public function show($id = null)
    {
        //metodo para ver un registro espesifico
        $this->vallidateInSuperUser();
        $this->getMessages();

        $title = 'Imagenes';
        $asunto = 'Ver Imagenes';
        $mensaje = 'No hay roles disponibles';
        $img = Img::select('id', 'nombre','producto_id','relevancia','created_at','updated_at')->find($id);
        $send = $this->encrypt($this->getForm());

        $this->_view->load('img/show', compact('title','asunto','mensaje','img','send'));         
    }
}