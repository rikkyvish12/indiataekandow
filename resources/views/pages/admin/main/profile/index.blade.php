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
                                    <h4>Profile</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                             @include('layouts.admin.alerts')
                            <div class="row">
                                @if ($profile)
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.profile.update',$profile->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <!-- <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        <div class="custom-file mb-4">
                                          <input type="file" class="custom-file-input" id="imgInp" name="logo" style="cursor:pointer" {{ $errors->has('logo') ? ' has-error' : '' }} >
                                          <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Logo file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 352x395) </span></label>
                                          <br><br>
                                          <img src="{{ $profile->logo }}" id="logo" style="width: 20%; height:20%;" alt="main logo">
                                      </div> -->
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{old('title',$profile->title)}}"  id="title"    placeholder="Title" class="form-control noSpace" {{ $errors->has('title') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{$errors->first('title')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control noSpace" id="description" name="description" placeholder="Description" rows="3" {{ $errors->has('description') ? 'autofocus' : 'null' }}>{{old('description',$profile->description)}}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                        <div class="form-group">
                                          <p>Footer Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <textarea class="form-control noSpace" id="smallDescription" name="smallDescription" placeholder="Footer Description" rows="3" {{ $errors->has('smallDescription') ? 'autofocus' : 'null' }} >{{old('smallDescription',$profile->smallDescription)}}</textarea>
                                          <small class="text-danger">{{ $errors->first('smallDescription') }}</small>
                                      </div>
                                        <div class="form-group">
                                            <p>Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control noSpace" id="address" name="address" placeholder="Address" rows="3"  {{ $errors->has('address') ? 'autofocus' : 'null' }} >{{old('address',$profile->address)}}</textarea>
                                            <small class="text-danger">{{ $errors->first('address') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Scroll Text <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="mirache" value="{{old('mirache',$profile->mirache)}}" id="mirache" placeholder="Scroll Text" class="form-control noSpace" {{ $errors->has('mirache') ? 'autofocus' : 'null' }}  >
                                            <small class="text-danger">{{ $errors->first('mirache') }}</small>
                                        </div>
                                        <div class="form-group">
                                          <p>Map (Iframe) <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <textarea class="form-control noSpace" id="map" name="map" placeholder="Map" rows="3" {{ $errors->has('map') ? 'autofocus' : 'null' }}   >{{old('map',$profile->map)}}</textarea>
                                          <small class="text-danger">{{ $errors->first('map') }}</small>
                                      </div>
                                        <div class="form-group">
                                            <p>Contact No. <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="number" id="number" value="{{old('number',$profile->number)}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" {{ $errors->has('number') ? 'autofocus' : 'null' }} placeholder="Number" maxlength="10" class="form-control noZeroAtStart"  >
                                            <small class="text-danger">{{ $errors->first('number') }}</small>
                                        </div>

                                        <div class="form-group">
                                          <p>Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="email" id="email" placeholder="Email" value="{{old('email',$profile->email)}}" class="form-control noSpace" {{ $errors->has('email') ? 'autofocus' : 'null' }}   > 
                                          <small class="text-danger">{{ $errors->first('email') }}</small>
                                      </div>
                                      
                                      <div class="form-group">
                                          <p>Send-To-Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email" id="send_to_email" placeholder="Send-To-Email" value="{{old('send_to_email',$profile->send_to_email)}}" class="form-control noSpace" {{ $errors->has('send_to_email') ? 'autofocus' : 'null' }}   > 
                                          <small class="text-danger">{{ $errors->first('send_to_email') }}</small>
                                      </div>

                                      <div class="form-group">
                                          <p>Send-To-Email-2 <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email_2" id="send_to_email_2" placeholder="Send-To-Email-2" value="{{old('send_to_email_2',$profile->send_to_email_2)}}" class="form-control noSpace"   > 
                                      </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <!-- <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/profile')">Cancel</button> -->

                                    </form>
                                </div>
                                @else
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('POST') }}
                                        <!-- <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        <div class="custom-file mb-4">
                                          <input type="file" class="custom-file-input" id="imgInp" name="logo" style="cursor:pointer" {{ $errors->has('logo') ? 'autofocus' : 'null' }} >
                                          <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Logo file  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 352x395 ) </span></label>
                                          <br><br>
                                          <img src="" id="logo" style="width: 20%; height:20%;" alt="main logo">
                                      </div> -->
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title"   id="title"  placeholder="Title"  value="{{old('title')}}" class="form-control noSpace"  >
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control noSpace" id="description" name="description" placeholder="Description" rows="3" {{ $errors->has('description') ? 'autofocus' : 'null' }}    >{{old('description')}}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                        <div class="form-group">
                                          <p>Footer Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <textarea class="form-control noSpace" id="smallDescription" name="smallDescription" placeholder="Footer Description" rows="3" {{ $errors->has('smallDescription') ? 'autofocus' : 'null' }}  >{{old('smallDescription')}}</textarea>
                                          <small class="text-danger">{{ $errors->first('smallDescription') }}</small>
                                      </div>
                                        <div class="form-group">
                                            <p>Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control noSpace" id="address" name="address" placeholder="Address" rows="3"  {{ $errors->has('address') ? 'autofocus' : 'null' }}  >{{old('address')}}</textarea>
                                            <small class="text-danger">{{ $errors->first('address') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Scroll Text <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="mirache"  value="{{old('mirache')}}" id="mirache" placeholder="Scroll Text" class="form-control noSpace" {{ $errors->has('mirache') ? 'autofocus' : 'null' }}  >
                                            <small class="text-danger">{{ $errors->first('mirache') }}</small>
                                        </div>
                                        <div class="form-group">
                                          <p>Map (Iframe)<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <textarea class="form-control noSpace" id="map" name="map" placeholder="Map" rows="3" {{ $errors->has('map') ? 'autofocus' : 'null' }}   >{{old('map')}}</textarea>
                                          <small class="text-danger">{{ $errors->first('map') }}</small>
                                      </div>
                                        <div class="form-group">
                                            <p>Contact No. <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="number" id="number"  value="{{old('number')}}" placeholder="Number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" {{ $errors->has('number') ? 'autofocus' : 'null' }} maxlength="10" class="form-control noZeroAtStart"   >
                                            <small class="text-danger">{{ $errors->first('number') }}</small>
                                        </div>

                                        <div class="form-group">
                                          <p>Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}" class="form-control noSpace" {{ $errors->has('email') ? 'autofocus' : 'null' }}  >
                                          <small class="text-danger">{{ $errors->first('email') }}</small>
                                      </div>
                                      <div class="form-group">
                                          <p>Send-To-Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email" id="send_to_email" placeholder="Send-To-Email" value="{{old('send_to_email')}}" class="form-control noSpace" {{ $errors->has('send_to_email') ? 'autofocus' : 'null' }}   > 
                                          <small class="text-danger">{{ $errors->first('send_to_email') }}</small>
                                      </div>

                                      <div class="form-group">
                                          <p>Send-To-Email-2 <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email_2" id="send_to_email_2" placeholder="Send-To-Email-2" value="{{old('send_to_email_2')}}" class="form-control noSpace"    > 
                                      </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <!-- <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/profile')">Cancel</button> -->

                                    </form>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

        <script>
    //         imgInp.onchange = evt => {
    //        const [file] = imgInp.files
    //         if (file) {
    //             logo.src = URL.createObjectURL(file)
    //         }
    //    }
        </script>
<!--  END CONTENT AREA  -->
@endsection
