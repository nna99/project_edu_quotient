@extends('admin.layouts.app')

@section('content')
    <div class="col-6 offset-3">
        <a href="{{ route('dashboard') }}"><button class="btn btn-dark text-white mb-3" ><i class="fa-solid fa-arrow-left mr-2"></i>Back</button></a>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h1>Profile</h1>
                    @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    </div>
                </div>
                <form action="{{ route('profile#update') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name',$data->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email',$data->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone',$data->phone) }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" cols="30" rows="10" placeholder="Address">{{ old('address',$data->address ) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class=" form-select">
                                <option value="">Choose Gender</option>
                                <option value="male" @if ($data->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if ($data->gender == 'female') selected @endif>Female</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
    </div>
@endsection
