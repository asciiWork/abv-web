@extends('adminPanel.layouts.app')
@section('adminStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/assets/css/file-upload-with-preview.min.css')}}" />
<style type="text/css">
.custom-file-container .image-cus {
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 4px;
    box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25);
    float: left;
    height: 180px;
    margin: 1.858736059%;
    position: relative;
    transition: background 0.2s ease-in-out, opacity 0.2s ease-in-out;
    width: 29.615861214%;
}
.custom-file-container .image-cus-clear {
    background: #edede8;
    border-radius: 50%;
    box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25);
    height: 20px;
    left: -6px;
    margin-top: -6px;
    position: absolute;
    text-align: center;
    transition: background 0.2s ease-in-out, color 0.2s ease-in-out;
    width: 20px;
}
.custom-file-container .image-cus-clear-icon {
    color: #333;
    display: block;
    margin-top: 0!important;
    cursor: pointer;
}
</style>
@endsection
@section('adminContent')
<div>
    <div class="panel">
    	 <div class="mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Add Product</h5>
    	 	{!! Form::model($formObj,['method' => $method,'enctype' => 'multipart/form-data', 'route' => [$action_url,$action_params],'class' => 'space-y-5', 'id' => 'submitfrm']) !!} 
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label>Select Category</label>
                        {!! Form::select('category_id',['' => 'select Category']+$category,null,['class' => 'form-select text-white-lighr', 'data-required' => true,'id'=>'id']) !!}
                    </div>
                    <div>
                        <label>Product name</label>
                        {!! Form::text('product_name',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Enter Product Name']) !!}
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label>Product Minimum Price</label>
                        {!! Form::text('product_min_price',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Enter Minimum Price']) !!}
                    </div>
                    <div>
                        <label>Product Maximum Price</label>
                        {!! Form::text('product_max_price',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Enter Maximum Price']) !!}
                    </div>
                </div>
                <div>
                    <label>Product Detail</label>
                    {!! Form::textarea('product_detail',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Procuct Detail']) !!}
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label>Product Dimension (Ex. : Cutting Dia. * Cutting Length * Shank Dia.* Total Length)</label>
                        {!! Form::text('product_dimension',null,['class' => 'form-input flex-1', 'data-required' => true,'autocomplete'=>'off','placeholder'=>'Product dimension like :(Cutting Dia. * Cutting Length * Shank Dia.* Total Length)']) !!}
                    </div>
                    <div>
                        <label>Size In MM</label>
                        {!! Form::select('size_in_mm',['' => 'Select Seze In MM']+$size_in_mm,null,['class' => 'form-select text-white-lighr', 'data-required' => true,'id'=>'id']) !!}
                    </div>
                </div>
                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
                <div class="mt-8" x-data="invoiceAdd">
                    <div class="text-lg font-semibold">Product Size</div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th class="w-1">Product Size(Ex. 3*12*4*30)</th>
                                    <th class="w-1">List Price</th>
                                    <th class="w-1">Offer Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="items.length <= 0">
                                    <tr>
                                        <td colspan="4" class="!text-center font-semibold">No Item Available</td>
                                    </tr>
                                </template>
                                <template x-for="(item, i) in items" :key="i">
                                    <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                        <td>
                                            <input name="product_code[]" type="text" class="form-input min-w-[200px]" placeholder="Product Code" x-model="item.product_code"/>
                                        </td>
                                        <td>
                                            <input name="product_size[]" type="text" class="form-input min-w-[200px]" placeholder="Product Size(3*12*4*30)" x-model="item.product_size"/>
                                        </td>
                                        <td>
                                            <input name="product_old_price[]" type="text" class="form-input min-w-[200px]" placeholder="Enter List Price" x-model="item.product_old_price"/>
                                        </td>
                                        <td>
                                            <input name="product_current_price[]" type="text" class="form-input min-w-[200px]" placeholder="Enter Offer Price" x-model="item.product_current_price"/>
                                            <input type="hidden" name="image_id[]" x-model="item.image_id">
                                        </td>
                                        <td>
                                            <button type="button" @click="removeItem(item)">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24px"
                                                    height="24px"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="h-5 w-5"
                                                >
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                        <td>
                                            <input name="product_code[]" type="text" class="form-input min-w-[200px]" placeholder="Product Code" x-model="item.product_code"/>
                                        </td>
                                        <td>
                                            <input name="product_size[]" type="text" class="form-input min-w-[200px]" placeholder="Product Size(3*12*4*30)" x-model="item.product_size"/>
                                        </td>
                                        <td>
                                            <input name="product_old_price[]" type="text" class="form-input min-w-[200px]" placeholder="Enter List Price" x-model="item.product_old_price"/>
                                        </td>
                                        <td>
                                            <input name="product_current_price[]" type="text" class="form-input min-w-[200px]" placeholder="Enter Offer Price" x-model="item.product_current_price"/>
                                        </td>
                                        <td>
                                            <button type="button" @click="removeItem(item)">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24px"
                                                    height="24px"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="h-5 w-5"
                                                >
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex flex-col justify-between px-4 sm:flex-row">
                        <div class="mb-6 sm:mb-0">
                            <button type="button" class="btn btn-primary" @click="addItem()">Add Item</button>
                        </div>
                    </div>
                </div>                
                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
                <div class="mt-8 px-4">
                    <div class="text-lg font-semibold">Product Images</div>
                    <div class="flex flex-col sm:flex-row">
                    	<div class="custom-file-container flex-1" data-upload-id="myFirstImage">
                        </div>
                    </div>
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
	var redirecturl="{{route('admin-products.index')}}";
	if ('{{$formObj->cat_img}}') {
		var imgurl = "<?=asset('web/assets/img/categories/'.$formObj->cat_img)?>";
	}
	var upload=new FileUploadWithPreview.FileUploadWithPreview('myFirstImage', {
        images: {
            baseImage: '',
            backgroundImage: '',
        },
        multiple: true,
        text: {
            browse: 'Add More Images',
            selectedCount: 'Files Added',
        },
    });
    //Add images
    <?php if (isset($proImg)): ?>
        var $customDiv = $('label.input-container').eq(0);
        <?php foreach ($proImg as $key => $value): ?>        
        $customDiv.after('<div id="img_<?=$value->id?>"><div class="image-cus" style="background-image: url(&quot;<?=asset('web/assets/img/product/main-product/'.$value->product_img_url)?>&quot);"><span class="image-cus-clear"><span class="image-cus-clear-icon" data-id="<?=$value->id?>" >×</span></span></div></div>');
        <?php endforeach ?>
    <?php endif ?>

    //Remove image
    $('.image-cus-clear-icon').on('click', function(){
        var id=$(this).data('id');
        var url="{{ route('admin-products.destroy',0) }}";
        $.ajax({
            type: "DELETE",
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'imgId':id},
            enctype: 'multipart/form-data',
            success: function(result) {
                if (result.status == 1) {
                    $('.image-cus-clear-icon').closest("#img_"+id).remove();
                }
            },
            error: function(error) {
                $('#AjaxLoaderDiv').fadeOut('slow');
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
    });
    document.forms[0].addEventListener("submit", async function (e) {
	    e.preventDefault();
	    const url = this.getAttribute("action"); // grab endpoint from HTML
	    const fd = new FormData();   // create FormData object
	    upload.cachedFileArray.forEach((file, i) => {
	        fd.append("files[]", file); // append each file to FormData object
	    });
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
                $('#AjaxLoaderDiv').fadeOut('slow');
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
                $('#submit-form #submit-form-button').attr('disabled', false);
            }
        });
	});

    document.addEventListener('alpine:init', () => {
        Alpine.data('invoiceAdd', () => ({
            items: [],
            selectedFile: null,
            
            init() {
                //set default data
                <?php if (isset($proSize)): ?>
                    <?php foreach ($proSize as $key => $ps): ?>
                        this.items.push({
                            id: '<?=$key+1?>',
                            image_id: '<?=$ps->id?>',
                            product_code: '<?=$ps->product_code?>',
                            product_size: '<?=$ps->product_size?>',
                            product_old_price: '<?=$ps->product_old_price?>',
                            product_current_price: '<?=$ps->product_current_price?>',
                        });
                    <?php endforeach ?>                    
                <?php else: ?>
                    this.items.push({
                        id: 1,
                        image_id: '',
                        product_code: '',
                        product_size: '',
                        product_old_price: '',
                        product_current_price: '',
                    });
                <?php endif ?>
            },
            addItem() {
                let maxId = 0;
                if (this.items && this.items.length) {
                    maxId = this.items.reduce((max, character) => (character.id > max ? character.id : max), this.items[0].id);
                }
                this.items.push({
                    id: maxId + 1,
                    product_code: '',
                    product_size: '',
                    product_old_price: 0,
                    product_current_price: 0,
                });
            },

            removeItem(item) {
                this.items = this.items.filter((d) => d.id != item.id);
            },
        }));
    });
</script>
@endsection