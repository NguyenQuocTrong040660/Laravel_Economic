<?php

namespace App\Component;

 class Recusive1
{
 private $data;
 private $htmlSelect='';

 public function __construct($data)
 {
     $this->data = $data;// thuoc tinh $data da co all::model
 }

    public function CategoryRecusive($parent_id, $id = 0, $text = ''): string{

        foreach ($this->data as $value) {

            if($value['parent_id'] == $id){
                if (!empty($parent_id) && $value['id'] == $parent_id) {

                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";//tim ra con

                } else
                 //danh cho ham Add khi parent_id is empty
                {
                    $this->htmlSelect .= "<option value=' " . $value['id'] . "'>" . $text . $value['name'] . "</option>";//tim ra con

                }
                $this->CategoryRecusive($parent_id,$value['id'], $text.'--');//de quy vuale id con tim ra chau
            }
        }

        return $this->htmlSelect;

    }
}


