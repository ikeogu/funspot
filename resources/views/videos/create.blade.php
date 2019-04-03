@extends('layouts.app')

@section('content')

<div id="stage"></div>
<div class="row">
              @if ($message = Session::get('success'))

                  <div class="alert alert-success alert-block">

                      <button type="button" class="close" data-dismiss="alert">×</button>

                      <strong>{{ $message }}</strong>

                  </div>

              @endif

              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
           </div>
    <div class="form-wrap mform">
        <form class="v-upload-form" method="POST" action="{{route('vstore')}}" enctype="multipart/form-data">
        @csrf
        <div class="box__input">
            <div class="upl-icon"><i class="fa fa-download"></i></div>
            <input class="box__file input" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
            <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
            <button class="box__button" type="submit">Upload</button>
        </div>
        <div class="box__uploading">
            <div><span>Videos are ready to be uploaded</span></div>
        </div>
        <div class="box__success">Done!</div>
        <div class="box__error">Error! <span></span>.</div>
        </form>
    </div>

   
@endsection