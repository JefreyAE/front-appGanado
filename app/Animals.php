<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Animals extends Model {

    public $url;

    public function __construct() {
        $api = new \App\Helpers\Constants();
        $this->url = $api->url();
    }

    public function getDetail($token, $id) {

        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/animal/detail/' . $id);

        return $response->json();
    }

    public function getAnimal($token, $id){
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->get($this->url . '/api/animals/animal/' . $id);

        return $response->json();
    }

    public function getImagesNames($token, $id) {

        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/images_names/' . $id);

        return $response->json();
    }

    //No funciona
    public function uploadImage($token, $title, $description, $image, $animal_id) {

        $response = Http::withHeaders(
                    ['Authorization' => $token]
                )->asForm()->attach(
                    'file0', file_get_contents($image)
                )->post($this->url . '/api/animals/upload', [
                    'title'       => $title,
                    'description' => $description,
                    'animal_id' => $animal_id
                ]);
                var_dump($response);
        die();        
        return $response->json();
    }

    public function deleteImage($token, $image_name, $animal_id) {

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->get($this->url . '/api/animals/deleteImage/' . $image_name . '/' . $animal_id);
        
        return $response->json();
    }

    public function getInjectables($token, $id) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/injectables/' . $id);

        return $response->json();
    }

    public function getIncidents($token, $id) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/incidents/' . $id);

        return $response->json();
    }

    public function getOffSprings($token, $id) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/offprings/' . $id);

        return $response->json();
    }

    public function getListActiveAnimals($token) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/index');

        return $response->json();
    }

    public function getListDeadAnimals($token) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/dead');

        return $response->json();
    }

    public function getListAnimalsAll($token) {
        $response = Http::withHeaders([
                    'Authorization' => $token
                ])->get($this->url . '/api/animals/indexAll');

        return $response->json();
    }

    public function saveAnimal($token, $nickname, $certification_name, $registration_number, $birth_weight, $code, $birth_date, $sex, $father_id, $mother_id, $race) {

        $response = Http::withHeaders(
                        ['Authorization' => $token]
                )->asForm()->post($this->url . '/api/animals/create', [
            'json' => [
                'nickname' => $nickname,
                'certification_name' => $certification_name,
                'registration_number' => $registration_number,
                'birth_weight' => $birth_weight,
                'code' => $code,
                'birth_date' => $birth_date,
                'sex' => $sex,
                'father_id' => $father_id,
                'mother_id' => $mother_id,
                'race' => $race
            ]
        ]);

        return $response->json();
    }

    public function findAnimal($token, $search_type, $find_string) {
        $response = Http::withHeaders(
                        ['Authorization' => $token]
                )->asForm()->post($this->url . '/api/animals/find', [
            'json' => [
                'search_type' => $search_type,
                'find_string' => $find_string
            ]
        ]);
        /* var_dump($response->json());
          die(); */
        return $response->json();
    }

    public function updateAnimal($token, $animal_id, $nickname, $certification_name, $registration_number, $birth_weight, $code, $birth_date, $sex, $father_id, $mother_id, $race) {

        $response = Http::withHeaders(
                        ['Authorization' => $token]
                )->asForm()->put($this->url . '/api/animals/update', [
            'json' => [
                'animal_id' => $animal_id,
                'nickname' => $nickname,
                'certification_name' => $certification_name,
                'registration_number' => $registration_number,
                'birth_weight' => $birth_weight,
                'code' => $code,
                'birth_date' => $birth_date,
                'sex' => $sex,
                'father_id' => $father_id,
                'mother_id' => $mother_id,
                'race' => $race
            ]
        ]);

        return $response->json();
    }

    public function deleteAnimal($token, $id){

        $response = Http::withHeaders(['Authorization' => $token])
            ->get($this->url.'/api/animals/delete/'.$id);

        return $response->json();
    }

}
