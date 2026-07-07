<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompilerController extends Controller
{
    private $folder;
    public function __construct(){
        $this->folder = storage_path('/public/codestorage/');
    }

    public function index(){
        if(!is_dir($this->folder)){
            mkdir($this->folder, 0755, true);
        }
        //file_put_contents($this->folder . 'temp.php', null);
        return view('welcome');
    }

    public function storecode(Request $request){
        
        $code = $request->code;
        $filename = Str::random(20); 
        if(isset($code)){
            file_put_contents($this->folder . $filename . '.php', $code);
            include $this->folder . $filename .'.php';
            $this->runcode($filename);
        }
        else{
            file_put_contents($this->folder . 'temp.php', null);
            echo 'how can nothing be seen !!';
        }
    }

    public function runcode($filename){
        unlink($this->folder. $filename . '.php');
    }
}
