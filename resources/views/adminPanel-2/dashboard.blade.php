@extends('adminPanel-2.layout.appNew')

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
  <div class="col">
    <div class="card radius-10 border-0 border-start border-primary border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Orders</p>
            <h4 class="mb-0 text-primary">248</h4>
          </div>
          <div class="ms-auto widget-icon bg-primary text-white">
            <i class="bi bi-basket2-fill"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10 border-0 border-start border-danger border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Sales</p>
            <h4 class="mb-0 text-danger">25000</h4>
          </div>
          <div class="ms-auto widget-icon bg-danger text-white">
            <i class="bi bi-graph-down-arrow"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10 border-0 border-start border-warning border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total proforma</p>
            <h4 class="mb-0 text-warning">50</h4>
          </div>
          <div class="ms-auto widget-icon bg-warning text-dark">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10 border-0 border-start border-success border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Revenue</p>
            <h4 class="mb-0 text-success">75000</h4>
          </div>
          <div class="ms-auto widget-icon bg-success text-white">
            <i class="bi bi-currency-rupee"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
   </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="d-flex align-items-center">
          <div class="">
            <h6 class="mb-0 fw-bold">Sales Overview Daily</h6>
          </div>
          <!-- <div class="dropdown ms-auto">
            <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="javascript:;">Action</a>
              </li>
              <li><a class="dropdown-item" href="javascript:;">Another action</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:;">Something else here</a>
              </li>
            </ul>
          </div> -->
        </div>
      </div>
      <div class="card-body">
           <div id="chart1"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="d-flex align-items-center">
          <div class="">
            <h6 class="mb-0 fw-bold">Sales Overview Weekly</h6>
          </div>
          <!-- <div class="dropdown ms-auto">
            <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="javascript:;">Action</a>
              </li>
              <li><a class="dropdown-item" href="javascript:;">Another action</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:;">Something else here</a>
              </li>
            </ul>
          </div> -->
        </div>
      </div>
      <div class="card-body">
           <div id="chart2"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-12 col-lg-12 col-xl-6">
       <div class="card">
        <div class="card-header bg-transparent">
          <div class="d-flex align-items-center">
            <div class="">
              <h6 class="mb-0 fw-bold">Sales Overview Monthly</h6>
            </div>
          </div>
         </div>
         <div class="card-body">
            <div id="chart3"></div>
         </div>
       </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="d-flex align-items-center">
            <div class="">
              <h6 class="mb-0 fw-bold">Sales Overview Yearly</h6>
            </div>
            <!-- <div class="dropdown ms-auto">
              <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div> -->
          </div>
        </div>
        <div class="card-body">
          <div id="chart4"></div>
        </div>
      </div>
   </div>
</div>
<div class="row">
  @foreach($records as  $udata)
  <div class="col-lg-12 col-sm-3 col-xl-3">
    <div class="card overflow-hidden">
      <div class="profile-cover bg-dark position-relative mb-4">
        <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
          <img src="{{ asset('public/admin-theme/assetsNew-2/images/avatars/user-icon.png')}}" alt="...">
        </div>
      </div>
      <div class="card-body">
        <div class="mt-5 d-flex align-items-start justify-content-between">
          <div class="">
            <h6 class="mb-2 menu-title">Name : {{$udata->name}}</h6>
            <h6 class="mb-2 menu-title">Id : #{{$udata->id}}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection