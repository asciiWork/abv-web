@if(isset($breadcrumb))
<ul class="flex space-x-2 rtl:space-x-reverse">
  <li>
      <a href="{{route('admin-dashboard')}}" class="text-primary hover:underline">Dashboard</a>
  </li>
  <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
      <span>{{ (isset($breadcrumb))?$breadcrumb:'page'  }}</span>
  </li>
</ul>
@endif