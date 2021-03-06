<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Kategori <b></b>
            
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="container">
    <div class="row">
    <div class="col-md-8">
    <div class="card">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card-header">Semua Kategori</div>
    
            <table class="table">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">User</th>
            <th scope="col">Dibuat</th>
            </tr>
        </thead>
        <tbody>
        <!-- @php($i = 1) -->
        @foreach($categories as $category)        
            <tr>
            <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
            <td>{{$category->category_name}}</td>
            <td>{{$category->user_id}}</td>
            <td>
                @if($category->created_at == NULL)
                <span class="text-danger">Tidak ada waktu</span>
                @else 
                    {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                @endif
            </td>
            </tr>
        @endforeach
        
        </tbody>
        </table>
        {{$categories->links()}}
        </div>
    </div>

    <!-- //Form tambah kategori -->
    <div class="col-md-4">
    <div class="card">

        <div class="card-header">Tambah Kategori</div>
        <div class="card-body">
            <form action="{{route('store.category')}}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
            </form>
        </div>
    </div>
    </div>
    <!-- tutup form -->

    </div>
    </div>
    </div>
</x-app-layout>
