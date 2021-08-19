<?php

namespace App\Component;

use App\Models\menu;

class MenuRecusive
{
private $htmlSelect;
private  $data;

//Tao ham xay dung va gan data vao bien $menu
public function __construct()
{
    $this->htmlSelect='';

}

public function Recusive_menu($parent_id=0,$text=''){
    //get all data co parent_id == id ==0
    $data= menu::where('parent_id',$parent_id)->get();

    foreach ( $data as $value ){
        $this->htmlSelect .= "<option  value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
        $this->Recusive_menu($value['id'], $text.'--');//de quy vuale id con tim ra chau
    }
    return $this->htmlSelect;

}

public  function edit_menurecusive($parent_id,$id=0,$text=''){

     $data = menu::where('parent_id',$id)->get();
       foreach ( $data as $value){
           if($parent_id == $value['id']) {
               $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";

           }else{
               $this->htmlSelect .= "<option  value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
           }
           $this->edit_menurecusive($parent_id,$value['id'],$text.'--');
           }

       return $this->htmlSelect;

}


}
