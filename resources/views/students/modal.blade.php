<!-- Default Size -->
<div class="modal fade" id="add_student" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h6 class="title" id="defaultModalLabel">Add New Student</h6>
            </div>
            <form id="student_from" data-parsley-validate>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <span id="form_output"></span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" class="form-control student_name" required name="name" id="name"
                                    placeholder="Enter Student Name" autocomplete="off"
                                    data-parsley-required-message='Please enter student name'>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" class="form-control age" required name="age" id="age"
                                    placeholder="Enter age" autocomplete="off"
                                    data-parsley-required-message='Please enter age'>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="radio">
                                 <label class="radio-inline"><input type="radio" name="gender" id="gender" value="M" checked>Male</label>
                                 <label class="radio-inline"><input type="radio" name="gender" id="gender" value="F">Female</label>
                               </div>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reporting Teacher</label>
                                <select class="form-control" required name="teacher_id" id="teacher_id">
                                 <option value="">-- Select Teacher --</option>
                                 @foreach ($teacher as $key => $mt)
                                 <option value="{{ $mt['id'] }}">{{ $mt['name'] }}</option>
                                 @endforeach
                              </select>
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
            <form id="student_manage_from" data-parsley-validate>
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
