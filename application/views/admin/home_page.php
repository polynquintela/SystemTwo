<!DOCTYPE html>
<!--
Copyright (c) 2015, the development team
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.

Created on : Apr 10, 2015, 11:29:13 PM
Author     : John Paul Quijano
-->

<html>
    <head>
        <title></title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/main.css"/>

        <script type="text/JavaScript" src="<?php echo base_url();?>frameworks/jquery-2.1.3.js"></script>
        <script type="text/JavaScript" src="<?php echo base_url();?>frameworks/jquery.color-2.1.2.js"></script>
        <script type="text/JavaScript" src="<?php echo base_url();?>frameworks/factory.js"></script>
    </head>
    <body>
        <div id="background">
            <div id="centerblock">
                <div id="topblock">
                    <div id="header">
                        <div id="logopanel">
                        </div>

                        <div id="schoolname">
                            <span id="university">UNIVERSITY OF THE PHILIPPINES </span>
                            <span id="highschool">RURAL HIGH SCHOOL</span>
                        </div>
                    </div>

                    <div id="toolbar">
                        <div id="userpanel"><?php echo $name?></div>

                        <div id="signout" class="tool" tooltip="Sign-out" invoke="signoutdialog"></div>
                        <div id="about" class="tool" tooltip="Information" invoke="aboutdialog"></div>
                        <div id="viewlogs" class="tool" tooltip="View Logs" invoke="logsdialog"></div>
                        <div id="genreport" class="tool" tooltip="Generate Report" invoke="reportdialog"></div>
                        <div id="adduser" class="tool" tooltip="Add User" invoke="adduserdialog"></div>
                        <div id="addbatch" class="tool" tooltip="Add Batch" invoke="addbatchdialog"></div>
                        <div id="addsubject" class="tool" tooltip="Add Subject" invoke="addsubjectdialog"></div>
                        <div id="addstudent" class="tool" tooltip="Add Student" invoke="addstudentdialog"></div>
                        <div id="search" class="tool" tooltip="Search"></div>
                        <div id="searchfield" class="singleline" contenteditable="true">Search</div>
                    </div>
                </div>

                <div id="floatingtoolbar">
                    <div id="floatingtoolwrapper">
                        <div id="floatingsearchfield" class="singleline" contenteditable="true">Search</div>
                        <div id="floatingsearch" class="floatingtool"></div>
                        <div id="floatingaddstudent" class="floatingtool" invoke="addstudentdialog"></div>
                        <div id="floatingaddsubject" class="floatingtool" invoke="addsubjectdialog"></div>
                        <div id="floatingaddbatch" class="floatingtool" invoke="addbatchdialog"></div>
                        <div id="floatingadduser" class="floatingtool" invoke="adduserdialog"></div>
                        <div id="floatinggenreport" class="floatingtool" invoke="reportdialog"></div>
                        <div id="floatingviewlogs" class="floatingtool" invoke="logsdialog"></div>
                        <div id="floatingabout" class="floatingtool" invoke="aboutdialog"></div>
                        <div id="floatingsignout" class="floatingtool" invoke="signoutdialog"></div>
                    </div>
                </div>

                <div id="signoutdialog" class="dialog">
                    <div class="titlebar">
                        <span>Sign-out</span>
                        <div id="signoutdialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div> 
                    </div>

                    <div id="signoutdialogcontent" class="dialogcontent">
                        Confirm Sign-out
                    </div>

                    <div class="buttonbar">
                        <?php echo form_open('l/logout');?>
                        <button type="submit" value="" id="signoutdialogokbutton" class="dialogokbutton" tooltip="OK"></button>
                        <?php echo form_close();?>
                    </div>
                </div>

                <div id="aboutdialog" class="dialog">
                    <div class="titlebar">
                        <span>Information</span>
                        <div id="aboutdialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                    
                    <div id="aboutdialogcontent" class="dialogcontent">
                        <h3>UPRS Grading System</h3>
                        <p>
                            Welcome to the UPRS Grading System, 
                            a web-based application for managing 
                            student scholastic records of the University 
                            of the Philippines Rural High School based 
                            in Bay, Laguna. This application provides 
                            the school faculty secure and convenient 
                            access to student records.
                        </p>
                        
                        <h3>Developers</h3>
                        <p>
                            Marion Paulo A. Dagang,
                            Mary E. Clarino,
                            Carlos L. Catalan,
                            Bernadette M. Magat,
                            Merwin Jacob A. Alinea,
                            Orlando C. Tapia,
                            Xavier M. Lambon,
                            Louise Alvaran,
                            Chernhelyn I. Caponpon,
                            Yel  P. Gaminde,
                            John Paul T. Quijano,
                            Polyn Quintela,
                            Zyrine Mae A. Importa,
                            Ma Pauline S. Gonzales,
                            Paolo A. Casugay,
                            Jemuel de Villa,
                            Jude Dominic D. del Rio
                        </p>
                    </div>
                    
                    <div class="buttonbar"></div>
                </div>

                <div id="adduserdialog" class="dialog">
                    <div class="titlebar">
                        <span class="">User</span>
                        <div id="adduserdialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div>
                    </div>

                    <div id="adduserdialogcontent" class="dialogcontent">
                        <div class="label">Employee Number</div>
                        <div id="adduseridtextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Name</div>
                        <div id="addusernametextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Designation</div>
                        <div id="adduserteacherbutton" class="button toggle threebuttonline adduserdesigbutton" select="0">Teacher</div>
                        <div id="adduseradviserbutton" class="button toggle threebuttonline adduserdesigbutton" select="0">Adviser</div>
                        <div id="adduseradminbutton" class="button toggle threebuttonline adduserdesigbutton" select="0">Admin</div><br/>
                    </div>

                    <div class="buttonbar">
                        <div id="adduserdialogokbutton" class="dialogokbutton" tooltip="Save"></div>
                    </div>
                </div>

                <div id="addsubjectdialog" class="dialog">
                    <div class="titlebar">
                        <span>Subject</span>
                        <div id="addsubjectdialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div>
                    </div>

                    <div id="addsubjectdialogcontent" class="dialogcontent">
                        <div class="label">Name</div>
                        <div id="addsubjectnametextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Units</div>
                        <div id="addsubjectunitstextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Description</div>
                        <div id="addsubjectdesctextarea" class="textarea" contenteditable="true"></div>

                        <div class="label">Teacher</div>
                        <div id="addsubjectteacherbutton" class="button menuinvoker onebuttonline" invoke="addsubjectteachermenu"></div><br/>
                        
                        <div class="label">Type</div>
                        <div id="addsubjectregularbutton" class="button radio twobuttonline addsubjecttypebutton" group="subjecttype" select="1">Regular</div>
                        <div id="addsubjecthomeroombutton" class="button radio twobuttonline addsubjecttypebutton" group="subjecttype" select="0">Homeroom</div><br/>

                        <div class="label">Start Time</div>
                        <div id="addsubjectstarthourbutton" class="button menuinvoker threebuttonline addsubjecttimebutton" invoke="addsubjectstarthourmenu">8</div>
                        <div id="addsubjectstartminbutton" class="button singleline menuinvoker threebuttonline addsubjecttimebutton" invoke="addsubjectstartminmenu" contenteditable="true">00</div>
                        <div id="addsubjectstartampmbutton" class="button toggleampm threebuttonline addsubjecttimebutton">AM</div><br/>

                        <div class="label">End Time</div>
                        <div id="addsubjectendhourbutton" class="button menuinvoker threebuttonline addsubjecttimebutton" invoke="addsubjectendhourmenu">9</div>
                        <div id="addsubjectendminbutton" class="button singleline menuinvoker threebuttonline addsubjecttimebutton" invoke="addsubjectendminmenu" contenteditable="true">00</div>
                        <div id="addsubjectendampmbutton" class="button toggleampm threebuttonline addsubjecttimebutton">AM</div><br/>

                        <div id="addsubjectstarthourmenu" class="menu">
                            <div class="menuitem">1</div><div class="menuitem">2</div><div class="menuitem">3</div>
                            <div class="menuitem">4</div><div class="menuitem">5</div><div class="menuitem">6</div>
                            <div class="menuitem">7</div><div class="menuitem">8</div><div class="menuitem">9</div>
                            <div class="menuitem">10</div><div class="menuitem">11</div><div class="menuitem">12</div>
                        </div>

                        <div id="addsubjectstartminmenu" class="menu">
                            <div class="menuitem">00</div>
                            <div class="menuitem">15</div>
                            <div class="menuitem">30</div>
                            <div class="menuitem">45</div>
                        </div>

                        <div id="addsubjectendhourmenu" class="menu">
                            <div class="menuitem">1</div><div class="menuitem">2</div><div class="menuitem">3</div>
                            <div class="menuitem">4</div><div class="menuitem">5</div><div class="menuitem">6</div>
                            <div class="menuitem">7</div><div class="menuitem">8</div><div class="menuitem">9</div>
                            <div class="menuitem">10</div><div class="menuitem">11</div><div class="menuitem">12</div>
                        </div>

                        <div id="addsubjectendminmenu" class="menu">
                            <div class="menuitem">00</div>
                            <div class="menuitem">15</div>
                            <div class="menuitem">30</div>
                            <div class="menuitem">45</div>
                        </div>
                        
                        <div id="addsubjectteachermenu" class="menu"></div>
                    </div>

                    <div class="buttonbar">
                        <div id="addsubjectdialogokbutton" class="dialogokbutton" tooltip="Save"></div>
                    </div>
                </div>

                <div id="addstudentdialog" class="dialog">
                    <div class="titlebar">
                        <span>Student</span>
                        <div id="addstudentdialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div>
                    </div>

                    <div id="addstudentdialogcontent" class="dialogcontent">
                        <div class="label">Name</div>
                        <div id="addstudentnametextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Nationality</div>
                        <div id="addstudentnattextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Address</div>
                        <div id="addstudentaddresstextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Curriculum</div>
                        <div id="addstudentcurrtextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Status</div>
                        <div id="addstudentstatustextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Sex</div>
                        <div id="addstudentmalebutton" class="button radio twobuttonline addstudentsexbutton" group="studentsex" select="1">Male</div>
                        <div id="addstudentfemalebutton" class="button radio twobuttonline addstudentsexbutton" group="studentsex" select="0">Female</div><br/>

                        <div class="label">Birthdate</div>
                        <div id="addstudentbdatemonthbutton" class="button menuinvoker threebuttonline addstudentbdatebutton" invoke="addstudentbdatemonthmenu">January</div>
                        <div id="addstudentbdatedaybutton" class="button singleline menuinvoker threebuttonline addstudentbdatebutton" invoke="addstudentbdatedaymenu" contenteditable="true">1</div>
                        <div id="addstudentbdateyearbutton" class="button singleline menuinvoker threebuttonline addstudentbdatebutton" invoke="addstudentbdateyearmenu" contenteditable="true">2000</div><br/>

                        <div id="addstudentbdatemonthmenu" class="menu">
                            <div class="menuitem">January</div><div class="menuitem">February</div><div class="menuitem">March</div>
                            <div class="menuitem">April</div><div class="menuitem">May</div><div class="menuitem">June</div>
                            <div class="menuitem">July</div><div class="menuitem">August</div><div class="menuitem">September</div>
                            <div class="menuitem">October</div><div class="menuitem">November</div><div class="menuitem">December</div>
                        </div>

                        <div id="addstudentbdatedaymenu" class="menu">
                            <div class="menuitem">1</div><div class="menuitem">2</div><div class="menuitem">3</div>
                            <div class="menuitem">4</div><div class="menuitem">5</div><div class="menuitem">6</div>
                            <div class="menuitem">7</div><div class="menuitem">8</div><div class="menuitem">9</div>
                            <div class="menuitem">10</div><div class="menuitem">11</div><div class="menuitem">12</div>
                            <div class="menuitem">13</div><div class="menuitem">14</div><div class="menuitem">15</div>
                            <div class="menuitem">16</div><div class="menuitem">17</div><div class="menuitem">18</div>
                            <div class="menuitem">19</div><div class="menuitem">20</div><div class="menuitem">21</div>
                            <div class="menuitem">22</div><div class="menuitem">23</div><div class="menuitem">24</div>
                            <div class="menuitem">25</div><div class="menuitem">26</div><div class="menuitem">27</div>
                            <div class="menuitem">28</div><div class="menuitem">29</div><div class="menuitem">30</div>
                            <div class="menuitem">31</div>
                        </div>

                        <div id="addstudentbdateyearmenu" class="menu">
                            <div class="menuitem">2000</div>
                            <div class="menuitem">2001</div>
                            <div class="menuitem">2002</div>
                            <div class="menuitem">2003</div>
                            <div class="menuitem">2004</div>
                            <div class="menuitem">2005</div>
                            <div class="menuitem">2006</div>
                        </div>
                    </div>

                    <div class="buttonbar">
                        <div id="addstudentdialogokbutton" class="dialogokbutton" tooltip="Save"></div>
                    </div>
                </div>
                
                <div id="addbatchdialog" class="dialog">
                    <div class="titlebar">
                        <span>Batch</span>
                        <div id="addbatchdialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div>
                    </div>
                    
                    <div id="addbatchdialogcontent" class="dialogcontent">
                        <div class="label">Section</div>
                        <div id="addbatchsectiontextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Start Academic Year</div>
                        <div id="addbatchstartacadyeartextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">End Academic Year</div>
                        <div id="addbatchendacadyeartextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Adviser</div>
                        <div id="addbatchadviserbutton" class="button menuinvoker onebuttonline" invoke="addbatchadvisermenu"></div><br/>
                        
                        <div class="label">Year Level</div>
                        <div id="addbatchyearlevelbutton" class="button menuinvoker onebuttonline" invoke="addbatchyearlevelmenu">Grade 7</div><br/>
                        
                        <div id="addbatchyearlevelmenu" class="menu">
                            <div class="menuitem">Grade 7</div>
                            <div class="menuitem">Grade 8</div>
                            <div class="menuitem">Grade 9</div>
                            <div class="menuitem">Grade 10</div>
                            <div class="menuitem">Grade 11</div>
                            <div class="menuitem">Grade 12</div>
                        </div>
                        
                        <div id="addbatchadvisermenu" class="menu"></div>
                    </div>
                    
                    <div class="buttonbar">
                        <div id="addbatchdialogokbutton" class="dialogokbutton" tooltip="Save"></div>
                    </div>
                </div>
                
                <div id="confirmdeletedialog" class="dialog">
                    <div class="titlebar">
                        <span>Delete</span>
                        <div id="confirmdeletedialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div> 
                    </div>

                    <div id="confirmdeletedialogcontent" class="dialogcontent">
                        Confirm Delete
                    </div>

                    <div class="buttonbar">
                        <div id="confirmdeletedialogokbutton" class="dialogokbutton" tooltip="OK"></div>
                    </div>
                </div>
                
                <div id="logsdialog" class="dialog">
                    <div class="titlebar">
                        <span>Logs</span>
                        <div id="logsdialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                    
                    <div id="logsdialogcontent" class="dialogcontent">
                        <div id="logsdialogcontentcolumns">
                            <div id="logid" class="logsdialogcontentcolumn">
                                <div class="logsdialogcontentheader">Log ID</div>
                                <div class="logsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="logdate" class="logsdialogcontentcolumn">
                                <div class="logsdialogcontentheader">Date & Time</div>
                                <div class="logsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="logemp" class="logsdialogcontentcolumn">
                                <div class="logsdialogcontentheader">Employee ID</div>
                                <div class="logsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="logactivity" class="logsdialogcontentcolumn">
                                <div class="logsdialogcontentheader">Activity</div>
                                <div class="logsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="logremark" class="logsdialogcontentcolumn">
                                <div class="logsdialogcontentheader endcell">Remark</div>
                                <div class="logsdialogcontentcontent"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="buttonbar">
                    </div>
                </div>
                
                <div id="resultsdialog" class="dialog">
                    <div class="titlebar">
                        <span>Results</span>
                        <div id="resultsdialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                    
                    <div id="resultsdialogcontent" class="dialogcontent">
                        <div id="resultsdialogcontentcolumns">
                            <div id="entityid" class="resultsdialogcontentcolumn">
                                <div class="resultsdialogcontentheader">ID</div>
                                <div class="resultsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="entityname" class="resultsdialogcontentcolumn">
                                <div class="resultsdialogcontentheader">Name</div>
                                <div class="resultsdialogcontentcontent"></div>
                            </div>
                            
                            <div id="entitytype" class="resultsdialogcontentcolumn">
                                <div class="resultsdialogcontentheader endcell">Type</div>
                                <div class="resultsdialogcontentcontent"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="buttonbar">
                    </div>
                </div>
                
                <div id="gradedialog" class="dialog">
                    <div class="titlebar">
                        <span>Grade</span>
                        <div id="gradedialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                    
                    <div id="gradedialogcontent" class="dialogcontent">
                        <div class="label">Grade</div>
                        <div id="gradedialoggradetextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Grading Period</div>
                        <div id="gradedialoggradingperiodbutton" class="button menuinvoker onebuttonline" invoke="gradedialoggradingperiodmenu">First Quarter</div><br/>
                        
                        <div class="label">Subjects</div>
                        <div id="gradedialogsubjectsbutton" class="button menuinvoker onebuttonline" invoke="gradedialogsubjectsmenu"></div><br/>
                        
                        <div id="gradedialoggradingperiodmenu" class="menu">
                            <div class="menuitem">First Quarter</div>
                            <div class="menuitem">Second Quarter</div>
                            <div class="menuitem">Third Quarter</div>
                            <div class="menuitem">Fourth Quarter</div>
                        </div>
                        
                        <div id="gradedialogsubjectsmenu" class="menu">
                        </div>
                    </div>
                    
                    <div class="buttonbar">
                        <div id="gradedialogokbutton" class="dialogokbutton" tooltip="OK"></div>
                    </div>
                </div>
                
                <div id="attendancedialog" class="dialog">
                    <div class="titlebar">
                        <span>Attendance</span>
                        <div id="attendancedialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                    
                    <div id="attendancedialogcontent" class="dialogcontent">
                        <div class="label">Total School Days</div>
                        <div id="attendancedialogschooldaystextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Days Tardy</div>
                        <div id="attendancedialogtardytextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Days Present</div>
                        <div id="attendancedialogpresenttextfield" class="textfield singleline" contenteditable="true"></div><br/>
                        
                        <div class="label">Grading Period</div>
                        <div id="attendancedialoggradingperiodbutton" class="button menuinvoker onebuttonline" invoke="attendancedialoggradingperiodmenu">First Quarter</div><br/>
 
                        <div id="attendancedialoggradingperiodmenu" class="menu">
                            <div class="menuitem">First Quarter</div>
                            <div class="menuitem">Second Quarter</div>
                            <div class="menuitem">Third Quarter</div>
                            <div class="menuitem">Fourth Quarter</div>
                        </div>
                    </div>
                    
                    <div class="buttonbar">
                        <div id="attendancedialogokbutton" class="dialogokbutton" tooltip="OK"></div>
                    </div>
                </div>

                <div id="contentpanel">
                    <div id="tabspanel">
                        <div id="batchestab" class="contenttab">Batch<div class="tabicon"></div></div>
                        <div id="studentstab" class="contenttab">Student<div class="tabicon"></div></div>
                        <div id="subjectstab" class="contenttab">Subject<div class="tabicon"></div></div>
                        <div id="teacherstab" class="contenttab">Teacher<div class="tabicon"></div></div>
                        <div id="adviserstab" class="contenttab">Adviser<div class="tabicon"></div></div>
                        <div id="adminstab" class="contenttab">Admin<div class="tabicon"></div></div>
                    </div>

                    <div id="resultpanel">
                        <div id="firstlevelresult" class="resultlevel"></div>
                        <div id="secondlevelresult" class="resultlevel"></div>
                        <div id="thirdlevelresult" class="resultlevel"></div>
                    </div>
                </div>
                
                <div id="notification"></div>
                <div id="loadinganimation"></div>
                <div id="floatingtoolbarlabel">TOOLS</div>
                <div id="addtobatchmenu" class="menu"></div>
                <div id="addtosubjectmenu" class="menu"></div>
                <div id="copyright">Copyright © 2015, <a href="#" onclick="$('#aboutdialog').css('visibility', 'visible').fadeTo('fast', 0.9)">the development team</a>. All rights reserved.</div>
            </div>
        </div>

        <script type="text/JavaScript">
            $(document).ready
            (
                function()
                {
                    initialize();
                }
            );
        </script>
    </body>
</html>
