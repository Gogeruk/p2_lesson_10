@extends('layout')

@section('current')
<li class="page-item"><a class="page-link" href="/tag?page={{ $tags->currentPage() }}">{{ $tags->currentPage() }}</a></li>
@endsection
@section('current-')
<li class="page-item"><a class="page-link" href="/tag?page={{ $tags->currentPage() -1 }}">{{ $tags->currentPage() -1 }}</a></li>
@endsection
@section('current+')
<li class="page-item"><a class="page-link" href="/tag?page={{ $tags->currentPage() +1 }}">{{ $tags->currentPage() +1 }}</a></li>
@endsection

@section('previous')
<li class="page-item"><a class="page-link" href="/tag{{ $tags->previousPageUrl() }}">Previous</a></li>
@endsection
@section('next')
<li class="page-item"><a class="page-link" href="/tag{{ $tags->nextPageUrl() }}">Next</a></li>
@endsection

@section('last')
<li class="page-item"><a class="page-link" href="/tag?page={{ $tags->lastPage() }}">Last Page</a></li>
@endsection
@section('first')
<li class="page-item"><a class="page-link" href="/tag?page=1">First Page</a></li>
@endsection


@section('list-tags')
    <div class="m-3 border border-danger">
        <div class="form-group row m-2">
            <div class="m-3">
                <h2 class="mb-3 text-center">List-tags</h2>
                @forelse ($tags as $tag)
                    @if ($loop->first)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                </tr>
                            </thead>
                    @endif
                        <tbody>
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <button onclick="location.href='/tag/{{ $tag->id }}/update'" type="submit" class="btn btn-danger" name="button">update</button>
                                    <button onclick="location.href='/tag/{{ $tag->id }}/delete'" type="submit" class="btn btn-danger" name="button">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    @if ($loop->last)
                        </table>
                    @endif
                    @empty
                        <p class="m-3 text-center">No tags, sorry fren. Better luck next time.</p>
                    @endforelse
                    @if(isset($_SESSION['status']))
                        <p class="m-3 text-center">{{ $_SESSION['status'] }}</p>
                    @endif
                    @php
                        unset($_SESSION['status'])
                    @endphp
                <div class="m-3 text-center">
                    <button onclick="location.href='/tag/create'" type="submit" class="btn btn-danger" name="button">create a new tag</button>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-4 text-center">
                        @if( $tags->currentPage() == 1 )
                            @yield('current')
                            @yield('current+')
                            <li class="page-item"><a class="page-link" href="/tag?page={{ $tags->currentPage() +2 }}">{{ $tags->currentPage() +2 }}</a></li>
                            @yield('last')
                            @yield('next')
                        @elseif( $tags->currentPage()  == ($tags->lastPage()))
                            @yield('previous')
                            @yield('first')
                            @if(($tags->currentPage() -2) > 0)
                                <li class="page-item"><a class="page-link" href="/tag?page={{ $tags->currentPage() -2 }}">{{ $tags->currentPage() -2 }}</a></li>
                            @endif
                            @yield('current-')
                            @yield('current')
                        @else( $tags->currentPage() >3 )
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
