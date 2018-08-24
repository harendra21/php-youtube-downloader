<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	
	public function index(){
		$head = array();
		$data = array();
		
		if(isset($_POST['submit'])){
			$video_link = $_POST['video_link'];
			$l = explode('?v=', $video_link);
			
			$res = $this->download_api($video_link);
			for ($i=50; $i >=0 ; $i--) { 
				if(!empty($res[$i])){
					$resp[] = array('url' => $res[$i]['url'],'format' => $res[$i]['format']);
				} 
			}
			$data['iframe_link'] = $l['1'];
			$data['link'] = $video_link;
			$data['videos'] = $resp;
		}
		
		$this->front_render('home',$data,$head);
	}
	
}
