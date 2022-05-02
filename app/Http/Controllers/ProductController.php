<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\product_image;
use App\Models\product_tag;
use App\Models\Silder;
use App\Models\tag;
use App\Traits\StrorageProductImage;
use Illuminate\Http\Request;
use App\Models\Categogy;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;
use App\Component\Recusive1;
use DB;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    private $product;
    private $product_img;
    private $category;
    private $tag;
    private $product_tag;
    public function __construct(Categogy $categogy, product $product, product_image $product_img, tag $tag, product_tag $product_tag)
    {
        $this->category =$categogy;
        $this->product=$product;
        $this->product_img = $product_img;
        $this->tag= $tag;
        $this->product_tag=$product_tag;
    }

    //include Traits
    use StrorageProductImage;
    public  function index(){

        $data = $this->product->paginate(10);
        return view('admin.product.index',compact('data'));
    }


    //Ham de quy chung
    public function  get_category($parent_id){
        $data=Categogy::all(); //lay all data category

        $recusive1 = new Recusive1($data); //Tao doi tuong moi   $recusive1

        $htmlOption = $recusive1->CategoryRecusive($parent_id); //truy cap vao phuong thuc

        return $htmlOption;

    }
    //onclick on nut ADD
    public function add(){
        $htmlOption = $this->get_category($parent_id=''); // goi ham get_category()
        return view('admin.product.add',compact('htmlOption'));

    }

    public function store(Request $request)
    {
        try {
       //    DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'price' => $request->gia,
                'content' => $request->contents,
                'category_id' => $request->category_id,
                'user_id' => auth()->id()
            ];
            $datauploadfile = $this->storeuploadtrait($request, 'feature_image_path', 'products');

            //neu co $dataUploadfile thi cap nhat 2 filed feature_image_path - img_name
            if (!empty($datauploadfile)) {
                $data['feature_image_path'] = $datauploadfile['file_path'];
                $data['img_name'] = $datauploadfile['file_name'];
            }
            //insert Table -> product
            $result = $this->product::create($data);


            //InSert table product_images = anh chi tiet
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $img_chitiet) {
                    //goi classs trait su dung funtion UploadtMultifile
                    $UploadMultifile = $this->UploadtMultifile($img_chitiet, 'product_img');
                    $result1 = $result->images()->create([
                        'image_path' => $UploadMultifile['file_path'],
                        'img_name' => $UploadMultifile['file_name']

                    ]);
                }
            }

            //Insert table tags
            foreach ($request->tags as $tags) {
                $inser_tag = $this->tag::firstOrCreate(['name' => $tags]);  //tao create new  item isnot have, result instance item had

                $tag_id[] = $inser_tag->id; //tuyen tag id vao
            }
            //Inser vao intermedia table : Product_tag
            $result->product_tags()->attach($tag_id);

          //  DB::commit();

        }
        catch (\Exception $exception){
         //   DB::rollBack();
            Log::error("message:".$exception->getMessage()."--Line" .$exception->getLine());

        }

        return redirect()->route('product.index');
        }




        public function edit($id){
        //lay row id-edit
        $data = $this->product->find($id);
        //lay parent-id caterogy
        $htmlOption = $this->get_category($data->category_id); // parent_id la cha, option can selected
        return view('admin.product.edit',compact('data','htmlOption'));

        }

        public function update(Request $request, $id)
        {

          try {

              $dataUpdate = [
                  'name' => $request->name,
                  'price' => $request->gia,
                  'content' => $request->contents,
                  'category_id' => $request->category_id,
                  'user_id' => auth()->id()
              ];
              $datauploadfile = $this->storeuploadtrait($request, 'feature_image_path', 'products');

              //neu co $dataUploadfile thi cap nhat 2 filed feature_image_path - img_name
              if (!empty($datauploadfile)) {
                  $dataUpdate['feature_image_path'] = $datauploadfile['file_path'];
                  $dataUpdate['img_name'] = $datauploadfile['file_name'];
              }
              //Update Table -> product
              $this->product->find($id)->update($dataUpdate); //tra ve true false
              $result_after_update = $this->product->find($id);




              //InSert table product_images = anh chi tiet
              if ($request->hasFile('image_path')) {
                  //tim product_id == $id cua sp => delete
                  $this->product_img->where('product_id', $id)->delete();

                  foreach ($request->image_path as $img_chitiet) {
                      //goi classs trait su dung funtion UploadtMultifile
                      $UploadMultifile = $this->UploadtMultifile($img_chitiet, 'product_img');
                      $result1 = $result_after_update->images()->create([
                          'image_path' => $UploadMultifile['file_path'],
                          'img_name' => $UploadMultifile['file_name']

                      ]);
                  }
              }

              //Insert table tags
              foreach ($request->tags as $tags) {
                  $inser_tag = $this->tag::firstOrCreate(['name' => $tags]);  //tao create new  item isnot have, result instance item had

                  $tag_id[] = $inser_tag->id; //tuyen tag id vao
              }
              //Inser vao intermedia table : Product_tag
              $result_after_update->product_tags()->sync($tag_id);   // neu update item da ton tai thi ko them vao


          }catch (\Exception $exception){

              Log::error("message:".$exception->getMessage()."--Line" .$exception->getLine());

          }
            return redirect()->route('product.index');
             }

             // Delete cứng

        public function delete($id){
        //xoa img sp chi tiet
          $this->product_img->where('product_id',$id)->delete();
          //xoa product $id
          $data = $this->product->find($id);
          $data->delete();

          return redirect()->route('product.index');


        }
        //End Admin face

         //Detail_product
          public function detail_product($product_id){
             // lay categogy cho
              $all_categogies = Categogy::where('parent_id',0)->get();
              $all_slider = Silder::latest()->get();
              //lay san pham theo id
              $detail_id = $this->product->find($product_id);

              //Rating

              //Rating

              // lay id san pham lien quan  theo category
              $product_recomman = product::where('category_id',$detail_id->category_id)->whereNotIn('id',[$product_id])->paginate(3);

        return view('product_frontend.detail.detail_product',compact('all_categogies','all_slider','detail_id','product_recomman'));

          }

          //tim kiem san pham
        public function searchProduct(Request $request){
            // lay categogy cho
            $all_categogies = Categogy::where('parent_id',0)->get();

            //lay value search
            $getData = $request->nameproduct;
            //truyvan table
            $product = product::where('name','like','%'.$getData.'%')->get();

            // lay id san pham lien quan  theo category

            return view('product_frontend.detail.search_product',compact('all_categogies','product'));


        }

    }


