@extends('layouts.admin.admin')


@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('taekwondo', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('india_taekwondo', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

<script type="text/javascript">
    CKEDITOR.replace('world_taekwondo', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('asian_taekwondo_union', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('taekwondo_sport', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('kyorogi', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('poomsae', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('para_taekwondo', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

@endsection

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
                                    <h4>Taekwondo</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">


                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    @include('layouts.admin.alerts')
                                    @if ($taekwondo == null)
                                    <h6>Create New</h6>
                                    <form method="POST" action="{{ route('admin.taekwondo.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <b>What is taekwondo? <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></b>
                                            <textarea class="form-control noSpace" id="taekwondo" name="taekwondo"  placeholder="taekwondo" rows="3" {{ $errors->has('taekwondo') ? ' has-error' : '' }}>{!! old('taekwondo')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('taekwondo') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>INDIA TAEKWONDO <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> </p>
                                            <textarea class="form-control " id="india_taekwondo" name="india_taekwondo" placeholder="India taekwondo" rows="3" {{ $errors->has('india_taekwondo') ? ' has-error' : '' }}>{!! old('india_taekwondo')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('india_taekwondo') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>WORLD TAEKWONDO<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="world_taekwondo" name="world_taekwondo" placeholder="world taekwondo" rows="3" {{ $errors->has('world_taekwondo') ? ' has-error' : '' }}>{!! old('world_taekwondo')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('world_taekwondo') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>ASIAN TAEKWONDO UNION <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="asian_taekwondo_union" name="asian_taekwondo_union" placeholder="asian taekwondo union" rows="3" {{ $errors->has('asian_taekwondo_union') ? ' has-error' : '' }}>{!! old('asian_taekwondo_union')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('asian_taekwondo_union') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>TAEKWONDO SPORT <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="taekwondo_sport" name="taekwondo_sport" placeholder="taekwondo sport" rows="3" {{ $errors->has('taekwondo_sport') ? ' has-error' : '' }}>{!! old('taekwondo_sport')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('taekwondo_sport') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>KYOROGI <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="kyorogi" name="kyorogi" placeholder="kyorogi" rows="3" {{ $errors->has('kyorogi') ? ' has-error' : '' }}>{!!old('kyorogi')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('kyorogi') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>POOMSAE <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="poomsae" name="poomsae" placeholder="poomsae" rows="3" {{ $errors->has('poomsae') ? ' has-error' : '' }}>{!!old('poomsae')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('poomsae') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>PARA TAEKWONDO <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="para_taekwondo" name="para_taekwondo" placeholder="para taekwondo" rows="3" {{ $errors->has('para_taekwondo') ? ' has-error' : '' }}>{!!old('para_taekwondo')!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('para_taekwondo') }}</small>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/profile')">Cancel</button>
                                    </form>
                                    
                                    @else                              
                                    <h6>Update</h6>
                                    <form method="post" action="{{ route('admin.taekwondo.update',$taekwondo->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <b>What is taekwondo? <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></b>
                                            <textarea class="form-control noSpace" id="taekwondo" name="taekwondo"  placeholder="taekwondo" rows="3" {{ $errors->has('taekwondo') ? ' has-error' : '' }}>{!! old('taekwondo',$taekwondo->taekwondo)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('taekwondo') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>INDIA TAEKWONDO <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> </p>
                                            <textarea class="form-control " id="india_taekwondo" name="india_taekwondo" placeholder="India taekwondo" rows="3" {{ $errors->has('india_taekwondo') ? ' has-error' : '' }}>{!! old('india_taekwondo',$taekwondo->india_taekwondo)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('india_taekwondo') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>WORLD TAEKWONDO<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="world_taekwondo" name="world_taekwondo" placeholder="world taekwondo" rows="3" {{ $errors->has('world_taekwondo') ? ' has-error' : '' }}>{!! old('world_taekwondo',$taekwondo->world_taekwondo)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('world_taekwondo') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>ASIAN TAEKWONDO UNION <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="asian_taekwondo_union" name="asian_taekwondo_union" placeholder="asian taekwondo union" rows="3" {{ $errors->has('asian_taekwondo_union') ? ' has-error' : '' }}>{!! old('asian_taekwondo_union',$taekwondo->asian_taekwondo_union)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('asian_taekwondo_union') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>TAEKWONDO SPORT <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="taekwondo_sport" name="taekwondo_sport" placeholder="taekwondo sport" rows="3" {{ $errors->has('taekwondo_sport') ? ' has-error' : '' }}>{!! old('taekwondo_sport',$taekwondo->taekwondo_sport)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('taekwondo_sport') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>KYOROGI <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="kyorogi" name="kyorogi" placeholder="kyorogi" rows="3" {{ $errors->has('kyorogi') ? ' has-error' : '' }}>{!!old('kyorogi',$taekwondo->kyorogi)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('kyorogi') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>POOMSAE <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="poomsae" name="poomsae" placeholder="poomsae" rows="3" {{ $errors->has('poomsae') ? ' has-error' : '' }}>{!!old('poomsae',$taekwondo->poomsae)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('poomsae') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>PARA TAEKWONDO <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea class="form-control " id="para_taekwondo" name="para_taekwondo" placeholder="para taekwondo" rows="3" {{ $errors->has('para_taekwondo') ? ' has-error' : '' }}>{!!old('para_taekwondo',$taekwondo->para_taekwondo)!!}</textarea>
                                            <small class="text-danger">{{ $errors->first('para_taekwondo') }}</small>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/profile')">Cancel</button>
                                    </form>                          
                                     @endif
                                    {{-- <form method="post" action="{{ route('admin.taekwondo.update',$taekwondo->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>taekwondo</p>
                                            <textarea class="form-control" id="taekwondo" name="taekwondo" placeholder="taekwondo" rows="3" required>{{$taekwondo->Taekwondo}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Modern taekwondo Federation Of India</p>
                                            <textarea class="form-control" id="t_f_i" name="t_f_i" placeholder="Modern taekwondo Federation Of India" rows="3" required>{{taekwondo->t_f_i}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Swimming</p>
                                            <textarea class="form-control" id="Swimming" name="Swimming" placeholder="Swimming" rows="3" required>{{$taekwondo->Swimming}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Fencing</p>
                                            <textarea class="form-control" id="Fencing" name="Fencing" placeholder="Fencing" rows="3" required>{{$taekwondo->Fencing}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Riding</p>
                                            <textarea class="form-control" id="Riding" name="Riding" placeholder="Riding" rows="3" required>{{$taekwondo->Riding}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Laser Run</p>
                                            <textarea class="form-control" id="LaserRun" name="LaserRun" placeholder="Laser Run" rows="3" required>{{$taekwondo->LaserRun}}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form> --}}
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