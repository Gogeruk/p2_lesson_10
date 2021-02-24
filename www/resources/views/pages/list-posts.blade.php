@extends('layout')

@section('current')
<li class="page-item"><a class="page-link" href="/post?page={{ $posts->currentPage() }}">{{ $posts->currentPage() }}</a></li>
@endsection
@section('current-')
<li class="page-item"><a class="page-link" href="/post?page={{ $posts->currentPage() -1 }}">{{ $posts->currentPage() -1 }}</a></li>
@endsection
@section('current+')
<li class="page-item"><a class="page-link" href="/post?page={{ $posts->currentPage() +1 }}">{{ $posts->currentPage() +1 }}</a></li>
@endsection

@section('previous')
<li class="page-item"><a class="page-link" href="/post{{ $posts->previousPageUrl() }}">Previous</a></li>
@endsection
@section('next')
<li class="page-item"><a class="page-link" href="/post{{ $posts->nextPageUrl() }}">Next</a></li>
@endsection

@section('last')
<li class="page-item"><a class="page-link" href="/post?page={{ $posts->lastPage() }}">Last Page</a></li>
@endsection
@section('first')
<li class="page-item"><a class="page-link" href="/post?page=1">First Page</a></li>
@endsection

@section('list-posts')
    <div class="m-3 border border-danger">
        <div class="form-group row m-2">
            <div class="m-3">
                <h2 class="mb-3 text-center">List-posts</h2>
                @forelse ($posts as $post)
                    @if ($loop->first)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Category_id</th>
                                </tr>
                            </thead>
                    @endif
                        <tbody>
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->category_id }}</td>
                                <td>
                                    <button onclick="location.href='/post/{{ $post->id }}/update'" type="submit" class="btn btn-danger" name="button">update</button>
                                    <button onclick="location.href='/post/{{ $post->id }}/delete'" type="submit" class="btn btn-danger" name="button">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    @if ($loop->last)
                        </table>
                    @endif
                    @empty
                        <p class="m-3 text-center">No posts, sorry fren. Better luck next time.</p>
                    @endforelse
                    @if(isset($_SESSION['status']))
                        <p class="m-3 text-center">{{ $_SESSION['status'] }}</p>
                    @endif
                    @php
                        unset($_SESSION['status'])
                    @endphp
                <div class="m-3 text-center">
                    <button onclick="location.href='/post/create'" type="submit" class="btn btn-danger" name="button">create a new post</button>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-4 text-center">
                        @if( $posts->currentPage() == 1 )
                            @yield('current')
                            @yield('current+')
                            <li class="page-item"><a class="page-link" href="/post?page={{ $posts->currentPage() +2 }}">{{ $posts->currentPage() +2 }}</a></li>
                            @yield('last')
                            @yield('next')
                        @elseif( $posts->currentPage()  == ($posts->lastPage()))
                            @yield('previous')
                            @yield('first')
                            @if(($posts->currentPage() -2) > 0)
                                <li class="page-item"><a class="page-link" href="/post?page={{ $posts->currentPage() -2 }}">{{ $posts->currentPage() -2 }}</a></li>
                            @endif
                            @yield('current-')
                            @yield('current')
                        @else( $posts->currentPage() >3 )
                            @yield('previous')
                            @yield('first')
                            @yield('current-')
                            @yield('current')
                            @yield('current+')
                            @yield('last')
                            @yield('next')
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
@endsection
