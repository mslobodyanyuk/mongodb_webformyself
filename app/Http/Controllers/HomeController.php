<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class HomeController extends Controller
{
    public function index(){
    
        /*Article::create([
            'title' => "Hello world",
            'text' => "Some text",
            'author' => "Some user"
        ]);
        
        $articles = Article::all();
        */
        
        //$articles = Article::find('5fb2fd7169031f104e11a632');
        
        //$articles = Article::where('_id', '5fb2fd7169031f104e11a632')->get();
        
        //dump($articles);
        
        /*Category::create([
            'title' => "PHP"            
        ]);
        
        Category::create([
            'title' => "JS"            
        ]);
        */
        
        /*$article = new Article(['title' => "title article", 'text' => "some text"]);
        
        $category = Category::find("5fb30a29b524f902814fd0d4");
        
        $result = $category->articles()->save($article);*/
        
        $articles = Article::whereHas('category')->get();
        
        dump($articles);
        
        return view('welcome');
    }
}
