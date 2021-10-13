@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{__('general.listofCompany')}}
                <a href="/{{Lang::locale()}}/companies/add" class="btn btn-primary" style="float:right">{{__('general.addcompany')}}</a>
                </div>

                <div class="card-body">
                  @if(count($allCompanies)>0)
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{__('general.name')}}</th>
                          <th scope="col">{{__('general.email')}}</th>
                          <th scope="col">{{__('general.website')}}</th>
                          <th scope="col">{{__('general.logo')}}</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allCompanies as $companeis)
                        <tr>
                          <th scope="row">{{$companeis->id}}</th>
                          <td>{{$companeis->name}}</td>
                          <td>{{$companeis->email}}</td>
                          <td><a href="{{$companeis->website}}">{{__('general.clickhere')}}</a> </td>
                          <td><img src="{{ asset('storage/companyImgs/logo/'.$companeis->logo) }}" width="50px"></td>
                          <td>
                            <a href="/{{Lang::locale()}}/companies/edit/{{$companeis->id}}" class="btn btn-primary">{{__('general.edit')}}</a>
                            <a href="/{{Lang::locale()}}/companies/delete/{{$companeis->id}}" class="btn btn-danger">{{__('general.delete')}}</a>
                          </td>
                        </tr>
                       @endforeach
                      </tbody>
                </table>
                  @else
                  <p style="text-align: center;">{{__('general.norecordsfound')}}</p>
                  @endif
                {{ $allCompanies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection