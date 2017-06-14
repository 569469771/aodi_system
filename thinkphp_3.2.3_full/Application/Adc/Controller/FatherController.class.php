<?php
namespace Adc\Controller;
use Think\Controller;
class FatherController extends Controller{
	public function __construct(){
		parent::__construct();
		// echo "hello!";
	}
	public function getName(){
		return "1";
	}


}