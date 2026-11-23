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
                                    <h4>Input Text</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-6 col-12 mx-auto">
                                    <form method="post" action="{{ route('dummy.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <p>Use input <code>type="text"</code>.</p>
                                            <label for="t-text" class="sr-only">Text</label>
                                            <input id="t-text" type="text" name="txt" placeholder="Some Text..." class="form-control" required>
                                            <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        </div>
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