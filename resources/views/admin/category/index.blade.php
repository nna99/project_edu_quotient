@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-2">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Category list</h1>
        <nav class="navbar">
            <form class="form-inline" action="{{ route('category') }}" method="get">
                @csrf
              <input class="form-control mr-sm-2" type="search" name="key" placeholder="Search" value="{{ request('key') }}" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
        <a href="{{ route('category#addPage') }}"><button class="btn btn-primary">Add Category <i class="fa-solid fa-plus ml-1"></i></button></a>
    </div>
    @if (session('deleteSuccess'))
        <div class="col-4 offset-8">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('deleteSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('updateSuccess'))
        <div class="col-4 offset-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('updateSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div style="margin-top: 20px">
        @if (count($data) == 0)
            <h1 class="text-danger text-center mt-5">There is no category!</h1>
        @else
        <table class="table table-hover">
            <thead>
              <tr>
                <th class="align-middle col-3">Action</th>
                <th class="align-middle col-3">No</th>
                <th class="align-middle col-3">Name</th>
                <th class="align-middle col-3">Publish</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              <tr>
                <td class="col-3">
                    <a href="{{ route('category#editPage',$item->id) }}">
                        <i class="fa-solid fa-pen-to-square text-primary fs-3 mr-2" title="edit"></i>
                    </a>
                    <a href="{{ route('category#delete',$item->id) }}">
                        <i class="fa-solid fa-trash text-danger fs-3" title="delete"></i>
                    </a>
                </td>
                <td class="col-3 categoryId">{{ $item->id }}</td>
                <td class="col-3">{{ $item->category_name }}</td>
                <td class="col-3">
                    <div class="form-switch ms-3">
                        <input class="form-check-input fs-4 changeStatus" @if ($item->category_status == 1) checked @endif type="checkbox" >
                    </div>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){

            $('.changeStatus').click(function(){
                $parentNode = $(this).parents("tr");
                $categoryId = $parentNode.find('.categoryId').text();

                if($(this).prop("checked") == true){
                    $checked = '1';
                }else if($(this).prop("checked") == false){
                    $checked = '0';
                }

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/category/changeStatus',
                    dataType : 'json',
                    data : {'categoryId' : $categoryId, 'status' : $checked}
                })
            })

        })

    </script>
@endsection
