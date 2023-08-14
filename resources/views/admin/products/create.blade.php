@extends('layouts.layout-admin')

@section('content')
    
    <div class="body-wrapper">
    
        <header class="app-header mb-5">
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

        <form action="" method="POST" name="productForm" id="productForm">
            <input type="hidden" name="source_view" value="product_create">
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small> PRODUCTO / CREA  </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        
                        <!-- Titolo Slug y Descripcion -->
                        <div class="card mb-3">
                            <div class="card-body">								
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Titolo</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Titolo">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">	
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Descripcion</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Descripcion"></textarea>
                                            <p class="error"></p>
                                        </div>
                                    </div>                                            
                                </div>
                            </div>	                                                                      
                        </div>

                        <!-- Image Uploader -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Media</h2>								
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">    
                                        <br>Arrastra el file aqui para hacer el upload.<br><br>                                            
                                    </div>
                                </div>
                            </div>	                                                                      
                        </div>

                        <div id="product_gallery"></div>

                        <!-- Precios -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Precios</h2>								
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Precio</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                            <p class="error"></p>	
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                            </p>	
                                        </div>
                                    </div>                                            
                                </div>
                            </div>	                                                                      
                        </div>

                        <!-- Inventario -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>								
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                        </div>
                                    </div>   
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" name="track_qty" value="no">
                                                <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" checked>
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">	
                                            <p class="error"></p>
                                        </div>
                                    </div>                                         
                                </div>
                            </div>	                                                                      
                        </div>

                    </div>

                    <div class="col-md-4">
                        
                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Estado del Producto</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected >Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="card">
                            <div class="card-body">	
                                <h2 class="h4  mb-3">Categoria del Producto</h2>
                                <div class="mb-3">
                                    <label for="category">Categoria</label>
                                    <select name="category" id="category" class="form-control">
                                        <option selected value="">Selecciona una categoria</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub categoria</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Selecciona una subcategoria</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Brand del producto</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Selecciona un brand</option>
                                        @if ($brands->isNotEmpty())
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>                                                
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">	
                                <div>
                                  
                                        <button type="submit" class="btn btn-primary">CREA</button> 

                                        <button class="btn btn-danger">Cancela</button>    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </form>
    </div>
    @section('customJS')
    <script>

        $('#productForm').submit(function(event){
            event.preventDefault();

            var formArray = $(this).serializeArray();

            $("button[type='submit']").prop('disabled',true);

            $.ajax({
                url: '{{route("admin.products.store")}}',
                type: 'post',
                data: formArray,
                dataType: 'json',
                success: function(response){
                    $("button[type='submit']").prop('disabled',false);
                    if(response['status'] == true){

                    }else{
                        var errors = response['errors'];

                        $(".error").removeClass('invalid-feedback').html("");
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                        $.each(errors, function(key,value){
                            $(`#${key}`).addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(value);
                        });
                    }
                },
                error: function(){console.log('Algo ha ido mal')},
            });
        });

        $("#title").change(function(){
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
                        $("#slug").val(response["slug"]);
                    }
                }
            });
        })

        $('#category').change(function () {
            var category_id = $(this).val();
            $.ajax({
                url: '{{route("admin.product-subcategories.index")}}',
                type: 'get',
                data: {category_id:category_id},
                dataType: 'json',
                success: function(response){
                    //console.log(response);
                    $('#sub_category').find('option').not(":first").remove();
                    $.each(response["subCategories"],function(key,item){
                        $('#sub_category').append(`<option name='${item.id}'>${item.name}</option>`);
                    });  
                },
                error: function(){console.log('Algo ha ido mal')},
            });
        })

        Dropzone.autoDiscover = false;    
        $(function () {
            // Summernote
            $('.summernote').summernote({
                height: '300px'
            });

            const dropzone = $("#image").dropzone({ 
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },

                url:  "{{route('temp-images.create')}}",
                maxFiles: 10,
                paramName: 'image',
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, success: function(file, response){
                    //$("#image_id").val(response.image_id);
                    //console.log(response)

                    var html = `
                    <div class="card" style="width: 18rem;">
                        <img src="${response.ImagePath}" class="card-img-top" alt="...">
                        <div class="card-body">
                           <a href="#" class="btn btn-danger">Borrar</a>
                        </div>
                    </div>`;

                    $("#product_gallery").append(html);
                }
            });

        });

    </script>
    @endsection

@endsection

