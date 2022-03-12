<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{

    ///   Nuestra api :D
    public function apiNew(){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://newsapi.org/v2/top-headlines?country=mx&apiKey=d324cb0430b044e98a3d0584d0dadbc4');
        $data = json_decode($response->getBody()->getContents(), true);

        $mex=[];

        foreach ($data['articles'] as $value) {
            $mex[]=[
                'id' => $value['source']['id'],
                'name' => $value['source']['name'],
                'autor' => $value['author'],
                'title' => $value['title'],
                'description' => $value['description'],
                'url' => $value['url'],
                'urlToImage' => $value['urlToImage'],
                'publishedAt' => $value['publishedAt'],
                'content' => $value['content']
            ];
        }
        return $mex;
    }

    public function jalar(){
        return response()->json($this->apiNew());
    }

    public function injectar(){
        return view('index', ['mex' => $this->apiNew()]);
    }


    /////  Api de Miguel e Irvirgn
    public function apiMiguel(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://apisnews.herokuapp.com/api/ver');
        $data = json_decode($response->getBody()->getContents(), true);

        $news=[];

        foreach ($data['unidades'] as $value) {
            $news[]=[
                'id' => $value['id'],
                'name' => $value['name'],
                'autor' => $value['author'],
                'title' => $value['title'],
                'description' => $value['description'],
                'url' => $value['url'],
                'urlToImage' => $value['urlToImage'],
                'publishedAt' => $value['publishedAt'],
                'content' => $value['content']
            ];
        }
        return $news;
    }

    public function jalarMiguel(){
        return view('apiMiguel', ['news' => $this->apiMiguel()]);
    }


    ///   api Marco y la peso muerto :v
    public function apiMarco(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://notideportes.herokuapp.com/api/apiDeporte1');
        $data = json_decode($response->getBody()->getContents(), true);

        $marc=[];

        foreach($data['Deporte']as $value){
            $marc[]=[
                'title' => $value['titulo'],
                'content' => $value['contenido'],
                'autor' => $value['autor'],
                'urlToImage' => $value['imagen'],
            ];
        }
        return $marc;
    }

    public function jalarMarco(){
        return view('apiMarco', ['marc' => $this->apiMarco()]);
    }
}
