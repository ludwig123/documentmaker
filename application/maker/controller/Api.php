<?php
namespace app\maker\controller;

use app\maker\model\Code;
use app\maker\model\Man;
use app\maker\model\Record;
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
	
	
	public function records(){
	    $trafficCase = new TrafficCase();
	    $records = $trafficCase->all();
	    
	    $response = array(
	        'data'=>$records,
	        'code'=>'0',
	        'count'=>count($records)
	    );
	    return json($response);
	}

	/**通过决定书编号找到案卷所有信息
	 * @param $String $caseNum
	 */
	public function record($id) {
	    $case = TrafficCase::findById($id);
	    //不能直接返回json_encode是因为框架会自动给他套上json，根据请求类型转换为为html或json
	    return json($case);
	}
	
// 	public function record($Id) {
// 	    return $this->record($Id);
// 	}
	/**创建一个案卷
	 * @param Array $param
	 */
	public function addTrafficCase() {
	    $info = $this->postInfo();
	    $case = new TrafficCase();
	    $data = $case->add($info);
	    return json('添加成功！') ;
	}
	
	/**更新案卷信息
	 * @param
	 */
	public function refreshTrafficCase(){
	    $info = $this->postInfo();
 	    $case = new TrafficCase();
 	    $data = $case->refresh($info['id'], $info);
	    
	    return json('更新成功！') ;
	}
	

	
	/**删除一个案卷
	 * @param  $param
	 */
	public function removeTrafficCase() {
	    $info = $this->postInfo();
	    $case = new TrafficCase();
	    $case->remove($info['id']);
	    
	    if ($case !== false){
	        return json('删除成功');
	    }
	    
	    return json('删除失败');
	    
	}
	
	
	private function postInfo(){
	    if (Request::isPost())
	    return Request::post();
	}
	
	private function getInfo(){
	    return Request::instance()->get();
	}
	
}