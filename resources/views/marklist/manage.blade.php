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
            <select class="form-control" required name="student_id" id="student_id">
                <option value="">-- Select Student --</option>
                @foreach ($student as $key => $mt)
                    <option value="{{ $mt['id'] }}" @if ($modal['student']['id'] == $mt['id']) selected  @endif>{{ $mt['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Term</label>
            <select class="form-control" required name="term" id="term">
                <option value="">-- Select Term --</option>
                <option value="1" @if ($modal->term == 1) selected  @endif>One</option>
                <option value="2" @if ($modal->term == 2) selected  @endif>Two</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Maths</label>
            <input type="number" class="form-control mark" required name="maths" id="maths" value="{{ $modal->maths }}" placeholder="Enter Mark"
                autocomplete="off" data-parsley-required-message='Please enter mark'>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Science</label>
            <input type="number" class="form-control mark" required name="science" id="science" value="{{ $modal->science }}" placeholder="Enter Mark"
                autocomplete="off" data-parsley-required-message='Please enter mark'>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>History</label>
            <input type="number" class="form-control mark" required name="history" id="history" value="{{ $modal->history }}" placeholder="Enter Mark"
                autocomplete="off" data-parsley-required-message='Please enter mark'>
        </div>
    </div>

</div>
