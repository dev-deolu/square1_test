@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <a class="btn btn-primary float-end" href="{{ route('posts.create') }}" role="button">Create New
                            Post</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table" id="auth-user-posts-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titles</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Publication Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ Str::limit($post->title ?? '', 100) }}</td>
                                        <td>{{ Str::limit($post->description ?? '', 200) }}</td>
                                        <td>{{ $post->publication_date->format('jS F y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    <script>
        $(document).ready(function() {
            $('#auth-user-posts-table').DataTable();
        });
    </script>
@endpush
