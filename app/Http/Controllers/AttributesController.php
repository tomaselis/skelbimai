<?php
namespace App\Http\Controllers;
use App\Attributes;
use App\AttributeSetRelation;
use App\AttributeSet;
use App\AttributeTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AttributesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user && ($user->hasRole('admin'))){
            $data['types'] = AttributeTypes::all();
            $data['sets'] = AttributeSet::all();
            return view('admin.attributes', $data);
        }else{
            return view('auth.login');
        }
    }
    public function storeSet(Request $request)
    {
        $set = new AttributeSet();
        $set->name = $request->name;
        $set->save();
        return redirect()->back();
    }
    public function storeAttribute(Request $request)
    {
        $attribute = new Attributes();
        $set = new AttributeSetRelation();

        $unwanted_array = array('Š'=>'s', 'š'=>'s', 'Ž'=>'z', 'ž'=>'z', 'À'=>'a', 'Á'=>'a', 'Â'=>'a', 'Ã'=>'a', 'Ä'=>'a', 'Å'=>'a', 'Æ'=>'a', 'Ç'=>'c', 'È'=>'e', 'É'=>'e',
            'Ê'=>'e', 'Ë'=>'e', 'Ì'=>'i', 'Í'=>'i', 'Î'=>'i', 'Ï'=>'i', 'Ñ'=>'n', 'Ò'=>'o', 'Ó'=>'o', 'Ô'=>'O', 'Õ'=>'o', 'Ö'=>'o', 'Ø'=>'o', 'Ù'=>'u',
            'Ú'=>'u', 'Û'=>'u', 'Ü'=>'u', 'Ý'=>'y', 'Þ'=>'b', 'ß'=>'ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ą'=>'a', 'č'=>'c', 'ę'=>'e', 'ė'=>'e', 'į'=>'i', 'ų'=>'u', 'ū'=>'u',
            'Ą'=>'a', 'Č'=>'c', 'Ę'=>'e', 'Ė'=>'e', 'Į'=>'i', 'Ų'=>'u', 'Ū'=>'u', ' ' => '_');
        $str = $request->name;
        $str = strtr( $str, $unwanted_array );

        $attribute->name = $str;
        $attribute->label = ucfirst($request->name);
        $attribute->type_id = $request->type_id;
        $attribute->save();
        $attribute = Attributes::where('name', $str)->first();
        $set->attribute_set_id = $request->set_id;
        $set->attribute_id = $attribute->id;
        $set->save();
        return redirect()->back();
    }
}

