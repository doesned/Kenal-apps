@extends('app')

@section('title')
    Home - Posts
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

@section('content')
    <!-- @if(session('ok'))
    <div class="max-w-5xl mx-auto bg-green-500 text-white p-4 mb-4 rounded-lg">
        <i class="fa fa-check mr-1"></i> {{ session('ok') }}
    </div>
    @endif -->
<div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md mt-4 mb-5">
        <div class="flex justify-between items-center px-6 py-4">
            <h1 class="text-lg font-semibold text-gray-700">Data Postingan</h1>
            <a href="{{route('posts.create')}}">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">
                    Add Post
                </button>
            </a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Id</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($post as $row)                
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $row->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <!-- <img src="{{ asset('storage/'.$row->image ?? 'img/default.png') }}" alt="" class="w-20 h-auto"> -->
                        @if($row->image)
                        <img src="{{ asset('storage/'.$row->image) }}" alt="{{ $row->title }}" class="w-20 h-auto">
                        @else
                        <img src="{{ asset('img/default.png') }}" alt="Gambar Default" class="w-20 h-auto">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $row->title }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ Str::limit($row->content, 50) }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-center">
                        <?php
                            $postComment = App\Models\Post::find($row->id);
                            $comments = $postComment->comments->count();
                            echo $comments;
                        ?>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-center">
                        <a href="{{route('posts.show',$row->slug)}}" class="text-indigo-600 hover:text-indigo-900 mr-2">Detail</a>
                        <a href="{{route('posts.edit',$row->id)}}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                        <form action="{{route('posts.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap text-center" colspan="5">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $post->links() }}
        </div>
    </div>
    
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if(session('ok'))
        <script>
            messegaSuccess()
            function messegaSuccess() {
                Swal.fire({
                    title: '<?php echo session('ok'); ?>',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK',
                });
            }     
        </script>
    @endif    
@endsection
