<div class="flex gap-4 items-center module-action">
    @if(isset($isEdit) && $isEdit)
    <a href="{{ route($currentRoute.'.edit',$row->id) }}" title="Edit" class="">
        <span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span>
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
    @if(isset($isView) && $isView)
    <a href="{{ route($currentRoute.'.show',$row->id) }}" target="_blank" title="View" class="btn btn-xs btn-pink">
        <i class="ri-eye-line"></i>
    </a>
    @endif
    @if(isset($isInvoice) && $isInvoice)
    @if($row->is_invoice == 0)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.make-invoice', $row->id) }}" onclick="return confirm('Are you sure you want to make this as invoice?')" title="Make as invoice">
        <span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">Invoice<i class="bi bi-check2 ms-2"></i></span>
    </a>
    @endif
    @endif
</div>