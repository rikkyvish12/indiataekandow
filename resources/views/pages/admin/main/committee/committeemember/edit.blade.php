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
                                    <h4>Edit Committee Member</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.committee_member.update',$member->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
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
                                            <input  type="text" name="name" value="{{ $member->name }}" id="name" placeholder="Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Designation</p>
                                            <input  type="text" name="designation" value="{{ $member->designation }}" id="designation" placeholder="Designation" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Position</p>
                                            <input  type="text" name="position" value="{{ $member->position }}" id="position" placeholder="Position" class="form-control" required>
                                        </div>

                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="image">
                                            <label class="custom-file-label" for="customFile">Choose Profile Image file</label>
                                            <br><br>
                                            <img src="{{ $member->image }}" id="profImg" style="max-width: 60%" alt="">
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
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                   if (file) {
                     profImg.src = URL.createObjectURL(file)
                    }
                 }
          </script>

<!--  END CONTENT AREA  -->
@endsection
