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
                                    <h4>Edit Slider</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.slider.update',$slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Position</p>
                                            <input value="{{ $slider->position }}"  type="text" name="position" id="position" placeholder="Position" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Title</p>
                                            <input  type="text" value="{{ $slider->title }}" name="title" id="title" placeholder="Title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Description</p>
                                            <input  type="text" value="{{ $slider->description }}" name="description" id="description" placeholder="Description" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>URL</p>
                                            <input  type="text" name="url" value="{{ $slider->url }}" id="url" placeholder="url" class="form-control">
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="backgroundImage">
                                            <label class="custom-file-label" for="customFile">Choose Background Image file</label>
                                            <br><br>
                                            <img src="{{ $slider->backgroundImage }}" style="max-width: 100%" alt="">
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="playerImage">
                                            <label class="custom-file-label" for="customFile">Choose Player Image file</label>
                                            <br><br>
                                            <img src="{{ $slider->playerImage }}" style="max-width: 100%" alt="">
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