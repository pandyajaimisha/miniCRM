@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee show</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <dl>
                        <dt>First Name</dt>
                        <dd>{{ $employee->first_name }}</dd>
                        <dt>Last Name</dt>
                        <dd>{{ $employee->last_name }}</dd>
                        <dt>Company name</dt>
                        <dd>{{ $employee->company->name }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $employee->email }}</dd>
                        <dt>Phone</dt>
                        <dd>{{ $employee->phone }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection