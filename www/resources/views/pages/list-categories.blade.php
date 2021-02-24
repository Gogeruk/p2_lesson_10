@extends('layout')

@section('current')
<li class="page-item"><a class="page-link" href="/category?page={{ $categories->currentPage() }}">{{ $categories->currentPage() }}</a></li>
@endsection
@section('current-')
<li class="page-item"><a class="page-link" href="/category?page={{ $categories->currentPage() -1 }}">{{ $categories->currentPage() -1 }}</a></li>
@endsection
@section('current+')
<li class="page-item"><a class="page-link" href="/category?page={{ $categories->currentPage() +1 }}">{{ $categories->currentPage() +1 }}</a></li>
@endsection

@section('previous')
<li class="page-item"><a class="page-link" href="/category{{ $categories->previousPageUrl() }}">Previous</a></li>
@endsection
@section('next')
<li class="page-item"><a class="page-link" href="/category{{ $categories->nextPageUrl() }}">Next</a></li>
@endsection

@section('last')
<li class="page-item"><a class="page-link" href="/category?page={{ $categories->lastPage() }}">Last Page</a></li>
@endsection
@section('first')
<li class="page-item"><a class="page-link" href="/category?page=1">First Page</a></li>
@endsection


@section('list-categories')
    <div class="m-3 border border-danger">
        <div class="form-group row m-2">
            <div class="m-3">
                <h2 class="mb-3 text-center">List-categories</h2>
                @forelse ($categories as $category)
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
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <button onclick="location.href='/category/{{ $category->id }}/update'" type="submit" class="btn btn-danger" name="button">update</button>
                                    <button onclick="location.href='/category/{{ $category->id }}/delete'" type="submit" class="btn btn-danger" name="button">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    @if ($loop->last)
                        </table>
                    @endif
                    @empty
                        <p class="m-3 text-center">No categories, sorry fren. Better luck next time.</p>
                    @endforelse
                    @if(isset($_SESSION['status']))
                        <p class="m-3 text-center">{{ $_SESSION['status'] }}</p>
                    @endif
                    @php
                        unset($_SESSION['status'])
                    @endphp
                <div class="m-3 text-center">
                    <button onclick="location.href='/category/create'" type="submit" class="btn btn-danger" name="button">create a new category</button>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-4 text-center">
                        @if( $categories->currentPage() == 1 )
                            @yield('current')
                            @yield('current+')
                            <li class="page-item"><a class="page-link" href="/category?page={{ $categories->currentPage() +2 }}">{{ $categories->currentPage() +2 }}</a></li>
                            @yield('last')
                            @yield('next')
                        @elseif( $categories->currentPage()  == ($categories->lastPage()))
                            @yield('previous')
                            @yield('first')
                            @if(($categories->currentPage() -2) > 0)
                                <li class="page-item"><a class="page-link" href="/category?page={{ $categories->currentPage() -2 }}">{{ $categories->currentPage() -2 }}</a></li>
                            @endif
                            @yield('current-')
                            @yield('current')
                        @else( $categories->currentPage() >3 )
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
