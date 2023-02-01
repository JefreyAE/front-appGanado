<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\Notifications;

class UserController extends Controller {

    private $listImages = [];

    function __construct()
    {
        array_push($this->listImages,["image_name"=>"detalle2", "title"=>"Detalle de un animal", "description" => "Visualización de los datos de un animal y subida de imagenes."]);
        array_push($this->listImages,["image_name"=>"detalle", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"activos", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"ranimal", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"rcompra", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"estadisticas", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"rventas", "title"=>"", "description" => ""]);
        array_push($this->listImages,["image_name"=>"rincidentes", "title"=>"", "description" => ""]); 
    }

    public function register() {
        return view('users.userRegister');
    }

    public function profile() {
        return view('users.userProfile');
    }

    public function create(Request $request) {

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');

        if($password1 != $password2){
            $error = "Las constraseñas no coinciden.";
            return view('users.userRegister', array('error' => $error));
        }
       
        $user = new User();
        $response = $user->register($name, $surname, $email, $password1);

        if ($response == null) {
            $error = "Ocurrio un error al registrar los datos.";
            return view('users.userRegister', array('error' => $error));
        }

        if (!empty($response['status'])) {
            if ($response['status'] == "success") {
                if (isset($response)) {
                    return view('users.userRegister', ['message' => $response['message']]);
                }
            }
            if ($response['status'] == "error") {
                if (!empty($response['errors'])) {
                    return view('users.userRegister', ['listErrors' => $response['errors'],
                        'error' => $response['message']]);
                } else {
                    return view('users.userRegister', array('error' => $response['message']));
                }
            }
        } else {
            $error = "Ocurrio un error al registrar los datos.";
            return view('users.userRegister', array('error' => $error));
        }
    }

    public function index(){
       
        return view('users.userLogin', array(
                    'listImages' => $this->listImages
        ));
        
    }

    public function login(Request $request) {
        session_start();
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();
        $token = $user->login($email, $password);

        if (is_array($token)) {

            if (!empty($token['status'])) {
                if ($token['status'] == "error") {
                    if (!empty($token['errors'])) {
                        return view('users.userLogin', ['listErrors' => $token['errors'],
                            'message' => $token['message'],
                            'listImages' => $this->listImages]
                        );
                    } else {
                        return view('users.userLogin', ['message' => $token['message'],
                            'listImages' => $this->listImages]
                        );
                    }
                }
            } else {
                $error = "Ocurrio un al enviar la solicitud de ingreso";
                return view('users.userLogin', array('error' => $error,
                    'listImages' => $this->listImages
                ));
            }

            return view('users.userLogin', array('error' => $token['menssage'],
                'listImages' => $this->listImages
            ));
        } else {
            if (isset($token) && is_string($token)) {
                $jwtAuth = new \App\Helpers\JwtAuth();
                //$token = $_SESSION['token'] = $response;
                session(['token' => $token]);
                $user = $jwtAuth->checkToken($token, true);
                session(['user' => $user]);
                //var_dump($token);
                //die;
                return redirect('/notifications/generate/');
            }
        }
    }

    public function update(Request $request) {

        $email = $request->input('email');
        $passwordNew = $request->input('password1');
        $passwordCurrent = $request->input('passwordCurrent');
        $passwordRepeat = $request->input('password2');

        $token = session('token');
        $user = new User();
        $response = $user->updateEmailPassword($token, $passwordNew, $passwordRepeat, $passwordCurrent);

        if ($response == null) {
            $error = "Ocurrio un error al actualizar los datos.";
            return view('users.profile', array('error' => $error));
        }

        if (!empty($response['status'])) {
            if ($response['status'] == "success") {
                $tokenNew = $response['token'];
                if (isset($response) && is_string($tokenNew)) {
                    $jwtAuth = new \App\Helpers\JwtAuth();
                    session(['token' => $tokenNew]);
                    $user = $jwtAuth->checkToken($tokenNew, true);
                    session(['user' => $user]);

                    return view('users.userProfile', ['message' => $response['message']]);
                }
            }
            if ($response['status'] == "error") {
                if (!empty($response['errors'])) {
                    return view('users.userProfile', ['listErrors' => $response['errors'],
                        'error' => $response['message']]);
                } else {
                    return view('users.userProfile', array('error' => $response['message']));
                }
            }
        } else {
            $error = "Ocurrio un error al registrar los datos.";
            return view('users.userProfile', array('error' => $error));
        }
    }

    public function logout() {
        session()->forget('user');
        session()->forget('token');
        return redirect('/');
    }

    public function redirection($direction) {
        return redirect()->action($direction);
    }

}
