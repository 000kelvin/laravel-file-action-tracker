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