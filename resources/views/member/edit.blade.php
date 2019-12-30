@extends('layout.layout')
@section('content')

<div class="card" style="color:black;">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title">Edit Member Data</h4>
            </div>
        </div>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
        <form method="POST" action="{{ route( 'members.update', ['member' => $member->id] ) }}">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" name="id" disabled value="{{$member->data["id"]}}">
                </div>               
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$member->data["name"]}}">
                    @if ($errors->has('name'))
                    <p style="color:red; margin-top:1em">{{$errors->first('name')}} </p>
                    @endif
                </div>                 
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="active" {{$member->data["status"] == "active" ? 'selected' : ''}}>active</option>                        
                        <option value="nonactive" {{$member->data["status"] == "nonactive" ? 'selected' : ''}}>nonactive</option>                        
                    </select>
                    @if ($errors->has('status'))
                    <p style="color:red; margin-top:1em">{{$errors->first('status')}} </p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$member->data["email"]}}">
                    @if ($errors->has('email'))
                    <p style="color:red; margin-top:1em">{{$errors->first('email')}} </p>
                    @endif
                </div>              
            </div>
            <button type="submit" class="btn btn-outline-warning">Update</button>
        </form>
         
    </div>
</div> 
    
@endsection