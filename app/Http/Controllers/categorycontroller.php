<?php

namespace App\Http\Controllers;
use App\Component\Recusive1;
use App\Models\Categogy;
use Illuminate\Http\Request;
use function PHPUnit\Framework\stringContains;


class categorycontroller extends Controller
{
    private $category;
    //Tao ham xay dung

    //gan bien $category have all data table
    public function __construct(Categogy $categogy)
    {
        $this->category = $categogy;
    }


    //chuc nang khi click vao Add category
    public function create(){

        $htmlOption = $this->get_category($parent_id=''); // goi ham get_category()
        return view('admin.category.add',compact('htmlOption')); //truyen data qua view thong qua compact.
    }

    // dieu huong tra ve index
    public function index(){
        $result = Categogy::paginate(5);

        return view('admin.category.index',compact('result'));
    }


//ham Store DMSP
    public function store(Request  $httpRequest){

         Categogy::create([
             'name'=>$httpRequest->name,
            'parent_id'=>$httpRequest->parent_id,
            'slug'=> str_slug($httpRequest->name)
            ]);

       return redirect()->route('admin.category.index'); //chuyen huong den trang category.index

    }

    // ham chung:

    public function  get_category($parent_id){
        $data=Categogy::all(); //lay all data category

        $recusive1 = new Recusive1($data); //Tao doi tuong moi   $recusive1

        $htmlOption = $recusive1->CategoryRecusive($parent_id); //truy cap vao phuong thuc

        return $htmlOption;

    }



    //ham edit
    public function edit($id){

        $result_edit = $this->category->find($id);  //get row chua id can edit
        $htmlOption = $this->get_category( $result_edit->parent_id); // parent_id la cha, option can selected

        return view('admin.category.edit',compact('result_edit','htmlOption'));
    }





    //ham update
    public function update($id,Request $request){

        $this->category->find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=> str_slug($request->name)
        ]);
        return redirect()->route('admin.category.index');

    }

    //@delete

    public function delete($id){
        $this->category->find($id)->delete();
         return  redirect()->route('admin.category.index');
    }



}


