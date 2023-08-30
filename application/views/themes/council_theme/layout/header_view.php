<!doctype html>
<html>

<head>
    <base href="<?php echo base_url() ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>WBSCTVESD</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->config->item('theme_uri'); ?>councils/images/favicon.ico">
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri'); ?>councils/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri'); ?>councils/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri'); ?>councils/plugin/select2/css/select2.min.css ">
	
	<!--owl carousel-->
	<link rel="stylesheet" href="<?php echo $this->config->item('theme_uri'); ?>councils/css/owl.carousel.css">

    <?php foreach ($this->css_head as $hcss) { ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo $hcss ?>">
    <?php } ?>
   <!--  <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri'); ?>css/youth_responsive-style.css"> -->
    <?php if ($this->theme_css != "") { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri'); ?>css/<?php echo $this->theme_css; ?>">
    <?php } ?>

    <!--JS-->
    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/jquery.min.js">
    </script>
    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/bootstrap.js">
    </script>
    <!--counter JS-->
    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/jquery.countup.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/jquery.waypoints.min.js"></script>

    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/sweetalert.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/plugin/select2/js/select2.full.min.js"></script>
	
	<!--owl carousel-->
	<script type="text/javascript" src="<?php echo $this->config->item('theme_uri'); ?>councils/js/owl.carousel.js"></script>

    <style>
        .btn-skoch {
            box-sizing: border-box;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: transparent;
            border: 2px solid #e74c3c;
            border-radius: 0.6em;
            color: #e74c3c;
            cursor: pointer;
            display: flex;
            align-self: center;
            /* font-size: 1rem; */
            font-size: 12px;
            font-weight: 400;
            line-height: 1;
            margin: 10px;
            /* padding: 1.2em 2.8em; */
            padding: 1em 2em;
            text-decoration: none;
            text-align: center;
            text-transform: uppercase;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }


        .btn-skoch {
            border-color: #fff;
            border-radius: 0;
            color: #fff;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: color 150ms ease-in-out;
        }

        .btn-skoch:after {
            content: "";
            position: absolute;
            display: block;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 100%;
            background: #fff;
            z-index: -1;
            transition: width 150ms ease-in-out;
        }

        .btn-skoch:hover {
            color: #f4822e;
        }

        .btn-skoch:hover:after {
            width: 110%;
        }

        @-webkit-keyframes blinker {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .blink {
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 0.6s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
            -webkit-animation-direction: alternate;
        }
    </style>
</head>

<body>
    <header class="fixed">
        <div class="headtop">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-8">
                                <a class="navbar-brand" href="<?php echo base_url() ?>"><img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/logo.png" alt="WBSCTVESD"></a>
                                <!-- <a href="https://exhibition.skoch.in/exhibition/west-bengal-state-council-of-technical-and-vocational-education-and-skill-development/" target="_blank" class="btn-skoch pull-right">Vote For SKOCH Projects</a> -->

                                <!--<a href="<?php echo base_url('files/recruitment_advertisement.pdf'); ?>" target="_blank" class="btn-skoch pull-right blink">Urgent Requirement of S/W Prof. &nbsp;&nbsp;<img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/new.gif"></a>-->
								
								<!-- Add By Moli On 06-12-2022-->
								<a href="https://www.pbssd.gov.in/result"  target="_blank" class="btn-skoch pull-right blink">Urgent Requirement of S/W Prof. &nbsp;&nbsp;<img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/new.gif"></a>
								
							</div>
                            <div class="col-md-4">
                                <div class="headtop-link text-right">
                                    <!--<a href="coming_soon" target="_blank"><i class="fa fa-file-text-o"></i> Online Application for JEXPO / VOCLET</a>-->
                                    <div class="social-links">
                                        <a href="coming_soon" title="Facebook"><i class="fa fa-facebook fb"></i></a>
                                        <a href="coming_soon" title="Twitter"><i class="fa fa-twitter tw"></i></a>
                                        <a href="coming_soon" title="Linkedin"><i class="fa fa-linkedin in"></i></a>
                                        <a href="coming_soon" title="Youtube"><i class="fa fa-youtube-play tube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="head-list">
                            <ul>
                                <li class="searchbar">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <div class="togglesearch">
                                        <input type="text" placeholder="" />
                                        <input type="button" value="Search" />
                                    </div>
                                </li>

                                <li class="textdropdown"> <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/resize.png">
                                    <div class="drop-content">
                                        <a href="coming_soon">A+</a>
                                        <a href="coming_soon">A</a>
                                        <a href="coming_soon">A-</a>
                                    </div>
                                </li>

                                <li class="select-dropdown">
                                    <select>
                                        <option>English</option>
                                        <option>বাংলা</option>
                                    </select>
                                </li>


                                <li class="">
                                    <a class="loginbtn" href="admin"><i class="fa fa-lock"></i> Login</a>

                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="menuarea">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <nav class="navbar navbar-expand-lg navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">About Us</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="about/organogram">Overview</a></li>
                                            <li><a class="dropdown-item" href="about/council_members">Council Members</a></li>
                                            <li><a class="dropdown-item" href="about/executive_council">Executive Council</a></li>
                                            <!-- <li><a class="dropdown-item" href="about/vision_mission">Vision Mission</a></li> -->

                                            <li><a class="dropdown-item" href="about/vision_mission">Vision Mission</a></li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Desk</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="desk/mic">MOS (IC)</a></li>
                                                    <li><a class="dropdown-item" href="desk/p_secretary">Principle Secretary</a></li>
                                                    <li><a class="dropdown-item" href="desk/chairperson">Chairperson</a></li>
                                                    <li><a class="dropdown-item" href="desk/cao">CAO & Member Secretary</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" href="about/officers">Officers of the Council</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Admission</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="admission/hs_vocational">HS (Vocational)</a></li>
                                            <li><a class="dropdown-item" href="admission/class_x_vse">Class X (VSE)</a></li>
                                            <li><a class="dropdown-item" href="admission/class_xii_vhse">Class XII (VHSE)</a></li>
                                            <li><a class="dropdown-item" href="admission/viii_x_stc">VIII+/X+ STC</a></li>
                                            <li><a class="dropdown-item" href="admission/nqr_listed_courses">NQR Listed Course</a></li>
                                            <li><a class="dropdown-item" href="admission/stvt">STTC</a></li>
                                            <li><a class="dropdown-item" href="admission/polytechnic">Polytechnic</a></li>
											<li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/">JEXPO/VOCLET</a></li>
                                            <!-- <li><a class="dropdown-item" href="admission/polytechnic">Polytechnic</a></li> -->
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Academic</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">HS (Vocational)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/hs_voc/course_catalogue">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class X (VSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/class_x_vse/course_catalogue">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class XII (VHSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/class_xii_vhse/course_catalogue">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">NQR listed STT</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/viii_stc/nqr_list">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">NSQF structured STT</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/viii_stc/course_catalogue">Course Catalogue</a></li>
                                                </ul>
                                            </li>
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Non NQR listed</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Course Catalogue</a></li>

                                                </ul>
                                            </li> -->
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Other STT</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/stvt/course_catalogue">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Polytechnic</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="academic/polytechnic">Course Catalogue</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Examination</a>
                                        <ul class="dropdown-menu">
                                            <!-- <li><a class="dropdown-item" target="_blank" href="files/Academic%20Calendar%202019-20.pdf">Academic Calendar</a></li> -->
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">HS (Vocational)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/hs_voc_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class X (VSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/class_x_vse_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class XII (VHSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/class_xiii_vhse_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">VIII+/X+ STC</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/class_viii_x_stc_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">NQR Listed Course</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/nqr_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Non NQR listed</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Course Catalogue</a></li>

                                                </ul>
                                            </li> -->
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">STVT</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="exam/stvt_academic_callender">Academic Callender</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Polytechnic</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="exam/polytechnic_callender">Academic Callender</a></li>
                                                    <!-- <li><a class="dropdown-item" target="_blank" href="files/Academic%20Calendar%202019-20.pdf">Academic Callender</a></li> -->
                                                    <li><a class="dropdown-item" href="coming_soon">Examination Schedule</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Notice/Circular</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Result</a></li>

                                                </ul>
                                            </li>
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle"
                                                    href="coming_soon">On line Registration</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Internal</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">External</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" href="coming_soon">On line Fee Submission</a></li> -->
                                        </ul>
                                    </li>

                                    <!-- <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">e-Learning</a>
                                        <ul class="dropdown-menu">
                                        
                                            <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/E-Learning">E-Learning</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/3dm-Learning">3dm-Learning</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/vtc-study">VTC Study</a></li>
                                                    
                                            </li>
                                        </ul>
                                    </li> -->
                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">e-Learning</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">HS (Vocational)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/vtc-study">Study material</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class X (VSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="http://www.wbtetsd.gov.in/elearning/reading_materials/reading_materials_list">Study material</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Class XII (VHSE)</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="http://www.wbtetsd.gov.in/elearning/reading_materials/reading_materials_list">Study material</a></li>

                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">VIII+/X+ STC</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/vtc-study">Study material</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">NQR Listed Course</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/vtc-study">Study material</a></li>

                                                </ul>
                                            </li>
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Non NQR listed</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Course Catalogue</a></li>

                                                </ul>
                                            </li> -->
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">STVT</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="coming_soon">Study material</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Polytechnic</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/E-Learning">Study material</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/3dm-Learning">Digital content with 3D/2D visual</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Online Application</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Institute Login</a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">VTC / STTC / Polytechnic Institute Login</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" target="" href="online_app/inst/vtc/registration">Registration & Examination Related</a></li>
                                                            <!--<li><a class="dropdown-item" href="coming_soon">Affiliation Apply / Renewal</a></li>-->
                                                            <li><a class="dropdown-item" href="online_app/inst/vtc/affiliation">Affiliation Apply / Renewal / Registration</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Grievance</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Suggestion</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Nodal Login</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="online_app/inst/nodal/registration">Registration & Examination Related</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Grievance</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Suggestion</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Polytechnic Login</a>
                                                        <ul class="dropdown-menu">
                                                            <!-- <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/">Registration & Examination Related</a></li> -->
                                                            <li><a class="dropdown-item" target="_blank" href="polytechnic/affiliation">Renewal of affiliation</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Grievance</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Suggestion</a></li>
                                                        </ul>
                                                    </li>
                                                    <!--li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">STVT Login</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/">Registration Validation</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Renewal of affiliation</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Grievance</a></li>
                                                            <li><a class="dropdown-item" href="coming_soon">Suggestion</a></li>
                                                        </ul>
                                                    </li-->
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">CSS-VSE School</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="online_app/inst/cssvse/registration">Registration</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Faculty Login</a>
                                                <ul class="dropdown-menu">
                                                    <!-- <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/teacher/login/">Polytechnic Faculty</a></li> -->
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Polytechnic Faculty</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/teacher/login/">Evaluation</a></li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Student Login</a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Polytechnic</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/student-login">Registration</a></li>
                                                            <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/student/transfer">Transfer application</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li-->
                                            <!--li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">JEXPO/VOCLET</a>

                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/JEXPO-VOCLET">Apply online</a></li>
                                                    <!--<li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/assets/pdf/JEXPO_2021.pdf">Information Brochure of JEXPO 2021</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/assets/pdf/VOCLET_2021.pdf">Information Brochure of VOCLET 2021</a></li>-->
                                                    <!--li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Counselling</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" target="_blank" href="https://jexpo.webscte.co.in/">JEXPO</a></li>
                                                            <li><a class="dropdown-item" target="_blank" href="https://voclet.webscte.co.in/">VOCLET</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li-->
                                             <li><a class="dropdown-item" target="_blank" href="assessor/assessor_reg">Assessor registration</a></li>
                                            <!-- Added by Atreyee -->
                                       <!-- <li><a class="dropdown-item" target="_blank" href="online_application_various_courses/registration">PDPC/PDME</a></li> -->
									   
										<!--li><a class="dropdown-item" target="_blank" href="vtc/student_reg">Student registration</a></li-->
										
										<li><a class="dropdown-item" target="_blank" href="online_application_various_courses/apply">Online application for admission<br> in Polytechnic through JEXPO/VOCLET</a></li>
										<li><a class="dropdown-item" target="_blank" href="vtc/student_reg_login">Student Registration</a></li>
                                        <li><a class="dropdown-item" target="_blank" href="polytechnic/transfer">Student Transfer</a></li>
                                            <!-- end --->
											
											<!-- Added By Moli -->
											<!--<li><a class="dropdown-item" target="_blank" href="vtc/student_reg">VTC Student registration</a></li-->
											
											
                                            <!-- <li><a class="dropdown-item" href="online_app/useful_link">Useful link</a></li> -->
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Useful link</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Affiliation / Renewal</a></li>
                                                </ul>
                                            </li> -->
                                            <!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Students Log In</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Registration</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Application</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Admission</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Examination</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Duplicate Certificate</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Grievance</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Suggestion</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Submission of fees</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Useful Links</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/JEXPO-VOCLET">JEXPO/VOCLE</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/student/transfer">Student Transfer</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/student-login">Student Registration </a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://jexpo.webscte.co.in/">JEXPO Counselling </a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://voclet.webscte.co.in/">VOCLET Counselling</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://exam.webscte.co.in/">Institute Login</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://affiliation.webscte.co.in/">Affiliation/ Renewal</a></li>
                                                    <li><a class="dropdown-item" target="_blank" href="https://affiliation.webscte.co.in/">Study Materials</a></li>
                                                    
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" href="online/jexpo_voclet">JEXPO/VOCLET Application Procedure </a></li> -->  
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Events</a>
                                        <ul class="dropdown-menu">

                                            <!-- Added by Moli on 02-06-2023 -->
                                            <li><a class="dropdown-item" href="online_counselling/apply">Online Counselling</a></li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Exam Schedule</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">HS(vocational)</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">VIII+/X+ STC</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Polytechnic</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="coming_soon">Assessment</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="coming_soon">Class X(VSE)</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">Class XII (VHSE)</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">NQR Courses</a></li>
                                                    <li><a class="dropdown-item" href="coming_soon">PBSSD</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" href="coming_soon">Placement Camp</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Job Fair</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Competition</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Sports</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Award Ceremony </a></li>
                                            <!-- <li><a class="dropdown-item" href="coming_soon">Competition</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Exam Schedule</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Job Fair</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Placement Camps</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Assessments</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Sports</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Award Ceremony</a></li> -->
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Grievance</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/Grievance/0">Registration of Grievance</a></li>
                                            <!-- <li><a class="dropdown-item" target="_blank" href="https://webscte.co.in/Grievance/0">webscte.co.in/Grievance/0</a></li> -->
                                            <li><a class="dropdown-item" href="coming_soon">Summation of Grievance &amp;Redressals</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Student Tracker</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="coming_soon">Further Studies</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Apprenticeship</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Training</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Job</a></li>
                                            <li><a class="dropdown-item" href="coming_soon">Entrepreneurship</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </header>