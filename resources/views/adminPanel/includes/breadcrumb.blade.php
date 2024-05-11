<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ (isset($page_title)?$page_title:'' ) }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            @if(isset($breadcrumb))
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                @foreach($breadcrumb as $bkey => $b_value)
                <?php end($breadcrumb); ?>
                @if($bkey==key($breadcrumb))
                <li class="breadcrumb-item active" aria-current="page">{{$bkey}}</li>
                @elseif($b_value!="")
                <li class="breadcrumb-item" aria-current="page">{{$bkey}}</li>
                @else
                <li class="breadcrumb-item" aria-current="page">{{$bkey}}</li>
                @endif
                @endforeach
            </ol>
            @endif
        </nav>
    </div>
</div>
<div id="successAlert" class="alert border-0 bg-success-subtle alert-dismissible fade" style="display: none;">
    <div class="d-flex align-items-center">
      <div class="text-success" id="successMessage"></div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div id="errorAlert" class="alert border-0 bg-danger-subtle alert-dismissible fade" style="display: none;">
    <div class="d-flex align-items-center">
      <div class="text-danger" id="errorMessage"></div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>