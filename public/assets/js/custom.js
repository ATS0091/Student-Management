$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
var csrf = $('meta[name="csrf-token"]').attr("content");
$(function() {
    $('input[data-provide="datepicker"]').datepicker({
        todayHighlight: true,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d"
    });
    $(".select2").select2({
        allowClear: false,
        closeOnSelect: true
    });
    $(".digit_only").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});

/* Disable disgits in text fields*/

/* $(document).ready(function() {
    $("#dob").datepicker({
        autoclose: 1,
        // todayHighlight: !0,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d",
    }).on("changeDate", function(a) {
        $(this).parsley().validate();
        var t = new Date(a.date.valueOf());
        t.setDate(t.getDate() + 1), $("#bapt_date").val(""), $("#bapt_date").datepicker("setStartDate", t), $(".sac_date").val(""), $(".sac_date").datepicker("setStartDate", t), $(this).datepicker("hide")
    }), $("#bapt_date").datepicker({
        autoclose: 1,
        // todayHighlight: !0,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d"
    }).on("changeDate", function(a) {
        $(this).parsley().validate();
        var t = new Date(a.date.valueOf());
        $(".sac_matri").val(""), t.setDate(t.getDate() + 1), $(".sac_matri").datepicker("setStartDate", t), $(this).datepicker("hide")
    }), $(".sac_date").datepicker({
        autoclose: 1,
        // todayHighlight: !0,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d"
    }).on("changeDate", function(a) {
        $(this).parsley().validate(), $(this).datepicker("hide")
    }), $(".sac_matri").datepicker({
        autoclose: 1,
        todayHighlight: !0,
        format: "dd-mm-yyyy",
        endDate: "+1d",
        datesDisabled: "+1d"
    }).on("changeDate", function(a) {
        $(this).parsley().validate(), $(this).datepicker("hide")
    })
});*/

