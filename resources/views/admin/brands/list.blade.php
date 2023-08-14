@extends('layouts.layout-admin')

@section('content')
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                            <i class="ti ti-bell-ringing"></i>
                            <div class="notification bg-primary rounded-circle"></div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('acp_assets/images/profile/user-1.jpg') }}" alt="" width="35"
                                    height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <p class="text-center">{{ Auth::guard('admin')->user()->email }}</p>
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">Mi Perfil</p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3">Mi Account</p>
                                    </a>
                                    <a href="{{ route('admin.logout') }}"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="row">
                
                @include('admin.messages.messagge')

                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-6">
                                    <small> BRANDS / LISTA  </small>
                                </div>
                                <div class="col-6">
                                    <div class="ms-auto" style="width: 150px;">
                                        <a href="{{ route('admin.brands.create')}}">
                                            <button class="btn btn-sm btn-info "><i class="ti ti-circle-plus"></i> NUEVO BRAND </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Lista brands</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <form action="" method="get">
                                        <div class="form-group pull-right">
                                            <input value="{{ Request::get('keyboard')}}" type="text" name="keyboard" style="width:25%; float:left;"class="search form-control float-right" placeholder="Busca la categoria">
                                            <button class="ms-2 btn btn-info float-right" type="submit"> BUSCAR </button> 
                                        </div>
                                    </form>
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Id</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Slug</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($brands->isNotEmpty())
                                            @foreach ( $brands as $brand )
                                                
                                            
                                                <tr>
                                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$brand->id}}</h6></td> 
                                                    <td class="border-bottom-0"> <h6 class="fw-semibold mb-0">{{$brand->name}}</h6> </td>
                                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$brand->slug}}</h6></td>
                                                    <td class="border-bottom-0" style="text-align: center;">
                                                    @if($brand->status == 1)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <svg class="text-success-500 h-6 w-6 text-success" style="width:24px; height:24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                    @else
                                                    <div class="d-flex align-items-center gap-2">
                                                        <svg style="width:24px; height:24px;" class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    @endif
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0 fs-4">
                                                            <a href="{{route('admin.brands.edit',$brand->id)}}">
                                                                <svg style="width:16px; height:16px;"  class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                                </svg>
                                                            </a> 
                                                            
                                                            <a href="#" onclick="deleteBrand({{$brand->id}});"  class="text-danger w-4 h-4 mr-1">
                                                                <svg style="width:16px; height:16px;"  wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path ath="" fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                  </svg>
                                                            </a></h6>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"> Ningun record encontrado! </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-5" style="width:100%">
                                {{$brands->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('customJS')
        <script type="text/javascript">         
            function deleteBrand(id) {
                var url = "{{ route('admin.brands.delete', 'ID') }}";
                var newUrl = url.replace("ID",id);
                
                if(confirm("Estas seguro que quieres eliminar este brand?")){
                    $.ajax({
                        url: newUrl,
                        type: 'delete', // Assuming you are trying to delete a category
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response['status']) {
                            } else {
                                window.location.href = "{{ route('admin.brands.index')}}";
                                // Handle the error case if needed
                            }
                        }
                    });
                }
            }
        </script>

    @endsection
@endsection