@extends('app')

@section('title')
    Detail Post
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #submitButton {
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-md mt-4 shadow-md">
        <div class="flex justify-between items-center pt-2 pb-5">
            <a href="{{ route('posts.index') }}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-lg font-semibold text-gray-700">Detail Data</h1>
            <h1 class="text-lg font-semibold text-gray-700">
                <i class="fa fa-info-circle"></i>
            </h1>
        </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-semibold">Title:</label>
                <input value="{{ $post->title }}" type="text" id="title" name="title" readonly class="bg-gray-100 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-semibold">Content:</label>
                <textarea id="content" name="content" rows="4" readonly class="bg-gray-100 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ $post->content }}</textarea>
            </div>
    </div>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-md mt-4 shadow-md">
        <h1 class="text-lg font-semibold text-gray-700">Comments</h1>

        @forelse($post->comments as $comment)
        <div class="mb-4 flex flex-row items-center mt-3">
            <img class="comment-img rounded-full w-11 h-11" src="https://ui-avatars.com/api/?name={{ $comment->comment }}" alt="User Image">
            <div class="ml-3">
                <p>{{ $comment->comment }}</p>
            </div>
            <div class="ml-auto">
                <p>{{ date('d F Y', strtotime($comment->created_at)) }}</p>
            </div>
        </div>
        @empty
        <h1 class="text-md font-semibold text-gray-700 text-center">Jadi pertama berkomentar</h1>
        @endforelse
    </div>

    <form action="{{ route('comments.store') }}" method="post">
        @csrf
        <div class="max-w-xl mx-auto flex flex-row items-center mt-5">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input id="input" name="comment" type="text" class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-indigo-500" placeholder="Ketik sesuatu...">
            <button disabled id="submitButton" type="submit" class="ml-3 flex items-center justify-center px-4 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">
                <!-- <i class="fas fa-paper-plane"></i> -->
                <span>Kirim</span>
            </button>
        </div>
    </form>

@stop

@section('js')
<script>
    const input = document.getElementById('input');
    const submitButton = document.getElementById('submitButton');
    input.addEventListener('input', function() {
        if (input.value === '') {
            submitButton.disabled = true;
            submitButton.style.cursor = 'not-allowed';
        }
        else {
            submitButton.disabled = false;
            submitButton.style.cursor = 'pointer';
        }
    });
</script>
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
