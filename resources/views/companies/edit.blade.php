@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name" value="{{ old('name', $company->name) }}" required>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email', $company->email) }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="logo">Logo</label>
                            <input type="hidden" id="remove_logo" name="remove_logo" value="" />
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo">
                            <div id="logoHelp" class="form-text">Minimum dimension 100x100px and max size 5mb.</div>
                            @if($company->logo)
                                <img src="{{asset('storage/company-logos/' . $company->logo)}}" id="oldLogo" class="img img-responsive" width="60" height="60" alt="image">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('remove_logo').value = 'yes'; document.getElementById('oldLogo').remove(); this.remove();">Clear</a>
                            @endif
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website_url">Website URL</label>
                            <input type="text" class="form-control @error('website_url') is-invalid @enderror" name="website_url" id="website_url" placeholder="Enter website url" value="{{ old('website_url', $company->website_url) }}">

                            @error('website_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contact_person">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" id="contact_person" placeholder="Enter contact person" value="{{ old('contact_person', $company->contact_person) }}">

                            @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection