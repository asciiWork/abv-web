@extends('adminPanel.layouts.app')
@section('adminStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/assets/css/file-upload-with-preview.min.css')}}" />
@endsection
@section('adminContent')
<div>
    <div class="panel">
    	 <div class="mb-5">
    	 	{!! Form::model($formObj,['method' => $method,'enctype' => 'multipart/form-data', 'route' => [$action_url,$action_params],'class' => 'space-y-5', 'id' => 'submitfrm']) !!} 
                <div class="flex flex-col sm:flex-row">
                    <label class="mb-0 rtl:ml-2 sm:w-1/4 sm:ltr:mr-2">Category name</label>
                    {!! Form::text('category_name',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Enter Category Name']) !!}
                </div>
                <div class="flex flex-col sm:flex-row">
                	<label class="mb-0 rtl:ml-2 sm:w-1/4 sm:ltr:mr-2">Select Image</label>
                	<div class="custom-file-container flex-1" data-upload-id="myFirstImage"></div>
                </div>
                <input type="submit" name="submit" value="Save" class="btn btn-primary !mt-6">
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('adminscript')
<script src="{{ asset('admin-theme/assets/js/file-upload-with-preview.iife.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var img='Choose file...';
	var imgurl='';
	var redirecturl="{{route('admin-category.index')}}";
	if ('{{$formObj->cat_img}}') {
		var imgurl = "<?=asset('web/assets/img/categories/'.$formObj->cat_img)?>";
		var img = '{{$formObj->cat_img}}';
	}
	var upload=new FileUploadWithPreview.FileUploadWithPreview('myFirstImage', {
        images: {
            baseImage: imgurl,
            backgroundImage: '',
        },
        text: {
		    chooseFile: img,
		 },
    });
	
	document.forms[0].addEventListener("submit", async function (e) {
	    e.preventDefault();
	    const url = this.getAttribute("action"); // grab endpoint from HTML
	    const fd = new FormData();   // create FormData object
	    fd.append("files", upload.cachedFileArray[0]);
	    /*upload.cachedFileArray.forEach((file, i) => {
	        fd.append("files[]", file); // append each file to FormData object
	    });*/
	    this.querySelectorAll("input[name], select, textarea").forEach(el => {
	        fd.append(el.getAttribute("name"), el.value);
	    });
	    $.ajax({
            type: "POST",
            url: url,
            data: fd,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function(result) {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1) {
                	const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: 'success',
                        title: result.msg,
                        padding: '10px 20px',
                    });
                    window.location = redirecturl;
                } else {
                	const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: 'error',
                        title: result.msg,
                        padding: '10px 20px',
                    });
                }
                $('#submit-form #submit-form-button').attr('disabled', false);
            },
            error: function(error) {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                });
                toast.fire({
                    icon: 'error',
                    title: "Internal server error !",
                    padding: '10px 20px',
                });
            }
        });
	    // const response = await fetch(url, {
	    //     method: 'POST',
	    //     body: fd
	    // });
	    // optional processing of server response
	    //const text = await response.text();
	    //console.log('Success:', response);
	    // what happens after upload here
	    //location = "https://google.com"; // navigate to Google
	});
</script>
@endsection