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
            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-6">
                                    <small> BRANDS / EDITA  </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" id="brandForm" name="brandForm">
                                    
                                    <div class="mb-3">
                                        <label for="brandname" class="form-label">Titolo</label>
                                        <input type="text" name="name" class="form-control" id="brandname" aria-describedby="brandHelp" value="{{$brand->name}}">
                                        <p></p>
                                        <div id="brandHelp" class="form-text">Pon el nombre del brand.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="brandslug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="brandslug" aria-describedby="brandSlugHelp" readonly value="{{$brand->slug}}">
                                        <p></p>
                                        <div id="brandSlugHelp" class="form-text">Pon el slug del brand.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="brandstatus" name="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" id="brandstatus" aria-describedby="brandStatusHelp">
                                            <option {{($brand->status == 1) ? 'selected' : ''}} value="1">Activa</option>
                                            <option {{($brand->status == 0) ? 'selected' : ''}} value="0">Bloqueada</option>
                                        </select>
                                        <div id="brandStatusHelp" class="form-text">Elige el estado del brand</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edita</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('customJS')
        <script>      

            $("#brandForm").submit(function(event){
                event.preventDefault();
                var element = $(this);
                $.ajax({
                    url: '{{ route("admin.brands.update", $brand->id) }}',
                    type:'put',
                    data: element.serializeArray(),
                    dataType:'json',
                    success: function(response){

                        if(response["status"] == true){
                            $('#brandname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            $('#brandslug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(""); 

                        }else{
                            window.location.href = response["redirect"];
                            $('button').filter('[type="submit"]').prop('disabled', true);
                            
                            var errors = response['errors'];
                            if(errors['name']){
                                $('#brandname').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                            }else{
                                $('#brandname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }


                            if(errors['slug']){
                                $('#brandslug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                                
                            }else{
                                $('#brandslug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }

                        }

                    },
                    error: function(jqXHR, exception){
                        console.log('Algo ha ido mal');
                    }

                })
            })

            $("#brandname").change(function(){
                element = $(this);
                $('button').filter('[type="submit"]').prop('disabled', true);
                $.ajax({
                    url: '{{ route("getSlug") }}',
                    type:'get',
                    data: {title: element.val()},
                    dataType:'json',
                    success: function(response){
                        $('button').filter('[type="submit"]').prop('disabled', false);
                        if(response['status'] == true){
                            $("#brandslug").val(response["slug"]);
                        }
                    }
                });
            })

        </script>
    @endsection
@endsection
