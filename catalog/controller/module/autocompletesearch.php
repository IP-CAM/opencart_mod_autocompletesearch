<?php class ControllerModuleAutocompletesearch extends Controller
{
    private $module = "autocompletesearch";
    
    protected function index($setting)
    {
        $this->language->load('module/'.$this->module);
        
        $this->data["heading_title"] = $this->language->get('heading_title');				
		
		$this->data["button_search"] = $this->language->get('button_search');
		
		$this->data["filter_name"] = isset($this->request->get["filter_name"]) ? $this->request->get["filter_name"] : null;
        
        $this->data["module_config_minimum"] = $setting["minimum"];
        
        if(file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/module/'.$this->module.'.tpl')) {
			$this->template = $this->config->get('config_template')."/template/module/".$this->module.".tpl";
		} else {
			$this->template = "default/template/module/".$this->module.".tpl";
		}

		$this->render();
    }
    
    public function search()
    {
        if(isset($this->request->get["term"])) {
            $this->load->model('module/'.$this->module);
            
            eval('$products = $this->model_module_'.$this->module.'->get'.$this->module.'Products($this->request->get["term"]);');
            
            $data = array();
            
            foreach($products as $product) {
                $data[] = $product["name"];
            }
            
            echo json_encode($data);
        }
    }
    
}