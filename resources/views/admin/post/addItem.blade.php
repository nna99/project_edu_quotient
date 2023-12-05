@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-2">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Add Item</h2>
            @if (session('addSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('addSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <form action="{{ route('add#newItem') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Item Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="itemName" id="name" class="form-control" value="{{ old('itemName') }}" placeholder="Item name...">
                                @error('itemName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="itemCategory" id="category" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('itemCategory')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="itemPrice" id="price" class="form-control" value="{{ old('itemPrice') }}" placeholder="Item price...">
                                @error('itemPrice')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="itemDescription" id="description" class="form-control" placeholder="Description...">{{ old('itemDescription') }}</textarea>
                                @error('itemDescription')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="itemStatus" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Publish
                                    </label>
                                    @error('itemStatus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Item Photo</label>
                                <input type="file" name="itemImage" id="image" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="itemCondition" id="condition" class="form-select">
                                    <option value="">Choose item condition...</option>
                                    <option value="excellent">Excellent</option>
                                    <option value="good">good</option>
                                    <option value="bad">bad</option>
                                </select>
                                @error('itemCondition')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Owner Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ownerName">Owner Name</label>
                                <input type="text" name="ownerName" id="ownerName" class="form-control" value="{{ old('ownerName') }}" placeholder="Enter owner name...">
                                @error('ownerName')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ownerPhone">Contact Number</label>
                                <input type="text" name="ownerPhone" id="ownerPhone" class="form-control" value="{{ old('ownerPhone') }}" placeholder="Enter phone number...">
                                @error('ownerPhone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ownerAddress">Address</label>
                                <textarea name="ownerAddress" id="ownerAddress" cols="30" rows="10" class="form-control" placeholder="Enter address...">{{ old('ownerAddress') }}</textarea>
                                @error('ownerAddress')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('dashboard') }}">
                                    <button type="button" class="btn btn-outline-dark px-5 mr-3">Cancel</button>
                                </a>
                                <input type="submit" value="Save" class="btn btn-primary px-5">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
