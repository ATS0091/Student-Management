<!-- Default Size -->
<div class="modal fade" id="add_mark" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h6 class="title" id="defaultModalLabel">Add New Student</h6>
            </div>
            <form id="marklist_from" data-parsley-validate>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <span id="form_output"></span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name</label>
                                <select class="form-control" required name="student_id" id="student_id">
                                    <option value="">-- Select Student --</option>
                                    @foreach ($student as $key => $mt)
                                        <option value="{{ $mt['id'] }}">{{ $mt['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Term</label>
                                <select class="form-control" required name="term" id="term">
                                    <option value="">-- Select Term --</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Maths</label>
                                <input type="number" class="form-control mark" required name="maths" id="maths"
                                    placeholder="Enter Mark" autocomplete="off"
                                    data-parsley-required-message='Please enter mark'>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Science</label>
                                <input type="number" class="form-control mark" required name="science" id="science"
                                    placeholder="Enter Mark" autocomplete="off"
                                    data-parsley-required-message='Please enter mark'>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>History</label>
                                <input type="number" class="form-control mark" required name="history" id="history"
                                    placeholder="Enter Mark" autocomplete="off"
                                    data-parsley-required-message='Please enter mark'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Close</button>
                    <button type="submit" id="modal_button" class="btn btn-success btn-sm"> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Default Size -->
<!-- Default Size -->
<div class="modal fade" id="add_sample" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h6 class="title" id="defaultModalLabel">Manage Student</h6>
            </div>
            <form id="marklist_manage_from" data-parsley-validate>
                @csrf
                <div class="modal-body">
                    <span id="test"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Close</button>
                    <button type="submit" id="modal_button" class="btn btn-success btn-sm"> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Default Size -->
