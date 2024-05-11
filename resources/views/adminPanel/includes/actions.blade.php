@if(isset($isEdit) && $isEdit)
<a href="{{ route($currentRoute.'.edit',$row->id) }}" title="Edit"><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text4 fw-bold"><i class="bi bi-pencil-square"></i></span></a>
@endif
@if(isset($isDelete) && $isDelete)
<a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.destroy', $row->id) }}" title="Delete" class="btn-delete-record"><span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text4 fw-bold"><i class="bi bi-trash"></i></span></a>
@endif
@if(isset($isView) && $isView)
<a href="{{ route($currentRoute.'.show',$row->id) }}" target="_blank" title="View"><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text4 fw-bold"><i class="bi bi-eye"></i></span></a>
@endif
@if(isset($isPayment) && $isPayment)
@if($row->is_paid)
<a title="Payment" data-bs-toggle="modal" data-date="{{$row->payment_date}}" data-type="{{$row->payment_type}}" data-detail="{{$row->payment_detail}}" data-bs-target="#invoicePaymentViewModel" data-id="{{$row->id}}" class="open-payment-view"><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text4 fw-bold"><i class="bi bi-cash"></i></span></a>
@else
<a title="Payment" data-bs-toggle="modal" data-bs-target="#invoicePaymentModel" data-id="{{$row->id}}" class="open-payment-form"><span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text4 fw-bold"><i class="bi bi-cash"></i></span></a>
@endif
@endif
@if(isset($isLocked) && $isLocked)
@if($row->is_lock)
<a title="Un Lock" data-id="{{ $row->id }}" href="{{ route($currentRoute.'.locking', ['id'=>$row->id]) }}" onclick="return confirm('Are you sure you want to un-lock this?')">
    <span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text4 fw-bold"><i class="bi bi-lock"></i></span></a>
@else
<a title="Lock" data-id="{{ $row->id }}" href="{{ route($currentRoute.'.locking', ['id'=>$row->id]) }}" onclick="return confirm('Are you sure you want to lock this?')">
<span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text4 fw-bold"><i class="bi bi-unlock"></i></span></a>
@endif
@endif
@if(isset($isInvoice) && $isInvoice)
@if($row->is_invoice == 0)
<a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.make-invoice', $row->id) }}" onclick="return confirm('Are you sure you want to make this as invoice?')" title="Make as invoice">
    <span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text4 fw-bold">Invoice<i class="bi bi-check2 ms-2"></i></span>
</a>
@endif
@endif
<div class="flex gap-4 items-center module-action">
    @if(isset($isViewModel) && $isViewModel)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.show', $row->id) }}" class="hover:text-info" id="viewModelBtn">
        <i class="bi bi-eye-fill me-3 fs-20"></i>
    </a>
    @endif
</div>