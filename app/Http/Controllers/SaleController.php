<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Animals;

class SaleController extends Controller {

    public function index(Request $request) {
        //retorna el listado de animales
        $token = session('token');
        $sale = new Sales();
        $response = $sale->getListSales($token);

        
        return view('sales.salesIndex', ['listSales' => $response['listSales']]);
    }

    public function search(Request $request) {
        //$token = session('token');

        return view('sales.salesSearch');
    }

    public function find(Request $request) {
        //retorna el listado de animales
        $token = session('token');

        /* sale_type               varchar(100),
          weight                  int(255),
          price_total             int(255),
          price_kg                int(255),
          auction_commission      int(255),
          auction_name            varchar(100),
          description             text,
          sale_date               datetime DEFAULT NULL, */

        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        $sale = new Sales();
        $response = $sale->findByDates($token, $date1, $date2);

        $errorx = null;
        if ($response == null) {
            $errorx = "Ocurrio un error al registrar los datos";
            return view('sales.salesSearch', ['errorx' => $errorx]);
        }
        if ($response['status'] == "error") {
            return view('sales.salesSearch', ['errorx' => $response['message']]);
        }

        if (count($response['listSales']) == 0) {
            return view('sales.salesSearch', ['noData' => "x"]);
        }

        return view('sales.salesSearch', ['listSales' => $response['listSales'],
            'errorx' => $errorx]);
    }

    public function register(Request $request) {
        //$token = $request->route('token');
        if (session()->has('token')) {
            $token = session('token');
            $animal = new Animals();
            $response = $animal->getListActiveAnimals($token);
            $listAnimals = $response['listActive'];

            return view('sales.salesRegister', ['listAnimals' => $listAnimals]);
        } else {
            return view('users.login');
        }
    }

    public function create(Request $request) {
        //retorna el listado de animales
        $token = session('token');

        $animal_id = $request->input('animal_id');
        $sale_type = $request->input('sale_type');
        $weight = $request->input('weight');
        $price_total = $request->input('price_total');
        $price_kg = $request->input('price_kg');
        $auction_commission = $request->input('auction_commission');
        $auction_name = $request->input('auction_name');
        $sale_date = $request->input('sale_date');
        $description = $request->input('description');

        $sale = new Sales();
        $response1 = $sale->saveSale($token, $animal_id, $sale_type, $weight, $price_total, $price_kg, $auction_commission, $auction_name, $sale_date, $description);

        $animal = new Animals();
        $response2 = $animal->getListActiveAnimals($token);
        $listAnimals = $response2['listActive'];

        if ($response2 == null || $response2['status'] == 'error') {
            $error1 = "Ocurrio un error al registrar los datos.";
            return view('sales.salesRegister', ['response' => $response2,
                'errorMsg' => $error1
            ]);
        }

        $error1 = null;
        if ($response1 == null || $response1['status'] == 'error') {
            $error1 = "Ocurrio un error al registrar los datos.";
        }

        return view('sales.salesRegister', ['response' => $response1,
            'listAnimals' => $listAnimals,
            'errorMsg' => $error1
        ]);
    }

    public function deleteOne(Request $request){
        //retorna el listado de animales
        $token = session('token');
        $sale_id = $request->route('sale_id');
        $animal_id = $request->route('animal_id');

        $sale = new Sales();
        $response = $sale->deleteOne($token, $sale_id, $animal_id);

        if ($response == null) {
            return redirect('/sales/index/')->with(['error' => 'Ocurrio un error al borrar el registro.']);
        }
        if ($response['status'] == 'error') {
            return redirect('/sales/index/')->with(['error' => $response['message']]);
        }
        
        return redirect('/sales/index/')->with(['message' => $response['message']]);
    }

    public function detail(Request $request){
        $token = session('token');
        $animal_id = $request->route('animal_id');
        $sale_id   = $request->route('sale_id');

        $animal = new Animals();
        $response = $animal->getAnimal($token, $animal_id);

        $sale = new Sales();
        $response2 = $sale->getSale($token, $sale_id);
        
        $name      = $response['animal']['code'].' '.$response['animal']['nickname']. ' ' . $response['animal']['certification_name'];
        $sale_type = $response2['sale']['sale_type'];
        $sale_date = $response2['sale']['sale_date'];
        $weight    = $response2['sale']['weight'];
        $price_total = $response2['sale']['price_total'];
        $price_kg    = $response2['sale']['price_kg'];
        $auction_commision = $response2['sale']['auction_commission'];
        $auction_name = $response2['sale']['auction_name'];
        $sex          = $response['animal']['sex'];
        $description  = $response2['sale']['description'];
        $status       = $request->route('status');
        $message      = $request->route('message');

        return view('sales.salesDetail', [
            'animal_id'  => $animal_id,
            'sale_id'    => $sale_id,
            'name'       => $name,
            'sale_type'  => $sale_type,
            'sale_date'  => $sale_date,
            'weight'     => $weight,
            'price_total'=> $price_total,
            'price_kg'   => $price_kg,
            'auction_commision' => $auction_commision,
            'auction_name' => $auction_name,
            'sex'        => $sex,
            'description'=> $description,
            'status' => $status,
            'message' => $message
        ]);
    }

    public function update(Request $request){
        $token = session('token');
       
        $sale_id = $request->input('sale_id');
        $animal_id = $request->input('animal_id');
        $sale_type = $request->input('sale_type');
        $weight = $request->input('weight');
        $price_total = $request->input('price_total');
        $price_kg = $request->input('price_kg');
        $auction_commission = $request->input('auction_commission');
        $auction_name = $request->input('auction_name');
        $sale_date = $request->input('sale_date');
        $description = $request->input('description');
        $name      = $request->input('name');
        $sex      = $request->input('sex');

        if(empty($price_kg)){
            $price_kg = 0;
        }
        if(empty($auction_commission)){
            $auction_commission = 0;
        }
        if(empty($auction_name)){
            $auction_name = '-';
        }


        $sale = new sales();
        $response2 = $sale->updateSale($token, $sale_id, $sale_type, $weight, $price_total, $price_kg, $auction_commission, $auction_name, $sale_date, $description);

        $error2 = null;
        if ($response2 == null) {
            $error2 = "Ocurrio un error al actualizar los datos.";
        }
        if ($response2['status'] == 'error') {
            $error2 = "Ocurrio un error al actualizar los datos.";

            return redirect ('/sales/sale/detail/' . $animal_id . '/' .$sale_id . '/error/'.$error2.'/');

          
        }

        return redirect ('/sales/sale/detail/' . $animal_id . '/' .$sale_id . '/success/'.$response2['message'].'/');
        
    }

}
