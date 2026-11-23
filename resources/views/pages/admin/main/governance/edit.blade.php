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
                                    <h4>Edit {{ $member->name }} | Governance Member</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.governance.update',$member->id) }}" enctype="multipart/form-data">
                                    @include('layouts.admin.alerts')
                                        @csrf
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                            <p>Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="name" value="{{$member->name}}" id="name" placeholder="Name" class="form-control noSpace" {{ $errors->has('name') ? 'autofocus' : ''  }} >
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Designation <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="designation" value="{{$member->designation}}" id="designation" placeholder="Designation" class="form-control noSpace" {{ $errors->has('designation') ? 'autofocus' : ''  }} >
                                            <small class="text-danger">{{ $errors->first('designation') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="position" value="{{$member->position}}" id="position" placeholder="Position" class="form-control noZeroAtStart noSpace"  {{ $errors->has('position') ? 'autofocus' : ''  }} onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"   >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('profileImage') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="profileImage" accept="image/*" style="cursor:pointer"  {{ $errors->has('profileImage') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Profile Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250 ) </span></label>
                                            <br><br>
                                            <img src="{{ $member->image }}" id="gImg" style="max-width: 40%" alt="">
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/governance')">Cancel</button>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
<script>
     imgInp.onchange = evt => {
    const [file] = imgInp.files
     if (file) {
        gImg.src = URL.createObjectURL(file)
     }
   }
 </script>
<!--  END CONTENT AREA  -->
@endsection
