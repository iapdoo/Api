<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTraits;

class CategoryController extends Controller
{
    use GeneralTraits;

    public function allCategory(){
        $categories=category::select('id',
            'name_'.app()->getLocale(). ' as name',
            'title_'. app()->getLocale(). ' as title',
            'description_' . app()->getLocale() .' as description')->get();
       // return response()->json($categories);
        return $this->returnData('categories',$categories,'تم جلب البيانات بنجاح');
    }
    public function CategoryById(Request $request){
        $category=category::select('id',
            'name_'.app()->getLocale(). ' as name',
            'title_'. app()->getLocale(). ' as title',
            'description_' . app()->getLocale() .' as description')->find($request->id);
        if (!$category)
          return  $this->returnError('405','هذا المنتج غير موجود ');
        return $this->returnData('category',$category,'تم جلب البيانات بنجاح');
    }
    public function changeCategoryStatus(Request $request){

        category::where('id',$request->id)->update(['active'=>$request->active]);
        return $this->returnSuccessMessage('تم تغيير الحاله بنجاح ');
    }
}
