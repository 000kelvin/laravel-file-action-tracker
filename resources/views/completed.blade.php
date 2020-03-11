@extends('layouts.master')

@section('content')

<section>
    <div class="jumbotron vertical-center">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="title m-b-md">
                            <b>
                                <p>
                                    <h1>Welcome to LASG File and Action Tracking System </h1>
                                    <p>
                            </b>
                        </div>

                        <span>
                            <p>
                                <h5>Viewing all completed requests</h5>
                            </p>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(auth()->user()->type==2)
    <div class="col-md-12 acting">
        {{-- {{dd($completeds)}} --}}
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if($completeds->all() != [])
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">User</th>
                    <th scope="col">File (Click to download)</th>
                    <th scope="col">Verifier</th>
                    <th scope="col">Steps</th>
                    <th scope="col">Status</th>
                    <th scope="col">History (Click to view full History)</th>
                    <th scope="col">Approve</th>
                    <th scope="col">Disapprove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completeds as $completed)
                <tr>
                    <th scope="row">{{ $completed->id }}</th>
                    <td>{{ $completed->user()->pluck('name')->first() }}</td>
                    <td><a href="{{ asset('actionImage/'.$completed->image) }}" download>{{ $completed->image }}</a>
                    </td>
                    <td>{{ $completed->verifier()->pluck('name')->first() }}</td>
                    <td>{{ $completed->steps }}</td>
                    <td><span
                            class="badge {{ $completed->status == 0 ? 'badge-warning' :  ($completed->status == 1 ? 'badge-success' : 'badge-danger') }}">{{ $completed->status == 0 ? 'pending' :  ($completed->status == 1 ? 'approved' : 'Disapproved') }}</span>
                    </td>
                    <td>{{ $completed->unique_hash }}</td>
                    <td>
                        <span>
                            <form method="POST" action="{{ route('action-approve', $completed->id) }}">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-success" type="submit">Approve</button>
                            </form>

                    </td>
                    <td>
                        <form method="POST" action="{{ route('action-disapprove', $completed->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-danger" type="submit">Disapprove</button>
                        </form>
                        </span>
                    </td>
                </tr>
                @endforeach </tbody>
        </table>
        @else
        There is no data in this table
        @endif
    </div>
    @endif
</section>
@endsection