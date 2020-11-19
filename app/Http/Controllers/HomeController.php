<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show Application Home Page
     * 
     */
    public function index(){

        return view('home');

    }

    /**
     * Retrive Prime numbers
     * @param $request Request
     * @return array
     * 
     */

    public function primeNumbers(Request $request){

        if($request->num <= 1){

            return [ 
                'status' => 'error',
                'message' => "Please enter valid Prime Number(greater than 1)"
            ];

        }else{

            $prime = [];

            for ($i = 2; $i <= $request->num; $i++)  
            { 
                if ($this->isPrime($i)) 
                    $prime[$i] = $i; 
            } 

            $median = $this->findMedian(array_values($prime));

            $data = [
                'status' => 'success',
                'prime' => array_values($prime),
                'median' => array_values($median)
            ];

            return $data;
        }
    }

    /**
     * Check number whether it's prime or not
     * @param $n prime number
     * @return Boolean
     * 
     */
    protected function isPrime($n){ 
     
        for ($i = 2; $i < $n; $i++) 
            if ($n % $i == 0) 
                return false; 
    
        return true;

    }

    /**
     * Find Median from prime number's array
     * 
     * @param array 
     * @return array 
     */
    protected function findMedian($prime){

        $count = count($prime);
        $median = [];
        if($count % 2 == 0){
            
            for($i = 0; $i <= count($prime); $i++){

                if($i == ($count / 2) - 1 || $i == ($count / 2)){
                    $median[$i] = $prime[$i];
                }

            }

            return $median;


        }else{
            
            for($i = 0; $i <= count($prime); $i++){
            
                if(($count / 2) % 1 == 0){

                    if( $i == round($count / 2) - 1)
                        $median[$i] = $prime[$i];

                }else{

                    if( $i == round($count / 2) - 1 || $i == round($count / 2))
                        $median[$i] = $prime[$i];

                }
            }

            return $median;
        }

        
    }

}
