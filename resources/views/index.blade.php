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
                        <h5>Please upload the file to be verified by the administrator and we will get back to you
                            shortly</h5>
                        @endguest

                    </div>
                </div>

            </div>
        </div>
    </div>
    @auth
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
    @endauth
    @auth
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dropzone.min.js')}}" type="text/javascript"></script>
    <script type='text/javascript'>
        $('#went').hide();
        $('#notwent').hide();
        $('#proc').hide();
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", {
        autoProcessQueue: false,
        parallelUploads: 10 // Number of files process at a time (default 2)
        });

        myDropzone.on('sending', function(file, xhr, formData){
        formData.append('verifier_id', $('#verifier').val());
        });
        
        myDropzone.on('error', function(){
        $('#notwent').show();
        $('#proc').hide();
        $('#notwell').text("We encountered some errors while uploading your document, make sure you uploaded the required format or contact support if the problem persists");
        });

        myDropzone.on('success', function(){
        $('#went').show();
        $('#proc').hide();
        $('#well').text("We have successfully recieved your file upload and we will get back to you shortly");
        });

        myDropzone.on('processing', function(){
        $('#proc').show();
        $('#procwell').text("We are uploading your file...");
        });

        $('#uploadfiles').click(function(){
        myDropzone.processQueue();
        
        });
    </script>
    @endauth
</section>
@endsection