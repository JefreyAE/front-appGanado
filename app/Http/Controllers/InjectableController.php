<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;
use App\Injectables;

class InjectableController extends Controller {

    public function index(Request $request) {
        //retorna el listado de animales
        $token = session('token');
        $injectable = new Injectables();
        $response = $injectable->getListInjectables($token);
        $listInjectables = $response['listInjectables'];

       
        return view('injectables.injectablesIndex', ['listInjectables' => $listInjectables]);
    }

    public function detail(Request $request) {
        //retorna el listado de animales
        $token = session('token');
        $code = $request->route('creation_time');
        $injectable = new Injectables();
        $response = $injectable->getListInjectablesDetail($token, $code);
        $listInjectables = $response['listInjectables'];

        return view('injectables.injectablesDetail', ['listInjectables' => $listInjectables]);
    }

    public function register(Request $request) {
        //$token = $request->route('token');
        if (session()->has('token')) {
            $token = session('token');
            $animal = new Animals();
            $response = $animal->getListActiveAnimals($token);
            $listAnimals = $response['listActive'];

            return view('injectables.injectablesRegister', ['listAnimals' => $listAnimals]);
        } else {
            return view('users.login');
        }
    }

    public function create(Request $request) {
        //retorna el listado de animales
        $token = session('token');
        $animal = new Animals();
        $response1 = $animal->getListActiveAnimals($token);
        $listAnimals = $response1['listActive'];

        $animal_id = $request->input('animal_id');
        $injectable_type = $request->input('injectable_type');
        $application_date = $request->input('application_date');
        $injectable_name = $request->input('injectable_name');
        $injectable_brand = $request->input('injectable_brand');
        $withdrawal_time = $request->input('withdrawal_time');
        $effective_time = $request->input('effective_time');
        $description = $request->input('description');

        $injectable = new Injectables();
        $response = $injectable->saveInjectable($token, $animal_id, $injectable_type, $application_date, $injectable_name, $injectable_brand, $withdrawal_time, $effective_time, $description);

        $error = null;
        if ($response == null ) {
            $error = "Ocurrio un error al registrar los datos.";

        }
        if ($response['status'] == 'error') {
            $error = $response['message'];
        }

        return view('injectables.injectablesRegister', ['response' => $response,
            'listAnimals' => $listAnimals,
            'errorMsg' => $error
        ]);
    }

    public function deleteOne(Request $request){
        //retorna el listado de animales
        $token = session('token');
        $creation_time = $request->route('creation_time');
        $animal_id = $request->route('animal_id');

        $injectable = new Injectables();
        $response = $injectable->deleteOne($token, $creation_time, $animal_id);

        if ($response == null) {
            return redirect('/animals/detail/'.$animal_id.'/')->with(['error' => 'Ocurrio un error al borrar el registro.']);
        }
        if ($response['status'] == 'error') {
            return redirect('/animals/detail/'.$animal_id.'/')->with(['error' => $response['message']]);
        }
        
        return redirect('/animals/detail/'.$animal_id.'/')->with(['message' => $response['message']]);
    }

    public function deleteAll(Request $request){
        //retorna el listado de animales
        $token = session('token');
        $creation_time = $request->route('creation_time');

        $injectable = new Injectables();
        $response = $injectable->deleteAll($token, $creation_time);

        $route = '/injectables/index';

        if ($response == null) {
            return redirect($route)->with(['error' => 'Ocurrio un error al borrar el registro.']);
        }
        if ($response['status'] == 'error') {
            return redirect($route)->with(['error' => $response['message']]);
        }
        
        return redirect($route)->with(['message' => $response['message']]);
        
    }

}
