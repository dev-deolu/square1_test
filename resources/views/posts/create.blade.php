@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create A New Post') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('posts.store') }}" method="post">
                            @csrf
                            @error('title', 'description','publication_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="postTitle" class="form-label"> Title </label>
                                <input name="title" type="text" class="form-control" id="postTitle">
                            </div>
                            <div class="mb-3">
                                <label for="postDescription" class="form-label"> Description </label>
                                <textarea name="description" class="form-control" id="postDescription" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Publication Date</label>
                                <input name="publication_date" type="date" class="form-control"
                                    value="{{ now()->format('Y-m-d') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@prepend('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endprepend

@push('scripts')

@endpush
