<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\company;
use Redirect;
class CompanyController extends Controller
{
    function index()
    {
        $company = new Company;
        $companies = Company::paginate(10);
        //print_r($companies);
        $data = array(
            'title'         =>  __('Company List'),
            'allCompanies'  =>  $companies
        );
        return view('companies.companyList')->with($data);
    }

    function create(request $request)
    {
         $this->validate(
            $request,
            ['companyname' =>  'required'],
            ['companyname.required' =>  'Put a name']
        );
        $this->validate(
            $request,
            ['emailid' =>  'required|email'],
            ['emailid.required' =>  'Put a email id'],
            ['emailid.email' =>  'Put a valid email id']
        );
        $this->validate(
            $request,
            ['website' =>  'required'],
            ['website.required' =>  'Add your website']
        );
        $this->validate(
            $request,
            ['logo' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100,max_width=200,max_height=200'],
            ['logo.required' =>  'Put a file'],
            ['logo.image' =>  'Put a valid image file'],
            ['logo.dimensions' =>  'Put a proper image with size 100*100']
        );
      $company = new company;
      $companyExist = $company
      ->where(
            array('name' => $request->companyname)
        )
      ->orwhere(
        array('email' => $request->emailid)
      )
        ->first();

        if(!empty($companyExist))
        {
            $errors = 'The mail/name of company already exist';
            return Redirect::back()->withErrors($errors)->withInput();
        }else{
            if(!empty($request->file('logo')))
            {
                $companyNamereplace = preg_replace ('/[^\p{L}\p{N}]/u', '_', $request->companyname);
                $destinationPath = 'public/companyImgs/logo';
                $imageName = $companyNamereplace.'_'.$request->file('logo')->getClientOriginalName();
                $uploadedFile = $request->file('logo')->storeAs($destinationPath,$imageName);
                if($uploadedFile)
                {
                    $company->name              = $request->companyname;
                    $company->email             = $request->emailid;
                    $company->logo              = $imageName;
                    $company->website           = $request->website;
                    $company->save();
                    $success = 'Company created successfully';
                    return Redirect::back()->withSuccess($success);
                }else{
                    $errors = 'File not uploaded';
                    return Redirect::back()->withErrors($errors)->withInput();  
                }
            }else{
              $errors = 'You have to upload a logo';
                return Redirect::back()->withErrors($errors)->withInput();  
            }
        }
    }


    function update(request $request)
    {
         $this->validate(
            $request,
            ['companyname' =>  'required'],
            ['companyname.required' =>  'Put a name']
        );
        $this->validate(
            $request,
            ['emailid' =>  'required|email'],
            ['emailid.required' =>  'Put a email id'],
            ['emailid.email' =>  'Put a valid email id']
        );
        $this->validate(
            $request,
            ['website' =>  'required'],
            ['website.required' =>  'Add your website']
        );
        $this->validate(
            $request,
            ['logo' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100,max_width=200,max_height=200'],
            ['logo.required' =>  'Put a file'],
            ['logo.image' =>  'Put a valid image file'],
            ['logo.dimensions' =>  'Put a proper image with size 100*100']
        );
      $company = new company;
      $companyExist = $company
      ->where(
            array('id' => $request->companyid)
        )
        ->first();

        if(!empty($companyExist))
        {
            if(!empty($request->file('logo')))
            {
                $companyNamereplace = preg_replace ('/[^\p{L}\p{N}]/u', '_', $request->companyname);
                $destinationPath = 'public/companyImgs/logo';
                $imageName = $companyNamereplace.'_'.$request->file('logo')->getClientOriginalName();
                //var_dump(file_exists(public_path('storage/companyImgs/logo/'.$companyExist->logo)));
                //die;
                if (file_exists(public_path('storage/companyImgs/logo/'.$companyExist->logo))) 
                {
                    unlink(public_path('storage/companyImgs/logo/'.$companyExist->logo));
                };
                $uploadedFile = $request->file('logo')->storeAs($destinationPath,$imageName);
                if($uploadedFile)
                {
                     $updateing = $company->where(
                        'id', 
                        $request->companyid
                    )->update(
                        array(
                            'name'      =>  $request->companyname,
                            'email'     =>  $request->emailid,
                            'logo'      =>  $imageName,
                            'website'   =>  $request->website
                        )
                    );

                    $success = 'Company updated successfully';
                    return Redirect::back()->withSuccess($success);
                }else{
                    $errors = 'File not uploaded';
                    return Redirect::back()->withErrors($errors)->withInput();  
                }
            }else{
              $errors = 'You have to upload a logo';
                return Redirect::back()->withErrors($errors)->withInput();  
            }
        }else{
            $errors = 'The data not exist more';
            return Redirect::back()->withErrors($errors)->withInput();
        }
    }

    function editForm(request $request)
    {
        $company = new company;
      $companyToedit = $company
      ->where(
            array('id' => $request->companyID)
        )
        ->first();
        $data = array(
            'title'         =>  __('Edit Company'),
            'companyToedit'  =>  $companyToedit
        );
        return view('companies.edit')->with($data);
    }

    function delete(request $request)
    {
        $company = new company;
      $companyExist = $company
      ->where(
            array('id' => $request->companyid)
        )
        ->first();
        if (file_exists(public_path('storage/companyImgs/logo/'.$companyExist->logo))) 
        {
            unlink(public_path('storage/companyImgs/logo/'.$companyExist->logo));
        };
        $res = company::where('id',$request->companyid)->delete();
        return redirect('/'.app()->getLocale().'/companies');
    }
}
