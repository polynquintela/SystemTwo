/* 
 * Copyright (c) 2015, johnpaulquijano
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/* 
    Created on : Apr 10, 2015, 11:29:13 PM
    Author     : John Paul Quijano
*/

function initPlugins()
{
    (function($)
    {
        $.fn.disableSelection = function() 
        {
            return this
            .attr("unselectable", "on")
            .css("user-select", "none")
            .on("selectstart", false);
        };
    })(jQuery);
    
    (function($)
    {
        $.fn.setCentered = function () 
        {
            return this
            .css("top", Math.max(0, (($(window).height() - $(this).outerHeight(true)) / 2) + $(window).scrollTop()) + "px")
            .css("left", Math.max(0, (($(window).width() - $(this).outerWidth(true)) / 2) + $(window).scrollLeft()) + "px");
        };
    })(jQuery);
    
    (function($) 
    {
        $.fn.setDraggable = function() 
        {
            return this
            .mousedown
            (
                function(e) 
                {
                    var $draggable = $(this).addClass("draggable");

                    var drg_h = $draggable.outerHeight();
                    var drg_w = $draggable.outerWidth();
                    var pos_y = $draggable.offset().top + drg_h - e.pageY;
                    var pos_x = $draggable.offset().left + drg_w - e.pageX;

                    $draggable.css("z-index", 1000);

                    $("body").on("mousemove", function(e) 
                    {
                        $(".draggable")
                        .offset({top : e.pageY + pos_y - drg_h, left : e.pageX + pos_x - drg_w})
                        .on("mouseup", function(){$(this).removeClass("draggable");});
                    });
                }
            )
            .mouseup
            (
                function()
                {
                    $(this).removeClass("draggable");
                }
            );
        };
    })(jQuery);
    
    (function($)
    {
        $.fn.setToggleable = function(onToggleOn, onToggleOff) 
        {
            $(this).attr("toggle", "0");
            
            return this
            .click
            (
                function(event)
                {
                    if($(this).attr("toggle") === "0")
                    {
                        onToggleOn(event);
                        $(this).attr("toggle", "1");
                    }
                    else
                    {
                        onToggleOff(event);
                        $(this).attr("toggle", "0");
                    }

                    event.stopPropagation();
                }
            );
        };
    })(jQuery);
    
    (function($)
    {
        $.fn.initTooltip = function() 
        {
            this.find("[tooltip]")
            .each
            (
                function()
                {
                    if(!!$(this).attr("tooltip"))
                        $(this).createTooltip();
                }
            );
            
            return this;
        };
    })(jQuery);
    
    (function($)
    {
        $.fn.createTooltip = function() 
        {
            $("<div id='"+$(this).attr("id")+"Tooltip'></div>")
            .disableSelection()
            .addClass("tooltip")
            .html($(this).attr("tooltip"))
            .appendTo($(this))
            .hide();

            this
            .mouseover
            (
                function()
                {
                    $("div#"+$(this).attr("id")+"Tooltip")
                    .show()
                    .offset
                    (
                        {
                            left: $(this).offset().left + $(this).width() + 8, 
                            top: $(this).offset().top + $(this).height() + 8
                        }
                    );
                }
            )
            .mouseout
            (
                function(){$("div#"+$(this).attr("id")+"Tooltip").hide();}
            );
    
            return this;
        };
    })(jQuery);
}

function initTools()
{
    $("div.tool")
    .click
    (
        function(event)
        {
            $("div#"+$(this).attr("invoke")) //dialog to invoke
            .attr("posttype", "add")
            .css("visibility", "visible")
            .fadeTo("fast", 0.9)
            .find("div.textfield").html("")
            .parent().find("div.textarea").html("");
    
            if($(this).attr("invoke") === "logsdialog")
            {
                var data = {};
                data.query = "getlogs";
                
                handler = function(response)
                {
                    $("div#logid").find("div.logsdialogcontentcontent").empty();
                    $("div#logdate").find("div.logsdialogcontentcontent").empty();
                    $("div#logemp").find("div.logsdialogcontentcontent").empty();
                    $("div#logactivity").find("div.logsdialogcontentcontent").empty();
                    $("div#logremark").find("div.logsdialogcontentcontent").empty();
                    
                    for(var i = response.length-1; i >= 0; i--)
                    {
                        $("div#logid").find("div.logsdialogcontentcontent").append($("<div class='logsdialogcontentcell'>"+response[i].id+"</div>"));
                        $("div#logdate").find("div.logsdialogcontentcontent").append($("<div class='logsdialogcontentcell'>"+response[i].date+"</div>"));
                        $("div#logemp").find("div.logsdialogcontentcontent").append($("<div class='logsdialogcontentcell'>"+response[i].employee+"</div>"));
                        $("div#logactivity").find("div.logsdialogcontentcontent").append($("<div class='logsdialogcontentcell'>"+response[i].activity+"</div>"));
                        $("div#logremark").find("div.logsdialogcontentcontent").append($("<div class='logsdialogcontentcell endcell'>"+response[i].remarks+"</div>"));
                    }
                    
                    $("div#logsdialog").setCentered();
                };
                
                get(data, handler);
            }
    
            event.stopPropagation();
        }
    );
    
    $("div.floatingtool")
    .click
    (
        function(event)
        {
            $("div#"+$(this).attr("invoke"))
            .attr("posttype", "add")
            .css("visibility", "visible")
            .fadeTo("fast", 0.9)
            .find("div.textfield").html("")
            .parent().find("div.textarea").html("");
    
            event.stopPropagation();
        }
    )
    .mouseover
    (
        function(event)
        {
            $(this).css("border", "1px solid #ffffff");
            event.stopPropagation();
        }
    )
    .mouseout
    (
        function(event)
        {
            $(this).css("border", "1px solid transparent");
            event.stopPropagation();
        }
    );
}

function initTooltips()
{
    $("[tooltip]")
    .each
    (
        function()
        {
            if(!!$(this).attr("tooltip"))
                $(this).createTooltip();
        }
    );
}

function initFloatingToolbar()
{
    var tools = $("div#floatingtoolwrapper");

    $("div#floatingtoolbar")
    .setToggleable
    (
        function(event)
        {
            $(event.target).animate({width: 38*$("div.floatingtool").size()+$("div#floatingsearchfield").outerWidth()+"px", backgroundColor: "#111111", opacity: "0.5"}, "fast");
            tools.css("display", "block");
        },
        
        function(event)
        {
            $(event.target).animate({width: "24px", backgroundColor: "#666666", opacity: "0.15"}, "fast");
            tools.css("display", "none");
        }
    );
}

function initSearch()
{
    $("div#searchfield")
    .focus
    (
        function(event)
        {
            $(this)
            .css("font-style", "normal")
            .css("color", "#444444");
            
            if($(this).html() === "Search")
                $(this).html("");

            event.stopPropagation();
        }
    )
    .blur
    (
        function(event)
        {
            if($(this).html() === "")
            {
                $(this)
                .animate({backgroundColor: "transparent"}, "fast")
                .css("font-style", "italic")
                .css("color", "#cccccc")
                .html("Search");
            }
            
            event.stopPropagation();
        }
    )
    .keydown
    (
        function(event)
        {
            if(event.keyCode === 13) //prevent adding newline markups
            {
                document.execCommand("insertHTML", false, "");
                event.preventDefault();
                
                var data = 
                {
                    query: "search",
                    key: $("div#searchfield").html()
                };

                var handler = function(response)
                {
                    if(response.length > 0)
                    {
                        $("div#resultsdialog")
                        .css("visibility", "visible")
                        .fadeTo("fast", 0.9);
                
                        $("div#entityid").find("div.resultsdialogcontentcontent").empty();
                        $("div#entityname").find("div.resultsdialogcontentcontent").empty();
                        $("div#entitytype").find("div.resultsdialogcontentcontent").empty();
                        
                        for(var i = 0; i < response.length; i++)
                        {
                            $("div#entityid").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].id+"</div>"));
                            $("div#entityname").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].name+"</div>"));
                            $("div#entitytype").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell endcell'>"+response[i].type+"</div>"));
                        }
                        
                        $("div#resultsdialog").setCentered();
                    }
                    else
                        showNotification("No match found.");
                };

                get(data, handler);
            }
        }
    );
    
    $("div#floatingsearchfield")
    .click
    (
        function(event)
        {
            event.stopPropagation();
        }
    )
    .focus
    (
        function(event)
        {
            $(this)
            .animate({backgroundColor: "#555555"}, "fast")
            .css("font-style", "normal")
            .css("color", "white")
            .html("");
    
            event.stopPropagation();
        }
    )
    .blur
    (
        function(event)
        {
            if($(this).html() === "")
            {
                $(this)
                .animate({backgroundColor: "transparent"}, "fast")
                .css("font-style", "italic")
                .css("color", "#888888")
                .html("Search");
            }
            
            event.stopPropagation();
        }
    )
    .keydown
    (
        function(event)
        {
            if(event.keyCode === 13) //prevent adding newline markups
            {
                document.execCommand("insertHTML", false, "");
                event.preventDefault();
                
                var data = 
                {
                    query: "search",
                    key: $("div#floatingsearchfield").html()
                };

                var handler = function(response)
                {
                    if(response.length > 0)
                    {
                        $("div#resultsdialog")
                        .css("visibility", "visible")
                        .fadeTo("fast", 0.9);
                
                        $("div#entityid").find("div.resultsdialogcontentcontent").empty();
                        $("div#entityname").find("div.resultsdialogcontentcontent").empty();
                        $("div#entitytype").find("div.resultsdialogcontentcontent").empty();
                        
                        for(var i = 0; i < response.length; i++)
                        {
                            $("div#entityid").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].id+"</div>"));
                            $("div#entityname").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].name+"</div>"));
                            $("div#entitytype").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell endcell'>"+response[i].type+"</div>"));
                        }
                        
                        $("div#resultsdialog").setCentered();
                    }
                    else
                        showNotification("No match found.");
                };

                get(data, handler);
            }
        }
    );
    
    $("div#search")
    .click
    (
        function()
        {
            var data = 
            {
                query: "search",
                key: $("div#searchfield").html()
            };

            var handler = function(response)
            {
                if(response.length > 0)
                {
                    $("div#resultsdialog")
                    .css("visibility", "visible")
                    .fadeTo("fast", 0.9);

                    $("div#entityid").find("div.resultsdialogcontentcontent").empty();
                    $("div#entityname").find("div.resultsdialogcontentcontent").empty();
                    $("div#entitytype").find("div.resultsdialogcontentcontent").empty();

                    for(var i = 0; i < response.length; i++)
                    {
                        $("div#entityid").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].id+"</div>"));
                        $("div#entityname").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].name+"</div>"));
                        $("div#entitytype").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell endcell'>"+response[i].type+"</div>"));
                    }

                    $("div#resultsdialog").setCentered();
                }
                else
                    showNotification("No match found.");
            };
            
            if(data.key === "Search")
                data.key = "";

            get(data, handler);
        }
    );
    
    $("div#floatingsearch")
    .click
    (
        function()
        {
            var data = 
            {
                query: "search",
                key: $("div#floatingsearchfield").html()
            };

            var handler = function(response)
            {
                if(response.length > 0)
                {
                    $("div#resultsdialog")
                    .css("visibility", "visible")
                    .fadeTo("fast", 0.9);

                    $("div#entityid").find("div.resultsdialogcontentcontent").empty();
                    $("div#entityname").find("div.resultsdialogcontentcontent").empty();
                    $("div#entitytype").find("div.resultsdialogcontentcontent").empty();

                    for(var i = 0; i < response.length; i++)
                    {
                        $("div#entityid").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].id+"</div>"));
                        $("div#entityname").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell'>"+response[i].name+"</div>"));
                        $("div#entitytype").find("div.resultsdialogcontentcontent").append($("<div class='resultsdialogcontentcell endcell'>"+response[i].type+"</div>"));
                    }

                    $("div#resultsdialog").setCentered();
                }
                else
                    showNotification("No match found.");
            };
            
            if(data.key === "Search")
                data.key = "";

            get(data, handler);
        }
    );
}

function initDialogs()
{
    $("div.dialog")
    .each
    (
        function()
        {
            var $dialog = $(this);
            
            $dialog
            .setDraggable()
            .mousedown
            (
                function() //emulate focus
                {
                    $(this).css("z-index", "8");
                    
                    $("div.dialog").not(this)
                    .each(function(){$(this).css("z-index", "7");});
                }
            )
            .setCentered();
        }
    )
    .hide();
    
    $("div.dialogclosebutton")
    .each
    (
        function()
        {
            $(this)
            .click
            (
                function(event)
                {
                    $(this).parent().parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            )
            .mouseover
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#ff0000"}, "fast");
                    event.stopPropagation();
                }
            )
            .mouseout
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#ffffff"}, "fast");
                    event.stopPropagation();
                }
            );
        }
    );
    
    $("button.dialogokbutton")
    .each
    (
        function()
        {
            $(this)
            .mouseover
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#00ff00"}, "fast");
                    event.stopPropagation();
                }
            )
            .mouseout
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#ffffff"}, "fast");
                    event.stopPropagation();
                }
            );
        }
    );
    
    $("div.dialogokbutton") //submit
    .each
    (
        function()
        {
            $(this)
            .click
            (
                function(event)
                {
                    var data = {};
                    var $dialog = $(this).parent().parent();

                    switch($dialog.attr("id"))
                    {
                        case "adduserdialog":
                        {
                            data.query = "postuser";
                            data.posttype = $("div#adduserdialog").attr("posttype");
                            data.id = $("div#adduseridtextfield").html();
                            data.name = $("div#addusernametextfield").html();
                            data.teacher = $("div#adduserteacherbutton").attr("select");
                            data.adviser = $("div#adduseradviserbutton").attr("select");
                            data.admin = $("div#adduseradminbutton").attr("select");

                            handler = function(response)
                            {
                                if(response.status === "1")
                                {
                                    var contentType = $dialog.attr("contenttype");
                                    
                                    refreshContent($("div#"+$dialog.attr("contentpane")), contentType);
                                    showNotification("User data saved.");
                                    
                                    if(contentType === "teacher")
                                        initTeachersMenu();
                                    else if(contentType === "adviser")
                                        initAdvisersMenu();
                                    
                                    if($dialog.attr("updateuserpanel") === "1")
                                        $("div#userpanel").html(data.name);
                                }
                                else
                                    showNotification("Failed to save user data.");
                            };
                            
                            post(data, handler);
                            
                            break;
                        }
                        case "addbatchdialog":
                        {
                            data.query = "postbatch";
                            data.posttype = $("div#addbatchdialog").attr("posttype");
                            data.id = $("div#addbatchdialog").attr("entityid");
                            data.section = $("div#addbatchsectiontextfield").html();
                            data.adviser = $("div#addbatchadviserbutton").html();
                            data.yearlevel = $("div#addbatchyearlevelbutton").html();
                            data.startacadyear = $("div#addbatchstartacadyeartextfield").html();
                            data.endacadyear = $("div#addbatchendacadyeartextfield").html();
                            
                            handler = function(response)
                            {
                                if(response.status === "1")
                                {
                                    refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                    showNotification("Batch data saved.");                                    
                                    initBatchMenu();
                                }
                                else
                                    showNotification("Failed to save batch data.");
                            };
                            
                            post(data, handler);
                            
                            break;
                        }
                        case "addsubjectdialog":
                        {
                            data.query = "postsubject";
                            data.posttype = $("div#addsubjectdialog").attr("posttype");
                            data.id = $("div#addsubjectdialog").attr("entityid");
                            data.name = $("div#addsubjectnametextfield").html();
                            data.desc = $("div#addsubjectdesctextarea").html();
                            data.type = $("div.addsubjecttypebutton[select='1']").html();
                            data.units = $("div#addsubjectunitstextfield").html();
                            data.teacher = $("div#addsubjectteacherbutton").html();
                            data.startHour = $("div#addsubjectstarthourbutton").html();
                            data.startMin = $("div#addsubjectstartminbutton").html();
                            data.startAMPM = $("div#addsubjectstartampmbutton").html();
                            data.endHour = $("div#addsubjectendhourbutton").html();
                            data.endMin = $("div#addsubjectendminbutton").html();
                            data.endAMPM = $("div#addsubjectendampmbutton").html();

                            handler = function(response)
                            {
                                if(response.status === "1")   
                                {
                                    refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                    showNotification("Subject data saved.");
                                    initAddToSubjectMenu();
                                }
                                else
                                    showNotification("Failed to save subject data.");
                            };
                            
                            post(data, handler);
                            
                            break;
                        }
                        case "addstudentdialog":
                        {
                            data.query = "poststudent";
                            data.posttype = $("div#addstudentdialog").attr("posttype");
                            data.id = $("div#addstudentdialog").attr("entityid");
                            data.name = $("div#addstudentnametextfield").html();
                            data.sex = $("div.addstudentsexbutton[select='1']").html();
                            data.address = $("div#addstudentaddresstextfield").html();
                            data.nationality = $("div#addstudentnattextfield").html();
                            data.curriculum = $("div#addstudentcurrtextfield").html();
                            data.status = $("div#addstudentstatustextfield").html();
                            data.birthDay = $("div#addstudentbdatedaybutton").html();
                            data.birthMonth = $("div#addstudentbdatemonthbutton").html();
                            data.birthYear = $("div#addstudentbdateyearbutton").html();
                            
                            handler = function(response)
                            {
                                if(response.status === "1")   
                                {
                                    refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                    showNotification("Student data saved.");
                                }
                                else
                                    showNotification("Failed to save student data.");
                            };
                            
                            post(data, handler);
                            
                            break;
                        }
                        case "gradedialog":
                        {
                            data.query = "postsubjectgrade";
                            data.studentid = $dialog.attr("entityid");
                            data.subjectid = $("div#gradedialogsubjectsbutton").attr("subjectid");
                            data.period = $("div#gradedialoggradingperiodbutton").html();
                            data.grade = $("div#gradedialoggradetextfield").html();
                            
                            var tempdata = {};
                            tempdata.query = "getsubjectgrade";
                            tempdata.studentid = data.studentid;
                            tempdata.subjectid = data.subjectid;
                            tempdata.period = data.period;
                            
                            var temphandler = function(response)
                            {
                                if(response.length > 0)
                                    data.posttype = "edit";
                                else
                                    data.posttype = "add";
                                
                                handler = function(response)
                                {
                                    if(response.status === "1")
                                    {
                                        refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                        showNotification("Student grade saved.");
                                    }
                                    else
                                        showNotification("Failed to save student grade.");
                                };

                                post(data, handler);
                            };

                            get(tempdata, temphandler);
                            
                            break;
                        }
                        case "attendancedialog":
                        {
                            data.query = "postattendance";
                            data.studentid = $dialog.attr("entityid");
                            data.batchid = $dialog.attr("batchid");
                            data.period = $("div#attendancedialoggradingperiodbutton").html();
                            data.schooldays = $("div#attendancedialogschooldaystextfield").html();
                            data.dayspresent = $("div#attendancedialogpresenttextfield").html();
                            data.daystardy = $("div#attendancedialogtardytextfield").html();
                            
                            var tempdata = {};
                            tempdata.query = "getattendance";
                            tempdata.studentid = data.studentid;
                            tempdata.batchid = data.batchid;
                            tempdata.period = data.period;
                            
                            var temphandler = function(response)
                            {
                                if(response.length > 0)
                                    data.posttype = "edit";
                                else
                                    data.posttype = "add";
                                
                                handler = function(response)
                                {
                                    if(response.status === "1")
                                    {
                                        refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                        showNotification("Student attendance saved.");
                                    }
                                    else
                                        showNotification("Failed to save student attendance.");
                                };

                                post(data, handler);
                            };

                            get(tempdata, temphandler);
                            
                            break;
                        }
                        case "confirmdeletedialog":
                        {
                            data.query = "deleteentity";
                            data.id = $dialog.attr("entityid");
                            data.entitytype = $dialog.attr("contenttype");
                            
                            handler = function(response)
                            {
                                if(response.status === "1")
                                {
                                    refreshContent($("div#"+$dialog.attr("contentpane")), $dialog.attr("contenttype"));
                                    showNotification("Entity deleted.");
                                    
                                    if(data.entitytype === "teacher")
                                        initTeachersMenu();
                                    else if(data.entitytype === "adviser")
                                        initAdvisersMenu();
                                    else if(data.entitytype === "batch")
                                        initBatchMenu();
                                    else if(data.entitytype === "subject")
                                        initAddToSubjectMenu();
                                }
                                else
                                    showNotification("Failed to delete entity.");
                            };
                            
                            post(data, handler);
                            
                            break;
                        }
                    }
                    
                    $dialog.fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            )
            .mouseover
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#00ff00"}, "fast");
                    event.stopPropagation();
                }
            )
            .mouseout
            (
                function(event)
                {
                    $(this).animate({backgroundColor: "#ffffff"}, "fast");
                    event.stopPropagation();
                }
            );
        }
    );
    
    $("div.dialog").find("div[contenteditable='true']") //prevent dragging when editing fields
    .each
    (
        function()
        {
            $(this)
            .mousedown
            (
                function(event)
                {
                    var $dialog = $(this).parent().parent();
                    
                    //emulate focus on parent dialog
                    $dialog.css("z-index", "8");
                    $("div.dialog").not($dialog)
                    .each(function(){$(this).css("z-index", "7");});
            
                    event.stopPropagation();
                }
            );
        }
    );
    
    $("div.dialog").find("div.textfield")
    .keydown
    (
        function(event)
        {
            if (event.keyCode === 13) //prevent adding newline markups
            {
                document.execCommand("insertHTML", false, "");
                event.preventDefault();
            }
        }
    );
}

function initSubjectsMenu()
{
    var $menu = $("div#subjectmenu").empty();
    
    var handler = function(response) //initialize teacher list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].name+"</div>");

            $menu.append($menuitem);

            $menuitem.click
            (
                function(event)
                {
                    $($("div#subjectbutton").html($(event.target).html()));
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            )
            .css("min-width", $("div#subjectbutton").outerWidth());
        }
    };
    
    get({query: "getsubjects"}, handler);
}

function initTeachersMenu()
{
    var $menu = $("div#addsubjectteachermenu").empty();
    
    var handler = function(response) //initialize teacher list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].name+"</div>");

            $menu.append($menuitem);

            $menuitem.click
            (
                function(event)
                {
                    $($("div#addsubjectteacherbutton").html($(event.target).html()));
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            )
            .css("min-width", $("div#addsubjectteacherbutton").outerWidth());
        }
    };
    
    get({query: "getteachers"}, handler);
}

function initAdvisersMenu()
{
    var $menu = $("div#addbatchadvisermenu").empty();
    
    var handler = function(response) //initialize adviser list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].name+"</div>");

            $menu.append($menuitem);

            $menuitem.click
            (
                function(event)
                {
                    $($("div#addbatchadviserbutton").html($(event.target).html()));
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    
                    event.stopPropagation();
                }
            )
            .css("min-width", $("div#addbatchadviserbutton").outerWidth());
        }
    };
    
    get({query: "getadvisers"}, handler);
}

function initBatchMenu()
{
    var $menu = $("div#addtobatchmenu").empty();
    
    var handler = function(response) //initialize adviser list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].name+"</div>");

            $menuitem
            .attr("entityid", response[i].id)
            .css("padding-left", "6px")
            .css("padding-right", "6px");

            $menu.append($menuitem);

            $menuitem.click
            (
                function(event)
                {
                    var data = {};
                    
                    data.query = "poststudentbatch";
                    data.posttype = "add";
                    data.batchid = $(event.target).attr("entityid");
                    data.studentid = $(event.target).parent().attr("entityid");
                    
                    var handler = function(response) //initialize adviser list menu
                    {
                        if(response.status === "1")
                            showNotification("Student added to batch.");
                        else
                            showNotification("Failed to student to batch.");
                    };
                    
                    post(data, handler);
                    
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            );
        }
    };
    
    get({query: "getbatches"}, handler);
}

function initAddToSubjectMenu()
{
    var $menu = $("div#addtosubjectmenu").empty();
    
    var handler = function(response) //initialize adviser list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].name+"</div>");

            $menuitem
            .attr("entityid", response[i].id)
            .css("padding-left", "6px")
            .css("padding-right", "6px");

            $menu.append($menuitem);

            $menuitem.click
            (
                function(event)
                {
                    var data = {};
                    
                    data.query = "poststudentsubject";
                    data.posttype = "add";
                    data.subjectid = $(event.target).attr("entityid");
                    data.studentid = $menu.attr("entityid");
                    
                    var handler = function(response) //initialize adviser list menu
                    {
                        if(response.status === "1")
                            showNotification("Student added to subject.");
                        else
                            showNotification("Failed to student to subject.");
                    };
                    
                    post(data, handler);
                    
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            );
        }
    };
    
    get({query: "getsubjects"}, handler);
}

function initSubjectsPerStudentMenu(dialog)
{
    var data = {};
    var $menu = $("div#gradedialogsubjectsmenu").empty();
    
    data.query = "getsubjectsperstudent";
    data.studentid = dialog.attr("entityid");

    var handler = function(response) //initialize adviser list menu
    {
        for(var i = 0; i < response.length; i++)
        {
            var $menuitem = $("<div class='menuitem'>"+response[i].subject+"</div>");

            $menu.append($menuitem);
            
            $menuitem.click
            (
                function(event)
                {
                    $("div#gradedialogsubjectsbutton").html($(event.target).html()).attr("subjectid", $(event.target).attr("subjectid"));
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    event.stopPropagation();
                }
            )
            .attr("subjectid", response[i].subjectid)
            .css("min-width", $("div#gradedialogsubjectsbutton").outerWidth());
        }
    };
    
    get(data, handler);
}

function selectRadioButton(id)
{
    var $button = $(id);
    
    if($button.hasClass("radio"))
    {
        //select this button
        $button.attr("select", "1");
        $button.animate({color: "#444444", backgroundColor: "#dddddd"}, "fast");
        
        //deselect other buttons in the group
        $("div.button.radio[group='"+$button.attr("group")+"']").not($button).each
        (
            function()
            {
                $(this).attr("select", "0").animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");
            }
        );
    }
}

function toggleButton($button, toggle)
{
    if($button.hasClass("toggle"))
    {
        if(toggle === "1")
            $button.attr("select", "1").attr("toggle", "1").animate({color: "#444444", backgroundColor: "#dddddd"}, "fast");
        else
            $button.attr("select", "0").attr("toggle", "0").animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");
    }
}

function initButtons()
{
    $("div.button")
    .each
    (
        function()
        {
            if($(this).hasClass("toggle"))
            {
                toggleButton($(this), $(this).attr("toggle"));
                
                $(this).setToggleable
                (
                    function(event)
                    {
                        $(event.target)
                        .attr("select", "1")
                        .animate({color: "#444444", backgroundColor: "#dddddd"}, "fast");
                    }, 

                    function(event)
                    {
                        $(event.target)
                        .attr("select", "0")
                        .animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");
                    }
                )
                .mouseover
                (
                    function(event)
                    {
                        if($(this).attr("toggle") === "0")
                            $(this).animate({color: "#666666", backgroundColor: "#aaaaaa"}, "fast");

                        event.stopPropagation();
                    }
                )
                .mouseout
                (
                    function(event)
                    {
                        if($(this).attr("toggle") === "0")
                            $(this).animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");

                        event.stopPropagation();
                    }
                );
            }
            else if($(this).hasClass("radio"))
            {
                if($(this).attr("select") === "1")
                    selectRadioButton($(this));
                
                $(this)
                .mouseover
                (
                    function(event)
                    {
                        if($(this).attr("select") === "0")
                            $(this).animate({color: "#666666", backgroundColor: "#aaaaaa"}, "fast");

                        event.stopPropagation();
                    }
                )
                .mouseout
                (
                    function(event)
                    {
                        if($(this).attr("select") === "0")
                            $(this).animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");

                        event.stopPropagation();
                    }
                )
                .click
                (
                    function(event)
                    {
                        //select this button
                        $(this).attr("select", "1");
                        $(this).animate({color: "#444444", backgroundColor: "#dddddd"}, "fast");
                        
                        //deselect other buttons in the group
                        $("div.button.radio[group='"+$(this).attr("group")+"']").not($(this)).each
                        (
                            function()
                            {
                                $(this).attr("select", "0").animate({color: "#bbbbbb", backgroundColor: "#888888"}, "fast");
                            }
                        );

                        event.stopPropagation();
                    }
                );
            }
            else
            {
                $(this)
                .mouseover
                (
                    function(event)
                    {
                        $(this).animate({color: "#666666", backgroundColor: "#aaaaaa"}, "fast");
                        event.stopPropagation();
                    }
                )
                .mouseout
                (
                    function(event)
                    {
                        $(this).animate({color: "#444444", backgroundColor: "#dddddd"}, "fast");
                        event.stopPropagation();
                    }
                );
            }
        }
    );
    
    $("div.toggleampm").click
    (
        function()
        {
            $(this).disableSelection();
            
            if($(this).html() === "AM")
                $(this).html("PM");
            else
                $(this).html("AM");
        }
    );
}

