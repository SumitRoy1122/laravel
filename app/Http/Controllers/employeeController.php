<?php

namespace App\Http\Controllers;
use App\employee;
use Illuminate\Http\Request;
use Redirect;
use DB;
class employeeController extends Controller
{
     function index()
    {
        $employees = DB::table('employees')
        ->join('companies', 'employees.company_id', '=', 'companies.id')
        ->orderBy('employees.created_at', 'asc')
        ->select('employees.fname','employees.lname','employees.email','employees.phoneno','companies.name','companies.id','employees.id')
        ->paginate(10);

        //print_r($employees);
        $data = array(
            'title'         =>  __('Employee List'),
            'allEmployees'  =>  $employees
        );
        return view('employees.employeelist')->with($data);
    }


    function create(request $request)
    {
         $this->validate(
            $request,
            ['fname' =>  'required'],
            ['fname.required' =>  'Put a fname']
        );
          $this->validate(
            $request,
            ['lname' =>  'required'],
            ['lname.required' =>  'Put a lname']
        );
        $this->validate(
            $request,
            ['emailid' =>  'required|email'],
            ['emailid.required' =>  'Put a email id'],
            ['emailid.email' =>  'Put a valid email id']
        );
        $this->validate(
            $request,
            ['phoneno' =>  'required'],
            ['phoneno.required' =>  'Add your phoneno']
        );
       $this->validate(
            $request,
            ['companylist' =>  'required'],
            ['companylist.required' =>  'Add your company']
        );
      $employee = new employee;
      $employeeExist = $employee
      ->where(
            array('email' => $request->emailid)
        )
        ->first();

        if(!empty($employeeExist))
        {
            $errors = 'Use some different email id';
            return Redirect::back()->withErrors($errors)->withInput();
        }else{
                    $employee->fname              = $request->fname;
                    $employee->lname              = $request->lname;
                    $employee->email              = $request->emailid;
                    $employee->company_id         = $request->companylist;
                    $employee->phoneno            = $request->phoneno;
                    $employee->save();
                    $success = 'Employee created successfully';
                    return Redirect::back()->withSuccess($success);
        }
    }

    function editForm(request $request)
    {
        $employee = new employee;
      $employeeToedit = $employee
      ->where(
            array('id' => $request->empid)
        )
        ->first();
        $companyList = DB::table('companies')->get();
        $data = array(
            'title'             =>  __('Edit Employee'),
            'employeeToedit'    =>  $employeeToedit,
            'companyList'       =>  $companyList
        );
        return view('employees.edit')->with($data);
    }


    function update(request $request)
    {
         $this->validate(
            $request,
            ['fname' =>  'required'],
            ['fname.required' =>  'Put a fname']
        );
          $this->validate(
            $request,
            ['lname' =>  'required'],
            ['lname.required' =>  'Put a lname']
        );
        $this->validate(
            $request,
            ['emailid' =>  'required|email'],
            ['emailid.required' =>  'Put a email id'],
            ['emailid.email' =>  'Put a valid email id']
        );
        $this->validate(
            $request,
            ['phoneno' =>  'required'],
            ['phoneno.required' =>  'Add your phoneno']
        );
       $this->validate(
            $request,
            ['companylist' =>  'required'],
            ['companylist.required' =>  'Add your company']
        );
      $employee = new employee;
      $employeeExist = $employee
      ->where(
            array('id' => $request->employee_id)
        )
        ->first();

        if(empty($employeeExist))
        {
            $errors = 'Use some different email id';
            return Redirect::back()->withErrors($errors)->withInput();
        }else{
                     $updateing = $employee->where(
                        'id', 
                        $request->employee_id
                    )->update(
                        array(
                            'fname'         =>  $request->fname,
                            'lname'         =>  $request->lname,
                            'email'         =>  $request->emailid,
                            'phoneno'       =>  $request->phoneno,
                            'company_id'    =>  $request->companylist
                        )
                    );
                    $success = 'Employee updated successfully';
                    return Redirect::back()->withSuccess($success);
        }
    }

    function delete(request $request)
    {
        $employee = new employee;
      $employeeExist = $employee
      ->where(
            array('id' => $request->empid)
        )
        ->first();
        $res = employee::where('id',$request->empid)->delete();
        return redirect('/'.app()->getLocale().'/employees');
    }
}
