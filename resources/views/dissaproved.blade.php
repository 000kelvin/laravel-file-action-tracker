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
                                <h5>Viewing all dissaproved requests</h5>
                            </p>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(auth()->user()->type==1 || auth()->user()->type==2)
    <div class="col-md-12 acting">
        @if($dissaproveds->all() != [])
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @foreach($dissaproveds as $dissaproved)
                <tr>
                    <th scope="row">{{ $dissaproved->id }}</th>
                    <td>{{ $dissaproved->user()->pluck('name')->first() }}</td>
                    <td><a href="{{ asset('actionImage/'.$dissaproved->image) }}" download>{{ $dissaproved->image }}</a>
                    </td>
                    <td>{{ $dissaproved->verifier()->pluck('name')->first() }}</td>
                    <td>{{ $dissaproved->steps }}</td>
                    <td><span
                            class="badge {{ $dissaproved->status == 0 ? 'badge-warning' :  ($dissaproved->status == 1 ? 'badge-success' : 'badge-danger') }}">{{ $dissaproved->status == 0 ? 'dissaproved' :  ($dissaproved->status == 1 ? 'Approved' : 'Disapproved') }}</span>
                    </td>
                    <td>{{ $dissaproved->unique_hash }}</td>
                    <td>
                        <form method="POST" action="{{ route('view-dissaproved', $dissaproved->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-success" type="submit">Match</button>
                        </form>
                    </td>
                </tr>
                @endforeach </tbody>
        </table>
        @else
        There is no data for this table
        @endif
    </div>
    @endif
</section>
@endsection