$(function() {
    $("#dob")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "-1D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                //alert("ins");
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                //alert("we");
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 1); // add one day
            maxDate.setHours(0, 0, 0, 0); // clear time portion for correct results
            if (curDate > maxDate) {
                $(this).datepicker("setDate", maxDate);
            }
            if (curDate) {
                curDate.setDate(curDate.getDate() + 1);
                $("#bapt_date").val("");
                $("#bapt_date").datepicker("option", "minDate", curDate);
                $(".sac_date1").val("");
                $(".sac_date1").datepicker("option", "minDate", curDate);
                $(".sac_date2").val("");
                $(".sac_date2").datepicker("option", "minDate", curDate);
            }
        })
        .keyup(function(e) {
            $("#bapt_date").datepicker("option", "minDate", null);
            $(".sac_date1").datepicker("option", "minDate", null);
            $(".sac_date2").datepicker("option", "minDate", null);
            $(".sac_matri").datepicker("option", "minDate", null);
        });

    $("#bapt_date")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 1); // add one day
            maxDate.setHours(0, 0, 0, 0); // clear time portion for correct results
            if (curDate > maxDate) {
                $(this).datepicker("setDate", maxDate);
            }
            if (curDate) {
                curDate.setDate(curDate.getDate() + 1);
                $(".sac_date1").val("");
                //$(".sac_date1").datepicker("option", "minDate", curDate);
                $(".sac_date2").val("");
                //$(".sac_date2").datepicker("option", "minDate", curDate);
                $(".sac_matri").val("");
                //$(".sac_matri").datepicker("option", "minDate", null);
            }
        })
        .keyup(function(e) {
            $(".sac_date1").val("");
            $(".sac_date1").datepicker("option", "minDate", null);
            $(".sac_date2").val("");
            $(".sac_date2").datepicker("option", "minDate", null);
            $(".sac_matri").val("");
            $(".sac_matri").datepicker("option", "minDate", null);
        });
    $(".sac_date1")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate()); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                } else if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }

                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 1); // add one day
            maxDate.setHours(0, 0, 0, 0); // clear time portion for correct results
            if (curDate > maxDate) {
                $(this).datepicker("setDate", maxDate);
            }
            if (curDate) {
                $(".sac_date2").val("");
                //$(".sac_date2").datepicker("option", "minDate", curDate);
            }
            if (curDate) {
                curDate.setDate(curDate.getDate() + 1);
                $(".sac_matri").val("");
                //$(".sac_matri").datepicker("option", "minDate", curDate);
            }
        })
        .keyup(function(e) {
            $(".sac_date2").val("");
            $(".sac_date2").datepicker("option", "minDate", null);
            $(".sac_matri").val("");
            $(".sac_matri").datepicker("option", "minDate", null);
        });
    $(".sac_date2")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var sacdate = $(".sac_date1").datepicker("getDate");
                var curDate = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate()); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                }
                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                if (sacdate != null) {
                    sacdate.setDate(sacdate.getDate()); // add one day
                    $(this).datepicker("option", "minDate", sacdate);
                }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 1); // add one day
            maxDate.setHours(0, 0, 0, 0); // clear time portion for correct results
            if (curDate > maxDate) {
                $(this).datepicker("setDate", maxDate);
            }
            if (curDate) {
                curDate.setDate(curDate.getDate() + 1);
                $(".sac_matri").val("");
                $(".sac_matri").datepicker("option", "minDate", curDate);
            }
        })
        .keyup(function(e) {
            $(".sac_matri").val("");
            $(".sac_matri").datepicker("option", "minDate", null);
        });
    $(".sac_matri")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate3 = $(".sac_date1").datepicker("getDate");
                var curDate = $(".sac_date2").datepicker("getDate");
                var curDate1 = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                }
                // if (curDate1 != null) {
                //     curDate1.setDate(curDate1.getDate()); // add one day
                //     $(this).datepicker("option", "minDate", curDate1);
                // }

                // if (curDate3 != null && curDate != null)
                //     if (curDate3 < curDate) {
                //         curDate.setDate(curDate.getDate() + 1); // add one day
                //         $(this).datepicker("option", "minDate", curDate);
                //     }

                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                // if (curDate3 != null) {
                //     curDate3.setDate(curDate3.getDate()); // add one day
                //     $(this).datepicker("option", "minDate", curDate3);
                // }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .keyup(function(e) {
            $(".sac_matri").val("");
            $(".sac_matri").datepicker("option", "minDate", null);
            $(".sac_date4").val("");
            $(".sac_date4").datepicker("option", "minDate", null);
        });

    $(".sac_date4")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate = $(".sac_date2").datepicker("getDate");
                var curDate1 = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                var curDate3 = $(".sac_matri").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                }
                if (curDate1 != null) {
                    curDate1.setDate(curDate1.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate1);
                }
                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                if (curDate3 != null) {
                    curDate3.setDate(curDate3.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate3);
                }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .keyup(function(e) {
            $(".sac_date4").val("");
            $(".sac_date4").datepicker("option", "minDate", null);
        });

    $(".sac_date5")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate = $(".sac_date2").datepicker("getDate");
                var curDate1 = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                }
                if (curDate1 != null) {
                    curDate1.setDate(curDate1.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate1);
                }
                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                var curDate3 = $(".sac_matri").datepicker("getDate");
                if (curDate3 != null) {
                    curDate3.setDate(curDate3.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate3);
                }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .keyup(function(e) {
            $(".sac_date5").val("");
            $(".sac_date5").datepicker("option", "minDate", null);
        });

    $(".sac_date6")
        .datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(el, dp) {
                var curDate = $(".sac_date2").datepicker("getDate");
                var curDate1 = $("#bapt_date").datepicker("getDate");
                var curDate2 = $("#dob").datepicker("getDate");
                if (curDate != null) {
                    curDate.setDate(curDate.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate);
                }
                if (curDate1 != null) {
                    curDate1.setDate(curDate1.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate1);
                }
                if (curDate2 != null) {
                    curDate2.setDate(curDate2.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate2);
                }
                var curDate3 = $(".sac_matri").datepicker("getDate");
                if (curDate3 != null) {
                    curDate3.setDate(curDate3.getDate() + 1); // add one day
                    $(this).datepicker("option", "minDate", curDate3);
                }
                inputField = $(el);
                if (inputField.parents(".ui-dialog").length > 0) {
                    inputField.parent().append($("#ui-datepicker-div"));
                    $("#ui-datepicker-div").addClass("datepicker-modal");
                    $("#ui-datepicker-div").hide();
                }
            },
            onClose: function(dateText, inst) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .keyup(function(e) {
            $(".sac_date6").val("");
            $(".sac_date6").datepicker("option", "minDate", null);
        });

    /* Reports Page */
    $("#from_date")
        .datepicker({
            changeMonth: !0,
            changeYear: !0,
            autoclose: 1,
            dateFormat: "dd-mm-yy",
            maxDate: "+D",
            yearRange: "-130:+0",
            showAnim: "slide",
            beforeShow: function(e, t) {
                (inputField = $(e)),
                    inputField.parents(".ui-dialog").length > 0 &&
                        (inputField.parent().append($("#ui-datepicker-div")),
                        $("#ui-datepicker-div").addClass("datepicker-modal"),
                        $("#ui-datepicker-div").hide());
            },
            onClose: function(e, t) {
                $(this).datepicker("option", "dateFormat", "dd-mm-yy");
            }
        })
        .on("change", function(e) {
            var t = $(this).datepicker("getDate"),
                a = new Date();
            a.setDate(a.getDate() + 1),
                a.setHours(0, 0, 0, 0),
                t > a && $(this).datepicker("setDate", a),
                t &&
                    (t.setDate(t.getDate() + 1),
                    $("#to_date").val(""),
                    $("#to_date").datepicker("option", "minDate", t));
        })
        .keyup(function(e) {
            $("#to_date").val(""),
                $("#to_date").datepicker("option", "minDate", null);
        }),
        $("#to_date")
            .datepicker({
                changeMonth: !0,
                changeYear: !0,
                autoclose: 1,
                dateFormat: "dd-mm-yy",
                maxDate: "+D",
                yearRange: "-130:+0",
                showAnim: "slide",
                beforeShow: function(e, t) {
                    var a = $("#from_date").datepicker("getDate");
                    null != a &&
                        (a.setDate(a.getDate() + 1),
                        $(this).datepicker("option", "minDate", a)),
                        (inputField = $(e)),
                        inputField.parents(".ui-dialog").length > 0 &&
                            (inputField
                                .parent()
                                .append($("#ui-datepicker-div")),
                            $("#ui-datepicker-div").addClass(
                                "datepicker-modal"
                            ),
                            $("#ui-datepicker-div").hide());
                },
                onClose: function(e, t) {
                    $(this).datepicker("option", "dateFormat", "dd-mm-yy");
                }
            })
            .on("change", function(e) {
                var t = $(this).datepicker("getDate"),
                    a = new Date();
                a.setDate(a.getDate() + 1),
                    a.setHours(0, 0, 0, 0),
                    t > a && $(this).datepicker("setDate", a);
            });
});
