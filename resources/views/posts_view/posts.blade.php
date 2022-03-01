@extends('layouts.app')
@section('content')
    <div class="set-center set-border">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @can('edit posts')
                                <a href="{{ route('post.edit', ['post' => $item->id]) }}"><button
                                        class="btn btn-success">Edit</button></a>
                            @endcan
                            @can('delete posts')
                                <a href="{{ route('post.delete', ['post' => $item->id]) }}"><button
                                        class="btn btn-danger">Delete</button></a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
<style>
    .set-center {
        margin: 100px
    }

    .set-border {
        border: solid black;
        border-radius: 5px
    }

</style>
