<?php
namespace app\maker\controller;

use app\maker\model\Code;
use think\config\driver\Json;

class Api {
	public function code(){
		$code = Code::all();
		$data = array(
		    'data'=>$code,
		    'code'=>'0',
		    'count'=>count($code)
		);

		
		return json($data);
		
	}
}