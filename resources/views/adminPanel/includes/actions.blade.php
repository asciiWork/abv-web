<div class="flex gap-4 items-center module-action">
    @if(isset($isEdit) && $isEdit)
    <a href="{{ route($currentRoute.'.edit',$row->id) }}" title="Edit" class="btn btn-xs btn-primary">
        <i class="ri-edit-line"></i>
    </a>
    @endif
    @if(isset($isDelete) && $isDelete)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.destroy', $row->id) }}" title="Delete" class="text-reset fs-16 px-1 btn-delete-record"> <i class="ri-delete-bin-2-line"></i></a>
    @endif
    @if(isset($isViewModel) && $isViewModel)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.show', $row->id) }}" class="hover:text-info" id="viewModelBtn">
        <i class="bi bi-eye-fill me-3 fs-20"></i>
    </a>
    @endif
    @if(isset($isDownload) && $isDownload)
    <a href="{{ route($currentRoute.'.download-invoice', $row->id) }}" class="btn btn-xs btn-purple" title="Download PDF">
        <i class="bi bi-download"></i>
    </a>
    @endif
    @if(isset($isInvoice) && $isInvoice)
    @if($row->is_invoice == 0)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.make-invoice', $row->id) }}" onclick="return confirm('Are you sure you want to make this as invoice?')" title="Make as invoice" class="btn btn-xs btn-warning">
        <i class="ri-file-2-line"></i>
    </a>
    @endif
    @endif
</div>