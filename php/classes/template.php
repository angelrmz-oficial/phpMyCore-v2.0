<?php
if(!defined("system_webscr") && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die('<h3>¡Acceso denegado!</h3>');

class template
{
	private $content;
	private $params = array();
	private $count = 0;
  public $page, $post, $data;
	//
	// const TPL_LAYOUT = PATH_APP . "layout" . DS;
	// const TPL_BASE = self::TPL_LAYOUT . site_theme . DS;
	const TPL_STATICS = APP_TPL . 'statics' . DS;
	const TPL_VIEWS = APP_TPL . 'views' . DS;
	const TPL_PAGES = APP_TPL . 'pages' . DS;
	const TPL_MODALS = APP_TPL . 'modals' . DS;
	// const TPL_ASSETS = self::TPL_BASE . 'assets' . DS;
	// const TPL_SCRIPTS = self::TPL_ASSETS . 'scripts' . DS;

	public function __construct()
	{
		$this->GlobalParams();
	}

	function GlobalParams(){
		global $posted, $post;
		$this->posted=$posted;
		$this->post=$post;

		if(isset($_SESSION['userid'])):
			$this->user=new userData;
			$this->my=$this->user->data;
		endif;

		$this->SetParam('base', site_url);
		$this->SetParam('resources', site_resources);
		$this->SetParam('habboImaging', site_imaging);

		$this->SetParam('assets', site_url . "/templates/".site_theme."/assets");
		// $this->SetParam('scripts', site_url . "/themes/". site_theme ."/assets/scripts/");
		// $this->SetParam('modals', site_url . "/app/layout/".site_theme."/modals/");

		$this->SetParam('app_request', site_api . '/');
		$this->SetParam('app_handler', site_url . "/app/request/handler/");

		$this->SetParam('title', site_name);
		
		if(isset($this->page))
			$this->SetParam('subtitle', $this->page['subtitle']);

		// $this->SetParam('websocket_server', (new webcfg)->cfg('server_ip'));
		// $this->SetParam('websocket_port', (new webcfg)->cfg('websocket_port'));

		//header('Content-Type: text/html; charset='. system_charset);
	}

	// function LoadParams($content){
	// 	$web=new webcfg;
	// 	switch ($content) {
	// 		case 'client':
	// 			$this->SetParam('server_ip', $web->cfg('server_ip'));
	// 			$this->SetParam('server_port', $web->cfg('server_port'));
	// 			$this->SetParam('sso', $this->user->UpdateGetSSO());
	// 			$this->SetParam('client_starting', $web->cfg('client_starting'));
	// 			$this->SetParam('client_starting_revolving', $web->cfg('client_starting_revolving'));
	// 			$this->SetParam('external_texts_txt', $web->cfg('external_texts_txt'));
	// 			$this->SetParam('external_variables_txt', $web->cfg('external_variables_txt'));
	// 			$this->SetParam('external_override_variables_txt', $web->cfg('external_override_variables_txt'));
	// 			$this->SetParam('external_figurepartlist_txt', $web->cfg('external_figurepartlist_txt'));
	// 			$this->SetParam('flash_dynamic_avatar_download_configuration', $web->cfg('flash_dynamic_avatar_download_configuration'));
	// 			$this->SetParam('productdata_load_url', $web->cfg('productdata_load_url'));
	// 			$this->SetParam('furnidata_load_url', $web->cfg('furnidata_load_url'));
	// 			$this->SetParam('flash_client_url', $web->cfg('flash_client_url'));
	// 			$this->SetParam('username', $this->my['username']);
	// 			$this->SetParam('nux_library', $web->cfg('nux_library'));
	// 			$this->SetParam('swflash_url', $web->cfg('swflash_url'));
	// 		break;
	//
	// 		default:
	//
	// 		break;
	// 	}
	// }

	function statics($content, $tpl = self::TPL_STATICS)
	{
		$file=$tpl . $content . '.php';
		file_exists($file) ? $this->insertFile($file) : error_logs('<b>Template Error</b> - File not found: '.$content);
	}

	function pages($content, $tpl = self::TPL_PAGES){
		//$file=$tpl . $content . '.php';
		//$files=preg_grep('~\.(php|html|htm)$~', scandir(APP_TPL . 'pages'));
		//$file=glob("{$tpl}{$content}.*");
		$file=glob("{$tpl}{$content}.{php,html,htm}", GLOB_BRACE);
		count($file) > 0 ? $this->insertFile(reset($file)) : error_logs('<b>Template Error</b> - File not found: '.$content);
	}

	function scripts($content, $tpl = self::TPL_SCRIPTS){
		self::LoadParams($content);
		$file=$tpl . $content . '.js';
		file_exists($file) ? $this->insertFile($file) : die("console.log('TPL Error: Script not found');");
	}

	function modals($content, $tpl = self::TPL_MODALS){
		$file=$tpl . $content . '.php';
		file_exists($file) ? $this->insertFile($file) : error_logs('<b>Template Error</b> - File not found: '.$content);
	}

	function views($content, $tpl = self::TPL_VIEWS){
		$file=$tpl . $content . '.php';
		file_exists($file) ? $this->insertFile($file) : error_logs('<b>Template Error</b> - File not found: '.$content);
	}

	function insertFile($file){
		$this->insert = $file;
		$this->IncludeFiles($this->insert);
	}

	function IncludeFiles($file)
	{
		ob_start();
		include($file);
		$this->content = ob_get_contents();
		return $this->FilterParams($this->content);
		ob_end_clean();
	}

	function FilterParams($str)
	{
		foreach($this->params as $param)
		{
			$str = str_ireplace("{".$param['name']."}", $param['value'], $str );
		}
		ob_end_clean();
		print $str;
	}

	public function SetParam($name, $value)
	{
		$this->params[$this->count++] = array("name" => $name, "value" => $value);
	}
}
?>
