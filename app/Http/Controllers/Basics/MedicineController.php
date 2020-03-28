<?php

namespace App\Http\Controllers\Basics;

use App\Models\Generic;
use App\Models\Manufacturer;
use App\Models\Medicine;
use App\Models\MedicineType;
use App\Models\Strength;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    public function index(Request $request)
    {

        if(check_privilege(16,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select('select * from Item_Master where store_code = 1140 and Status = \'A\';');

        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {

                $generic_code = $db_ext->table('Item_Generic')->where('item_code',$row->item_code)->value('generic_code');

                $g_id = Generic::query()->where('generic_code',$generic_code)->value('id');

                $generic_id = empty($g_id) ? 2 : $g_id;


                $strength_id = Strength::query()->where('id',$row->Strengthid)->value('id');
                $str_id = empty($strength_id) ? 320 : $strength_id;

                $type_id = MedicineType::query()->where('type_code',$row->item_group)->value('id');
                $type = empty($type_id) ? 23 : $type_id;

                $manu_id = Manufacturer::query()->where('manu_code',$row->manufacture_code)->value('id');
                $manu_data = empty($manu_id) ? 1 : $manu_id;

                Medicine::firstOrCreate(['name'=>$row->item_name],
                    ['company_id'=> 1,
                        'generic_id'=>$generic_id,
                        'strength_id'=>$str_id,
                        'medicine_type_id'=>$type,
                        'manufacturer_id'=>$manu_data,
                        'doctor_id'=> 1,
                        'is_group'=>false,
                        'item_code' => $row->item_code,
                        'description'=>$row->item_name,
                        'user_id'=>Auth::user()->id,
                        'status'=>true
                    ]);

            }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->route('home')->with('success','Complete');

    }
}
