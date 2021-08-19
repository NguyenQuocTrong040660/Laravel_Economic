<?php

namespace App\Http\Controllers;
use App\Component\MenuRecusive;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Pagination;

class menuController extends Controller
{
    private $menu;

    //gan bien $menu co All data table menu
    public function __construct(menu $menu)
    {
        $this->menu = $menu;
    }

    public function index(){

        $reult = menu::paginate(5);
        return view('admin.menu.index',compact('reult'));
    }

    //click vao add truyen vao form option
    public  function  add(){
        $newclass = new MenuRecusive();
        $htmlOption = $newclass->Recusive_menu();
        return view('admin.menu.add',compact('htmlOption'));
    }

    //submit-> add menu
    public function store(Request $request){

        $this->menu = menu::create([
           'name'=>$request->name,
           'parent_id'=>$request->parent_id,
           'slug' => str_slug($request->name)
        ]);
        return redirect()->route('admin.menu.index');

    }

    public function get_recusive($parent_id){
        $data = menu::all();
        $menurecusive = new MenuRecusive($data);
        $htmlOption = $menurecusive->edit_menurecusive($parent_id);
        return $htmlOption;
    }

    // ham nay truyen parent_id lay duoc  cho ham get_recusive ben tren
    public  function edit($id){
        $result_edit = $this->menu->find($id);
        $htmlOption = $this->get_recusive( $result_edit->parent_id);
        return view('admin.menu.edit',compact('htmlOption','result_edit'));
    }

    //khi edit-> submit :: update

    public function update($id,Request $request){
      $this->menu->find($id)->update([
          'name'=>$request->name,
          'parent_id'=>$request->parent_id,
          'slug'=> str_slug($request->name)
      ]);
  return redirect()->route('admin.menu.index');
    }

    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menu.index');
    }
}
