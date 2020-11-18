<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        return view('home');

    }

    public function primeNumbers(Request $request){

        $prime = [];

        for ($i = 2; $i <= $request->num; $i++)  
        { 
            if ($this->isPrime($i)) 
                $prime[$i] = $i; 
        } 

        $median = $this->findMedian(array_values($prime));

        return $median;
    }

    protected function isPrime($n){

        if ($n <= 1) 
        return false; 
    
        // Check from 2 to n-1 
        for ($i = 2; $i < $n; $i++) 
            if ($n % $i == 0) 
                return false; 
    
        return true;

    }

    protected function findMedian($prime){

        $count = count($prime) / 2;
        $median = [];
        if($count % 2 == 0){
            
            for($i = 0; $i <= count($prime); $i++){

                if($i == $count - 1 || $i == $count){
                    $median[$i] = $prime[$i];
                }

            }

            return $median;


        }else{
            
            for($i = 0; $i <= count($prime); $i++){
            
                if( $i == round($count) - 1 )
                    $median[$i] = $prime[$i];
            }

            return $median;
        }

        
    }

}
