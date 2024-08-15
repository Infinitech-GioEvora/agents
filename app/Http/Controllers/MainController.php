<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function all()
    {
        $records = Employee::all();
        $data = ['records' => $records];
        return response($data);
    }

    public function employee($employee_id)
    {
        // $record = Employee::all();
        $record = Employee::where('employeeID', $employee_id)->first();
        $data = ['record' => $record];
        return view('Homepage/index', compact('record'));
    }
    public $ent = "Employee";

    public function add(Request $request)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'position' => 'required',
            'employeeID' => 'required',
            'description' => 'required',
            'facebook' => 'required',
            'telegram' => 'required',
            'wechat' => 'required',
            'viber' => 'required',
            'whatsapp' => 'required',
            'profile' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        $record = new Employee();

        $from = [255, 0, 0];
        $to = [0, 0, 255];

        $qr =  QrCode::size(200)
            ->style('dot')
            ->eye('circle')
            ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
            ->margin(1)
            ->generate($request['employeeID']);


        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move('profiles', $filename, 'public');
        }

        $keys = [
            'lastname',
            'firstname',
            'middlename',
            'position',
            'employeeID',
            'description',
            'facebook',
            'telegram',
            'wechat',
            'viber',
            'whatsapp',
            'profile',
            'qrcode'
        ];




        foreach ($keys as $key) {
            if ($key == 'qrcode') {
                $record->$key = $qr;
            } 
            elseif($key == 'profile'){
                $record->$key = $filename;
            }
            else {
                $record->$key = $request->$key;
            }
        }
        $record->save();

        return response(['msg' => "Added $this->ent"]);
    }
}
