<?php
namespace app\maker\controller;

use app\maker\model\Code;
use app\maker\model\Record;
use think\config\driver\Json;
use think\facade\Request;

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

	/**通过决定书编号找到案卷所有信息
	 * @param $String $caseNum
	 */
	public function findcase() {
	    $record = Record::where('Id',1)->find();
	    $data = json($record);
	    return $data;
	}
	
	/**创建一个案卷
	 * @param Array $param
	 */
	public function createCase() {
	    $info = Request::instance()->post();
	    
	    $data = array(
	        'data'=>"2",
	        'code'=>'0',
	        'count'=>"2"
	    );
	    return json($data) ;
	}
	
	/**更新案卷信息
	 * @param unknown $caseDetail
	 */
	public function updateCase($caseDetail) {
	    ;
	}
	
	/**删除一个案卷
	 * @param unknown $param
	 */
	public function deleteCase($param) {
	    ;
	}
	
	
}