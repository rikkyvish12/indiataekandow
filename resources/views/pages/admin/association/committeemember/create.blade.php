@extends('layouts.admin.admin')



@section('content')
<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create Committee Member</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.committee_member_store',$assoc_id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Committee</p>
                                            <select name="committee" id="committee" class="form-control">
                                                @foreach ($committee as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <p>Name</p>
                                            <input  type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name')}}"  required>
                                        </div>
                                        <div class="form-group">
                                            <p>Designation</p>
                                            <input  type="text" name="designation" id="designation" placeholder="Designation" class="form-control" value="{{ old('designation')}}" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Position</p>
                                            <input  type="text" name="position" id="position" placeholder="Position" class="form-control" value="{{ old('position')}}" required>
                                        </div>
                                      
                                        <div class="custom-file-container" data-upload-id="Imagepreview1">
                                            <p style="float: left">Upload Profile Image </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="image" accept="image/*" required>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form>
                                </div>                                        
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

<!--  END CONTENT AREA  -->
@endsection