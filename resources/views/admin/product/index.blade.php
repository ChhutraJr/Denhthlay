@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <h4 class="m-t-0 header-title">Products</h4>
            <div class="col-md-12">
                <button class="btn btn-primary waves-effect waves-light pull-right btn-lg" data-toggle="modal" data-target="#con-close-modal"><span class="fa fa-plus-circle btn-add-new"></span> Add New</button>
                <div id="con-close-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-product">
                                {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add New Product</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Title <span class="req">*</span></label>
                                                <input type="text" class="form-control input-name" name="title" id="title" placeholder="Enter Title...">
                                                <span class="text-danger">
                                                   <strong id="name-error"></strong>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label class="control-label">Category <span class="req">*</span></label>
                                                <select class="form-control select2 input-cat" id="select2" name="category" data-placeholder="Select a category..." data-tabindex="1">
                                                    <option value=""></option>
                                                    @foreach($cats as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                   <strong id="cat-error"></strong>
                                                </span>
                                            </div>



                                        </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Price <span class="req">*</span></label>
                                            <input type="text" class="form-control input-price" id="price" name="price"  placeholder="Enter Price...">
                                            <span class="text-danger">
                                                   <strong id="price-error"></strong>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date <span class="req">*</span></label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-end-date" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="end_date" >
                                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                    </div><!-- input-group -->
                                                </div>
                                                <span class="text-danger">
                                                   <strong id="end-date-error"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Time <span class="req">*</span></label>
                                                <div>
                                                    <div class="input-group clockpicker m-b-20" data-placement="bottom" data-align="top" data-autoclose="true">
                                                        <input type="text" class="form-control input-end-time"  name="end_time" placeholder="00:00">
                                                        <span class="input-group-addon"> <span class="mdi mdi-clock"></span> </span>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                   <strong id="end-time-error"></strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description <span class="req">*</span></label>
                                            <div class="summernote input-des" id="des">

                                            </div>
                                            <span class="text-danger">
                                                   <strong id="des-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Delivery Info <span class="req">*</span></label>
                                            <div class="summernote input-delivery" id="delivery">

                                            </div>
                                            <span class="text-danger">
                                                   <strong id="delivery-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img class="img-rounded" id="pic" width="25px" /> <label class="control-label">Image <span class="req">*</span></label>
                                            <input type="file" class="filestyle input-image" data-buttontext="Select file" name="image" id="image" data-buttonname="btn-default" onchange="readURL(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="image-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button class="btn btn-info waves-effect waves-light" id="btn-save">Save</button>
                            </div>
                            </form>

                        </div>

                    </div>
                </div><!-- /.modal -->
            </div>

            </div>

            <table id="datatable-responsive"
                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Delivery Info</th>
                    <th>History</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                   <!-- <td style="text-align: center"><img src="{url('storage/'.$item->icon)}}" alt="" class="img-circle" width="25px"></td>
                    -->
                    <td>
                        <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="35px">

                    </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->cat->name}}</td>
                    <td>{{ number_format($item->price, 0) }} KHR</td>
                    <td style="text-align: center">
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#des-{{$item->id}}"><i class="glyphicon  glyphicon-comment "></i></a>
                    </td>
                    <td style="text-align: center">
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#delivery-{{$item->id}}"><i class="glyphicon glyphicon-road "></i></a>
                    </td>
                    <td style="text-align: center">
                        <a target="_blank" href="{{url('/system/products/history/'.$item->id)}}" style="outline: none;" >{{$item->auctions->count()}} <i class="glyphicon glyphicon-time "></i></a>
                    </td>
                    <td>{{$item->view}}</td>

                    <td>

                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#edit-{{$item->id}}"><i class="glyphicon glyphicon-pencil btn-edit edit-cl"></i>Edit</a>
                        <!--<a href="{url('system/categories/sub/'.$item->id)}}"><i class="glyphicon glyphicon-th-large"></i></a>-->
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#delete-{{$item->id}}"><i class="glyphicon glyphicon-trash btn-delete delete-cl"></i>Delete</a>

                    </td>

                </tr>

                <!--Update-->
                <div class="modal fade modal-danger" id="edit-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update: <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="25px"> {{$item->name}}</h4>
                            </div>

                            <div class="modal-body">
                                Continue ?
                            </div>

                            <div class="modal-footer">
                                <form action="{{ url('/system/products/update/'.$item->id) }}" method="GET">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--Delete-->
                    <div class="modal fade modal-danger" id="delete-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Delete: <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="25px"> {{$item->name}}</h4>
                                </div>

                                <div class="modal-body">
                                    Continue ?
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ url('/system/products/delete') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="delete_id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="modal fade modal-danger" id="des-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Description : <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="25px"> {{$item->name}}</h4>
                            </div>

                            <div class="modal-body">
                               {!! $item->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade modal-danger" id="delivery-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Delivery Info : <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="25px"> {{$item->name}}</h4>
                            </div>

                            <div class="modal-body">
                                {!! $item->delivery_info !!}
                            </div>
                        </div>
                    </div>
                </div>


                  @endforeach

                </tbody>
            </table>
        </div>

@endsection

@section('data')
    <script type="text/javascript">
        $('#pic').fadeOut();
        $('#select2').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        var btnSave= $('#btn-save');
        btnSave.click(function (e) {
            e.preventDefault();


            has_errors('.input-name', '#name-error');
            has_errors('.input-cat', '#cat-error');
            has_errors('.input-price', '#price-error');
            has_errors('.input-end-date', '#end-date-error');
            has_errors('.input-end-time', '#end-time-error');
            has_errors('.input-des', '#des-error');
            has_errors('.input-delivery', '#delivery-error');
            has_errors('.input-image', '#image-error');

            /*
            var title=$('#title').val();
            var cat=$('#select2').val();
            var price=$('#price').val();
            var description=$('#des').summernote('code');
            var image=$('#image').val();
*/
            var description=$('#des').summernote('code');
            var delivery_info=$('#delivery').summernote('code');
            var form = new FormData($("#form-product")[0]);
            form.append('description',description);
            form.append('delivery_info',delivery_info);
            $.ajax({
                type: "POST",
                url: "{{route('products.create')}}",
                dataType: 'json',
                /*data: {
                    'title': title,
                    'price': price,
                    'description':description,
                    'category':cat,
                    'image':image,
                    '_token': "{ csrf_token() }}"
                },
                */
                data: form,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.errors) {

                        if (data.errors.title) {
                            errors('#name-error', data.errors.title[0], '.input-name');
                        }

                        if (data.errors.category) {
                            errors('#cat-error', data.errors.category[0], '.input-cat');
                        }

                        if (data.errors.price) {
                            errors('#price-error', data.errors.price[0], '.input-price');
                        }

                        if (data.errors.end_date) {
                            errors('#end-date-error', data.errors.end_date[0], '.input-end-date');
                        }

                        if (data.errors.end_time) {
                            errors('#end-time-error', data.errors.end_time[0], '.input-end-time');
                        }

                        if (data.errors.description) {
                            errors('#des-error', data.errors.description[0], '.input-des');
                        }

                        if (data.errors.delivery_info) {
                            errors('#delivery-error', data.errors.delivery_info[0], '.input-delivery');
                        }

                        if (data.errors.image) {
                            errors('#image-error', data.errors.image[0], '.input-image');
                        }
                    }

                    if (data.verify=='true'){

                        window.location.href = "{{URL::to('system/products')}}"
                    }

                    if (data.date=='false'){
                        $('.input-end-date').parent().addClass('has-error');
                        $('.input-end-time').parent().addClass('has-error');
                        $('#end-date-error').html('The end datetime field must be bigger than current datetime.');
                    }
                }
            });
        });

        $('#datatable-responsive').DataTable();
        $(document).ready(function() {
            $('.summernote').summernote({

                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['link', ['linkDialogShow', 'unlink']],
                    ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather']
                ]
            });
        });

        $('input#price').on('input', function() {

            this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ;

            if (this.value.length>21){

                var cut= $('#price').val().substring(0,21);
                $('#price').val(cut);
            }

        });

        $('#clear_image').click(function () {
            $.ajax({
                /* location to go*/
                url: "{{route('products.picture.delete')}}",
                method: "POST",
                dataType: 'json',
                /* Send all values from Users to controller to check*/
                data: {
                    '_token':"{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data);
                }
            });

            $('div.dz-success').remove();

            $('#clear_image').fadeOut();
        })

    </script>
@endsection