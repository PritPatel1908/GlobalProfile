<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Employee extends Controller
{
    public function index()
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }
        //$employees = EmployeeModel::paginate(10);
        $employees = EmployeeModel::active()->get();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }
        $last_employee = EmployeeModel::orderBy('id', 'desc')->first();
        if ($last_employee) {
            $last_emp_id = $last_employee->emp_id;
            $last_number = (int) substr($last_emp_id, 3);
            $new_number = $last_number + 1;
            $employee_id = "ZES" . $new_number;
        } else {
            $employee_id = "ZES00000001";
        }
        return view('employee.create', compact('employee_id'));
    }

    public function store(Request $request)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }

        $request->validate([
            // 'emp_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'emp_name' => 'required|string',
            'contact_number' => 'required|numeric',
            'email' => 'required|email|unique:employee,email',
            'employee_name' => 'required|string',
            'employee_code' => 'required|string|unique:employee,employee_code',
            'family_contact_number' => 'required|numeric',
            'gender' => 'required',
            'dob' => 'required|date',
            'nationality' => 'required|string',
            'address' => 'required|string',
            'card_date_of_issue' => 'required|date',
            'card_valid_till' => 'required|date',
        ]);

        try {
            // $data = $request->all();
            // $data['emp_image'] = $this->uploadImage($request, 'emp_image');
            // unset($data['_token']);
            // $employee = EmployeeModel::create($data);

            $img = $request->emp_image;
            $folderPath = "public/uploads/images/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $rand_code = Str::random(6);
            $fileName =  $request->employee_code . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);

            $employee = EmployeeModel::create([
                'emp_id'  =>  $request->emp_id,
                'emp_name'  =>  $request->emp_name,
                'email' =>  $request->email,
                'employee_name' => $request->employee_name,
                'employee_code' => $request->employee_code,
                'contact_number' => $request->contact_number,
                'family_contact_number' => $request->family_contact_number,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'card_date_of_issue' => $request->card_date_of_issue,
                'card_valid_till' => $request->card_valid_till,
                'emp_image' => $fileName,
                'is_deleted' => 0
            ]);

            // $id = $employee->id;
            // $employee_id = "ZES" . date("ym") . str_pad($id, 5, '0', STR_PAD_LEFT);
            // $employee->emp_id = $request->emp_id;

            // $EMP_QR_UPLOAD_PATH = config('constants.EMP_QR_UPLOAD_PATH');
            // $qrCodePath = $EMP_QR_UPLOAD_PATH . 'employee_' . $employee_id . '.png';

            // $scan_url = URL::to('/employee/view/' . $employee_id);

            // QrCode::format('png')->size(300)->generate($scan_url, public_path($qrCodePath));

            // $EmpQRCodeImageName = 'employee_' . $employee_id . '.png';
            // $employee->qr_code_path = $EmpQRCodeImageName;

            // $employee->save();
            return redirect()->route('employee.index')->with('success', 'Profile created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('employee.create')->with('error', $e->getMessage());
            // return redirect()->route('employee.create')->with('error', 'Error in updating profile. Please try again.');
        }
    }

    // private function uploadImage(Request $request, $fieldName)
    // {
    //     $uploadedFile = $request->file($fieldName);
    //     $fileName = Str::random(20) . '.' . $uploadedFile->getClientOriginalExtension();
    //     $IMG_UPLOAD_PATH = config('constants.IMG_UPLOAD_PATH');
    //     //$uploadedFile->storeAs($IMG_UPLOAD_PATH, $fileName);
    //     $uploadedFile->move($IMG_UPLOAD_PATH, $fileName);
    //     return $fileName;
    // }

    public function show(EmployeeModel $employee)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }
        return view('employee.show', compact('employee'));
    }

    public function GetByEmpId($emp_id)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }
        $employee = EmployeeModel::where('emp_id', $emp_id)->first();
        return view('employee.show', compact('employee'));
    }

    public function edit(EmployeeModel $employee)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, EmployeeModel $employee)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }

        if ($request->file('emp_image') != "") {
            $request->validate([
                'emp_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                'emp_name' => 'required|string',
                'contact_number' => 'required|numeric',
                'email' => 'required|email',
                'employee_name' => 'required|string',
                'employee_code' => 'required|string|unique:employee,employee_code',
                'family_contact_number' => 'required|numeric',
                'gender' => 'required',
                'dob' => 'required|date',
                'nationality' => 'required|string',
                'address' => 'required|string',
                'card_date_of_issue' => 'required|date',
                'card_valid_till' => 'required|date',
            ]);

            $data = $request->all();
            $data['emp_image'] = $this->uploadImage($request, 'emp_image');
            unset($data['_token']);
        } else {
            $request->validate([
                'emp_name' => 'required|string',
                'contact_number' => 'required|numeric',
                'email' => 'required|email',
                'employee_name' => 'required|string',
                'employee_code' => 'required|string|unique:employee,employee_code',
                'family_contact_number' => 'required|numeric',
                'gender' => 'required',
                'dob' => 'required|date',
                'nationality' => 'required|string',
                'address' => 'required|string',
                'card_date_of_issue' => 'required|date',
                'card_valid_till' => 'required|date',
            ]);
            $data = $request->all();
            unset($data['_token']);
        }

        try {
            $employee->update($data);
            return redirect()->route('employee.index')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('employee.edit')->with('error', 'Error in updating profile. Please try again.');
        }
    }

    public function destroy(EmployeeModel $employee)
    {
        $email_session = Session::get('user_email');
        if ($email_session == "" || empty($email_session)) {
            return redirect('login');
        }

        try {
            $data['is_deleted'] = 1;
            $employee->update($data);
            //$employee->delete();
            return redirect()->route('employee.index')->with('success', 'Profile deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('employee.index')->with('error', 'Error deleting profile. Please try again.');
        }
    }
}
