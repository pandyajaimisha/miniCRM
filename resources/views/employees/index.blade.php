@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body table-responsive">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <a href="{{ route('employees.create') }}" class="btn btn-secondary mb-2 float-end">Add employee</a>
                    <div class="clearfix"></div>
                    <hr>

                    <form method="GET" action="{{ route('employees.index') }}">
                        <div class="mb-3">
                            <label for="companyFilter">Company filter</label>
                            <select id="companyFilter" name="company" class="form-control">
                                <option value="">Select company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ request()->get('company') == $company->id ? 'selected' : ''}}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary mb-4">Filter</button>
                    </form>
                    
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush