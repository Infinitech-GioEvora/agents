<?php

namespace App\Http\Controllers;

use App\Models\Employee as employee;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCard;
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
        $record = Employee::where('employeeID', $employee_id)->first();

        if ($record == null) {
            return view('error/PageNotFound');
        } else {
            return view('Homepage/index', compact('record'));
        }
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
            'phone' => 'required',
            'email' => 'required',
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
            ->generate(
                "http://127.0.0.1:8000/abic/" . $request['employeeID']
            );

        $keys = ['lastname', 'firstname', 'middlename', 'position', 'employeeID', 'phone', 'email', 'facebook', 'telegram', 'wechat', 'viber', 'whatsapp', 'profile', 'qrcode'];


        foreach ($keys as $key) {
            if ($key == 'qrcode') {
                $filename = $request['employeeID'] . '.png';
                Storage::disk('public')->put('qrcodes/' . $filename, $qrcode);
                $record->$key = $filename;
            } elseif ($key == 'wechat') {
                if ($request->hasFile('wechat')) {
                    $file = $request->file('wechat');
                    $filename = $file->getClientOriginalName();
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
            } elseif ($key == 'profile') {
                if ($request->hasFile('profile')) {
                    $paths = [];
                    array_push($paths, public_path("profiles/" . $record->profile));
            
                    foreach ($paths as $path) {
                        file_exists($path) ? unlink($path) : false;
                    }
                  
                    $file = $request->file('profile');
                    $filename = $file->getClientOriginalName();
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
        $record = Employee::find($id);

        $paths = [];
        array_push($paths, public_path("wechat/" . $record->wechat));
        array_push($paths, public_path("uploads/qrcodes/" . $record->qrcode));
        array_push($paths, public_path("profiles/" . $record->profile));

        foreach ($paths as $path) {
            file_exists($path) ? unlink($path) : false;
        }

        $record->delete();

        return response(['msg' => "Deleted $this->ent"]);
    }

    public function downloadVCard(Request $request)
    {
        $id = $request->input('id'); 
        $user = Employee::where('employeeID', $id)->first();
        
        if (!$user) {
            return response()->json(['error' => 'User not found.']);
        }
    
        $vCard = new VCard();
        $vCard->addName($user->firstname, $user->lastname);
        $vCard->addEmail($user->email);
        $vCard->addPhoneNumber($user->phone);
        $vCard->addJobtitle("Abic Realty - ". $user->position);
        $vCard->addAddress($name = '', $extended = 'Unit 311, Campos Rueda Bldg.', $street = 'Urban Ave.', $city ='Makati City', $region='NCR', $zip='5200', $country='Philippines', $type='WORK');
        $vCard->addURL("https://abicrealtycorporation.com/");
        $vCard->addCompany('Abic Realty & Consultancy Corporation', $department = 'Sales');
    
        $vCardDirectory = public_path('vcard');
        
    
        if (!file_exists($vCardDirectory)) {
            mkdir($vCardDirectory, 0755, true);
        }
    
    
        $filename = $user->lastname . '-' . $user->firstname . '.vcf';
        $filePath = $vCardDirectory . DIRECTORY_SEPARATOR . $filename; 
    
    
        $vCard->setSavePath($vCardDirectory);
        $vCard->save($filename);
    
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'vCard not generated: ' . $filePath]);
        }
    
      
        return response()->download($filePath);
    }
}
