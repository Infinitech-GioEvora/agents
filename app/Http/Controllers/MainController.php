<?php

namespace App\Http\Controllers;

use App\Models\Employee as employee;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\Configuration\Merger;

class MainController extends Controller
{

    public function dashboard_data()
    {
        $data["all"] = Employee::all()->count();
    }

    public function all()
    {
        $records = Employee::all();
        $data = ['records' => $records];
        return response($data);
    }

    public function edit($id)
    {
        $record = Employee::find($id);

        $data = [
            'record' => $record,
        ];

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
            'facebook' => 'required',
            'telegram' => 'required',
            'wechat' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'viber' => 'required',
            'whatsapp' => 'required',
            'profile' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        $record = new Employee();
        $qrcode = QrCode::format('png')
            ->size(512)
            ->merge('/public/assets/img/qr-bg.png')
            ->errorCorrection('L')
            ->margin(1)
            ->generate("http://127.0.0.1:8000/abic/" .$request['employeeID']
        );

        $keys = ['lastname','firstname', 'middlename', 'position','employeeID','facebook','telegram','wechat','viber', 'whatsapp','profile','qrcode'];


        foreach ($keys as $key) {
            if ($key == 'qrcode') { 
                $filename = $request['employeeID'] . '.png';
                Storage::disk('public')->put('qrcodes/' . $filename, $qrcode);
                $record->$key = $filename;

            } elseif ($key == 'wechat') {
                if ($request->hasFile('wechat')) {
                    $file = $request->file('wechat');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->move('wechat', $filename, 'public');
                    $record->$key = $filename;
                }
            } elseif ($key == 'profile') {
                if ($request->hasFile('profile')) {
                    $file = $request->file('profile');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->move('profiles', $filename, 'public');
                    $record->$key = $filename;
                }
            } else {
                $record->$key = $request->$key;
            }
        }
        $record->save();

        return response(['msg' => "Added $this->ent"]);
    }

    public function upd(Request $request)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'position' => 'required',
            'employeeID' => 'required',
            'facebook' => 'required',
            'telegram' => 'required',     
            'viber' => 'required',
            'whatsapp' => 'required',
        ]);

        $record = Employee::find($request->id);

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
        ];

        foreach ($keys as $key) {
            if ($key == 'wechat') {
                if ($request->hasFile('wechat')) {
                    $file = $request->file('wechat');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->move('wechat', $filename, 'public');
                    $upd[$key] = $filename;
                }
            } 
            elseif ($key == 'profile') {
                if ($request->hasFile('profile')) {
                    $file = $request->file('profile');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->move('profiles', $filename, 'public');

                    $upd[$key] = $filename;
                }
            } else {
                $upd[$key] = $request->$key;
            }
        }
        $record->update($upd);

        return response(['msg' => "Updated $this->ent"]);
    }

    public function del($id)
    {
        $record = Employee::find($id)->delete();
        return response(['msg' => "Deleted $this->ent"]);
    }
}
