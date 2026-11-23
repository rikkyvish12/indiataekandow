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
                                    <h4>Edit {{ $member->name }} | Petrons Member</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.petrons_update',[$assoc_id,$member->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <p>Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>                                            
                                        <input  type="text" name="name" value="{{ old('name',$member->name) }}" id="name" placeholder="Name" class="form-control" required>
                                            <small class="text-danger">{{ $errors->first('name') }}</small>

                                        </div>
                                        <div class="form-group">
                                        <p>Designation <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="designation" value="{{ old('designation',$member->designation) }}" id="designation" placeholder="Designation" class="form-control" required>
                                            <small class="text-danger">{{ $errors->first('designation') }}</small>

                                        </div>
                                        <div class="form-group">
                                        <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="position" value="{{ old('position',$member->position) }}" id="position" placeholder="Position" class="form-control noZeroAtStart noSpace" {{ $errors->has('position') ? 'autofocus' : ''  }}  onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"   >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>

                                        </div>

                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="image" accept="image/* " style="cursor:pointer" {{ $errors->has('profileImage') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Profile Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250 ) </span></label>
                                            <br><br>
                                            <img src="{{ $member->image }}" id="bImg" style="max-width:300px;max-height:300px"  alt="">
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/petrons/{{$assoc_id}}')">Cancel</button>

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
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
           if (file) {
            bImg.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection
