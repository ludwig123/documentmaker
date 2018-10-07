<?php
namespace app\maker\controller;

use app\maker\model\Code;
use app\maker\model\Man;
use app\maker\model\Record;
use app\maker\model\TrafficCaseFactory;
use think\config\driver\Json;
use think\facade\Request;
use app\maker\model\TrafficCase;

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
	
	public function recordsList(){
	    $records = new Record();
	    $lists = $records->records();
            
	    
	    $response = array(
	        'data'=>$lists,
	        'code'=>'0',
	        'count'=>count($lists)
	    );

	    return json($response);
	}

	/**通过决定书编号找到案卷所有信息
	 * @param $String $caseNum
	 */
	public function record($Id) {
	    $case = TrafficCaseFactory::getById($Id);
	    return json($case->case);
	}
	
	/**创建一个案卷
	 * @param Array $param
	 */
	public function newCase() {
	    $info = Request::instance()->post();
	    
	    $data = array(
	        'data'=>"2",
	        'code'=>'0',
	        'count'=>"2"
	    );
	    return json($data) ;
	}
	
	/**更新案卷信息
	 * @param
	 */
	public function updateCase(){
	    $case = new TrafficCase();
	    $case->update();
	}
	

	
	/**删除一个案卷
	 * @param  $param
	 */
	public function deleteCase($param) {
	    ;
	}
	
	
	private function postInfo(){
	    return Request::instance()->post();
	}
	
	private function getInfo(){
	    return Request::instance()->get();
	}
	
}