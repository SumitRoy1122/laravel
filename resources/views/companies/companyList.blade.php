@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('general.listofCompany')}}</div>

                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{__('general.name')}}</th>
                          <th scope="col">{{__('general.email')}}</th>
                          <th scope="col">{{__('general.website')}}</th>
                          <th scope="col">{{__('general.logo')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allCompanies as $companeis)
                        <tr>
                          <th scope="row">{{$companeis->id}}</th>
                          <td>{{$companeis->name}}</td>
                          <td>{{$companeis->email}}</td>
                          <td><a href="{{$companeis->website}}">{{__('general.clickhere')}}</a> </td>
                          <td><img src="{{ Storage::url('app/'.$companeis->logo) }}"></td>
                        </tr>
                       @endforeach
                      </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection