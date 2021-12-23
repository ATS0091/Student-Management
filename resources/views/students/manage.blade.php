<div class="row clearfix">
    @if ($modal)
        <input type="hidden" value="{{ $modal->id }}" name="id">
    @endif
    <div class="col-md-12">
        <span id="form_output_edit"></span>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Student Name</label>
            <input type="text" class="form-control student_name" required name="name" id="edit_name" value="{{ $modal->name }}"
                placeholder="Enter Student Name" autocomplete="off"
                data-parsley-required-message='Please enter student name'>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Age</label>
            <input type="text" class="form-control age" required name="age" id="age" value="{{ $modal->age }}"
                placeholder="Enter age" autocomplete="off"
                data-parsley-required-message='Please enter age'>
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label>Gender</label>
            <div class="radio">
             <label class="radio-inline"><input type="radio" name="gender" id="gender" @if ($modal->gender == 'M') checked  @endif value="M">Male</label>
             <label class="radio-inline"><input type="radio" name="gender" id="gender" @if ($modal->gender == 'F') checked  @endif value="F">Female</label>
           </div>
          </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Reporting Teacher</label>
            <select class="form-control" required name="teacher_id" id="teacher_id">
             <option value="">-- Select Teacher --</option>
             @foreach ($teacher as $key => $mt)
             <option value="{{ $mt['id'] }}" @if ($modal['teacher']['id'] == $mt['id']) selected  @endif>{{ $mt['name'] }}</option>
             @endforeach
          </select>
        </div>
    </div>
    
</div>
