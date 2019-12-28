@extends('layout.layout')
@section('content')
    <div class="card" style="color:black;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="card-title">List of Member</h4>
                </div>
                <div class="col-md-4">
                    {{-- <a class="btn btn-outline-primary card-title float-right" href="member/create" role="button">Add Data with Excel</a> --}}
                    <button type="button" class="btn btn-outline-primary card-title float-right" data-toggle="modal" data-target="#exampleModalCenter">
                        Add Data with Calc or Excel
                    </button>
                </div>
            </div>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Email</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Qrcode</th>
                    <th scope="col">Configuration</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach ($members as $no => $member)
                        <tr>
                            <td>{{$no+1}}</td>        
                            <td>{{$member->data["id"]}}</td>
                            <td>{{$member->data["name"]}}</td>
                            <td>{{$member->data["status"]}}</td>
                            <td>{{$member->data["email"]}}</td>                            
                            <td>{!!'<img src="'. DNS1D::getBarcodePNGPath($member->data["id"], "C128B") . '" alt="barcode"   />'!!}</td>
                            <td class="btn-outline-success">coming soon</td>
                            <td>
                                <a class="btn btn-outline-warning mr-2" href="{{ route( 'members.edit', ['member' => $member->id] ) }}"><i class="fas fa-edit"></i></a>
                                <form method="POST" action=" {{ route( 'members.destroy',['member' => $member->id] ) }} " style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>        
        </div>
    </div>    
    
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle" style="color:black">Add Data (format in .ods or .xlsx or .xls)</h5>          
            </div>
            <form action="{{ route('member-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                <input type="file" name="file">
                @if ($errors->has('file'))
                <p style="color:red; margin-top:1em">{{$errors->first('file')}} </p>
                @endif
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Add Data</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
