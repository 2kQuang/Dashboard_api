@extends('admin.master')
@section('content')
<div class="table-container">
  <div class="formbold-main-wrapper">
    <div class="formbold-form-wrapper">
      <form action="{{route('admin.category.store')}}" method="POST">
        @csrf
        <div class="formbold-mb-5">
          <label for="name" class="formbold-form-label"> Name </label>
          <input type="text" name="name" id="name" placeholder="Full Name" class="formbold-form-input" />
        </div>
        <div class="formbold-mb-5">
          <label for="description" class="formbold-form-label"> Description </label>
          <textarea rows="6" name="description" id="ckeditor" placeholder="Type your description"
            class="formbold-form-input"></textarea>
        </div>

        <div>
          <button class="formbold-btn">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection