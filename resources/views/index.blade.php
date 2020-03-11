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

                        @guest
                        <span>
                            <p>
                                <h5>You are required to Login or Register before you can be granted rights to
                                    any file action on this system</h4>
                            </p>
                        </span>

                        <div class="links s-info">
                            <a href="{{ route('login') }}">Login</a> ||
                            <a href="{{ route('register') }}">Register</a>
                        </div>

                        @else
                        @if (auth()->user()->type == 1)
                        <span>
                            <p>
                                <h5>Welcome admin, your role is to match all open requests to their respective parties
                                    for verification, click the URL below to view all open requests</h5>
                            </p>
                        </span>

                        <div class="links s-info">
                            <a href="{{ route('upload-pending') }}">Match Pending Requests</a>
                        </div>

                        @else
                        <span>
                            <p>
                                <h5>Please upload the file to be verified by the administrator and we will get back to
                                    you
                                    shortly</h5>
                            </p>
                        </span>
                        @endif
                        @endguest

                    </div>
                </div>

            </div>
        </div>
    </div>
    @auth
    @if(auth()->user()->type == 0)
    <div class="col-md-12 acting">
        <div class="alert alert-success alert-block" id="went">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong id="well"></strong>

        </div>
        <div class="alert alert-warning alert-block" id="proc">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong id="procwell"></strong>

        </div>
        <div class="alert alert-danger alert-block" id="notwent">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong id="notwell"></strong>

        </div>

        <form action="{{ route('upload-action') }}" class="dropzone" style="height: 330px;">
            {{ csrf_field() }}
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
            <small class="form-text text-muted">Please upload a valid text, pdf, docx or image file. The size of your
                upload should not exceed 5MB.</small>
        </form>

        <br>
        <div class="who">
            <label for="verifier">Who should recieve the document(s)?: </label>
            <select name="verifier" class="verifier" id="verifier">
                @foreach ($verifiers as $verifier)
                <option value="{{ $verifier->id }}">{{ $verifier->name }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <input type="button" id='uploadfiles' value='Upload Files'>

    </div>
    @endif
    @endauth

</section>
@endsection