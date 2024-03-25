<div class="flex gap-4 items-center module-action">
    @if(isset($isEdit) && $isEdit)
    <a href="{{ route($currentRoute.'.edit',$row->id) }}" title="Edit" class="text-reset fs-16 px-1"> <i class="ri-edit-line"></i></a>
    @endif
    @if(isset($isDelete) && $isDelete)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.destroy', $row->id) }}"  title="Delete" class="text-reset fs-16 px-1 btn-delete-record"> <i class="ri-delete-bin-2-line"></i></a>
    @endif
    @if(isset($isViewModel) && $isViewModel)
    <a data-id="{{ $row->id }}" href="{{ route($currentRoute.'.show', $row->id) }}" class="hover:text-info" id="viewModelBtn">
        <i class="bi bi-eye-fill me-3 fs-20"></i>
    </a>
    @endif
</div>