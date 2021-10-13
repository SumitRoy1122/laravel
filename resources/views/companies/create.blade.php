@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('general.companyAdd') }}</div>
                <div class="card-body">
                    <form action="{{route('saveCompany')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email">{{__('general.companyname')}}:</label>
                            <input type="text" class="form-control" id="name" name="companyname" value="{{ old('companyname') }}">
                            @error('companyname')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">{{__('general.emailid')}}:</label>
                            <input type="email" class="form-control" id="email" name="emailid" value="{{ old('emailid') }}">
                            @error('emailid')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                         <div class="form-group">
                            <label for="pwd">{{__('general.logo')}}({{__('general.minsize')}}):</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            @error('logo')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
                         <div class="form-group">
                            <label for="pwd">{{__('general.companywebsite')}}:</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}">
                            @error('website')<p style="color:red;">{{ $message }}</p>@enderror
                        </div>
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