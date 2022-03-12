<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
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
        return view('index',['mex' => $mex]);
    }

    public function jalar(){
        return response()->json(['status' =>'ok', 'data' =>$this->apiNew()]);
    }

    public function index(){
        return view('index', ['data' =>$this->apiNew()]);
    }

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
        return view('jalarMiguel', ['news' => $this->apiMiguel()]);
    }
}
