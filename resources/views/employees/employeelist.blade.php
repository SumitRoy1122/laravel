@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{__('general.listofEmploee')}}
                <a href="/{{Lang::locale()}}/employees/add" class="btn btn-primary" style="float:right">{{__('general.addemployee')}}</a>
                </div>

                <div class="card-body">
                  @if(count($allEmployees)>0)
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{__('general.fname')}}</th>
                          <th scope="col">{{__('general.lname')}}</th>
                          <th scope="col">{{__('general.email')}}</th>
                          <th scope="col">{{__('general.phoneno')}}</th>
                          <th scope="col">{{__('general.company')}}</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allEmployees as $employees)
                        <tr>
                          <th scope="row">{{$employees->id}}</th>
                          <td>{{$employees->fname}}</td>
                          <td>{{$employees->lname}}</td>
                          <td>{{$employees->email}}</td>
                          <td>{{$employees->phoneno}}</td>
                          <td>{{$employees->name}}</td>
                          <td>
                            <a href="/{{Lang::locale()}}/employees/edit/{{$employees->id}}" class="btn btn-primary">{{__('general.edit')}}</a>
                            <a href="/{{Lang::locale()}}/employees/delete/{{$employees->id}}" class="btn btn-danger">{{__('general.delete')}}</a>
                          </td>
                        </tr>
                       @endforeach
                      </tbody>
                </table>
                  @else
                  <p style="text-align: center;">{{__('general.norecordsfound')}}</p>
                  @endif
                {{ $allEmployees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection