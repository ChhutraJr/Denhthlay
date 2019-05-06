@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <form class="" role="form" method="POST" id="form-product">
                {{ csrf_field() }}

                <input type="hidden" id="update_id" name="update_id" value="{{$product->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update: <img class="img img-rounded" src="{{url('storage/'.$product->image)}}" alt=""  height="25px"> {{$product->name}}</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Title <span class="req">*</span></label>
                                <input type="text" class="form-control input-name" name="title" id="title" value="{{$product->name}}" placeholder="Enter Title...">
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
                                        @if($item->id==$product->cat->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
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
                                <input type="text" class="form-control input-price" id="price" name="price" value="{{$product->price}}" placeholder="Enter Price...">
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
                                            <input type="text" class="form-control input-end-date" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="end_date" value="{{date('m/d/Y', strtotime($product->end_date))}}">
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
                                            <input type="text" class="form-control input-end-time"  name="end_time" placeholder="00:00" value="{{date('H:i', strtotime($product->end_date))}}">
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
                                    {!! $product->description !!}
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
                                    {!! $product->delivery_info !!}
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
                                <img class="img-rounded" id="pic" width="25px" src="{{url('storage/'.$product->image)}}" /> <label class="control-label">Image <span class="req">*</span></label>
                                <input type="file" class="filestyle input-image" data-buttontext="Select file" name="image" id="image" data-buttonname="btn-default" onchange="readURL(this,25,25);">
                                <span class="text-danger">
                                                   <strong id="image-error"></strong>
                                            </span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location='{{url('/system/products')}}'" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-info waves-effect waves-light" id="btn-save">Update</button>
                </div>
            </form>
      </div>


    </div>

@endsection

@section('data')
    <script type="text/javascript">
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

          /*  var title=$('#title').val();
            var cat=$('#select2').val();
            var price=$('#price').val();
            var description=$('#des').summernote('code');
            var update_id=$('#update_id').val();
*/
            var description=$('#des').summernote('code');
            var delivery_info=$('#delivery').summernote('code');
            var form = new FormData($("#form-product")[0]);
            form.append('description',description);
            form.append('delivery_info',delivery_info);
            $.ajax({
                type: "POST",
                url: "{{route('products.update')}}",
                dataType: 'json',
            /*    data: {
                    'title': title,
                    'price': price,
                    'description':description,
                    'category':cat,
                    'update_id':update_id,
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


    </script>
@endsection