@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <h4 class="m-t-0 header-title">History of <img class="img img-rounded" src="{{url('storage/'.$product->image)}}" alt=""  height="25px"> {{$product->name}}</h4>


            </div>

            <table id="datatable-responsive"
                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Phone Number</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($history as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{ number_format($item->price, 0) }} KHR</td>
                    <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                    <td>{{$item->created_at->diffForHumans()}}</td>

                </tr>





                  @endforeach

                </tbody>
            </table>
        </div>

@endsection

@section('data')
    <script>
        $('#datatable-responsive').DataTable();
    </script>
@endsection