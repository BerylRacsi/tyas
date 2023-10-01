<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Response, Validator};

use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.home');
    }

    public function getList()
    {
        return view('department.list');
    }

    public function getForm()
    {
        return view('department.form');
    }

    public function getData()
    {
        $records = Department::select('id', 'name')->get();

        $data_arr = array();

        foreach ($records as $record) {
            $data_arr[] = array(
                'id'    => $record->id,
                'department'   => $record->name,
            );
        }
        
        return response()->json(["data" => $data_arr]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'department'          => 'required',
        ];

        $customMessages = [
            'department.required'          => "'Department Name' cannot be empty",
        ];

        $validator  = Validator::make($input, $rules, $customMessages);
        if ($validator->fails()) {
            return Response::json([
                'error'    => 1,
                'message'  => $validator->errors(),
                'code'     => 'validation',
            ]);
        }

        $storeArray = [
            'name' => $input['department'],
        ];

        try {
            $msg = !empty($request->id) ? 'Update Data Success !' : 'Save Data Success !';
            
            DB::beginTransaction();

            Department::updateOrCreate(
                ['id' => $request->id],
                $storeArray,
            );

            DB::commit();

            return Response::json([
                'error'     => 0,
                'message'   => $msg,
                'code'      => ''
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage() . " (" . $e->getLine() . ")";
        }
    }

    public function show(Request $request)
    {
        $record = Department::where('id', $request->id)->first();

        return $record;
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $record = Department::find($request->id);

            $record->delete();

            DB::commit();
            return Response::json([
                'error'     => 0,
                'message'   => 'Delete Data Success',
                'code'      => ''
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage() . " (" . $e->getLine() . ")";
        }
    }
}
