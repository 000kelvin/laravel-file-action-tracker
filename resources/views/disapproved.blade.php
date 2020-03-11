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
                                <h5>Viewing {{ $title }}</h5>
                            </p>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(auth()->user()->type==1 || auth()->user()->type==2)
    <div class="col-md-12 acting">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if($disapproveds->all() != [])
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
                    @if(auth()->user()->type==2)
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach($disapproveds as $disapproved)
                <tr>
                    <th scope="row">{{ $disapproved->id }}</th>
                    <td>{{ $disapproved->user()->pluck('name')->first() }}</td>
                    <td><a href="{{ asset('actionImage/'.$disapproved->image) }}" download>{{ $disapproved->image }}</a>
                    </td>
                    <td>{{ $disapproved->verifier()->pluck('name')->first() }}</td>
                    <td>{{ $disapproved->steps }}</td>
                    <td><span
                            class="badge {{ $disapproved->status == 0 ? 'badge-warning' :  ($disapproved->status == 1 ? 'badge-success' : 'badge-danger') }}">{{ $disapproved->status == 0 ? 'disapproved' :  ($disapproved->status == 1 ? 'Approved' : 'Disapproved') }}</span>
                    </td>
                    <td>{{ $disapproved->unique_hash }}</td>

                    @if(auth()->user()->type==2)
                    <td>
                        <form method="POST" action="{{ route('action-approve', $disapproved->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-success" type="submit">Approve</button>
                        </form>
                    </td>
                    @endif
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