<!--breadcrumb-->
@if(isset($breadcrumb))
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ (isset($page_title)?$page_title:'' ) }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                @foreach($breadcrumb as $bkey => $b_value)
                    <?php end($breadcrumb); ?>
                    @if($bkey==key($breadcrumb))
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        <li class="breadcrumb-item active" aria-current="page">{{$bkey}}</li>
                    @elseif($b_value!="")
                        <li class="breadcrumb-item"><a href="{{url($b_value)}}">{{$bkey}}</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$bkey}}</a></li>
                    @endif
                @endforeach
                </li>
            </ol>
        </nav>
    </div>
</div>
@endif
<!--end breadcrumb-->
