@extends('admin.layouts.app')

@section('content')
    <div class="col-10 offset-1">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Item list update</h1>
            <nav class="navbar">
                <form class="form-inline" action="{{ route('dashboard') }}" method="get">
                    @csrf
                  <input class="form-control mr-sm-2" type="search" name="key" value="{{ request('key') }}" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
            <a href="{{ route('add#item') }}"><button class="btn btn-primary">Add Item <i class="fa-solid fa-plus ml-1"></i></button></a>
        </div>
        @if (session('deleteSuccess'))
            <div class="col-3 offset-9">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('deleteSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="" style="margin-top: 20px">
            @if (count($data) == 0)
                <h1 class="text-danger text-center mt-5">There is no item!</h1>
            @else
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="align-middle">Action</th>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Name</th>
                    <th class="align-middle">Category</th>
                    <th class="align-middle">Codition</th>
                    <th class="align-middle">Price</th>
                    <th class="align-middle">Owner</th>
                    <th class="align-middle">Publish</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <td>
                        <a href="{{ route('edit#itemPage',$item->id) }}">
                            <i class="fa-solid fa-pen-to-square text-primary fs-3 mr-2" title="edit"></i>
                        </a>
                        <a href="{{ route('delete#item',$item->id) }}">
                            <i class="fa-solid fa-trash text-danger fs-3" title="delete"></i>
                        </a>
                    </td>
                    <td class="itemId">{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->condition }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->owner_name }}</td>
                    <td>
                        <div class="form-switch">
                            <input class="form-check-input fs-5 changeStatus" @if ($item->publish == 1) checked @endif type="checkbox" >
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
                $itemId = $parentNode.find('.itemId').text();

                if($(this).prop("checked") == true){
                    $status = '1';
                }else if($(this).prop("checked") == false){
                    $status = '0';
                }

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/item/changeStatus',
                    dataType : 'json',
                    data : {
                        'itemId' : $itemId,
                        'status' : $status
                    }
                })
            })

        })

    </script>
@endsection
