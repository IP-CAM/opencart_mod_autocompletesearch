<?php class ModelModuleAutocompletesearch extends Model {
    
    private $module = "autocompletesearch";
    
    public function getAutocompleteSearchProducts($term)
    {
        $sql = "SELECT p.`product_id`, pd.`name`
            FROM `".DB_PREFIX."product` p
                LEFT JOIN `".DB_PREFIX."product_description` pd ON p.`product_id` = pd.`product_id`
                LEFT JOIN `".DB_PREFIX."product_to_store` p2s ON p.`product_id` = p2s.`product_id`
            WHERE p.`status` = '1'
            AND p.`date_available` <= '".date('Y-m-d')."'
            AND p2s.`store_id` = '".(int)$this->config->get('config_store_id')."'
            AND pd.`language_id` = ".(int)$this->config->get('config_language_id')."
            AND LOWER(pd.`name`) LIKE '%".strtolower($this->db->escape($term))."%'
            GROUP BY p.`product_id`, pd.`name`
            ORDER BY p.`viewed` DESC, pd.`name` ASC";
        
        $query = $this->db->query($sql);
        
        return $query->rows;
    }
    
}