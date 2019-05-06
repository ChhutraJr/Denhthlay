@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <h4 class="m-t-0 header-title">Slideshow</h4>

            <div class="col-md-12">
                <button class="btn btn-primary waves-effect waves-light pull-right btn-lg" data-toggle="modal" data-target="#con-close-modal"><span class="fa fa-plus-circle btn-add-new"></span> Add New</button>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-add">
                                {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add New Slideshow</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="req">*</span></label>
                                            <input type="text" class="form-control input-name" name="name" placeholder="Enter Name...">
                                            <span class="text-danger">
                                                   <strong id="name-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img class="img-rounded" id="pic" width="25px" /> <label class="control-label">Image <span class="req">*</span></label>
                                            <input type="file" class="filestyle input-image" data-buttontext="Select file" name="image" data-buttonname="btn-default" onchange="readURL(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="image-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
                    <th>Name</th>
                    <th>Order</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($slide_show as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td ><img src="{{url('storage/'.$item->image)}}" alt="" class="img-rounded" width="45px" ></td>
                    <td>{{$item->name}}</td>
                    <td>
                        @if(!$loop->first)
                            <a href="{{url('system/slide_show/order/'.$item->id.'/'.$item->order.'/up')}}"><i class=" glyphicon glyphicon-chevron-up"></i></a>
                        @endif

                        @if(!$loop->last)
                            <a href="{{url('system/slide_show/order/'.$item->id.'/'.$item->order.'/down')}}"><i class="glyphicon glyphicon-chevron-down"></i></a>
                        @endif
                    </td>
                    <td>

                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#edit-{{$item->id}}"><i class="glyphicon glyphicon-pencil btn-edit edit-cl"></i>Edit</a>
                        <!--<a href="{url('system/categories/sub/'.$item->id)}}"><i class="glyphicon glyphicon-th-large"></i></a>-->
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#delete-{{$item->id}}"><i class="glyphicon glyphicon-trash btn-delete delete-cl"></i>Delete</a>

                    </td>

                </tr>

                <div class="modal fade modal-defualt" id="edit-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-update-{{$item->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$item->id}}" name="update_id">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Update: <img src="{{url('storage/'.$item->image)}}" alt="" class="img-rounded" width="25px"> {{$item->name}}</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="req">*</span></label>
                                            <input type="text" class="form-control input-name-{{$item->id}}" value="{{$item->name}}" name="name" placeholder="Enter Name...">
                                            <span class="text-danger">
                                                   <strong id="name-error-{{$item->id}}"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="{{url('storage/'.$item->image)}}" class="img-rounded " id="pic-{{$item->id}}" width="25px" /> <label class="control-label">Image <span class="req">*</span></label>
                                            <input type="file" class="filestyle input-image-{{$item->id}}" data-buttontext="Select file" name="image" data-buttonname="btn-default" onchange="readURL_{{$item->id}}(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="image-error-{{$item->id}}"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                    <!--Delete-->
                    <div class="modal fade modal-danger" id="delete-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Delete: <img src="{{url('storage/'.$item->image)}}" alt="" class="img-rounded" width="25px">  {{$item->name}}</h4>
                                </div>

                                <div class="modal-body">
                                    Continue ?
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ url('/system/slide_show/delete') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="delete_id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <script type="text/javascript">
                    //Change image when input file
                    function readURL_{{$item->id}}(input,width,height) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#pic-{{$item->id}}')
                                    .attr('src', e.target.result)
                                    .width(width)
                                    .height(height)
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(function () {
                        //Update
                        $('#form-update-{{$item->id}}').submit(function (e) {
                            e.preventDefault();


                            has_errors('.input-name-{{$item->id}}', '#name-error-{{$item->id}}');
                            has_errors('.input-image-{{$item->id}}', '#image-error-{{$item->id}}');

                            /* Create new varaible that store all values from form From User\*/
                            var form = new FormData($("#form-update-{{$item->id}}")[0]);
                            $.ajax({
                                /* location to go*/
                                url: "{{route('slide_show.update')}}",
                                method: "POST",
                                dataType: 'json',
                                /* Send all values from Users to controller to check*/
                                data: form,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    /* When controller is complete it send back value to data*/
                                    console.log(data);

                                    /* Display all the errors message*/
                                    if (data.errors) {
                                        if (data.errors.name) {
                                            errors('#name-error-{{$item->id}}', data.errors.name[0], '.input-name-{{$item->id}}');
                                        }

                                        if (data.errors.image) {
                                            errors('#image-error-{{$item->id}}', data.errors.image[0], '.input-image-{{$item->id}}');
                                        }
                                    }

                                    /* Clear all the value when send is success*/
                                    if (data.verify == 'true') {

                                        window.location.href = '{{URL::to('/system/slide_show')}}';
                                    }
                                },
                                error: function (er) {
                                }
                            });
                        });



                    })
                </script>
                  @endforeach

                </tbody>
            </table>
        </div>

@endsection

@section('data')
    <script type="text/javascript">
        $('#pic').fadeOut();
        $('#datatable-responsive').DataTable();
        $('#form-add').submit(function (e){
            e.preventDefault();
            has_errors('.input-name', '#name-error');
            has_errors('.input-image', '#image-error');

            /* Create new varaible that store all values from form From User\*/
            var form = new FormData($("#form-add")[0]);
            $.ajax({
                /* location to go*/
                url: "{{route('slide_show.create')}}",
                method: "POST",
                dataType: 'json',
                /* Send all values from Users to controller to check*/
                data: form,
                processData: false,
                contentType: false,
                success: function (data) {
                    /* When controller is complete it send back value to data*/
                    console.log(data);

                    /* Display all the errors message*/
                    if (data.errors) {
                        if (data.errors.name) {
                            errors('#name-error', data.errors.name[0], '.input-name');
                        }

                        if (data.errors.image) {
                            errors('#image-error', data.errors.image[0], '.input-image');
                        }
                    }

                    /* Clear all the value when send is success*/
                    if (data.verify == 'true') {
                        $("#form-add")[0].reset();
                        window.location.href = '{{URL::to('/system/slide_show')}}';
                    }
                },
                    error: function (er) {
                }
            });
        });

    </script>
@endsection