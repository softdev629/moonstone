<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CherishedPlates_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_datatables($sql_details)
    {
        $this->load->library('datatables_ssp');
        $table = 'cherished_plates';
        $primaryKey = 'id';
        $myjoin="left join company on company.id = cherished_plates.company_id";
        $columns = array(
            array('customfilter' => 'cherished_plates.id',
                'db'        => 'cherished_plates.id',
                'dt'        => 0
            ),
            array('customfilter' => 'category_name','db'=> 'category_name','dt'=> 1),
            array('customfilter' => 'is_active',
                'db'        => 'CONCAT(is_active,"#",category_id)',
                'dt'        => 2,
                'formatter' => function( $is_active, $row ) {
                    return get_is_active($is_active);
                }
            ),
            array('customfilter' => 'category_id','db' => 'category_id', 'dt'  => 3,
                'formatter' => function( $category_id, $row ) {
                    return get_edit($category_id);
                }),
            array('customfilter' => 'category_id','db' => 'category_id', 'dt'  => 4,
                'formatter' => function( $category_id, $row ) {
                    return get_delete($category_id);
                })
        );

        
                function get_is_active($is_active)
                {
                    $Yes_no=explode("#",$is_active);
                
                    if($Yes_no[0]==1)
                    {
                        return "<div class='TextCenter poiter' id='display_isactive".$Yes_no[1]."'><span class='fa fa-fw fa-check' onclick='update_is_active(0,".$Yes_no[1].",&#39;category&#39;,&#39;is_active&#39;);'></span></div>";
                    }
                    else
                    {
                        return "<div class='TextCenter poiter' id='display_isactive".$Yes_no[1]."'><span class='fa fa-fw fa-close' onclick='update_is_active(1,".$Yes_no[1].",&#39;category&#39;,&#39;is_active&#39;);'></span></div>";
                    }
                    
                }
                function get_edit($category_id)
                {
                    return "<div class='TextCenter'><a class='fa fa-fw fa-edit' href='".base_url()."admin/category/edit_category/".$category_id."'></a></div>";
                }
                
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'','')
            );
    }

}