function initContentTabs()
{
    $("div.contenttab")
    .each
    (
        function()
        {
            var tab = $(this);
            
            tab
            .click
            (
                function(event)
                {
                    var data = {};
                    var icon = tab.find("div.tabicon");
                    var firstLevel = $("div#firstlevelresult");
                    var secondLevel = $("div#secondlevelresult");
                    var thirdLevel = $("div#thirdlevelresult");
                    
                    //mark selected tab
                    icon.css("opacity", "1");
                    tab.css("border-top", "1px solid #ff7722").css("border-bottom", "1px solid #ff7722").css("border-left", "1px solid #ff7722");
                    
                    //deselect other tabs
                    $("div.contenttab").not(tab)
                    .css("border-top", "1px solid transparent")
                    .css("border-bottom", "1px solid transparent")
                    .css("border-left", "1px solid transparent")
                    .find("div.tabicon")
                    .css("opacity", "0");
                    
                    switch(event.target.id) //process content request
                    {
                        case "subjectstab":
                        {
                            data.query = "getsubjects";

                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                    createContent(firstLevel, "subject"+i, "subject", response[i].name, response[i]);
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                        case "teacherstab":
                        {
                            data.query = "getteachers";
                            
                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                    createContent(firstLevel, "teacher"+i, "teacher", response[i].name, response[i]);
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                        case "adviserstab":
                        {
                            data.query = "getadvisers";
                            
                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                    createContent(firstLevel, "adviser"+i, "adviser", response[i].name, response[i]);
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                        case "studentstab":
                        {
                            data.query = "getstudents";
                            
                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                    createContent(firstLevel, "student"+i, "student", response[i].name, response[i]);
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                        case "adminstab":
                        {
                            data.query = "getadmins";
                            
                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                {
                                    createContent(firstLevel, "admin"+i, "admin", response[i].name, response[i]);
                                }
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                        case "batchestab":
                        {
                            data.query = "getbatches";
                            
                            var handler = function(response)
                            {
                                //clear content
                                firstLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                secondLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                thirdLevel.empty().css("opacity", "0").css("min-height", $("div#tabspanel").height()+"px");
                                
                                for(var i = 0; i < response.length; i++)
                                    createContent(firstLevel, "batch"+i, "batch", response[i].name, response[i]);
                                
                                firstLevel.fadeTo("fast", 1);
                            };

                            get(data, handler);
                            
                            break;
                        }
                    }

                    event.stopPropagation();
                }
            );
        }
    );
}

function createContent(panel, id, type, text, entitydata)
{
    var $cardicon = null;
    var $batchicon = null;
    var $subjecticon = null;
    var $gradeicon = null;
    var $attendanceicon = null;
    var $tabicon = $("<div class='tabicon'></div>");
    var $editicon = $("<div id='edit"+id+"'class='editicon resulticon' tooltip='Edit'></div>");
    var $deleteicon = $("<div id='delete"+id+"'class='deleteicon resulticon' tooltip='Delete'></div>");
    var $content = $("<div id='"+id+"' class='resultitem contenttab "+type+"'>"+text+"</div>").append($tabicon);

    $content.append($deleteicon).append($editicon);
    
    if(type === "student")
    {
        $cardicon = $("<div id='card"+id+"'class='cardicon resulticon' tooltip='Generate Report Card'></div>");
        $batchicon = $("<div id='batch"+id+"'class='batchicon resulticon' tooltip='Add To Batch'></div>");
        $subjecticon = $("<div id='subject"+id+"'class='subjecticon resulticon' tooltip='Enroll To Subject'></div>");
        $gradeicon = $("<div id='grade"+id+"'class='gradeicon resulticon' tooltip='Edit Grade'></div>");
        $attendanceicon = $("<div id='attendance"+id+"'class='attendanceicon resulticon' tooltip='Edit Attendance'></div>");
       
        $content.append($batchicon);
        $content.append($cardicon);
        $content.append($subjecticon);
        $content.append($gradeicon);
        $content.append($attendanceicon);
    }

    $content
    .click
    (
        function()
        {
            var $nextLevel = null;
            var panelID = panel.attr("id");
            
            //establish next level panel and reset content of succeeding levels
            if(panelID === "firstlevelresult")
            {
                $nextLevel = $("div#secondlevelresult").empty().css("opacity", "0").css("min-height", $("div#firstlevelresult").height()+"px");
                $("div#thirdlevelresult").empty().css("opacity", "0");
            }
            else if(panelID === "secondlevelresult")
                $nextLevel = $("div#thirdlevelresult").empty().css("opacity", "0").css("min-height", $("div#secondlevelresult").height()+"px");
            
            //mark selected item
            $tabicon.css("opacity", "1");
            $content.css("border-top", "1px solid #ff7722").css("border-bottom", "1px solid #ff7722");

            //deselect other items
            panel.find("div.contenttab").not($content)
            .css("border-top", "1px solid transparent")
            .css("border-bottom", "1px solid transparent")
            .find("div.tabicon")
            .css("opacity", "0");
            
            switch(type)
            {
                case "subject":
                {
                    var data = {};
                    
                    var handler = function(response)
                    {
                        for(var i = 0; i < response.length; i++)
                            createContent($nextLevel, "student"+i, "student", response[i].name, response[i]);
                    };

                    data.query = "getstudentspersubject";
                    data.id = entitydata.id;

                    get(data, handler);
                    
                    break;
                }
                case "teacher":
                {
                    var data = {};
                    
                    var handler = function(response)
                    {
                        for(var i = 0; i < response.length; i++)
                            createContent($nextLevel, "subject"+i, "subject", response[i].name, response[i]);
                    };

                    data.query = "getsubjectsperteacher";
                    data.id = entitydata.id;

                    get(data, handler);
                    
                    break;
                }
                case "adviser":
                {
                    var data = {};
                    
                    var handler = function(response)
                    {
                        for(var i = 0; i < response.length; i++)
                            createContent($nextLevel, "student"+i, "student", response[i].name, response[i]);
                    };

                    data.query = "getadvisees";
                    data.name = entitydata.name;

                    get(data, handler);
                    
                    break;
                }
                case "batch":
                {   
                    var data = {};
                    
                    var handler = function(response)
                    {
                        for(var i = 0; i < response.length; i++)
                            createContent($nextLevel, "student"+i, "student", response[i].name, response[i]);
                    };

                    data.query = "getstudentsperbatch";
                    data.id = entitydata.id;

                    get(data, handler);
                    
                    break;
                }
                case "student":
                {   
                    break;
                }
                case "admin":
                {
                    break;
                }
            }
            
            if($nextLevel !== null)
                $nextLevel.fadeTo("fast", 1);
        }
    )
    .initTooltip()
    .disableSelection();
    
    if($cardicon !== null)
    {
        $cardicon
        .click
        (
            function(event)
            {
                event.stopPropagation();
            }
        );
    }
    
    if($batchicon !== null)
    {
        $batchicon
        .click
        (
            function(event)
            {
                var $menu = $("div#addtobatchmenu");
                
                $menu
                .attr("entityid", entitydata.id)
                .css("opacity", "0.9")
                .css("visibility", "visible")
                .slideToggle
                (
                    "fast",
            
                    function() //called when animatin completes
                    {
                        var menuOffset = $menu.offset().top + $menu.outerHeight();
                        
                        if(menuOffset > window.innerHeight+window.scrollY) //part of menu is outside viewport, adjust position
                            $menu.animate({top: $menu.offset().top - (menuOffset - window.innerHeight)}, "fast");
                    }
                )
                .offset
                (
                    {
                        left: $batchicon.offset().left,
                        top: $batchicon.offset().top + $(this).outerHeight()
                    }
                );
                
                event.stopPropagation();
            }
        );
    }
    
    if($subjecticon !== null)
    {
        $subjecticon
        .click
        (
            function(event)
            {
                var $menu = $("div#addtosubjectmenu");
                
                $menu
                .attr("entityid", entitydata.id)
                .css("opacity", "0.9")
                .css("visibility", "visible")
                .slideToggle
                (
                    "fast",
            
                    function() //called when animatin completes
                    {
                        var menuOffset = $menu.offset().top + $menu.outerHeight();
                        
                        if(menuOffset > window.innerHeight+window.scrollY) //part of menu is outside viewport, adjust position
                            $menu.animate({top: $menu.offset().top - (menuOffset - window.innerHeight)}, "fast");
                    }
                )
                .offset
                (
                    {
                        left: $subjecticon.offset().left,
                        top: $subjecticon.offset().top + $(this).outerHeight()
                    }
                );
        
                event.stopPropagation();
            }
        );
    }
    
    if($gradeicon !== null)
    {
        $gradeicon
        .click
        (
            function(event)
            {
                var $dialog = $("div#gradedialog");
                
                $("div#gradedialogsubjectsbutton").html("");
                
                $dialog
                .attr("entityid", entitydata.id)
                .css("visibility", "visible")
                .fadeTo("fast", 0.9);
        
                initSubjectsPerStudentMenu($dialog);

                event.stopPropagation();
            }
        );
    }
    
    if($attendanceicon !== null)
    {
        $attendanceicon
        .click
        (
            function(event)
            {
                var $dialog = $("div#attendancedialog");

                $dialog
                .attr("entityid", entitydata.id)
                .css("visibility", "visible")
                .fadeTo("fast", 0.9);

                event.stopPropagation();
            }
        );
    }
    
    $editicon
    .click
    (
        function(event)
        {
            var $dialog = null;

            if(type === "subject")
            {
                $dialog = $("div#addsubjectdialog")
                .css("visibility", "visible")
                .fadeTo("fast", 0.9)
                .attr("posttype", "edit")
                .attr("entityid", entitydata.id)
                .attr("contenttype", type)
                .attr("contentpane", panel.attr("id"));

                if(entitydata.type === "Regular")
                    selectRadioButton("div#addsubjectregularbutton");
                else
                    selectRadioButton("div#addsubjecthomeroombutton");

                $("div#addsubjectnametextfield").html(entitydata.name);
                $("div#addsubjectdesctextarea").html(entitydata.desc);
                $("div#addsubjectunitstextfield").html(entitydata.units);
                $("div#addsubjectteacherbutton").html(entitydata.teacher);
                $("div#addsubjectstarthourbutton").html(entitydata.startHour);
                $("div#addsubjectstartminbutton").html(entitydata.startMin);
                $("div#addsubjectstartampmbutton").html(entitydata.startAMPM);
                $("div#addsubjectendhourbutton").html(entitydata.endHour);
                $("div#addsubjectendminbutton").html(entitydata.endMin);
                $("div#addsubjectendampmbutton").html(entitydata.endAMPM);
            }
            else if(type === "student")
            {
                $dialog = $("div#addstudentdialog")
                .css("visibility", "visible")
                .fadeTo("fast", 0.9)
                .attr("posttype", "edit")
                .attr("entityid", entitydata.id)
                .attr("contenttype", type)
                .attr("contentpane", panel.attr("id"));
        
                if(entitydata.sex === "Male")
                    selectRadioButton("div#addstudentmalebutton");
                else
                    selectRadioButton("div#addstudentfemalebutton");

                $("div#addstudentnametextfield").html(entitydata.name);
                $("div#addstudentaddresstextfield").html(entitydata.address);
                $("div#addstudentnattextfield").html(entitydata.nationality);
                $("div#addstudentcurrtextfield").html(entitydata.curriculum);
                $("div#addstudentstatustextfield").html(entitydata.status);
                $("div#addstudentbdatedaybutton").html(entitydata.birthDay);
                $("div#addstudentbdatemonthbutton").html(entitydata.birthMonth);
                $("div#addstudentbdateyearbutton").html(entitydata.birthYear);
            }
            else if(type === "batch")
            {
                $dialog = $("div#addbatchdialog")
                .css("visibility", "visible")
                .fadeTo("fast", 0.9)
                .attr("posttype", "edit")
                .attr("entityid", entitydata.id)
                .attr("contenttype", type)
                .attr("contentpane", panel.attr("id"));

                $("div#addbatchsectiontextfield").html(entitydata.section);
                $("div#addbatchstartacadyeartextfield").html(entitydata.startacadyear);
                $("div#addbatchendacadyeartextfield").html(entitydata.endacadyear);
                $("div#addbatchadviserbutton").html(entitydata.adviser);
                $("div#addsbatchyearlevelbutton").html(entitydata.yearlevel);
            }
            else if(type === "teacher" || type === "adviser" || type === "admin")
            {
                $dialog = $("div#adduserdialog")
                .css("visibility", "visible")
                .fadeTo("fast", 0.9)
                .attr("posttype", "edit")
                .attr("contenttype", type)
                .attr("contentpane", panel.attr("id"));
        
                if(entitydata.name === $("div#userpanel").html())
                    $dialog.attr("updateuserpanel", "1");
                else
                    $dialog.attr("updateuserpanel", "0");

                $("div#adduseridtextfield").html(entitydata.id);
                $("div#addusernametextfield").html(entitydata.name);

                toggleButton($("div#adduserteacherbutton"), entitydata.teacher);
                toggleButton($("div#adduseradviserbutton"), entitydata.adviser);
                toggleButton($("div#adduseradminbutton"), entitydata.admin);
            }

            //mark selected item
            $tabicon.css("opacity", "1");
            $content.css("border-top", "1px solid #ff7722").css("border-bottom", "1px solid #ff7722");

            //deselect other items
            panel.find("div.contenttab").not($content)
            .css("border-top", "1px solid transparent")
            .css("border-bottom", "1px solid transparent")
            .find("div.tabicon")
            .css("opacity", "0");

            event.stopPropagation();
        }
    );
    
    $deleteicon
    .click
    (
        function(event)
        {
            var $nextLevel = null;
            
            //establish next level panel
            if(panel.attr("id") === "firstlevelresult")
                $nextLevel = $("div#secondlevelresult");
            else if(panel.attr("id") === "secondlevelresult")
                $nextLevel = $("div#thirdlevelresult");
            
            $("div#confirmdeletedialog")
            .attr("contenttype", type)
            .attr("contentpane", panel.attr("id"))
            .attr("entityid", entitydata.id)
            .css("visibility", "visible")
            .fadeTo("fast", 0.9);
            
            //mark selected item
            $tabicon.css("opacity", "1");
            $content.css("border-top", "1px solid #ff7722").css("border-bottom", "1px solid #ff7722");
            
            //deselect other items
            panel.find("div.contenttab").not($content)
            .css("border-top", "1px solid transparent")
            .css("border-bottom", "1px solid transparent")
            .find("div.tabicon")
            .css("opacity", "0");
            
            event.stopPropagation();
        }
    );
    
    if(panel !== null)
        panel.append($content);
    
    return $content;
}

function refreshContent(panel, type)
{
    var data = {};
    var panelID = panel.attr("id");
    
    panel.empty();
    
    if(panelID === "firstlevelresult")
    {
        $("div#secondlevelresult").empty().css("opacity", "0").css("min-height", $("div#firstlevelresult").height()+"px");
        $("div#thirdlevelresult").empty().css("opacity", "0");
    }
    else if(panelID === "secondlevelresult")
        $("div#thirdlevelresult").empty().css("opacity", "0").css("min-height", $("div#secondlevelresult").height()+"px");

    switch(type)
    {
        case "subject":
        {
            data.query = "getsubjects";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "subject"+i, "subject", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "student":
        {
            data.query = "getstudents";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "student"+i, "student", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "teacher":
        {
            data.query = "getteachers";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "teacher"+i, "teacher", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "adviser":
        {
            data.query = "getadvisers";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "adviser"+i, "adviser", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "advisee":
        {
            data.query = "getadvisees";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "advisee"+i, "student", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "admin":
        {
            data.query = "getadmins";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "admin"+i, "admin", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
        case "batch":
        {
            data.query = "getbatches";
            
            var handler = function(response)
            {
                for(var i = 0; i < response.length; i++)
                    createContent(panel, "batch"+i, "batch", response[i].name, response[i]);
            };

            get(data, handler);

            break;
        }
    }
    
    panel.fadeTo("fast", 1);
}

function initMenus()
{
    initBatchMenu();
    initAddToSubjectMenu();
    initTeachersMenu();
    initAdvisersMenu();
    
    $("div.menuinvoker")
    .each
    (
        function()
        {
            var $invoker = $(this);

            $("div#"+$invoker.attr("invoke")).attr("invoker", $invoker.attr("id"));

            $invoker.click
            (
                function(event)
                {
                    var $menu = $("div#"+$invoker.attr("invoke"))
                    .css("opacity", "0.9")
                    .slideToggle
                    (
                        "fast",

                        function() //called when animatin completes
                        {
                            var menuOffset = $menu.offset().top + $menu.outerHeight();

                            if(menuOffset > window.innerHeight+window.scrollY) //part of menu is outside viewport, adjust position
                                $menu.animate({top: $menu.offset().top - (menuOffset - window.innerHeight)}, "fast");
                        }
                    )
                    .offset
                    (
                        {
                            left: $invoker.offset().left,
                            top: $invoker.offset().top + $(this).outerHeight()
                        }
                    );

                    event.stopPropagation();
                }
            );
        }
    );
    
    $("div.menu")
    .each
    (
        function()
        {
            var $menu = $(this);
            
            $menu
            .mouseleave
            (
                function(event)
                {
                    $menu.slideUp("fast");
                    event.stopPropagation();
                }
            );
        }
    )
    .hide();
    
    $("div.menuitem")
    .each
    (
        function()
        {
            $(this)
            .click
            (
                function(event)
                {
                    $("div#"+$(event.target).parent().attr("invoker")).html($(event.target).html());
                    $(event.target).parent().fadeTo("fast", 0, function(){$(this).hide();});
                    
                    event.stopPropagation();
                }
            )
            .css("min-width", $("div#"+$(this).parent().attr("invoker")).outerWidth());
        }
    );
}

function showNotification(message)
{
    $("div#notification")
    .html(message)
    .css("visibility", "visible")
    .fadeTo("slow", 0.80)
    .setCentered()
    .delay(600)
    .fadeTo("slow", 0, function(){$(this).css("visibility", "hidden");});
}

function post(data, success, error, complete) //ajax wrapper
{
    $.ajax
    (
        {
            data: data,
            type: "POST",
            dataType: "json",
            success: success,
            error: error,
            complete: complete,
            url: "../index.php/post"
        }
    );
}

function get(data, success, error, complete) //ajax wrapper
{
    $.ajax
    (
        {
            data: data,
            type: "GET",
            dataType: "json",
            success: success,
            error: error,
            complete: complete,
            url: "../index.php/get"
        }
    );
}

function initialize()
{
    initPlugins();
    initTools();
    initTooltips();
    initDialogs();
    initButtons();
    initMenus();
    initSearch();
    initContentTabs();
    initFloatingToolbar();
    
    $("div#header").disableSelection();
    $("div#userpanel").disableSelection();
    $("div#tabspanel").disableSelection();
    $("div#copyright").disableSelection();
}