<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculator extends CI_Controller {

	function __construct(){
		parent::__construct();
		//check if input from CLI or not
		if(!$this->input->is_cli_request()){
       echo 'Only CLI request is allowed..!!!';
       exit();
    }
	}

	public function index()
	{
		//$this->load->view('welcome_message');
		echo "nishant soni". PHP_EOL;
	}

	//function to handle only 2 values
	public function sum()
	{
		//Let's take the input from CLI as $_SERVER['argv'][3] , if it is not present then print zero.
		if(isset($_SERVER['argv'][3])){
				// check the size of argument, its size should not be more than 2
				if( sizeof(explode(',' , $_SERVER['argv'][3])) <= 2 ){
					// explode it, and print the sum of numbers.
					echo array_sum( explode(',' , $_SERVER['argv'][3]) ) . PHP_EOL;
				}else{
					echo "Not allowed more than 2 values..!!" . PHP_EOL;
				}
		}else{
				echo 0 . PHP_EOL;
		}
	}

	/*
	* =========This is common function which is used for all the tasks. =======
	* ==========================================================================
	* ==========================================================================
	*/

	// function for handling multiple argument from CLI
	public function add(){
		//Let's take the input from CLI as $_SERVER['argv'][3] , if it is not present then print zero.
		if(isset($_SERVER['argv'][3])){
			//first we will check if the argument contans negative number or not ?
			$negative_number_response = $this->is_negative_number($_SERVER['argv'][3]);

			if( $negative_number_response != false ){
				// it means, negative number is exist..
				echo 'Negative numbers '. '(' . implode(',' , $negative_number_response ) . ')' .' are not allowed...!!' . PHP_EOL;
				exit;
			}

			//remove special characters from the Command line argument, and we will get the value in zeroth index of array
			preg_match_all('!\d+!', $_SERVER['argv'][3], $numbers_arr);

			//Now Let's check, number is greater then 1000, if yes then remove it from the array;
			$additionArr = $this->is_more_than_thousand($numbers_arr[0]);

			//finally print the sum of an array
			echo  array_sum($additionArr).PHP_EOL;

		}else{
			echo 0 . PHP_EOL;
		}
	}

	// function to check, string contains negative numbers or not...
	protected function is_negative_number($numbers){
		if( preg_match('/-/', $numbers ) ){
			$testArr = explode(',' , $_SERVER['argv'][3]);
			$neg = array_filter($testArr, function($x) {
					return $x < 0;
			});
			return $neg;
		}else{
			return false;
		}
	}

	// function to check, array contains more than 1000 value ?
	protected function is_more_than_thousand($arr){
		if( max($arr) > 1000 ){
			$arr = array_diff($arr , array( max($arr) )  );
		}
		return $arr;
	}

	 /*
	 *  ================= Above function is for all task. ==========================
	 *
	 * ============== But Now Let's create  functions for Task Wise. ================
	 */

	  //function to handle only 2 values ( Task-1 )
	 	public function task1()
	 	{
	 		//Let's take the input from CLI as $_SERVER['argv'][3] , if it is not present then print zero.
	 		if(isset($_SERVER['argv'][3])){
	 				// check the size of argument, its size should not be more than 2
	 				if( sizeof(explode(',' , $_SERVER['argv'][3])) <= 2 ){
	 					// explode it, and print the sum of numbers.
	 					echo array_sum( explode(',' , $_SERVER['argv'][3]) ) . PHP_EOL;
	 				}else{
	 					echo "Not allowed more than 2 values..!!" . PHP_EOL;
	 				}
	 		}else{
	 				echo 0 . PHP_EOL;
	 		}
	 	}

		// function for task-2, it will handle multiple numbers which are seperated by comma..
		public function task2()
		{
			//Let's take the input from CLI as $_SERVER['argv'][3] , if it is not present then print zero.
	 		if(isset($_SERVER['argv'][3])){
	 			// explode it, and print the sum of numbers.
	 			echo array_sum( explode(',' , $_SERVER['argv'][3]) ) . PHP_EOL;
			}else{
				//if there is no argument passed from CL, then display zero..
	 			echo 0 . PHP_EOL;
	 		}
		}

		// function for task-3, it will handle 'new line character also'...
		public function task3()
		{
			//remove special characters from the Command line argument..
			preg_match_all('!\d+!', $_SERVER['argv'][3], $matches);

			//finally print the sum of an array
			echo  array_sum($matches[0]).PHP_EOL;
		}

		// Function for  task-4, and it will handle negative numbers
		public function task4()
		{
			// check negative number is exist in the argument or not
			if( preg_match('/-/', $_SERVER['argv'][3]) ){
				echo 'Negative numbers are not allowed...!!' . PHP_EOL;
				exit;
			}
		}

		//function for task-5 , if negative numbers are exist then print them..
		public function task5(){
			// check negative numbers are exist or not ? if exist then print them..
			if( preg_match('/-/', $_SERVER['argv'][3]) ){
				$testArr = explode(',' , $_SERVER['argv'][3]);
				$neg = array_filter($testArr, function($x) {
				    return $x < 0;
				});
				echo 'Negative numbers '. '(' . implode(',' , $neg ) . ')' .' are not allowed...!!' . PHP_EOL;
				exit;
			}
		}

		// function for task-6, if number is more than 1000, then remove it.
		public function task6(){
			//remove special characters from the Command line argument..
			preg_match_all('!\d+!', $_SERVER['argv'][3], $matches);

			//Now Let's check, number is greater then 1000, if yes then remove it from the array;
			if( max($matches[0]) > 1000 ){
				$matches[0] = array_diff($matches[0] , array( max($matches[0]) )  );
			}

			//finally print the sum of an array
			echo  array_sum($matches[0]).PHP_EOL;
		}

		// function for multiply
		public function multiply(){
			//Let's take the input from CLI as $_SERVER['argv'][3] , if it is not present then print zero.
	 		if(isset($_SERVER['argv'][3])){
 				// explode it, and print the sum of numbers.
 				echo array_product( explode(',' , $_SERVER['argv'][3]) ) . PHP_EOL;
			}else{
	 				echo 0 . PHP_EOL;
	 		}
		}

	/*
 	 *  ========== Now multiplication functionality will be same as addition. ==============
 	 *  =====================================================================================
 	 *  =======only difference is , we will use array_product() function instead of array_sum(). ======
 	 */





}
