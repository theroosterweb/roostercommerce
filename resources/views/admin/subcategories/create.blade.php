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
                                    <small> SUB-CATEGORIAS / CREA  </small>
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
                                <form action="" id="subCategoryForm" name="subCategoryForm">
                                    
                                    <div class="mb-3">
                                        <label for="categoryfather" name="categoryfather" class="form-label">Categoria Padre</label>
                                        <select name="categoryfather" class="form-control" id="categoryfather" aria-describedby="statusHelp">
                                            <option value="" active>Selecciona una categoria padre:</option>
                                            @if($categories->isNotEmpty())
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach        
                                            @endif
                                        </select>
                                        <p></p>
                                        <div id="categoryFatherHelp" class="form-text">Elige una categoria padre</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subcategoryname" class="form-label">Titolo</label>
                                        <input type="text" name="name" class="form-control" id="subcategoryname" aria-describedby="categoryHelp">
                                        <p></p>
                                        <div id="subcategoryHelp" class="form-text">Pon el nombre de la sub-categoria.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="subcategoryslug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="subcategoryslug" aria-describedby="slugHelp" readonly>
                                        <p></p>
                                        <div id="slugHelp" class="form-text">Pon el slug de la sub-categoria.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subcategorystatus" name="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" id="subcategorystatus" aria-describedby="statusHelp">
                                            <option value="1">Activa</option>
                                            <option value="0">Bloqueada</option>
                                        </select>
                                        <div id="statusHelp" class="form-text">Elige el estado de la sub-categoria</div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Crea</button>
                                
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
            $("#subCategoryForm").submit(function(event){

                event.preventDefault();
                
                var element = $("#subCategoryForm");
                
                $.ajax({
                    url: '{{ route("admin.subcategories.store") }}',
                    type:'post',
                    data: element.serializeArray(),
                    dataType:'json',
                    success: function(response){

                        if(response["status"] == true){
                            
                            window.location.href = '{{route("admin.subcategories.index")}}';

                            $('#subcategoryname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            $('#subcategoryslug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(""); 
                            $('#categoryfather').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }else{
                            
                            window.location.href = '{{route("admin.subcategories.index")}}';

                            $('button').filter('[type="submit"]').prop('disabled', true);
                            
                            var errors = response['errors'];

                            if(errors['name']){
                                $('#subcategoryname').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                            }else{
                                $('#subcategoryname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }


                            if(errors['slug']){
                                $('#subcategoryslug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                                
                            }else{
                                $('#subcategoryslug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }

                            if(errors['categoryfather']){
                                $('#categoryfather').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['categoryfather']);
                                
                            }else{
                                $('#categoryfather').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }

                        }

                    },
                    error: function(jqXHR, exception){
                        console.log('Algo ha ido mal');
                    }

                })
            })

            $("#subcategoryname").change(function(){
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
                            $("#subcategoryslug").val(response["slug"]);
                        }
                    }
                });
            })

        </script>
    @endsection
@endsection
