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
                                    <h1>Welcome to LASG File Tracking System </h1>
                                    <p>
                            </b>
                        </div>

                        <span>
                            <p>
                                <h5>{{ $title }}</h5>
                            </p>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(auth()->user()->type==1)
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="col-md-12 acting">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Time Created</th>
                    <th scope="col">Time Updated</th>
                    <th scope="col">Make User</th>
                    <th scope="col">Make Admin</th>
                    <th scope="col">Make Verifier</th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span
                            class="badge {{ $user->type == 1 ? 'badge-warning' :  ($user->type == 2 ? 'badge-success' : 'badge-danger') }}">{{ $user->type == 0 ? 'Normal User' :  ($user->type == 1 ? 'Administrator' : 'Verifier') }}</span>
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                    <td>
                        <form method="POST" action="{{ route('attach-user', $user->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-danger" type="submit">Make user</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('attach-admin', $user->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-warning" type="submit">Make Admin</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('attach-verifier', $user->id) }}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-success" type="submit">Make Verifier</button>
                        </form>
                    </td>
                </tr>
                @endforeach </tbody>
        </table>
    </div>
    @endif
</section>
@endsection