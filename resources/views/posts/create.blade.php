@extends('app')

@section('title')
    Add Post
@endsection

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-md mt-4 shadow-md">
        <div class="flex justify-between items-center pt-2 pb-4">
            <h1 class="text-lg font-semibold text-gray-700">Tambahkan Data Baru</h1>
            <a href="{{route('posts.index')}}">
                <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-indigo-200">
                    Back
                </button>
            </a>
        </div>
        <form action="{{ route('posts.store2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-semibold">Title:</label>
                <input value="{{old('title')}}" type="text" id="title" name="title" class="@error('title') border-red-500 @enderror w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan judul disini">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>            
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-semibold">Content:</label>
                <textarea id="content" name="content" rows="4" class="@error('title') border-red-500 @enderror w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan konten disini"></textarea>
                @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Image:</label>
                <input type="file" id="image" name="image" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                    "/>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="text-center">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">Simpan</button>
            </div>
        </form>
    </div>
@stop
