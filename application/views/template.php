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

        <link rel="stylesheet" type="text/css" href="css/main.css"/>

        <script type="text/JavaScript" src="frameworks/jquery-2.1.3.js"></script>
        <script type="text/JavaScript" src="frameworks/jquery.color-2.1.2.js"></script>
        <script type="text/JavaScript" src="frameworks/factory.js"></script>
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
                        <div id="userpanel">John Paul Quijano</div>

                        <div id="signout" class="tool" tooltip="Sign-out" invoke="signoutdialog"></div>
                        <div id="about" class="tool" tooltip="About" invoke="aboutdialog"></div>
                        <div id="sendmessage" class="tool" tooltip="Send Message" invoke="messagedialog"></div>
                        <div id="search" class="tool" tooltip="Search"></div>
                        <div id="searchfield" class="singleline" contenteditable="true">Search</div>
                    </div>
                </div>

                <div id="floatingtoolbar">
                    <div id="floatingtoolwrapper">
                        <div id="floatingsearchfield" class="singleline" contenteditable="true">Search</div>
                        <div id="floatingsearch" class="floatingtool"></div>
                        <div id="floatingsendmessage" class="floatingtool" invoke="messagedialog"></div>
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
                        <div id="signoutdialogokbutton" class="dialogokbutton" tooltip="OK"></div>
                    </div>
                </div>

                <div id="aboutdialog" class="dialog">
                    <div class="titlebar">
                        <span>About</span>
                        <div id="aboutdialogclosebutton" class="dialogclosebutton" tooltip="Close"></div>
                    </div>
                </div>

                <div id="messagedialog" class="dialog">
                    <div class="titlebar">
                        <span>Send Message</span>
                        <div id="messagedialogclosebutton" class="dialogclosebutton" tooltip="Cancel"></div>
                    </div>

                    <div id="messagedialogcontent" class="dialogcontent">
                        <div class="label">To</div>
                        <div id="messagetotextfield" class="textfield singleline" contenteditable="true"></div><br/>

                        <div class="label">Message</div>
                        <div id="messagecontenttextarea" class="textarea" contenteditable="true"></div>
                    </div>

                    <div class="buttonbar">
                        <div id="messagedialogokbutton" class="dialogokbutton" tooltip="Send"></div>
                    </div>
                </div>

                <div id="contentpanel">
                    
                </div>
                
                <div id="notification"></div>
                <div id="loadinganimation"></div>

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
