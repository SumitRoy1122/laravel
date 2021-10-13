@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('general.employeeadd') }}</div>
                <div class="card-body">
                    <form action="{{route('updateEmployee')}}"  method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email">{{__('general.fname')}}:</label>
                            <input type="text" class="form-control" id="name" name="fname" value="{{ $employeeToedit->fname }}">
                            @error('fname')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">{{__('general.lname')}}:</label>
                            <input type="text" class="form-control" id="email" name="lname" value="{{ $employeeToedit->lname }}">
                            @error('lname')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">{{__('general.emailid')}}:</label>
                            <input type="email" class="form-control" id="email" name="emailid" value="{{ $employeeToedit->email }}">
                            @error('emailid')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                         <div class="form-group">
                            <label for="pwd">{{__('general.phoneno')}}:</label>
                            <input type="text" class="form-control" id="logo" name="phoneno" value="{{ $employeeToedit->phoneno }}">
                            @error('phoneno')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                         <div class="form-group">
                            <label for="pwd">{{__('general.companylist')}}:</label>
                            <select name="companylist" class="form-control">
                                <option value="">{{__('general.chhoseCompany')}}</option>
                                @if(!empty($companyList))
                                    @foreach($companyList as $lst)
                                        @if($lst->id == $employeeToedit->company_id)
                                        <option value="{{$lst->id}}" selected="selected">{{$lst->name}}</option>
                                        @else
                                        <option value="{{$lst->id}}">{{$lst->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('companylist')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                        <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ $employeeToedit->id }}">
                        <button type="submit" class="btn btn-primary">{{__('general.save')}}</button>
                    </form> 
                </div>
                    @if($errors->any())
                      <div class="alert alert-danger" role="alert">
                        {{$errors->all()[0]}}
                      </div>
                    @endif

                    @if (Session::has('success'))
                      <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                      </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection