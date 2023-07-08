@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $company->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <dl>
                        @if($company->logo)
                        <dt>Logo</dt>
                        <dd><img class="img-fluid" style="width: 100px;" src="{{ asset('storage/company-logos/' . $company->logo) }}" alt="{{ $company->name }}" /></dd>
                        @endif
                        <dt>Email</dt>
                        <dd>{{ $company->email }}</dd>
                        <dt>Website URL</dt>
                        <dd>{{ $company->website_url }}</dd>
                        <dt>Contact Person</dt>
                        <dd>{{ $company->contact_person }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection