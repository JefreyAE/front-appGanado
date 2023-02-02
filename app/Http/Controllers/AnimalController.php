<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;

class AnimalController extends Controller {

    public function __construct() {
        $api = new \App\Helpers\Constants();
        $this->url = $api->url();
    }

    public function index(Request $request) {
        //retorna el listado de animales
        $token = session('token');
        $type = $request->route('type');
        $animal = new Animals();
        $response = $animal->getListActiveAnimals($token);

        return view('animals.animalsIndex', ['listActive' => $response['listActive'],
            'type' => $type
        ]);
    }

    public function indexAll(Request $request) {
        $token = session('token');
        $type = $request->route('type');
        $animal = new Animals();
        $response = $animal->getListAnimalsAll($token);

        return view('animals.animalsIndex', ['listAll' => $response['listAll'],
            'token' => $token,
            'type' => $type
        ]);
    }

    public function search() {
        return view('animals.animalsSearch');
    }

    public function find(Request $request) {

        $token = session('token');
        $animal = new Animals();
        $search_type = $request->input('search_type');
        $find_string = $request->input('find_string');
        $response = $animal->findAnimal($token, $search_type, $find_string);

        $error = null;
        if ($response == null) {
            $error = "Ocurrio un error al realizar la busqueda.";
            return view('animals.animalsSearch', ['errorMsg' => $error,
            ]);
        }
        $listFind = null;

        if ($response['status'] == 'error') {
            $error = "Ocurrio un error al consultar los datos.";
            return view('animals.animalsSearch', ['response' => $response,
                'errorMsg' => $response['message']
            ]);
        }
        if (count($response['listFind']) == 0) {
            return view('animals.animalsSearch', ['noData' => "x"]);
        }

        if ($response['status'] == "success") {
            $listFind = $response['listFind'];
            return view('animals.animalsSearch', ['listFind' => $listFind,
                'errorMsg' => $error,
            ]);
        }
    }

    public function dead(Request $request) {
        $token = session('token');
        $type = $request->route('type');
        $animal = new Animals();
        $response = $animal->getListDeadAnimals($token);

        if ($response == null) {
            $error1 = "Ocurrio un error.";
            return view('animals.animalsRegister', ['errorMsg' => $error1
            ]);
        }

        return view('animals.animalsIndex', ['listDead' => $response['listDead'],
            'type' => $type
        ]);
    }

    public function detail(Request $request) {
        
        $message = $request->route('message');
        $id = $request->route('id');
        $token = session('token');
        if ($id == null) {
            return redirect('/animals/index');
        } else {
            $animal = new Animals();
            $response = $animal->getListAnimalsAll($token);
            $animals = $response['listAll'];

            $animalDetail = $animal->getDetail($token, $id);

            if ($animalDetail == null) {
                return redirect('/animals/index/animales activos')->with(['error' => 'Ocurrio al buscar el registro.']);
            }
            if ($animalDetail['status'] == 'error') {
                return redirect('/animals/index/animales activos')->with(['error' => $animalDetail['message']]);
            }     

            $listImages = $animal->getImagesNames($token, $id);

            if($animalDetail['status'] == 'error'){
                return redirect('/animals/index/animales activos');
            }

            return view('animals.animalsDetail', [
                'message'        => $message,
                'tk'             => $token,
                'animal_id'      => $id,
                'animal'         => $animalDetail['detail'][0],
                'animals'        => $animals,
                'listInjectables' => $animalDetail['injectables'],
                'listIncidents'  => $animalDetail['incidents'],
                'listOffSprings' => $animalDetail['offsprings'],
                'listImages'     => $listImages['images_list'],
                'url_api'        => $this->url,
                'statistics'     => $animalDetail['statistics']
            ]);
        }
    }

    public function create(Request $request) {
        //retorna el listado de animales

        $token = session('token');
        $nickname = $request->input('nickname');
        $certification_name = $request->input('certification_name');
        $registration_number = $request->input('registration_number');
        $birth_weight = $request->input('birth_weight');
        $code = $request->input('code');
        $birth_date = $request->input('birth_date');
        $sex = $request->input('sex');
        $father_id = $request->input('father_id');
        $mother_id = $request->input('mother_id');
        $race = $request->input('race');

        $animal = new Animals();
        $response = $animal->saveAnimal($token, $nickname, $certification_name, $registration_number, $birth_weight, $code, $birth_date, $sex, $father_id, $mother_id, $race);
        $list = $animal->getListActiveAnimals($token);
        $animals = $list['listActive'];

        $error1 = null;
        if ($response == null) {
            return view('animals.animalsRegister', ['animals' => $animals,
                'response' => $response,
                'errorMsg' => $response['message']
            ]);
        }

        if ($response['status'] == 'error') {
            return view('animals.animalsRegister', ['animals' => $animals,
                'response' => $response,
                'errorMsg' => $response['message']
            ]);
        }

        return view('animals.animalsRegister', ['animals' => $animals,
            'response' => $response,
            'errorMsg' => $response['message']
        ]);
    }

    public function register() {
        //$token = $request->route('token');
        if (session()->has('token')) {
            $token = session('token');
            $animal = new Animals();
            $response = $animal->getListActiveAnimals($token);
            $animals = $response['listActive'];

            $error = null;
            if ($response == null) {
                $error = "Ocurrio un error al registrar los datos.";
            }

            return view('animals.animalsRegister', ['animals' => $animals,
                'token' => $token,
                'error' => $error]);
        } else {
            return view('users.login');
        }
    }

    //No funciona adecuadamente
    public function uploadImage(Request $request){

        $token = session('token');
        $title = $request->input('title');
        $description = $request->input('description');
        $animal_id = $request->input('animal_id');
        $image = $request->file('file0');
        

        $animal = new Animals();
      
        $response = $animal->uploadImage($token, $title, $description, $image, $animal_id);

        if ($response == null) {
            $error1 = "Ocurrio un error al registrar los datos.";
            return redirect('/animals/detail/'.$animal_id.'/'.$error1);
        }

        return redirect('/animals/detail/'.$animal_id.'/Imagen guardada correctamente');
    }

    public function deleteImage(Request $request){

        $image_name = $request->route('image_name');
        $animal_id = $request->route('animal_id');
        $token = session('token');
        $animal = new Animals();

        $response = $animal->deleteImage($token, $image_name, $animal_id);

        if ($response == null) {
            return redirect('/animals/detail/'.$animal_id.'/')->with(['imageError' => 'Ocurrio un error al borrar la imagen.']);
        }

        return redirect('/animals/detail/'.$animal_id.'/')->with(['imageMessage' => 'Imagen borrada correctamente.']);
    }

    public function update(Request $request) {
        //retorna el listado de animales

        $token = session('token');
        $nickname = $request->input('nickname');
        $certification_name = $request->input('certification_name');
        $registration_number = $request->input('registration_number');
        $birth_weight = $request->input('birth_weight');
        $code = $request->input('code');
        $birth_date = $request->input('birth_date');
        $sex = $request->input('sex');
        $father_id = $request->input('father_id');
        $mother_id = $request->input('mother_id');
        $race = $request->input('race');
        $animal_id = $request->input('animal_id');

        $animal = new Animals();
        $response = $animal->updateAnimal($token, $animal_id, $nickname, $certification_name, $registration_number, $birth_weight, $code, $birth_date, $sex, $father_id, $mother_id, $race);
        
        if ($response == null) {
            $error1 = "Ocurrio un error al registrar los datos.";
            return redirect('/animals/detail/'.$animal_id.'/'.$error1);
        }

        if ($response['status'] == 'error') {
            return redirect('/animals/detail/'.$animal_id.'/')->with(['message' => 'Ocurrio un error al registrar los datos.']);
        }

        return redirect('/animals/detail/'.$animal_id.'/')->with(['message' => 'Datos actualizados correctamente']);
    }

    public function delete(Request $request){
        $token = session('token');
        $id = $request->route('id');

        $animal = new Animals();
        $response = $animal->deleteAnimal($token, $id);

        if ($response == null) {
            return redirect('/animals/detail/'.$id.'/')->with(['error' => 'Ocurrio un error al borrar el registro.']);
        }
        if ($response['status'] == 'error') {
            return redirect('/animals/detail/'.$id.'/')->with(['error' => $response['message']]);
        }

        return redirect('/animals/index/')->with(['message' => 'Registro borrado correctamente']);

    }

}
