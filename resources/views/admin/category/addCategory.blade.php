@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-2">

            <div class="row">
                <div class="col-6 offset-3 mt-3">
                    @if (session('addSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('addSuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Add Category</h3>
                        </div>
                        <form action="{{ route('category#add') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="categoryName" id="name" class="form-control" placeholder="Category name...">
                                    @error('categoryName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group ms-1">
                                    <label for="">Status</label>
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" name="categoryStatus" value="1" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Publish
                                        </label>
                                        @error('categoryStatus')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('category') }}">
                                        <button type="button" class="btn btn-outline-dark mt-3">Cancel</button>
                                    </a>
                                    <button type="submit" class="btn btn-primary mt-3">Add Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
