$(function() {
    $('input[data-provide="datepicker"]').datepicker({
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        endDate: '+1d',
        datesDisabled: '+1d',
    });
});
$(document).ready(function() {
    $("#dob").datepicker({
        autoclose: 1,
        todayHighlight: !0,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d",
    }).on("changeDate", function(a) {
        $(this).parsley().validate();
        var t = new Date(a.date.valueOf());
        t.setDate(t.getDate() + 1), $("#bapt_date").val(""), $("#bapt_date").datepicker("setStartDate", t), $(".sac_date").val(""), $(".sac_date").datepicker("setStartDate", t), $(this).datepicker("hide")
    }), $("#bapt_date").datepicker({ autoclose: 1, todayHighlight: !0, format: "dd-mm-yyyy", endDate: "+1d", datesDisabled: "+1d" }).on("changeDate", function(a) {
        $(this).parsley().validate();
        var t = new Date(a.date.valueOf());
        $(".sac_matri").val(""), t.setDate(t.getDate() + 1), $(".sac_matri").datepicker("setStartDate", t), $(this).datepicker("hide")
    }), $(".sac_date").datepicker({ autoclose: 1, todayHighlight: !0, format: "dd-mm-yyyy", endDate: "+1d", datesDisabled: "+1d" }).on("changeDate", function(a) { $(this).parsley().validate(), $(this).datepicker("hide") }), $(".sac_matri").datepicker({ autoclose: 1, todayHighlight: !0, format: "dd-mm-yyyy", endDate: "+1d", datesDisabled: "+1d" }).on("changeDate", function(a) { $(this).parsley().validate(), $(this).datepicker("hide") })
});