<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<link rel="stylesheet" type="text/css" href="themes/council_theme/councils/plugin/datatable/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="themes/council_theme/councils/plugin/datatable/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="themes/council_theme/councils/plugin/datatable/dataTables.bootstrap.min.css" />
<script type="text/javascript" src="themes/council_theme/councils/plugin/datatable/jquery-3.5.1.js"></script>
<script type="text/javascript" src="themes/council_theme/councils/plugin/datatable/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="themes/council_theme/councils/plugin/datatable/datatables.min.js"></script>
</header>

<section class="inner-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="breadcrumb-box">
					<h2 class="breadcrumb-title">Admission</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a target="_blank" href="#">Home</a></li>
						<li class="breadcrumb-item active">Higher Secondary (Voc) Course Catalogue </li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-hover" style="font-size:12px;">
				<tbody>
						<tr>
							<th>SERIAL</th>
							<th>DISCIPLINE</th>
							<th>SYLLABUS</th>
						</tr>
						<tr>
							<td>1</td>
							<td><a href="academic/hs_voc/course_catalogue/ag">AGRICULTURE</a></td>
							<td><a class="btn btn-primary btn-sm" href="files/academic/HS Vocational Syllabus/Syllabus Agriculture.pdf">Download</a></td>
						</tr>

						<tr>
							<td>2</td>
							<td><a href="academic/hs_voc/course_catalogue/et">ENGINEERING TECHNOLOGY</a</td>
							<td><a class="btn btn-primary btn-sm" href="files/academic/HS Vocational Syllabus/Syllabus Enineering & Technology.pdf">Download</a></td>
						</tr>

						<tr>
							<td>3</td>
							<td><a href="academic/hs_voc/course_catalogue/hs">HOME SCIENCE</a</td>
							<td><a class="btn btn-primary btn-sm" href="files/academic/HS Vocational Syllabus/Syllabus Home Science.pdf">Download</a></td>
						</tr>
						
						<tr>
							<td>4</td>
							<td><a href="academic/hs_voc/course_catalogue/bc">BUSINESS COMMERCE</a</td>
							<td><a class="btn btn-primary btn-sm" href="files/academic/HS Vocational Syllabus/Syllabus Business & Commerce.pdf">Download</a></td>
						</tr>
						
					</tbody>
				</table>
			<br>
			<br>

			<h3>Institute List</h3>
			
			<div class="table-responsive">
				<table id="data_table" class="table table-striped table-bordered table-hover" style="font-size:12px;">
					<thead>
					<tr>
						<td>Serial</td>
						<td>Group Code1</td>
						<td>Group Code2</td>
						<td>Group Code3</td>
						<td>INSTITUTE NAME</td>
						<td>DISTRICT</td>
						<td>ADDRESS</td>
						<td>MUNICIPALITY/BLOCK</td>
						<td>PANCHAYET</td>
						<td>PIN NO.</td>
						<td>INSTITUTE PHONE</td>
						<td>VTC EMAIL</td>
						<td>Lab Availibility</td>
						<td>Hostel Availiblity</td>
						<td>View Institute location on map</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>RURAL VOCATIONAL TRAINING
							INSTITUTE RAMAKRISHNA VIVEKANANDA MISSION</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - JOYRAMBATI</td>
						<td>KOTULPUR</td>
						<td>USMANPUR</td>
						<td>721659</td>
						<td>3.23E+09</td>
						<td>KALIKAKHALIGIRLS@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>ITI, CHHATNA</td>
						<td>BANKURA</td>
						<td>P.O. - CHHATNA,</td>
						<td>CHHATNA</td>
						<td>ANANTAPUR-I</td>
						<td>721653</td>
						<td>3.23E+09</td>
						<td>ANANTAPURBNGIRLS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>3</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>ITI SABRAKONE</td>
						<td>BANKURA</td>
						<td>P.O. - SABRAKONE</td>
						<td>TALDANGRA</td>
						<td>SARBERIA-II</td>
						<td>721146</td>
						<td>9.78E+09</td>
						<td>NKKBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>4</td>
						<td>BCLS</td>
						<td>BCRS</td>
						<td></td>
						<td>DUBRAJPUR UTTARAYAN VIDYATAN</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - DUBRAJPUR</td>
						<td>INDPUR</td>
						<td>AJABNAGAR-II</td>
						<td>721212</td>
						<td>3.23E+09</td>
						<td>BALARAMGARHHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>5</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BASULI BANPUSRA JR. HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - NISCHINTAPUR</td>
						<td>CHHATNA</td>
						<td>PINDRUI-VIII</td>
						<td>721131</td>
						<td>9.73E+09</td>
						<td>PINDRUI.K.I.V.7211@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>6</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>TALDANGRA FULMATI HIGH SCHOOL
							(H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - TALDANGRA</td>
						<td>TALDANGRA</td>
						<td>KHANDAGHOSH</td>
						<td>713142</td>
						<td>9.43E+09</td>
						<td>OHS.1963@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>7</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>ASANBANI KAJALKURA S. M. JR.
							HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. ,KAJAL KURA,
							P.O. - AHANDA</td>
						<td>INDPUR</td>
						<td></td>
						<td>731101</td>
						<td>9.56E+09</td>
						<td>HAMIDIAHM123@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>8</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KOTULPUR HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - KOTULPUR</td>
						<td>KOTULPUR</td>
						<td></td>
						<td>731224</td>
						<td>9.15E+09</td>
						<td>HMBHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>9</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>RAJAGRAM S.B. RAHA
							INSTITUTION</td>
						<td>BANKURA</td>
						<td>P.O. - RAHAGRAM</td>
						<td>JAYPUR</td>
						<td>AMDOLE</td>
						<td>731219</td>
						<td>9.15E+09</td>
						<td>KALAHAPURHMKH786@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>10</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MEJIA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - MEJIA</td>
						<td>MEJHIA</td>
						<td>HASAN-I</td>
						<td>731202</td>
						<td>9.05E+09</td>
						<td>SJMVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>11</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>RANIBANDH HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - RANIBANDH</td>
						<td>RANIBUNDH</td>
						<td>RAJGRAM</td>
						<td>731222</td>
						<td>9.87E+09</td>
						<td><a href="mailto:RJMMAHS@GMAIL.COM">RJMMAHS@GMAIL.COM</a>
						</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>12</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>PURANDARPUR HIGH SCHOOL
							(H.S.)</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. -
							PURANDARPUR</td>
						<td>BANKURA - II</td>
						<td>SINGHEE</td>
						<td>731240</td>
						<td>9.43E+09</td>
						<td>SINGHEEHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>13</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BIKNA KSHIRODE PRASAD SMRITI
							VIDYAPITH (H.S.) SCHOOL</td>
						<td>BANKURA</td>
						<td>BIKNA, P.O. -
							KESHIAKOLE,</td>
						<td>BANKURA - II</td>
						<td>HAZARATPUR</td>
						<td>731125</td>
						<td>3.46E+09</td>
						<td>RASARAJLAKSHMIHIGHSCHOOL5636@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>14</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>DHEKO RAJANI KANTA HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - DHEKO</td>
						<td>RAIPUR</td>
						<td>NOAPARA</td>
						<td>731237</td>
						<td>9.23E+09</td>
						<td>UPSH1952@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>15</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>AMARKANAN DESHBANDHU
							VIDYALAYA</td>
						<td>BANKURA</td>
						<td>P.O. - AMARKANAN</td>
						<td>GANGAJALGHATI</td>
						<td>DWARKA</td>
						<td>731303</td>
						<td>9.48E+09</td>
						<td>ABADANGA5671@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>16</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>SHAMAYITA MATH</td>
						<td>BANKURA</td>
						<td>RANBAHAL, AMARKANAN</td>
						<td>GANGAJALGHATI</td>
						<td>PADUMA</td>
						<td>731124</td>
						<td>3.46E+09</td>
						<td>KDSHM5673@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>17</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>SIMLAPAL MADAN MOHAN HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - SIMLAPAL</td>
						<td>SIMLAPAL</td>
						<td>GOLAMARA</td>
						<td>723147</td>
						<td>9.93E+09</td>
						<td>GLMSCH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>18</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BELIATORE HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - BELIATORE</td>
						<td>BARJORA</td>
						<td>MURADIH</td>
						<td>723156</td>
						<td>9.43E+09</td>
						<td>MURADIGIRLSHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>19</td>
						<td>BCLS</td>
						<td>BCRS</td>
						<td></td>
						<td>RAMSAGAR HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - RAMSAGAR</td>
						<td>ONDA</td>
						<td>MIRA-II</td>
						<td>741156</td>
						<td>9.48E+09</td>
						<td>SMNSHSV6316@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>20</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>HIRBANDH HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - HILBANDH</td>
						<td>HIRBANDH</td>
						<td>BAGULA-I</td>
						<td>741502</td>
						<td>3.47E+09</td>
						<td>19101211705.HS.C@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>21</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>INDUS HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - INDUS</td>
						<td>INDUS</td>
						<td>MALIBARI-I</td>
						<td>742304</td>
						<td>9.78E+09</td>
						<td>AMIRABADHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>22</td>
						<td>BCLS</td>
						<td>BCRS</td>
						<td></td>
						<td>MADHUBAN GOENKA VIDYALAYA</td>
						<td>BANKURA</td>
						<td>P.O. - PAPURDIHI</td>
						<td>BANKURA - I</td>
						<td>PAHARPUR</td>
						<td>742302</td>
						<td>9.47E+09</td>
						<td>ISLAM.ASRAFUL87@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>23</td>
						<td>BCLS</td>
						<td>BCRS</td>
						<td></td>
						<td>CHHENDAPATHAR S.K.S.T. HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL- CHHENDAPATHAR, P.O. -
							BARIKUL</td>
						<td>RANIBUNDH</td>
						<td>SWARUPPUR</td>
						<td>742166</td>
						<td>9.47E+09</td>
						<td>SWARUPPURHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>24</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>SALDIHA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - SALDIHA</td>
						<td>INDPUR</td>
						<td></td>
						<td>742103</td>
						<td>3.48E+09</td>
						<td>BLMGHS6924@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>25</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>RASULPUR HIGH MADRASAH (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - RASULPUR</td>
						<td>PATRASAYER</td>
						<td>ISLAMPUR</td>
						<td>742304</td>
						<td>3.48E+09</td>
						<td>NAZIRPUR.ESSERPARAHS6932@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>26</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BANKURA BANGA VIDYALAY</td>
						<td>BANKURA</td>
						<td>MACHANTALA, P.O. - BANKURA</td>
						<td>BANKURA (M)</td>
						<td>SAMBALPUR</td>
						<td>732102</td>
						<td>9.8E+09</td>
						<td>MAHARAJNAGARHIGHMADRASAHHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>27</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BISHNUPUR KRITTIBUS MUKHERJEE
							HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>NEAR BISHNUPUR
							MUNICIPALITY,P.O- BISHNUPUR,</td>
						<td>BISHNUPUR (M)</td>
						<td>SADLICHAK</td>
						<td>732125</td>
						<td>8.12E+09</td>
						<td>SADLICHAKHIGHSCHOOL.SCHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>28</td>
						<td>BCLS</td>
						<td>BCRS</td>
						<td></td>
						<td>NANDA PALLIMANGAL HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - JHARIAKACHA, VILL. -
							NANDA</td>
						<td>HIRBANDH</td>
						<td>KALIA CHAK-I</td>
						<td>732201</td>
						<td>9.59E+09</td>
						<td>KHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>29</td>
						<td>BCLS</td>
						<td>BCTE</td>
						<td></td>
						<td>SHASHPUR D. N. S INSTITUTION</td>
						<td>BANKURA</td>
						<td>P.O. &amp; VILL. - SHASHPUR</td>
						<td>INDUS</td>
						<td>UDAYPUR</td>
						<td>733121</td>
						<td>7.6E+09</td>
						<td>MAHIPALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>30</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BARJORA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O.- BARJORA</td>
						<td>BARJORA</td>
						<td>CHOPRA</td>
						<td>733216</td>
						<td>9.56E+09</td>
						<td>CGHS.VOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>31</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BAROHAZARI SAMMILANI CHANDAI
							HIGH MADRASAH (H.S)</td>
						<td>BANKURA</td>
						<td>VILL. - CHANDAI, P.O. -
							PEARBERA</td>
						<td>BARJORA</td>
						<td></td>
						<td>733123</td>
						<td>3.52E+09</td>
						<td>DGRUVP@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>32</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BIKRAMPUR R.D. HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - BIKRAMPUR</td>
						<td>SIMLAPAL</td>
						<td>BARUA</td>
						<td>733134</td>
						<td>9.73E+09</td>
						<td>VTC.8561@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>33</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>CHAKA NIRMALANANDA HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - CHAKA</td>
						<td>KHATRA</td>
						<td></td>
						<td>733134</td>
						<td>9.56E+09</td>
						<td>RTCGHS.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>34</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>CHOUSAL HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL+ P.O. - CHOUSAL</td>
						<td>GANGAJALGHATI</td>
						<td>MAGURMARI-II</td>
						<td>735210</td>
						<td>9.78E+09</td>
						<td>MPVNHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>35</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KUCHIAKOL RADHABALLAV
							INSTITUTION</td>
						<td>BANKURA</td>
						<td>P.O. - DIGPAR</td>
						<td>JAYPUR</td>
						<td>SALBARI-I</td>
						<td>735220</td>
						<td>9.83E+09</td>
						<td>BIRSAVIDYABHAWANHIGHSL.JAL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>36</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>DHULAI RAMKUMAR MRINMOYEE
							VIDYAMANDIR</td>
						<td>BANKURA</td>
						<td>P.O. - GOPIKANTAPUR</td>
						<td>SONAMUKHI</td>
						<td></td>
						<td>735101</td>
						<td>3.56E+09</td>
						<td>KADAMTALAGIRLSJAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>37</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>DUNDAR SONAGARA ASHUTOSH
							VIDYAPITH</td>
						<td>BANKURA</td>
						<td>P.O. &amp; VILL. - DUNDAR</td>
						<td>RAIPUR</td>
						<td>CHAMTA</td>
						<td>736167</td>
						<td>9.93E+09</td>
						<td>CHAMTAADARSHAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>38</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>GARH RAIPUR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - GARH RAIPUR</td>
						<td>RAIPUR</td>
						<td>GHUGHUMARI</td>
						<td>736170</td>
						<td>3.58E+09</td>
						<td>HBGHS123@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>39</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>GOPALPUR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - GOPALPUR</td>
						<td>HIRBANDH</td>
						<td>BAMANHAT-I</td>
						<td>736168</td>
						<td>9.43E+09</td>
						<td>BAMANHATHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>40</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>GORABARI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL.&amp; P.O. -
							GORABARI</td>
						<td>KHATRA</td>
						<td>DHALPAL-I</td>
						<td>736159</td>
						<td>9.43E+09</td>
						<td>DHS.CB_VTC9339@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>41</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>HARMASRA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - HARMASRA</td>
						<td>TALDANGRA</td>
						<td>SOURANI-I</td>
						<td>734227</td>
						<td>9.43E+09</td>
						<td>RNHSVOC9810@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>42</td>
						<td>AGPM</td>
						<td></td>
						<td></td>
						<td>KARTICK ORAON NUTANGRAM S. S.
							A.HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. - SARESHKANALI. P.O. -
							CHHAGULIA</td>
						<td>ONDA</td>
						<td>PARSOLA</td>
						<td>722160</td>
						<td>9.43E+09</td>
						<td>PARSOLABBVM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>43</td>
						<td>AGPM</td>
						<td></td>
						<td></td>
						<td>KHATRA GIRLS HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - KHATRA</td>
						<td>KHATRA</td>
						<td>AGARDIH CHITRA</td>
						<td>723130</td>
						<td>9.73E+09</td>
						<td>AGARDIH2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>44</td>
						<td>AGPM</td>
						<td></td>
						<td></td>
						<td>MUNINAGAR RADHAKANTA
							VIDYAPITH</td>
						<td>BANKURA</td>
						<td>P.O. - MUNINAGAR</td>
						<td>BISHNUPUR (M)</td>
						<td>SONATHALI</td>
						<td>723121</td>
						<td>3.25E+09</td>
						<td>SBSONATHALI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>45</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>ONDA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - ONDA</td>
						<td>ONDA</td>
						<td>KARANJALI</td>
						<td>743348</td>
						<td>9.73E+09</td>
						<td>KARANJALIBKINSTVOC1774@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>46</td>
						<td>AGHC</td>
						<td>ETIA</td>
						<td></td>
						<td>PARSOLA BANIBITAN VIDYAMANDIR</td>
						<td>BANKURA</td>
						<td>AT. ,P.O. - PARSOLA
						</td>
						<td>SIMLAPAL</td>
						<td></td>
						<td>721657</td>
						<td>3.22E+09</td>
						<td>POURAPATHA3157@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>47</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td></td>
						<td>RADHANAGAR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - BON RADHANAGAR</td>
						<td>VISHNUPUR</td>
						<td>GARMAL</td>
						<td>721516</td>
						<td>3.22E+09</td>
						<td>MOUPALDPVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>48</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>RAJGRAM VIVEKANANDA HINDU
							VIDYALAYA</td>
						<td>BANKURA</td>
						<td>P.O. RAJGRAM</td>
						<td>BANKURA - I</td>
						<td>SARIA</td>
						<td>721506</td>
						<td>9.73E+09</td>
						<td>SARIATRIBALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>49</td>
						<td>AGHC</td>
						<td>BCLS</td>
						<td></td>
						<td>RANGAMATI UDBASTU COLONY
							MILANTIRTHA VIDYAPITH (H.S)</td>
						<td>BANKURA</td>
						<td>P.O. - DIHIPARA</td>
						<td>SONAMUKHI</td>
						<td>ROTAN</td>
						<td>712410</td>
						<td>7.41E+09</td>
						<td>GOTANSMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>50</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>SONAMUKHI B.J.HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - SONAMUKHI</td>
						<td>SONAMUKHI</td>
						<td>SIMLAPAL</td>
						<td>722151</td>
						<td>3.24E+09</td>
						<td>SIMLAPALMMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>51</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>UKHRADIHI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL + P.O. - UKHRADIHI</td>
						<td>GANGAJALGHATI</td>
						<td>KENJAKURA</td>
						<td>722132</td>
						<td>5025</td>
						<td>RATHINCHATTERJEE9474@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>52</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>BELIARA JR. HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. - BELIARA, P.O. -
							LATBELIARA</td>
						<td>VISHNUPUR</td>
						<td>S.K.DEAR</td>
						<td>742303</td>
						<td>9.73E+09</td>
						<td>RUKUNJJAMAN1990@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>53</td>
						<td>AGHC</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td>HARMASRA BRAHMANDIHA HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - LADDA BRAHMANDIHA</td>
						<td>TALDANGRA</td>
						<td>KIRTIPUR</td>
						<td>742159</td>
						<td>9.43E+09</td>
						<td>NAGARAMHIGHSCHOOLS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>54</td>
						<td>AGHC</td>
						<td>BCRS</td>
						<td>AGFF</td>
						<td>JHUNJHKA MADHYAMIK VIDYALAYA</td>
						<td>BANKURA</td>
						<td>P.O. - KARRAH</td>
						<td>CHHATNA</td>
						<td>KUSHMONDI</td>
						<td>733132</td>
						<td>3.52E+09</td>
						<td>DILIPKUMARDAS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>55</td>
						<td>AGHC</td>
						<td>BCRS</td>
						<td></td>
						<td>KALPATHAR BINAPANI HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. ,P.O. -
							KALPATHAR</td>
						<td>BANKURA - I</td>
						<td></td>
						<td>733101</td>
						<td>3.52E+09</td>
						<td>NAMABONGIHIGHSCHOOLBLG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>56</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>SABRAKONE HIGH SCHOOL
							(BENGALI MEDIUM)</td>
						<td>BANKURA</td>
						<td>VILL. - AMDANGRA, P.O. -
							SABRAKONE</td>
						<td>TALDANGRA</td>
						<td>DANGA</td>
						<td>733103</td>
						<td>9.43E+09</td>
						<td>RISTARASSRGHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>57</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>GANGAJALGHATI HIGH
							SCHOOL(H.S.)</td>
						<td>BANKURA</td>
						<td>GANGAJAL GHATI</td>
						<td>GANGAJALGHATI</td>
						<td></td>
						<td>733134</td>
						<td>3.52E+09</td>
						<td>HMSDPUVC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>58</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>BIBARDA SATCHIDANANDA
							VIDYAPITH</td>
						<td>BANKURA</td>
						<td>BIBARDA</td>
						<td>TALDANGRA</td>
						<td>PANIKOWRI</td>
						<td>7351345</td>
						<td>9.43E+09</td>
						<td>FATAPUKURSARADAMONISCHOOL.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>59</td>
						<td>AGHC</td>
						<td></td>
						<td></td>
						<td>BAITAL GOPESWAR PAL VIDYAPITH
							(H.S.)</td>
						<td>BANKURA</td>
						<td>BAITAL</td>
						<td>JAYPUR</td>
						<td></td>
						<td>734301</td>
						<td>3.55E+09</td>
						<td>SUMIVOC9752@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>60</td>
						<td>AGFF</td>
						<td></td>
						<td></td>
						<td>BIHARJURIA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>BIHARJURIA</td>
						<td>GANGAJALGHATI</td>
						<td>HERAMBAGOPALPUR</td>
						<td>743383</td>
						<td>9.73E+09</td>
						<td>DKHS1944@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>61</td>
						<td>AGFF</td>
						<td></td>
						<td></td>
						<td>DADHIMUKHA HIGH SCHOOL (H.S)</td>
						<td>BANKURA</td>
						<td>DADHIMUKHA</td>
						<td>BARJORA</td>
						<td>SRIKANTHA</td>
						<td>721647</td>
						<td>9.65E+09</td>
						<td>RRHS1945@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>62</td>
						<td>AGFF</td>
						<td>BCTE</td>
						<td></td>
						<td>FULKUSHMA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>VILL+P.O-FULKUSHMA
						</td>
						<td>RAIPUR</td>
						<td>AMRITBERIA</td>
						<td>721648</td>
						<td>9.33E+09</td>
						<td>MAYACHARHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>63</td>
						<td>AGFF</td>
						<td></td>
						<td></td>
						<td>PURUSOTTAMPUR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. - PURUSOTTAMPUR, P.O. -
							AGARDA</td>
						<td>ONDA</td>
						<td>HARIPUR</td>
						<td>721433</td>
						<td>3.22E+09</td>
						<td>WBSCVET3587@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>64</td>
						<td>AGFF</td>
						<td></td>
						<td></td>
						<td>BAN ASHURIA HIGH SCHOOL (H.S)</td>
						<td>BANKURA</td>
						<td>P.O. - BAN ASHURIA</td>
						<td>GANGAJALGHATI</td>
						<td>INDPUR</td>
						<td>722136</td>
						<td>3.24E+09</td>
						<td>JKUNDU@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>65</td>
						<td>AGFF</td>
						<td></td>
						<td></td>
						<td>BARCHATRA RAMKANAI
							INSTITUTION</td>
						<td>BANKURA</td>
						<td>P.O. - MAJAIRDANGA</td>
						<td>SONAMUKHI</td>
						<td>PATIKABARI</td>
						<td>741126</td>
						<td>9.15E+09</td>
						<td>19100305002.SG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>66</td>
						<td>AGCM</td>
						<td></td>
						<td></td>
						<td>CHANDRA K. S. H HIGH SCHOOL
							(H.S)</td>
						<td>BANKURA</td>
						<td>P.O. - CHANDRA</td>
						<td>SALTORA</td>
						<td>MONIPUR</td>
						<td>743446</td>
						<td>9.84E+09</td>
						<td>ATAPURKENARAMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>67</td>
						<td>AGCM</td>
						<td>ETBC</td>
						<td></td>
						<td>CHHANDAR GOURISANKAR HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							CHHANDAR</td>
						<td>BARJORA</td>
						<td>AMRITBERIA</td>
						<td>721628</td>
						<td>9.93E+09</td>
						<td>KESHABPUR.B.B.MANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>68</td>
						<td>AGCM</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td>DHANSIMLA VIDYABHAWAN (H.S)</td>
						<td>BANKURA</td>
						<td>P.O. - DHANSIMLA</td>
						<td>SONAMUKHI</td>
						<td>AMLAGORA</td>
						<td>721121</td>
						<td>3.23E+09</td>
						<td>BAN1_HIGHSCH@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>69</td>
						<td>AGCM</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td>KANKRADARA S. S VIDYALAYA</td>
						<td>BANKURA</td>
						<td>P.O. - KANKRADARA</td>
						<td>KHATRA</td>
						<td>SATBANKURA</td>
						<td>721253</td>
						<td>9.43E+09</td>
						<td>DNHS.VTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>70</td>
						<td>AGCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KUSUMBANI JAMUNADAS KHEMKA
							HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>STATION ROAD, BISHNUPUR, P.O.
							- BISHNUPUR</td>
						<td>BISHNUPUR (M)</td>
						<td>BALPAT</td>
						<td>721155</td>
						<td>9.59E+09</td>
						<td>TILANTAPARA_SCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>71</td>
						<td>AGCM</td>
						<td></td>
						<td></td>
						<td>LAKSHMISAGAR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							LAKSHMISAGAR</td>
						<td>SIMLAPAL</td>
						<td>BERANDA</td>
						<td>713126</td>
						<td>3.45E+09</td>
						<td>KURUMBAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>72</td>
						<td>AGCM</td>
						<td></td>
						<td></td>
						<td>SARENGA MAHATMAJI SMRITI
							VIDYAPITH</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							SARENGA</td>
						<td>SARENGA</td>
						<td>HATAGRAM</td>
						<td>722136</td>
						<td>9.43E+09</td>
						<td>UTTARAYAN50@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>73</td>
						<td>AGCM</td>
						<td></td>
						<td></td>
						<td>BAHARAMURI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>BAHARAMURI, HATIRAMPUR,</td>
						<td>HIRBANDH</td>
						<td>BAHIRI PANCHSOWA</td>
						<td>731240</td>
						<td>9.43E+09</td>
						<td>BIBEKRC.2007@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>74</td>
						<td>AGCM</td>
						<td>AGCF</td>
						<td></td>
						<td>KENJAKURA DAMODAR BALIKA
							VIDYALAYA (H.S.)</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O.
							- KENJAKURA</td>
						<td>BANKURA - I</td>
						<td>LAKHANPUR</td>
						<td>723101</td>
						<td>3.25E+09</td>
						<td><a
								href="mailto:YSSKVLAKHANPURL@GMAIL.COM">YSSKVLAKHANPURL@GMAIL.COM</a></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>75</td>
						<td>AGCM</td>
						<td></td>
						<td></td>
						<td>CHANGDOBA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>VILL. - CHANGDOBA, P.O. -
							SHYAMNAGAR</td>
						<td>JAYPUR</td>
						<td>DHARMODA</td>
						<td>741138</td>
						<td>3.47E+09</td>
						<td>TENTULBERIAHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>76</td>
						<td>AGCM</td>
						<td>BCLS</td>
						<td>AGPM</td>
						<td>JOYPUR HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							JOYPUR,</td>
						<td>JAYPUR</td>
						<td>MARAIKURA</td>
						<td>733123</td>
						<td>3.52E+09</td>
						<td>MIMV8559@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>77</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>BANKISOLE AKSHOY KUMAR
							INSTITUTION</td>
						<td>BANKURA</td>
						<td>P.O. - BANKISOLE</td>
						<td></td>
						<td>JETIA</td>
						<td>743135</td>
						<td>3.33E+09</td>
						<td>JHSVTC@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>78</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>NABASON HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - NABASON</td>
						<td>SONAMUKHI</td>
						<td>BIRSINGHA</td>
						<td>721222</td>
						<td>3.23E+09</td>
						<td>VIDYALAYA_BIRSINGHABHAGABATI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>79</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>KHATRA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. ,KHATRA</td>
						<td>KHATRA</td>
						<td>KAPGARI</td>
						<td>721505</td>
						<td>9.73E+09</td>
						<td>HM.KAPGARISBVIDYAYATAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>80</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>PALASDANGA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - PALASDANGA</td>
						<td>SONAMUKHI</td>
						<td>FULKUSHMA</td>
						<td>722162</td>
						<td>9.43E+09</td>
						<td>FULKUSHMAHS01@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>81</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>BHULANPUR HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - JAMJURI</td>
						<td>ONDA</td>
						<td>&nbsp;</td>
						<td>741127</td>
						<td>3.47E+09</td>
						<td>BHSVTC6254@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>82</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>NEPURA-KUMARARA S.B. HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. - NEPURA, P.O. -
							AKHOPAL,</td>
						<td>RAIPUR</td>
						<td>PAYRADANGA</td>
						<td>741247</td>
						<td>3.47E+09</td>
						<td>PRITINAGARBHUDEBSMRITIVIDYAPITHBOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>83</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>SONAMUKHI BYOM SANKAR HIGH
							SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - SONAMUKHI</td>
						<td>SONAMUKHI (M)</td>
						<td>SAGUNA</td>
						<td>741245</td>
						<td>9.23E+09</td>
						<td>SUBODHPAL7@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>84</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>KUSHADWIP MAKHANLAL
							VIDYAMANDIR (H.S.)</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							KUSHADWIP</td>
						<td>PATRASAYER</td>
						<td>MATIARY</td>
						<td>741153</td>
						<td>9.8E+09</td>
						<td>RAJIBNARAYANMUKHERJEE@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>85</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>PATRAHATI RAM RATAN HIGH
							SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O.- MAKARKOLE</td>
						<td>ONDA</td>
						<td>SAMSI</td>
						<td>732139</td>
						<td>9.73E+09</td>
						<td>BADRUL.BHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>86</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>CHAKSHYAMPUR JNANENDRA PRASAD
							HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							CHAKSHYAMPUR</td>
						<td>TALDANGRA</td>
						<td>KHARIA</td>
						<td>735101</td>
						<td>3.56E+09</td>
						<td>DHLHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>87</td>
						<td>AGCF</td>
						<td></td>
						<td></td>
						<td>HETIA HIGH SCHOOL (H.S.)</td>
						<td>BANKURA</td>
						<td>P.O. - HETIA,</td>
						<td>JAYPUR</td>
						<td></td>
						<td>735210</td>
						<td>3.56E+09</td>
						<td>DHUPGURIHIGH.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>88</td>
						<td>AGAH</td>
						<td>AGCF</td>
						<td></td>
						<td>NARICHA SARBAMANGALA
							VIDYAPITH</td>
						<td>BANKURA</td>
						<td>VILL. - NARICHA,P.O.
							- PANDUA</td>
						<td>PATRASAYER</td>
						<td>DEHI MANDALGHAT-II</td>
						<td>711301</td>
						<td>3.21E+09</td>
						<td>ANANTAPURSHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>89</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>PUTIADAHA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>AT ,P.O. - PUTIADAHA
						</td>
						<td>SIMLAPAL</td>
						<td>PURSURAH-I</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>JANGALPARABCKMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>90</td>
						<td>AGAH</td>
						<td>HSCH</td>
						<td></td>
						<td>KESHRA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. - KESHRA, P.O. - RUDRA</td>
						<td>RANIBUNDH</td>
						<td>TIROL</td>
						<td>712615</td>
						<td>3.21E+09</td>
						<td>1103GHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>91</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>JOYGARIA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - GOPALNAGAR</td>
						<td>JAYPUR</td>
						<td>JHENTLA</td>
						<td>721150</td>
						<td>9E+09</td>
						<td>BAHS_1956@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>92</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>CHHATNA BASUDEV VIDYAMINDIR
							(HIGH)</td>
						<td>BANKURA</td>
						<td>VILL. &amp;P.O. -
							CHHATNA</td>
						<td>CHHATNA</td>
						<td>RAMGARH</td>
						<td>721141</td>
						<td>3.23E+09</td>
						<td>RMSRAMGARH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>93</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>PURNPANI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL+P.O. - PURANPANI,</td>
						<td>RANIBUNDH</td>
						<td>CHANDABILA</td>
						<td>721125</td>
						<td>9.93E+09</td>
						<td>CHANDABILAS.C.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>94</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>GODARDIHI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - GODARDIHI</td>
						<td>BARJORA</td>
						<td>BORO JARAGORA</td>
						<td>723131</td>
						<td>9.43E+09</td>
						<td>BORO6003@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>95</td>
						<td>AGAH</td>
						<td>HSFN</td>
						<td></td>
						<td>NARRAH HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL.&amp; P.O. -
							NARRAH</td>
						<td>BANKURA - II</td>
						<td>CHOA G.P</td>
						<td>742166</td>
						<td>3.48E+09</td>
						<td>WBSCVET6751@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>96</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>ARKAMA HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>P.O. - ARKAMA</td>
						<td>KHATRA</td>
						<td>JASAHARI ANUKHA-I</td>
						<td>742138</td>
						<td>9.48E+09</td>
						<td>BAHARAVTC6758@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>97</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>TANADIGHI HIGH SCHOOL (H.S)</td>
						<td>BANKURA</td>
						<td>VILL. - TANADIGHI, P.O. -
							K-SADHUADAL</td>
						<td>JAYPUR</td>
						<td>CHAPARERPAR-II</td>
						<td>736208</td>
						<td>3.56E+09</td>
						<td>SMHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>98</td>
						<td>AGAH</td>
						<td></td>
						<td></td>
						<td>CHINGANI HIGH SCHOOL</td>
						<td>BANKURA</td>
						<td>VILL. &amp; P.O. - CHINGANI</td>
						<td>ONDA</td>
						<td>BAROKAIMARI</td>
						<td>736172</td>
						<td>9.93E+09</td>
						<td>NAGARDAKALIGANJHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>99</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>SHISHU NIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>BHATCHHALA, P.O. - SRIPALLY</td>
						<td>BARDDHAMAN (M)</td>
						<td>BARKOLA</td>
						<td>721301</td>
						<td>3.22E+09</td>
						<td>JAVIDYAYATAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>100</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>BENGAL INSTITUTE OF
							TECHNOLOGY, KATWA</td>
						<td>BARDHAMAN/EAST</td>
						<td>JAGIGRAM INDUSTRIAL COMPLEX,
							KATWA</td>
						<td>KATWA - I</td>
						<td>PINDRUI-VIII</td>
						<td>721152</td>
						<td>9.74E+09</td>
						<td>UPALDA3671@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>101</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>SATISH CHANDRA ITI</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KALNABAGRAM</td>
						<td>MEMARI - I</td>
						<td></td>
						<td>713358</td>
						<td>3.41E+09</td>
						<td>BNSN.BIJPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>102</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>VIDYANAGAR G.D.VIDYAMANDIR</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - VIDYANAGAR</td>
						<td>PURBASTHALI - I</td>
						<td></td>
						<td>713101</td>
						<td>3.42E+09</td>
						<td>MBCIENGG@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>103</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>VIDYASAGAR UCHCHA VIDYALAYA</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - MIRZAPUR</td>
						<td>BURDWAN - I</td>
						<td>ARUI</td>
						<td>713424</td>
						<td>3.45E+09</td>
						<td>ARUIVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>104</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>ERAL ANCHAL HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - ABHIRAMPUR, P.O.
							-ABHIRAMPUR</td>
						<td>AUSGRAM - II</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>105</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>GANTAR B.M. HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - GANTAR</td>
						<td>MEMARI - I</td>
						<td>GOGLA</td>
						<td>713381</td>
						<td>3.41E+09</td>
						<td>NUTANDANGA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>106</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>HATGOBINDAPUR MANGOBINDA
							CHOUDHURY HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - HATGOBINDAPUR</td>
						<td>BURDWAN - II</td>
						<td>MADANPUR</td>
						<td>713321</td>
						<td>9.55E+09</td>
						<td>MADANPURMAHESHVIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>107</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>DHAMACHIA VIDYASAGAR
							VIDYAMANDIR</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - DHAMACHIA, P.O. -
							MANGALPUR</td>
						<td>MANTESWAR</td>
						<td></td>
						<td>713130</td>
						<td>3.45E+09</td>
						<td>IKBALNAWAZ1982@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>108</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>GALSI SARADA VIDYAPITHA</td>
						<td>BARDHAMAN/EAST</td>
						<td>GALSI SARDA VIDYAPITHA. P.O -
							GALSI</td>
						<td>GALSI - II</td>
						<td>MANKAR</td>
						<td>713144</td>
						<td>3.43E+09</td>
						<td>MHS1855@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>109</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>NABAGRAM MAYNA P.B. HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - NABAGRAM</td>
						<td>JAMALPUR</td>
						<td>SUSUNIA</td>
						<td>713426</td>
						<td>3.42E+09</td>
						<td>315SUSUNIA.VIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>110</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>ORGRAM CHATUSPALLI HIGH
							MADRASHA</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - ORGRAM</td>
						<td>BHATAR</td>
						<td>AMDANGRA</td>
						<td>722149</td>
						<td>3.24E+09</td>
						<td>SABRAKONEITC32@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>111</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BELENDA ADARSHA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. ,BELENDA, P.O.
							- FULGRAM</td>
						<td>MANTESWAR</td>
						<td>KOTULPUR</td>
						<td>722141</td>
						<td>3.24E+09</td>
						<td>HMKOTALPURHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>112</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ORGRAM HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - ORGRAM</td>
						<td>BHATAR</td>
						<td>MEJHIA</td>
						<td>722143</td>
						<td>3.24E+09</td>
						<td>MEJIAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>113</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>RADHAKANTAPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							RADHAKANTAPUR</td>
						<td>MEMARI - I</td>
						<td>RANIBANDH</td>
						<td>722148</td>
						<td>9.43E+09</td>
						<td>ASHISKUMARPRAMANIK98@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>114</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>BCLS</td>
						<td>TALIT GOURESWAR HIGH SCHOOL
							(H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - TALIT</td>
						<td>BURDWAN - I</td>
						<td></td>
						<td>722122</td>
						<td>3.24E+09</td>
						<td>BKMHS.VOC@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>115</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>KRISHNAPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - KRISHNAPUR, P.O. -
							RAJBATI</td>
						<td>BURDWAN - I</td>
						<td>DUNDAR</td>
						<td>722140</td>
						<td>9.43E+09</td>
						<td>DSAV5042@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>116</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>M B C INSTITUTE OF
							ENGINEERING &amp; TECHNOLOGY</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BURDWAN</td>
						<td>BARDDHAMAN (M)</td>
						<td>HARMASRA</td>
						<td>722152</td>
						<td>9.88E+09</td>
						<td>WBSCVET5046@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>117</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td>AGPM</td>
						<td>ARUI ANCHALIK AHARCHANDI
							VIDYAPITH</td>
						<td>BARDHAMAN/EAST</td>
						<td>MADHABDIHI</td>
						<td>RAINA - II</td>
						<td>NAKAIJURI</td>
						<td>722152</td>
						<td>9.73E+09</td>
						<td>K.O.N.S.S.A.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>118</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>PARULIA KULA KAMINI HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>PARULIA</td>
						<td>PURBASTHALI - II</td>
						<td>ONDA-I</td>
						<td>722144</td>
						<td>3.24E+09</td>
						<td>ONDAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>119</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>BURDWAN SHIB KUMAR HARIJAN
							VIDYALAYA (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>KACHARI ROAD, P.O. - BURDWAN</td>
						<td>BARDDHAMAN (M)</td>
						<td>RADHANAGAR</td>
						<td>722157</td>
						<td>3.24E+09</td>
						<td>RHS.BISHNUPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>120</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>GOTAN SUBODH MEMORIAL HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>GOTAN</td>
						<td>RAINA - II</td>
						<td>DAHALA</td>
						<td>722140</td>
						<td>9.47E+09</td>
						<td>KANKRADARA.S.S.VIDYALAYA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>121</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>KALNA MAHARAJAS HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>KALNA</td>
						<td>KALNA (M)</td>
						<td></td>
						<td>731101</td>
						<td>3.46E+09</td>
						<td>VTC5518@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>122</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>KENDUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILLAGE- KENDURNPOST- KENDUR</td>
						<td>KHANDAGHOSH</td>
						<td>BARSHAL</td>
						<td>731233</td>
						<td>9E+09</td>
						<td>BHSVTC5555@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>123</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MOHANPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							MOHANPUR</td>
						<td>BHATAR</td>
						<td></td>
						<td>731224</td>
						<td>3.46E+09</td>
						<td>HEADMASTER.RHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>124</td>
						<td>ETAT</td>
						<td>ETCE</td>
						<td></td>
						<td>KURUMBA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>KURUMBA</td>
						<td>AUSGRAM - I</td>
						<td></td>
						<td>723133</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>125</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>P. P. D HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - PANDUK</td>
						<td>AUSGRAM - II</td>
						<td>KALMA</td>
						<td>723202</td>
						<td>9E+09</td>
						<td>SPITC2@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>126</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>SAHAHOSSAINPUR VIDYANIKETAN
							HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							SAHAHOSSAINPUR</td>
						<td>JAMALPUR</td>
						<td>MANBAZAR</td>
						<td>723131</td>
						<td>3.25E+09</td>
						<td>RMI6031@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>127</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>KETUGRAM S. A. M INSTITUTION</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KETUGRAM</td>
						<td>KETUGRAM - II</td>
						<td>BARABAZAR</td>
						<td>723127</td>
						<td>3.25E+09</td>
						<td>BARBHUMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>128</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>OKERSA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>OKERSA</td>
						<td>KATWA-II BLOCK</td>
						<td>ILOO JARGO</td>
						<td>723212</td>
						<td>8.12E+09</td>
						<td>JHSVET6035@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>129</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MEMARI V.M. INSTITUTION UNIT
							- 1</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - MEMARI</td>
						<td>MEMARI (M)</td>
						<td>MANGURIA LALPUR</td>
						<td>723101</td>
						<td>9.93E+09</td>
						<td>SSBM6039@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>130</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>PALITA HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							PALITA</td>
						<td>KETUGRAM - I</td>
						<td>CHELYAMA</td>
						<td>723146</td>
						<td>9.68E+09</td>
						<td>TICCHBPHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>131</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>JAHAN NAGAR KUMARANANDA HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>JAHANNAGAR</td>
						<td>PURBASTHALI - I</td>
						<td>CHANDRA</td>
						<td>723128</td>
						<td>9.93E+09</td>
						<td>RAJNOWAGARHVTC6062@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>132</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BILWESWAR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BILWESWAR,</td>
						<td>KETUGRAM - II</td>
						<td>TULIN</td>
						<td>723212</td>
						<td>9.93E+09</td>
						<td>VTC.JAISIARAM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>133</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>KHANDAGHOSH HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILI. &amp;P.O. -
							KHANDAGHOSH</td>
						<td>KHANDAGHOSH</td>
						<td>PIRRAH</td>
						<td>723128</td>
						<td>9.73E+09</td>
						<td>KURUKTOPAHS108@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>134</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KHORADAMENA HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O.- SATGACHIA</td>
						<td>MEMARI - II</td>
						<td>GOPALNAGAR</td>
						<td>723128</td>
						<td>9.93E+09</td>
						<td>GOPALNAGARATHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>135</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KARUI HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>KARUI, KATWA</td>
						<td>KATWA - II</td>
						<td></td>
						<td>741404</td>
						<td>9.23E+09</td>
						<td>HMORIACADEMY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>136</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>PARAJ HITLAL BANI MANDIR HIGH
							SCHOOL (H.S.)</td>
						<td>BARDHAMAN/EAST</td>
						<td>PARAJ</td>
						<td>GALSI - I</td>
						<td>DUBRA</td>
						<td>741223</td>
						<td>9.73E+09</td>
						<td>BHSVTC6286@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>137</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ADRAHATI BANWARILAL SADHARAN
							SIKSHANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL - ADRAHATI, P.O. -
							ADRAHATI,</td>
						<td>GALSI - II</td>
						<td>GHETUGACHHI</td>
						<td>741223</td>
						<td>9.43E+09</td>
						<td>19101621603.HIC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>138</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>AKLAKHI HIGH SCHOOL (H.S.)</td>
						<td>BARDHAMAN/EAST</td>
						<td>AKLAKHI</td>
						<td>RAINA - II</td>
						<td>BEROHI-I</td>
						<td>741245</td>
						<td>8E+09</td>
						<td>19101706503.HSC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>139</td>
						<td>ETAT</td>
						<td>ETIA</td>
						<td></td>
						<td>KATWA BHARATI BHABAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>KATWA</td>
						<td>KATWA (M)</td>
						<td>MAHESHPUR</td>
						<td>741508</td>
						<td>9.68E+09</td>
						<td>SHIMULIAHIGHSCHOOL.NADIA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>140</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>BARABAINAN UNION SAMABAY
							KRISHI SAMITY SIKSHANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BARABAINAN,</td>
						<td>RAINA - II</td>
						<td>SILINDA-I</td>
						<td>741223</td>
						<td>9.47E+09</td>
						<td>BALIAHIGH.SCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>141</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>KASEMNAGAR N. A. J. HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - KASEMNAGAR</td>
						<td>MANGOLKOTE</td>
						<td>BETHUA DAHARI-II</td>
						<td>741126</td>
						<td>3.47E+09</td>
						<td>MANIKDE135@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>142</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>PATULI HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - PATULI</td>
						<td>PURBASTHALI - II</td>
						<td>ANISHMALI</td>
						<td>741253</td>
						<td>3.47E+09</td>
						<td>SPHS.ERULI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>143</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KALNA AMBIKA MAHISMARDINI
							HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>BHADURIPARA P.O. - KALNA</td>
						<td>KALNA (M)</td>
						<td>HABIBPUR</td>
						<td>741201</td>
						<td>9.43E+09</td>
						<td>PALCHOWDHURYSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>144</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BAZAR BONKAPASI S. M. HIGH
							SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BAZAR BONKAPASI</td>
						<td>MANGOLKOTE</td>
						<td>DEBAGRAM</td>
						<td>741238</td>
						<td>3.47E+09</td>
						<td>19101413204HSC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>145</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>JANAKILAL SIKSHA SADAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KATWA</td>
						<td>KATWA (M)</td>
						<td>JOTKAMAL</td>
						<td>742213</td>
						<td>9.47E+09</td>
						<td>JOTEKAMALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>146</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>PAHARHATI GOLAPMONI HIGH
							SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - GARGESWAR, P.O. -
							PAHARHATI</td>
						<td>MEMARI - II</td>
						<td>AZIMGONG GOLA</td>
						<td>742303</td>
						<td>9.47E+09</td>
						<td>DUMKAL_B.T@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>147</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td>BHATAR MADHAB PUBLIC HIGH
							SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O.- BHATAR.</td>
						<td>BHATAR</td>
						<td>SAKTIPUR</td>
						<td>742163</td>
						<td>3.48E+09</td>
						<td>SKMCI.1905@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>148</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>SULTANPUR TULSI DAS
							VIDYAMANDIR</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - SULTANPUR</td>
						<td>KALNA - I</td>
						<td></td>
						<td>742133</td>
						<td>3.48E+09</td>
						<td>SCHOOL.CRGS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>149</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>KASTHASALI NIVANANI HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - KASTHASALI</td>
						<td>PURBASTHALI - II</td>
						<td>ISLAMPUR</td>
						<td>742304</td>
						<td>3.48E+09</td>
						<td>SCM6781@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>150</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>OARI HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - OARI,</td>
						<td>KHANDAGHOSH</td>
						<td></td>
						<td>742149</td>
						<td>3.48E+09</td>
						<td>LSHS.VOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>151</td>
						<td>ETAT</td>
						<td>ETIA</td>
						<td>BCTE</td>
						<td>UCHALAN HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - UCHALAN</td>
						<td>RAINA - II</td>
						<td></td>
						<td>742103</td>
						<td>3.48E+09</td>
						<td>SANDIPDG_BER@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>152</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BURDWAN HARISAVA HINDU GIRLS
							HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>SUBHASPALLY, P.O. - BURDWAN</td>
						<td>BARDDHAMAN (M)</td>
						<td></td>
						<td>742137</td>
						<td>3.48E+09</td>
						<td>KANDIRAJHIGHSCHOOL1859@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>153</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>KEUGURI HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - KEUGURI</td>
						<td>KETUGRAM - II</td>
						<td>SRIPUR-I</td>
						<td>732102</td>
						<td>9.15E+09</td>
						<td>SRIPURANCHALHIGHSCHOOL1962@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>154</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>DEBSHALA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - DEBSHALA,</td>
						<td>AUSGRAM - II</td>
						<td>BIRNAGAR-II</td>
						<td>732201</td>
						<td>9.93E+09</td>
						<td>RAJNAGARVOC7772@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>155</td>
						<td>ETAT</td>
						<td>ETIA</td>
						<td></td>
						<td>PUBAR ANCHALIC HIGH MADRASAH</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - PANDUK</td>
						<td>AUSGRAM - II</td>
						<td>PAKUAHAT</td>
						<td>732138</td>
						<td>3.51E+09</td>
						<td>PAKUAHATVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>156</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BURDWAN NEHRU VIDYA MANDIR
							HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>INDRAPRASTHA, BABURBAG, P.O.
							- RAJBATI.</td>
						<td>BARDDHAMAN (M)</td>
						<td></td>
						<td>732103</td>
						<td>3.51E+09</td>
						<td>VTC.7783@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>157</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>KHERUR CHHATNI K. N. HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KHERUR</td>
						<td>BHATAR</td>
						<td>CHAK BHRIGU</td>
						<td>733102</td>
						<td>3.52E+09</td>
						<td>NADIPARNCHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>158</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>GOPALPUR MUKTAKESHI VIDYALAYA</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - GOPALPUR, P.O. -
							REORAH GOPALPUR (VIA NABAGRAM)</td>
						<td>JAMALPUR</td>
						<td>KARANJI</td>
						<td>733132</td>
						<td>8.1E+09</td>
						<td>RAJIBBASAK124@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>159</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>AUSHARA UDGARA CHITTARANJAN
							KONER SIKSHANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. ,AUSHARA, P.O.
							- PALASHAN,<span style='mso-spacerun:yes'>��</span></td>
						<td></td>
						<td>GANGARAMPUR</td>
						<td>733142</td>
						<td>3.52E+09</td>
						<td>NAYABAZARHIGHSCHOOL.2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>160</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>MEJHIARY S. C. S HIGH SCHOOL
							(H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - PANJOA</td>
						<td>KATWA - II</td>
						<td>DEUL</td>
						<td>733132</td>
						<td>9.78E+09</td>
						<td>MANIKOREHS1963@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>161</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td>KATWA KASHIRAM DAS
							INSTITUTION</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KATWA</td>
						<td>KATWA (M)</td>
						<td>KAMALABARI-I</td>
						<td>733130</td>
						<td>3.52E+09</td>
						<td>ITI.RAIGANJ@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>162</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>AGRADWIP SUBODH CHOWDHURY
							SIKSHA NIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - AGRADWIP</td>
						<td>KATWA - II</td>
						<td></td>
						<td>733134</td>
						<td>3.52E+09</td>
						<td>MDA_SUNAM@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>163</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>SADHANPUR VIVEKANANDA HIGH
							SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>HTUDEWAN (KATWA ROAD), P.O. -
							BURDWAN</td>
						<td>BURDWAN - I</td>
						<td></td>
						<td>733134</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>164</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>SILUT BASANTAPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - SILUT, P.O. - SAHAPUR
							BASANTAPUR</td>
						<td>AUSGRAM - I</td>
						<td>BAROGHARIA</td>
						<td>735210</td>
						<td>9.73E+09</td>
						<td>PIHM.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>165</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BHAITA HARI DAS KAR HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							BHAITA,</td>
						<td>BURDWAN - II</td>
						<td>BOUALMARI NANDANPUR</td>
						<td>735139</td>
						<td>3.56E+09</td>
						<td>MANDALGHATHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>166</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>MOUGRAM HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. - MOUGRAM</td>
						<td>KETUGRAM - II</td>
						<td></td>
						<td>735224</td>
						<td>03561-204649</td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>167</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>MOHANPUR NOWHATI S.R.S.
							VIDYALAYA</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - AMADPUR</td>
						<td>MEMARI - II</td>
						<td>RAMSAI</td>
						<td>735219</td>
						<td>9.8E+09</td>
						<td>BHAWANIHS8788@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>168</td>
						<td>ETAT</td>
						<td>AGCF</td>
						<td></td>
						<td>SARANGA HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - SARANGA</td>
						<td>KHANDAGHOSH</td>
						<td></td>
						<td>736160</td>
						<td>3.58E+09</td>
						<td>TUFANGANJNNMHS1916@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>169</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>SAMUDRAGARH HIGH SCHOOL (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - SAMUDRAGARH</td>
						<td>PURBASTHALI - I</td>
						<td>MATALHAT</td>
						<td>736135</td>
						<td>3.58E+09</td>
						<td>MATALHATHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>170</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ADARSHA BALIKA VIDYALAYA</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							SHYAMSUNDAR</td>
						<td></td>
						<td>GHOKSADANGA</td>
						<td>736171</td>
						<td>9.47E+09</td>
						<td>DRTD291155@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>171</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>LAKSHMIPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL.&amp; P.O. -
							LAKSHMIPUR,</td>
						<td>PURBASTHALI - II</td>
						<td>CHAKCHAKA</td>
						<td>736156</td>
						<td>3.58E+09</td>
						<td>SRIRAMKRISHNA1965@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>172</td>
						<td>ETAT</td>
						<td>BCTM</td>
						<td>ETEM</td>
						<td>JOTESRIRAM HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							JOTESRIRAM,</td>
						<td>JAMALPUR</td>
						<td></td>
						<td>736101</td>
						<td>3.58E+09</td>
						<td>VIVEKANANDAVIDYAPEETH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>173</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>UDAYPALLI SIKSHANIKETAN HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - KANCHANNAGAR</td>
						<td>BURDWAN - I</td>
						<td>NATABARI-I</td>
						<td>736156</td>
						<td>9.43E+09</td>
						<td>NATABARIHS1967@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>174</td>
						<td>BCTM</td>
						<td></td>
						<td></td>
						<td>SIMLON ANNAPURNA KALI
							VIDYAMANDIR (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							SIMLON</td>
						<td>KALNA - I</td>
						<td></td>
						<td>700076</td>
						<td>9.68E+09</td>
						<td>MONIKUNTALA1002@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>175</td>
						<td>BCTM</td>
						<td></td>
						<td></td>
						<td>BHITA M.P.INSTITUTION (H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							BHITA</td>
						<td>BURDWAN - I</td>
						<td>JAGADALLA-II</td>
						<td>722146</td>
						<td>3.24E+09</td>
						<td>59RVHV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>176</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>RATHTALA MANOHARDAS
							VIDYANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>RATHTALA, P.O. - KANCHANNAGAR</td>
						<td>BARDDHAMAN (M)</td>
						<td></td>
						<td>700028</td>
						<td>3.33E+09</td>
						<td>J.GAIN2005@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>177</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>PARAMANANDA MISSION HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							BANAGRAM</td>
						<td>MEMARI - II</td>
						<td>BHANDARIA</td>
						<td>743503</td>
						<td>8.42E+09</td>
						<td>KASTEKUMARI.C1139@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>178</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>BURDWAN DUBRAJDIGHI HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BAJEPARATAPPUR</td>
						<td>BARDDHAMAN (M)</td>
						<td>POURANDARPUR</td>
						<td>731129</td>
						<td>3.46E+09</td>
						<td>PURANDARPURHIGHSCHOOLBIRB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>179</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>BASANTAPUR S. S.
							SIKSHANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - BASANTAPUR, P.O. -
							MALAMBA</td>
						<td>MANTESWAR</td>
						<td></td>
						<td>742302</td>
						<td>9.47E+09</td>
						<td>KHATUNMAHMUDA69@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>180</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>AMARAR GARH HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - AMARARGARH VIA MANKAR</td>
						<td>AUSGRAM - II</td>
						<td>GOKARNA-I</td>
						<td>742136</td>
						<td>9.48E+09</td>
						<td><a
								href="mailto:GOKARNANGGHS@REDIFFMAIL.COM">GOKARNANGGHS@REDIFFMAIL.COM</a></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>181</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>BIJIPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BASUDA</td>
						<td>BHATAR</td>
						<td>MAHALANDI-I</td>
						<td>742136</td>
						<td>9.48E+09</td>
						<td>JOYSK2008@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>182</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>BURDWAN HIGH MADRASAH</td>
						<td>BARDHAMAN/EAST</td>
						<td>KESHAB GANJ CHATI, P.O. -
							RAJBATI, BURDWAN</td>
						<td>BURDWAN - I</td>
						<td></td>
						<td>700005</td>
						<td>3.33E+09</td>
						<td>RAPTAN.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>183</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>SURAKALITALA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VIIL. - SOUTH SURA, P.O. -
							CHAKDIGHI</td>
						<td>JAMALPUR</td>
						<td></td>
						<td>700003</td>
						<td>3.33E+09</td>
						<td>MCPI1916@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>184</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>NUTANGRAM HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - NANDAI</td>
						<td>KALNA - I</td>
						<td>KASHIMPUR</td>
						<td>743294</td>
						<td>3.33E+09</td>
						<td>MAKAM.03435@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>185</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>MATHRUN N.C. INSTITUTION</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - MATHRUN</td>
						<td>MANGOLKOTE</td>
						<td>KAMPA-CHAKLA</td>
						<td>743193</td>
						<td>3.33E+09</td>
						<td>KAMPAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>186</td>
						<td>BCRS</td>
						<td>BCTE</td>
						<td></td>
						<td>KRISHNADEVPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							KRISHNADEVPUR</td>
						<td>KALNA - I</td>
						<td>BERGOOM II G.P</td>
						<td>743263</td>
						<td>3.22E+09</td>
						<td>BERGOOMHIGHSCHOOL@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>187</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>KULDIHA M.S.K</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							KULDIHA,</td>
						<td>AUSGRAM - I</td>
						<td></td>
						<td>743235</td>
						<td>3.22E+09</td>
						<td>NBGHS1186VTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>188</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>MONIARY FATICKGRAM VIDYASAGAR
							M.S.K</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - MONIARY, P.O. -
							AKLAKHI</td>
						<td>RAINA - II</td>
						<td></td>
						<td>743144</td>
						<td>3.33E+09</td>
						<td>ICHAPUR_ACADEMY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>189</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>PITAMBARPUR M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - PITAMBARPUR, P.O. -
							TORKONA</td>
						<td>KHANDAGHOSH</td>
						<td>PATHARGHATA</td>
						<td>700135</td>
						<td>9.43E+09</td>
						<td>PATHARGHATAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>190</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>RAMNAGAR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - UTTAR RAMNAGAR,</td>
						<td>AUSGRAM - II</td>
						<td></td>
						<td>700036</td>
						<td>3.33E+09</td>
						<td>MAYAPITH1379@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>191</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>GUREGHAR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - GUREGHAR, P.O. - BISHNUBATI,</td>
						<td>JAMALPUR</td>
						<td>DEBRA-II</td>
						<td>721124</td>
						<td>3.22E+09</td>
						<td>DEBRAUCHCHATARA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>192</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>BONBIBITALA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BERUGRAM,</td>
						<td>JAMALPUR</td>
						<td></td>
						<td>713104</td>
						<td>3.42E+09</td>
						<td>BURDWANNVMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>193</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>JABAGRAM MAHARANI KASISWARI
							INSTITUTION</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - JABAGRAM,</td>
						<td>MANGOLKOTE</td>
						<td>KANKI</td>
						<td>733209</td>
						<td>3.53E+09</td>
						<td>KSJVM1969@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>194</td>
						<td>BCRS</td>
						<td>BCTM</td>
						<td></td>
						<td>SRIKHANDA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - SRIKHANDA,</td>
						<td>KATWA - I</td>
						<td>ST. MARY-II</td>
						<td>734220</td>
						<td>3.54E+09</td>
						<td>HOLYCROSSKSG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>195</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>BADLA HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							BADLA</td>
						<td></td>
						<td>LOWER BAGDOGRA</td>
						<td>734014</td>
						<td>3.53E+09</td>
						<td>CRHSHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>196</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>JADABGANJ ADIBASI HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp; P.O. -
							JADABGANJ,</td>
						<td>AUSGRAM - I</td>
						<td>GOPALNAGAR-II</td>
						<td>743709</td>
						<td>9.75E+09</td>
						<td>NUTANGRAMSUBHASINIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>197</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BURDWAN SRI RAMKRISHNA
							SARADAPITH HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O.-<span
								style='mso-spacerun:yes'>�
							</span>BURDWAN</td>
						<td>BARDDHAMAN (M)</td>
						<td>AMULIA</td>
						<td>743423</td>
						<td>9.73E+09</td>
						<td>RAIPURNIRAMISHAADARSHA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>198</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MAJIGRAM BISWESWARI HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							MAJIGRAM,</td>
						<td>MANGOLKOTE</td>
						<td>DADPUR</td>
						<td>743423</td>
						<td>3.22E+09</td>
						<td>GOLABARIPALLIMONGALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>199</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>CHAKCHANDAN DURGADAS HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL.- CHAKCHANDAN,
							P.O. - BUJRUKDIGHI,</td>
						<td>RAINA - II</td>
						<td></td>
						<td>700051</td>
						<td>3.33E+09</td>
						<td>BMVB1968@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>200</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>DEBAGRAM BARAMPUR MADHYAMIK
							VIDYALAYA</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							BARAMPUR,</td>
						<td>KATWA - I</td>
						<td>TEPUL MIRZAPUR</td>
						<td>743273</td>
						<td>3.22E+09</td>
						<td>MEDIABASTUHARAHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>201</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KAIRAPUR VIDYASAGAR VIDYAPITH</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - KAIRAPUR, P.O. -
							MOHANPUR,</td>
						<td>AUSGRAM - I</td>
						<td>MINAKHAN</td>
						<td>743441</td>
						<td>8.37E+09</td>
						<td>GETSANTIBISWAS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>202</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KRISHNARAMPUR HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - RONDIA,</td>
						<td>GALSI - I</td>
						<td>GUMA-II</td>
						<td>743704</td>
						<td>3.22E+09</td>
						<td>HEADMASTER.GRV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>203</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KOLEYPARA- KANTHALGACHI HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - KANTHALGACHI, P.O. -
							NIMO,</td>
						<td>MEMARI - I</td>
						<td>BHURKUNDA</td>
						<td>743222</td>
						<td>3.22E+09</td>
						<td>SJBHM.HS.1968@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>204</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MOHINI MOHAN BASU HIGH SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. ,DURGAPUR,
							P.O. - CHOTKHANDA,</td>
						<td>MEMARI - I</td>
						<td>RADHAKANTAPUR</td>
						<td>743354</td>
						<td>9.43E+09</td>
						<td>BGHSSCHOOL.N@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>205</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BELGRAM NALINI RANJAN
							VIDYAMANDIR</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - GOBARDHANPUR,</td>
						<td>MANGOLKOTE</td>
						<td>JANGALIA</td>
						<td>743372</td>
						<td>9.73E+09</td>
						<td>CPGSNHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>206</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MOSLEMABAD HIGH MADRASAH</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - MOSLEMABAD, P.O. -
							ASTAGHORIA,</td>
						<td>KALNA - I</td>
						<td>DHAMUA SOUTH</td>
						<td>743610</td>
						<td>3.22E+09</td>
						<td>DHAMUABALIKAVIDYALAYA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>207</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>PUTUNDA M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - PUTUNDA, P.O. -
							SAKTIGARH,</td>
						<td>BURDWAN - II</td>
						<td>MOGRAHAT EAST</td>
						<td>743355</td>
						<td>9.43E+09</td>
						<td>RADHANAGARBNMINSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>208</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>FALEYA M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>P.O. - BISWARAMBHA,</td>
						<td>PURBASTHALI - II</td>
						<td>PRATAPADITYA NAGAR</td>
						<td>743347</td>
						<td>9.87E+09</td>
						<td>SUNDARBANBALIKAVIDYANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>209</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>KHAJURDIHI M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							KHAJRDIHI,</td>
						<td>KATWA - I</td>
						<td>SATJELIA</td>
						<td>743370</td>
						<td>8E+09</td>
						<td>DAYAPURPCSENHIGHLSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>210</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BARASAT M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - BARASAT, P.O. -
							KALIBELE,</td>
						<td>MEMARI - II</td>
						<td></td>
						<td>711106</td>
						<td>9.43E+09</td>
						<td>SSMV2055@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>211</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MAHESHDANGA CAMP M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. - MAHESHDANGA CAMP,
							P.O. - MAHESHDANGA,</td>
						<td>MEMARI - I</td>
						<td>GANGADHARPUR</td>
						<td>711302</td>
						<td>3.21E+09</td>
						<td>GBV06267@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>212</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>SAHEBDANGA ADIBASI UNNAYAN
							M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL.- SAHEBDANGA,
							P.O. - KHANDARIDANGA, VIA. -
							MANKAR,</td>
						<td>AUSGRAM - II</td>
						<td>KHARDAHA</td>
						<td>711401</td>
						<td>9.04E+09</td>
						<td>KHARDAH.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>213</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MALGRAM M.S.K.</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL.- MALGRAM, P.O.
							- KACHUTIA</td>
						<td>KETUGRAM - I</td>
						<td>HARIPAL SAHADEB</td>
						<td>712403</td>
						<td>9.64E+09</td>
						<td>KBSSM1964@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>214</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>MAJIDA GANA BIDYABHABAN HIGH
							SCHOOL</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. &amp;P.O. -
							MAJIDA</td>
						<td>PURBASTHALI - II</td>
						<td>SRIRAMPUR</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>DBCS.VIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>215</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>BARARI DIHIPALASHON
							SAPTAPALLI SIKSHANIKETAN</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL.- BARARI, P.O.
							- BIJUR,</td>
						<td>MEMARI - II</td>
						<td></td>
						<td>712201</td>
						<td>3.33E+09</td>
						<td>SERAMPOREHIGHSCHOOL@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>216</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>SUSUNIA RANIBALA VIDYAMANDIR
							(H.S)</td>
						<td>BARDHAMAN/EAST</td>
						<td>VILL. P.O. - SUSUNIA</td>
						<td>MANTESWAR</td>
						<td>JUKHIA</td>
						<td>721425</td>
						<td>9.47E+09</td>
						<td>BDHS1960@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>217</td>
						<td>BCLS</td>
						<td>AGFF</td>
						<td></td>
						<td>BURDWAN INSTITUTE OF
							MANAGEMENT AND COMPUTER SCIENCE</td>
						<td>BARDHAMAN/EAST</td>
						<td>DEWANDIGHI, KATWA ROAD, P.O.
							- MIRZAPUR,</td>
						<td>BURDWAN - I</td>
						<td>TILKHOJA</td>
						<td>721629</td>
						<td>9.93E+09</td>
						<td>MVVM1969@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>218</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td>KENDA HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - KENDA</td>
						<td>JAMURIA</td>
						<td>RADHAMOHANPUR-II</td>
						<td>721160</td>
						<td>9E+09</td>
						<td>RVHS3609@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>219</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>DURGAPUR T. N. HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - DURGAPUR - I</td>
						<td>DURGAPUR (M CORP.)</td>
						<td></td>
						<td>721242</td>
						<td>3.23E+09</td>
						<td>RBLI-1925@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>220</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td>ASANSOL POLYTECHNIC</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - ASANSOL - 2</td>
						<td>ASANSOL (M CORP.)</td>
						<td>KHAJRA</td>
						<td>721133</td>
						<td>3.22E+09</td>
						<td>VTC3624@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>221</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KANYAPUR POLYTECHNIC</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - ASANSOL</td>
						<td>ASANSOL (M CORP.)</td>
						<td>KALAIKUNDA</td>
						<td>721301</td>
						<td>9.64E+09</td>
						<td>GBCVBHS1963@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>222</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KANYAPUR ITI</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - ASANSOL</td>
						<td></td>
						<td>JALIMANDA</td>
						<td>721301</td>
						<td>3.22E+09</td>
						<td>SHSVOC@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>223</td>
						<td>ETAT</td>
						<td>ETCE</td>
						<td></td>
						<td>NAZRUL CENTENARY POLYTECHNIC</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - HINDUSTAN CABLES</td>
						<td>SALANPUR</td>
						<td>GOAI</td>
						<td>713130</td>
						<td>3.45E+09</td>
						<td>BIT_KATWA@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>224</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>RUPNARAINPUR ITC</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - HINDUSTAN CABLES</td>
						<td>SALANPUR</td>
						<td>DALUIBAZAR-II</td>
						<td>713124</td>
						<td>3.42E+09</td>
						<td>SCITC1957SCITC@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>225</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>BAHULA SASHI SMRITI HIGH
							SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp; P.O. BAHULA</td>
						<td>PANDABESWAR</td>
						<td></td>
						<td>713146</td>
						<td>3.42E+09</td>
						<td>MEMARIVM.UNIT1@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>226</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>UKHRA KUNJA BEHARI
							INSTITUTION</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - UKRA , DIST. - BURDWAN</td>
						<td>ONDAL</td>
						<td></td>
						<td>713203</td>
						<td>9.43E+09</td>
						<td>AMRAIVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>227</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>DURGAPUR PROJECTS BOYS HIGH
							SCHOOL (UNIT II)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - DURGAPUR -2</td>
						<td>DURGAPUR (M CORP.)</td>
						<td>BILLESWAR</td>
						<td>713150</td>
						<td>9.43E+09</td>
						<td>SUBHA.BAKSHI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>228</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>KHANDRA HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - KHANDRA</td>
						<td>ONDAL</td>
						<td>JAMGRAM</td>
						<td>713315</td>
						<td>9.33E+09</td>
						<td>JAHS.VTC4070@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>229</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>CHURULIA NABA KRISHNA HIGH
							SCHOOL (H.S)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - CHURULIA</td>
						<td>JAMURIA</td>
						<td>AMLAJORA</td>
						<td>713212</td>
						<td>3.43E+09</td>
						<td>AMLAJORAHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>230</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BIJPUR NETAJI SIKSHANIKETAN</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - BIJPUR</td>
						<td>ASANSOL (M CORP.)</td>
						<td>SULTANPUR</td>
						<td>713146</td>
						<td>3.45E+09</td>
						<td>VTC.4090@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>231</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>RAMKRISHNA PALLY VIVEKANANDA
							VIDYAPITH</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - DURGAPUR</td>
						<td>DURGAPUR (M CORP.)</td>
						<td>GOPALPUR</td>
						<td>722136</td>
						<td>9.43E+09</td>
						<td>NANDAPALLIMANGAL5032@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>232</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>GOURANGDI RKS INSTITUTION
							(H.S.)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - PANURIA</td>
						<td>BARABANI</td>
						<td>SUKURHUTU</td>
						<td>723127</td>
						<td>9.43E+09</td>
						<td>KPMAHATO71@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>233</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>AMRAI HIGH SCHOOL (H.S)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - AMRAI</td>
						<td>DURGAPUR (M CORP.)</td>
						<td>BURIBANDH</td>
						<td>723131</td>
						<td>9.43E+09</td>
						<td>GOLAPARARNHIGHSCHOOL6041@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>234</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>JAMGRAM ANCHALICK HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp;P.O. -
							JAMGRAM</td>
						<td>BARABANI</td>
						<td>BERADA</td>
						<td>723143</td>
						<td>9.93E+09</td>
						<td>BERADAHIGHSCHOOLK1037@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>235</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>NUTANDANGA HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - NATUNDANGA</td>
						<td>FARIDPUR DURGAPUR</td>
						<td>MANBAZAR</td>
						<td>723131</td>
						<td>9.61E+09</td>
						<td>BAPDGM309@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>236</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>AMLAJORAH HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - AMLAJORAH</td>
						<td>KANKSA</td>
						<td>HABIBPUR</td>
						<td>741402</td>
						<td>3.47E+09</td>
						<td>PALASH9933@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>237</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MADANPUR MAHESH VIDYAMANDIR</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - MADANPUR, ANDAL</td>
						<td>ONDAL</td>
						<td></td>
						<td>741159</td>
						<td>9.73E+09</td>
						<td>HMTNHS@YMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>238</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>DURGAPUR PROJECTS BOYS HIGH
							SCHOOL (H.S &amp;GOVT. SPONSORED)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - DURGAPUR 2,
						</td>
						<td>DURGAPUR (M CORP.)</td>
						<td>ASAN NAGAR</td>
						<td>741161</td>
						<td>3.47E+09</td>
						<td>AHSVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>239</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>USHAGARM BOYS HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - USHAGRAM, ASANSOL 3</td>
						<td>ASANSOL (M CORP.)</td>
						<td></td>
						<td>733124</td>
						<td>2.52E+09</td>
						<td>RSVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>240</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td>MALANDIGHI DURGADAS
							VIDYAMANDIR</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp; P.O. - MALANDIGHI</td>
						<td>KANKSA</td>
						<td>SIRSHI</td>
						<td>733125</td>
						<td>9.74E+09</td>
						<td>VTC8291@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>241</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>RAHMAT NAGAR IQBAL ACADEMY
							HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - ANDAL</td>
						<td>ONDAL</td>
						<td>BOCHADANGA</td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>TNKHS.UD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>242</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>SEARSOLE RAJ HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P. N. MALIAH ROAD, P.O. -
							RAIGANJ</td>
						<td>RANIGANJ (M)</td>
						<td>KAPASIA</td>
						<td>733128</td>
						<td>9.83E+09</td>
						<td>KAPASIA1947@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>243</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>NARSAMUDA JANAKALYAN SAMITY
							HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. - NARSAMUDA, P.O. -
							ASANSOL-4</td>
						<td>ASANSOL (M CORP.)</td>
						<td>FALAKATA-I</td>
						<td>735211</td>
						<td>3.56E+09</td>
						<td>FALAKATAHIGHSCHOOL.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>244</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BORINGDANGA HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. - BORINDANGA, P.O. -
							JAMURIA HAT,</td>
						<td>ASANSOL (M CORP.)</td>
						<td></td>
						<td>735210</td>
						<td>3.56E+09</td>
						<td>VTCBAIRATIGURI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>245</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>MANKAR HIGH SCHOOL (H.S)</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - MANKAR</td>
						<td>GALSI - I</td>
						<td>KUKURJAN</td>
						<td>735138</td>
						<td>9.73E+09</td>
						<td>KUKURJAN8781@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>246</td>
						<td>BCTE</td>
						<td></td>
						<td></td>
						<td>CHELOD HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - CHELOD,</td>
						<td>&nbsp;</td>
						<td></td>
						<td>734214</td>
						<td>9.83E+09</td>
						<td>YAGNANIDHIDHAKAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>247</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>ASANSOL CHELIDANGA HIGH
							SCHOOL (H.S)</td>
						<td>BURDWAN/WEST</td>
						<td>S. B. GORAI ROAD, P.O. -
							UPPER CHELIDANGA, ASANSOL-4</td>
						<td>ASANSOL (M CORP.)</td>
						<td></td>
						<td>700012</td>
						<td>22572665</td>
						<td>CITY_0007VOC@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>248</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>H.B.INSTITUTE OF TECHNOLOGY
							&amp; MINNING</td>
						<td>BURDWAN/WEST</td>
						<td>GIRJAPARA, P.O. - RANIGANJ</td>
						<td>ASANSOL (M CORP.)</td>
						<td></td>
						<td>700030</td>
						<td>3.33E+09</td>
						<td>KAIVTC59@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>249</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>BIJRA HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. - BIJRA, P.O. -
							DHABANI, DURGAPUR - 5</td>
						<td>DURGAPUR (M CORP.)</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>250</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>GOPALPUR HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp; P.O. -
							GOPALPUR,</td>
						<td>KANKSA</td>
						<td></td>
						<td>711101</td>
						<td>3.33E+09</td>
						<td>HOWRAH.SIKSHAYATAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>251</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>RAKSHITPUR HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. P.O. - RAKSHITPUR,</td>
						<td>KANKSA</td>
						<td></td>
						<td>711201</td>
						<td>3.33E+09</td>
						<td>BJAVHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>252</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>ASANSOL OLD STATION HIGH
							SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>G. T. ROAD EAST, P.O. -
							ASANSOL - 3,</td>
						<td>ASANSOL (M CORP.)</td>
						<td>SUBHARARAH</td>
						<td>711322</td>
						<td>3.33E+09</td>
						<td>TALBANDI2091@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>253</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>KANYAPUR HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. &amp;P.S. -
							KANYAPUR I.C. (ASANSOL NORTH)</td>
						<td>ASANSOL (M CORP.)</td>
						<td>MADANPUR</td>
						<td>713321</td>
						<td>3.41E+09</td>
						<td>IQBALACADEMY5@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>254</td>
						<td>BCRS</td>
						<td></td>
						<td></td>
						<td>ONDAL VILLAGE HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp;P.O. -
							ANDAL GRAM, SUB DIV. - DURGAPUR</td>
						<td></td>
						<td>JITUJURI</td>
						<td>723128</td>
						<td>9.73E+09</td>
						<td>JITUJURIHIGHSCHOOL6108@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>255</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>NIMSHA KHOTTADIHI ALINAGAR
							HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - KHOTTADIHI,</td>
						<td>JAMURIA</td>
						<td>SADHANPUR</td>
						<td>743221</td>
						<td>9.83E+09</td>
						<td>RHS1260@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>256</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>ANJUMAN URDU GIRLS HIGHER
							SECONDARY SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>RAJABANDH, P.O.-
							RANIGUNJ</td>
						<td>RANIGANJ</td>
						<td>KAJURI G.P</td>
						<td>743427</td>
						<td>9.56E+09</td>
						<td>KAIJURIHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>257</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>HAJI QADAM RASUL HIGH SCHOOL</td>
						<td>BURDWAN/WEST</td>
						<td>NADIPAR, O.K. ROAD, P.O. -
							ASANSOL,</td>
						<td>ASANSOL (M CORP.)</td>
						<td></td>
						<td>700110</td>
						<td>3.33E+09</td>
						<td>SSKSBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>258</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>TOPOSI MADHYAMIK SIKSHA
							KENDRA</td>
						<td>BURDWAN/WEST</td>
						<td>P.O. - TOPOSI,</td>
						<td>JAMURIA</td>
						<td>ITKHOLA</td>
						<td>743329</td>
						<td>9.73E+09</td>
						<td>NITYANANDAHALDER100@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>259</td>
						<td>BCLS</td>
						<td></td>
						<td></td>
						<td>HARIPUR M.S.K.</td>
						<td>BURDWAN/WEST</td>
						<td>VILL. &amp;P.O. -
							HARIPUR</td>
						<td>PANDABESWAR</td>
						<td>MULTI</td>
						<td>743610</td>
						<td>3.22E+09</td>
						<td>MULTIPSINSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>260</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BENGAI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - BENGAI</td>
						<td>GOGHAT - I</td>
						<td>NAMKHANA</td>
						<td>743357</td>
						<td>3.21E+09</td>
						<td>ANIKETDASDMDHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>261</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>SAORA UNION HIGH SCHOOL
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O.- SAORA, P.S.
							- GOGHAT.</td>
						<td>GOGHAT - I</td>
						<td>PARULIA</td>
						<td>743368</td>
						<td>3.17E+09</td>
						<td>PARULIASRK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>262</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>GOGHAT HIGH SCHOOL (H.S.)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - GOGHAT</td>
						<td>GOGHAT - I</td>
						<td></td>
						<td>743372</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>263</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHASTARA JAJNESWAR HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL.+P.O. - BHASTARA</td>
						<td>DHANIAKHALI</td>
						<td>BURUL</td>
						<td>743318</td>
						<td>7.87E+09</td>
						<td>BURULHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>264</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BALIPUR MELATALA HIGH SCHOOL
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - BALIPUR,</td>
						<td>KHANAKUL - I</td>
						<td>MURIGANGA-II</td>
						<td>743373</td>
						<td>9.48E+09</td>
						<td>COMPANYCHAR.MAHESWARI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>265</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MOLOYPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - MOLOYPUR</td>
						<td>ARAMBAG</td>
						<td></td>
						<td>711202</td>
						<td>3.33E+09</td>
						<td>RKMBELURMATH.ITC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>266</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td></td>
						<td>DHAMSA P.C.SEN INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>P.O. - ARANDI</td>
						<td>ARAMBAG</td>
						<td>HARALI UDAYNARAYANPUR</td>
						<td>711226</td>
						<td>3.21E+09</td>
						<td>UDAYNARAYANPUR.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>267</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MUTHADANGA RAMKRISHNA HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - MAYAPUR</td>
						<td>ARAMBAG</td>
						<td></td>
						<td>711227</td>
						<td>3.33E+09</td>
						<td>ANANDANAGARHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>268</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BERABERI SURYYA NARAYAN
							MEMORIAL HIGH SCHOOL (H.S.)</td>
						<td>HOOGHLY</td>
						<td>P.O. - BAJEMELIA</td>
						<td>SINGUR</td>
						<td></td>
						<td>711105</td>
						<td>3.33E+09</td>
						<td>DASNAGARCHAPALADEVIBALIKAVID@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>269</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td></td>
						<td>JANAI TRAINING HIGH
							SCHOOL(H.S.)</td>
						<td>HOOGHLY</td>
						<td>P.O. - JANAI</td>
						<td>CHANDITALA - II</td>
						<td>DHULASIMLA</td>
						<td>711315</td>
						<td>9.05E+09</td>
						<td>PALPARA2011@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>270</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PURSURAH HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - PURSURAH</td>
						<td>PURSURA</td>
						<td>HATGACHHA-I</td>
						<td>711316</td>
						<td>9.23E+09</td>
						<td>KHARIAMOYNAPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>271</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>PASCHIMPARA HIGH SCHOOL
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>VILL. - PASCHIMPARA, P.O. -
							NIMDANGA</td>
						<td>PURSURA</td>
						<td>BACHRI</td>
						<td>711312</td>
						<td>9.73E+09</td>
						<td>SASATIN.K.AHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>272</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>ILSOBA MONDLAI HIGH SCHOOL
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>VILL.MONDLAIN P.O.ILSOBA
							MONDLAI</td>
						<td>PANDUA</td>
						<td>JAYPUR</td>
						<td>711401</td>
						<td>3.21E+09</td>
						<td>JOYPURPHAKIRDAS2018@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>273</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KUMARHAT HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - KUMARHAT, P.O. -
							RAJHATI BANDAR</td>
						<td>KHANAKUL - II</td>
						<td></td>
						<td>711322</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>274</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BADANGANJ HIGH SCHOOL (H.S.)</td>
						<td>HOOGHLY</td>
						<td>P.O. - BADANGANJ</td>
						<td>GOGHAT - II</td>
						<td>BANTUL BAIDYANATHPUR</td>
						<td>711312</td>
						<td>3.21E+09</td>
						<td>BANTULLMAHAKALI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>275</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KAMARPARA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - KAMARPARA, P.O. -
							BRINDABONPUR</td>
						<td>BALAGARH</td>
						<td>BAGNAN-I</td>
						<td>711303</td>
						<td>3.21E+09</td>
						<td>TENPURANHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>276</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAMNAGAR NOOT BEHARI PAL
							CHOWDHURI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - RAMNAGAR</td>
						<td>TARAKESWAR</td>
						<td>NARNA</td>
						<td>711405</td>
						<td>3.21E+09</td>
						<td>BABUA000@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>277</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>UNION HIGH MADRASAH</td>
						<td>HOOGHLY</td>
						<td>VILL : MAJER AINTN P.O.
							-KUMIRMORAN</td>
						<td>CHANDITALA - I</td>
						<td>SHYAMPUR</td>
						<td>711314</td>
						<td>3.21E+09</td>
						<td>SHYAMPURHIGHSCHOOLHSULUSUBDIVN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>278</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>KALACHARA HIGH MADRASAH
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>P.O. - KALACHARA</td>
						<td>HARIPAL</td>
						<td>RAGHUDEBBATI</td>
						<td>711310</td>
						<td>9.83E+09</td>
						<td>RSV_VOC@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>279</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>ARAMBAGH HIGH SCHOOL (H.S.)</td>
						<td>HOOGHLY</td>
						<td>TOWN &amp; P.O. - ARAMBAGH</td>
						<td>ARAMBAG (M)</td>
						<td>GAZIPUR</td>
						<td>711401</td>
						<td>3.21E+09</td>
						<td>KHOROPHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>280</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHADRAKALI SRI SARADAMONI
							GIRLS� HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>13, B. B. STREET, P.O. -
							BHADRAKALI</td>
						<td>UTTARPARA KOTRUNG (M)</td>
						<td>SAPUIPARA-BASUKAT</td>
						<td>711227</td>
						<td>3.33E+09</td>
						<td>NAPATYHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>281</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEULPARA B. N. VIDYANIKETAN</td>
						<td>HOOGHLY</td>
						<td>VILL.+P.O. - DEULPARA</td>
						<td>PURSURA</td>
						<td>BARGRAM</td>
						<td>711312</td>
						<td>9.61E+09</td>
						<td>MOULANETAJI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>282</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SEKENDARPUR RAI K.P. P. B.
							HIGH (H.S.) SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - SEKENDARPUR, P.O. -
							HELAN</td>
						<td>KHANAKUL - I</td>
						<td>DEULPUR</td>
						<td>711411</td>
						<td>3.33E+09</td>
						<td>DHS_2042@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>283</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHANGAMORA N.K.N.C.M
							INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>P.O. - BHANGAMORA</td>
						<td>PURSURA</td>
						<td>AMARDAHA</td>
						<td>711312</td>
						<td>9.05E+09</td>
						<td>NAODASCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>284</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SHYAMPUR HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. SHYAMPUR P.O. -
							PARSHYAMPUR</td>
						<td>PURSURA</td>
						<td>TAJPUR</td>
						<td>711413</td>
						<td>3.21E+09</td>
						<td>HMTMNR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>285</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>NAISARAI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - NASARAI</td>
						<td>ARAMBAG</td>
						<td>PANCHLA</td>
						<td>711322</td>
						<td>9.14E+09</td>
						<td>PANCHLAAZEEM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>286</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOPALPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. &amp; VILL. - GOPALPUR</td>
						<td>BALAGARH</td>
						<td></td>
						<td>711101</td>
						<td>3.33E+09</td>
						<td>HRHS1862@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>287</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAMPADANGA BIJOY KRISHNANA
							U. B VIDYALAYA</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. -
							CHAMPADANGA</td>
						<td>TARAKESWAR</td>
						<td>HALLYAN</td>
						<td>711312</td>
						<td>3.21E+09</td>
						<td>HALLYAN2069@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>288</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DUMURDAHA DHRUBANANDA HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - DUMURDAHA</td>
						<td>BALAGARH</td>
						<td>HARISHPUR</td>
						<td>711410</td>
						<td>3.21E+09</td>
						<td>CRGBC.INSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>289</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>NABAGRAM VIDYAPITH</td>
						<td>HOOGHLY</td>
						<td>P.O. - NABAGRAM</td>
						<td>SERAMPUR UTTARPARA</td>
						<td>NAKOLE</td>
						<td>711312</td>
						<td>9.8E+09</td>
						<td>KHMINFORMATION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>290</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BALI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - BALIDEWANGANJ</td>
						<td>GOGHAT - I</td>
						<td>NABAGRAM</td>
						<td>711315</td>
						<td>9.43E+09</td>
						<td>HM.KOLIAAMIRALIHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>291</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>GARBATI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. -
							BUROSHIBTALA,CHINSURAH,</td>
						<td>HUGLI-CHINSURAH (M + OG)</td>
						<td>BANESWARPUR-II</td>
						<td>711314</td>
						<td>7.04E+09</td>
						<td>GUJARPURGIRLSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>292</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>AKUNI B.G. BIHARILAL INST.</td>
						<td>HOOGHLY</td>
						<td>P.O. - AKUNI</td>
						<td>CHANDITALA - I</td>
						<td>DINGA KHOLA</td>
						<td>711314</td>
						<td>9.73E+09</td>
						<td>GSBHIGHSCHOOL07@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>293</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KINKARBATI AGRICULTURAL INST.</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - KINKARBATI</td>
						<td>HARIPAL</td>
						<td>GANGADHARPUR</td>
						<td>711302</td>
						<td>9.14E+09</td>
						<td>JPV1962@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>294</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>JANGALPARA B.C. KUNDU
							MEMORIAL HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - JANGALPARA</td>
						<td>PURSURA</td>
						<td>DHANDALI</td>
						<td>711315</td>
						<td>7.28E+09</td>
						<td>TS.BJHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>295</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ANANDANAGAR A.C. ROY HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - ANANDANAGAR,</td>
						<td>SINGUR</td>
						<td>TAJPUR</td>
						<td>711413</td>
						<td>7.89E+09</td>
						<td>NNIX1885@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>296</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KASWARA YEASIN MONDAL
							SIKSHANIKETAN (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - KASWARA</td>
						<td>POLBA - DADPUR</td>
						<td>PANCHRUL</td>
						<td>711225</td>
						<td>3.21E+09</td>
						<td>SRIHARIVIDYAMANDIR2164@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>297</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>AGFF</td>
						<td>SAMANTAKHANDA HARENDRA
							KRISHANA ROY HIGH SCHOOL(H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. -
							SAMANTAKHANDA</td>
						<td>GOGHAT - II</td>
						<td>RAGHUBATI</td>
						<td>712611</td>
						<td>3.21E+09</td>
						<td>BENGAIHIGHSCHOOL12@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>298</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PASCHIMPARA R. K. VIDYABHABAN</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. -
							PASCHIMPARA</td>
						<td>GOGHAT - II</td>
						<td>SEORAH</td>
						<td>712616</td>
						<td>3.21E+09</td>
						<td>8004SUHS2015@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>299</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KONNAGAR SRI ARABINDA
							VIDYAPITH</td>
						<td>HOOGHLY</td>
						<td>2, DR. BANKIM MUKHERJEE
							STREET P.O. - KONNAGAR</td>
						<td>KONNAGAR (M)</td>
						<td>GOGHAT</td>
						<td>712614</td>
						<td>3.21E+09</td>
						<td>GOGHAT2505@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>300</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>THE BELMURI UNION INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - BELMURI</td>
						<td>DHANIAKHALI</td>
						<td>BHASTARA</td>
						<td>712303</td>
						<td>3.21E+09</td>
						<td>BJHSHOOGHLY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>301</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHADRESWAR DHARMATALA GIRLS
							HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>JAGADHATRI TALA RD, P.O. -
							BHADRESWAR</td>
						<td>CHAMPDANI (M)</td>
						<td>MOLAYPUR-I</td>
						<td>712420</td>
						<td>3.21E+09</td>
						<td>MOLOYPUR.HIGHSCHOOL2015@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>302</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NILARPUR RAJA RAM MOHON
							VIDYAPITH</td>
						<td>HOOGHLY</td>
						<td>VILL. - NILARPUR, P.O. -
							CHARPUR</td>
						<td>JANGIPARA</td>
						<td>ARANDI-I</td>
						<td>712413</td>
						<td>3.21E+09</td>
						<td>DHAMSAPCSENINSTITUTION@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>303</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SAHAGANJ DUNLOP HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>DUNLOP ESTATE, SAHAGANJ.</td>
						<td>CHINSURAH - MAGRA</td>
						<td>JANAI</td>
						<td>712304</td>
						<td>3.21E+09</td>
						<td>JANAITRAININGHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>304</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HAZIPUR UNION HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - DATPUR, P.O. -
							DEBKHANDA</td>
						<td>GOGHAT - II</td>
						<td>PURSURAH-I</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>PHS.VTC2515@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>305</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HARISHCHAK HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - HARISHCHAK</td>
						<td></td>
						<td>DEHIBATPUR</td>
						<td>712414</td>
						<td>3.21E+09</td>
						<td>PASCHIMPARA.HIGH1955@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>306</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAJBALHAT HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - RAJBALHAT</td>
						<td>JANGIPARA</td>
						<td>BADANGANJ FULUI-I</td>
						<td>712122</td>
						<td>3.21E+09</td>
						<td>BADANGANJHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>307</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAMANATHPUR K. A. N. HIGH
							SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - KUMIRMORA</td>
						<td>CHANDITALA - I</td>
						<td>MOHIPALPUR</td>
						<td>712146</td>
						<td>3.21E+09</td>
						<td>KAMARPARAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>308</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAGATI RAMGOPAL GHOSH HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - MOGRA</td>
						<td>CHINSURAH - MAGRA</td>
						<td>KUMIRMORAH</td>
						<td>712704</td>
						<td>3.21E+09</td>
						<td>UNIONHIGH01@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>309</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALIPUR SWAMIJI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - ARAMBAGH</td>
						<td>ARAMBAG</td>
						<td>JEJUR</td>
						<td>712405</td>
						<td>3.21E+09</td>
						<td>KALACHARA1926@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>310</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAKHLA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>MAKHLA GOVT. COLONY, NO. 1
							P.O. MAKHLA</td>
						<td>UTTARPARA KOTRUNG (M)</td>
						<td></td>
						<td>712601</td>
						<td>3.21E+09</td>
						<td>ARAMBAGHHIGHSCHOOL1861@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>311</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>HSHM</td>
						<td>BIGHATI KISHORI MOHAN HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - BIGHATI</td>
						<td>SINGUR</td>
						<td></td>
						<td>712232</td>
						<td>3.33E+09</td>
						<td>BHADRAKALISARADAMONIGHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>312</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BAIDYABATI SURENDRANATH ROY
							BALIKA VIDYALAYA</td>
						<td>HOOGHLY</td>
						<td>S.C. MUKHERJEE RD., P.O. -
							BAIDYABATI</td>
						<td>BAIDYABATI (M)</td>
						<td>DEHIBATPUR</td>
						<td>712414</td>
						<td>3.21E+09</td>
						<td>DEULPARABNV1949@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>313</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GARH MANDARAN HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - MANDARAN</td>
						<td>GOGHAT - II</td>
						<td>TIROL</td>
						<td>712602</td>
						<td>9.43E+09</td>
						<td>9702NHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>314</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>MAHESH BALIKA VIDYAMANDIR</td>
						<td>HOOGHLY</td>
						<td>10, KHATIR BAZAR LANE, P.O. -
							RISHRA</td>
						<td>SERAMPORE MUNICIPALITY</td>
						<td>DUMUR DAHA NITYANANDAPUR-II</td>
						<td>712513</td>
						<td>3.21E+09</td>
						<td>GOPALPURHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>315</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>SHYAMSUNDAR CHILDREN HIGH
							SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>19 &amp; 20 SARKAR PARA LANE</td>
						<td>CHAMPDANI (M)</td>
						<td>CHAMPADANGA</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>CHAMPADANGAGIRLS@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>316</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>KHALISANI VIDYAMANDIR</td>
						<td>HOOGHLY</td>
						<td>P.O. - KHALISANI</td>
						<td>CHANDANNAGAR (M CORP)</td>
						<td>BALI</td>
						<td>712616</td>
						<td>3.21E+09</td>
						<td>BALIHIGH2545@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>317</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>JAMAIBATI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - BRAHMANPARA, HARIPAL</td>
						<td>HARIPAL</td>
						<td>AMNAN</td>
						<td>712102</td>
						<td>3.21E+09</td>
						<td>KYMSN.1469@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>318</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>INCHURA RAI SAHEB HARADHAN
							CHANDRAADIBASI VIDYAMANDIR (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. - INCHURA, P.O. -
							INCHURA BAZAR</td>
						<td>BALAGARH</td>
						<td>PASCHIMPARA</td>
						<td>712612</td>
						<td>7.06E+09</td>
						<td>0409PRKV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>319</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>HARIPUR DURGAPADA MEMORIAL
							HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - HARIPUR</td>
						<td>CHANDITALA - I</td>
						<td></td>
						<td>712235</td>
						<td>3.33E+09</td>
						<td>ARABINDAVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>320</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GHARGOHAL MAHAMAYA BASU
							VIDYANIKETAN</td>
						<td>HOOGHLY</td>
						<td>VILL+PO:GHARGOHAL,</td>
						<td>ARAMBAG</td>
						<td>BELMURI</td>
						<td>712309</td>
						<td>3.21E+09</td>
						<td>BELMURIVTC2560@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>321</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAKULIA RAJENDRANATH
							INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							BAKULIAGRAM</td>
						<td>BALAGARH</td>
						<td></td>
						<td>712124</td>
						<td>9.43E+09</td>
						<td>MAIL.BDGHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>322</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>TARAKESWAR MAHAVIDYALAYA
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>SAHAPUR, P.O. - TARAKESWAR</td>
						<td>TARAKESWAR</td>
						<td>FURFURAH</td>
						<td>712706</td>
						<td>9.47E+09</td>
						<td>RAJARAMMOHANVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>323</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>TALPUR PATHSALA</td>
						<td>HOOGHLY</td>
						<td>VILL+P.O: TALPUR,</td>
						<td>TARAKESWAR</td>
						<td>BANDLE</td>
						<td>712104</td>
						<td>9.43E+09</td>
						<td>SAHAGANJDUNLOPHS1959@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>324</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SIMLA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - SIMLA, P.O. -
							SERAMPORE - 3</td>
						<td>SERAMPUR UTTARPARA</td>
						<td>HAZIPUR</td>
						<td>712614</td>
						<td>3.21E+09</td>
						<td>0909HUHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>325</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SALEPUR SANTOSH SADHARAN
							VIDYAPITH</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							SALEPUR</td>
						<td>ARAMBAG</td>
						<td>KUMIRMORAH</td>
						<td>712704</td>
						<td>3.21E+09</td>
						<td>RKAN2569@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>326</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>PIRATALI VIDYAMANDIR HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - PIRA TALI, P.O. -
							JOLEKUL</td>
						<td>DHANIAKHALI</td>
						<td>TIROL</td>
						<td>712601</td>
						<td>9.73E+09</td>
						<td>1203KSHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>327</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PARUL RAMKRISHNA SARADA HIGH
							SCHOOL (H.S.)</td>
						<td>HOOGHLY</td>
						<td>ARAMBAGH</td>
						<td>ARAMBAG (M)</td>
						<td></td>
						<td>712245</td>
						<td>3.33E+09</td>
						<td>WBSCVET2575@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>328</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NARAYANPUR ASHUTOSH
							BHABANMAYEE HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. - NARAYANPUR, P.O. -
							TARAKESWAR</td>
						<td>DHANIAKHALI</td>
						<td>MANDARAN</td>
						<td>712612</td>
						<td>3.21E+09</td>
						<td>4703GMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>329</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KONNAGAR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>68, G.T. ROAD (WEST), P.O. -
							KONNAGAR</td>
						<td>KONNAGAR (M)</td>
						<td></td>
						<td>712124</td>
						<td>3.33E+09</td>
						<td>SHYAMSUNDARSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>330</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>ETEM</td>
						<td>RISHRA BRAHMANANDA KESHAB
							CHANDRA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>38/139, SARAT SARANI,
							MOREPUKUR</td>
						<td>RISHRA (M)</td>
						<td></td>
						<td>712138</td>
						<td>26820045</td>
						<td>KHALISANIVIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>331</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOLTA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL.+P.O. - GOLTA,</td>
						<td>ARAMBAG</td>
						<td>BANDIPUR</td>
						<td>712405</td>
						<td>3.21E+09</td>
						<td>JAMAIBATIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>332</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RISHRA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>4 &amp; 15, TILAK RAM DAN
							GHAT LANE</td>
						<td>RISHRA (M)</td>
						<td>HARIPUR</td>
						<td>712701</td>
						<td>3.21E+09</td>
						<td>HARIPURDPM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>333</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAMODARPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							DAMODARPUR</td>
						<td>GOGHAT - I</td>
						<td>MOLAYPUR-I</td>
						<td>712414</td>
						<td>3.21E+09</td>
						<td>GHARGOHAL2591@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>334</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BANSBERIA GIRLS HIGH SCHOOL
							(H.S.)</td>
						<td>HOOGHLY</td>
						<td>BENIA LANE, P.O. - BANSBERIA,</td>
						<td>BANSBERIA (M)</td>
						<td>BAKULIA DHOBAPARA</td>
						<td>712512</td>
						<td>3.21E+09</td>
						<td>BAKULIA.RNINSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>335</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>CHAMPADANGA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - CHAMPADANGA</td>
						<td>TARAKESWAR</td>
						<td></td>
						<td>712410</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>336</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAYAL K.C. RAY INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>VILL. - MAYAL, P.O. -
							MAYAL-BANDIPUR</td>
						<td>KHANAKUL - I</td>
						<td>SALEPUR-I</td>
						<td>712616</td>
						<td>9.47E+09</td>
						<td>4502SSSV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>337</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALUBATI BHAGABATIPUR
							SIDDQUIA SENIOR MADRASAH</td>
						<td>HOOGHLY</td>
						<td>VILL. - KALUBATI, P.O. -
							HARIPAL</td>
						<td>HARIPAL</td>
						<td>BHASTARA</td>
						<td>712303</td>
						<td>3.21E+09</td>
						<td>PVHSVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>338</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>FURFURA HIGH MADRASAH (H.S)</td>
						<td>HOOGHLY</td>
						<td>P.O. - FURFURA</td>
						<td>JANGIPARA</td>
						<td>GOPINATHPUR-II</td>
						<td>712410</td>
						<td>3.21E+09</td>
						<td>NARAYANPURABHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>339</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DHAPDHARA BALAI CHANDRA
							SARKAR VIDYAPITH (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. - DHAPDHARA, P.O. -
							ANKRISRIRAMPUR</td>
						<td>PURSURA</td>
						<td>KISHOREPUR-I</td>
						<td>712617</td>
						<td>9.73E+09</td>
						<td>MAYALKCROYINSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>340</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SATBERIA HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp; P.O. - SATBERIA</td>
						<td>GOGHAT - II</td>
						<td>KAMARPUKUR</td>
						<td>712612</td>
						<td>3.21E+09</td>
						<td>3404SATBERIAHSSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>341</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHURKUNDA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - BHURKUNDA,</td>
						<td>GOGHAT - II</td>
						<td>DUMUR DAHA NITYANANDAPUR-I</td>
						<td>712515</td>
						<td>3.21E+09</td>
						<td>KAMALPOREHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>342</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KAMALPORE HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - DADPUR, P.O. -
							KHAMARGACH</td>
						<td>BALAGARH</td>
						<td>GHOSHPUR</td>
						<td>712613</td>
						<td>3.21E+09</td>
						<td>ghoshpurunv@gmail.com</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>343</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>ITACHUNA SREE NARAYAN
							INSTITUTION(H.S)</td>
						<td>HOOGHLY</td>
						<td>ITACHUNA, HOOGHLY</td>
						<td>PANDUA</td>
						<td>SRIPUR BALAGARH</td>
						<td>712501</td>
						<td>3.21E+09</td>
						<td>BALAGARHHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>344</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SAHAGANJ SHYAMAPROSAD JATIYA
							VIDYALAYA (H.S)</td>
						<td>HOOGHLY</td>
						<td>1 KEOTA ROAD, P.O. - SAHAGANJ</td>
						<td>HUGLI-CHINSURAH (M + OG)</td>
						<td></td>
						<td>721602</td>
						<td>3.22E+09</td>
						<td>VIDYASAGARITC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>345</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>AGCF</td>
						<td>SARAT CHANDRA MEMORIAL H.S.
							INSTITUTION (INDEPENDENT)</td>
						<td>HOOGHLY</td>
						<td>VILL. + P.O. ,POLBA
						</td>
						<td>POLBA - DADPUR</td>
						<td>HERIA</td>
						<td>721430</td>
						<td>3.22E+09</td>
						<td>HARIASPINSTITUTION1917@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>346</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td></td>
						<td>HARIPAL GURU DAYAL
							INSTITUTION</td>
						<td>HOOGHLY</td>
						<td>P.O. &amp; VILL. -
							KHAMARCHANDI,</td>
						<td>HARIPAL</td>
						<td>SIMULIA</td>
						<td>721458</td>
						<td>3.22E+09</td>
						<td>BHIMESWARI.UCHCHA.SIKSHAYATAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>347</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td>KANTALI HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							KANTALI</td>
						<td>GOGHAT - I</td>
						<td>PANSKURA-I</td>
						<td>721139</td>
						<td>3.23E+09</td>
						<td>PBBHSHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>348</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SERAMPORE HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>121, NETAJI SUBHAS AVENUE,
							P.O. - SERAMPORE</td>
						<td>SERAMPORE (M)</td>
						<td>CHAITANYAPUR-I</td>
						<td>721152</td>
						<td>9.59E+09</td>
						<td>HARIPADABHAUMIKPKU@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>349</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>BAIDYABATI VIDYANIKETAN HIGH
							SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>RAJABAGAN, BAIDYABATI</td>
						<td>BAIDYABATI (M)</td>
						<td>RAGHUNATHPUR-I</td>
						<td>721668</td>
						<td>9.93E+09</td>
						<td>DEMARISCHOOL.1937@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>350</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>GHOSHPUR UNION NETAJI
							VIDYAPITH</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							GHOSHPUR</td>
						<td>KHANAKUL - I</td>
						<td>PANIPARUL</td>
						<td>721448</td>
						<td>3.22E+09</td>
						<td>PANIPARULMUKTESWARHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>351</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>ANKRI M.S.K.</td>
						<td>HOOGHLY</td>
						<td>VILL. - ANKIR,
							P.O.GHOLDIGREEI, P.S. - PURSURAH</td>
						<td>PURSURA</td>
						<td>CHALTI</td>
						<td>721442</td>
						<td>9.8E+09</td>
						<td>HM.CHALTI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>352</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BROJOMOHANPUR M.S.K.</td>
						<td>HOOGHLY</td>
						<td>VILL. - BROJOMOHANPUR, P.O. -
							DOHIAKANDA</td>
						<td>GOGHAT - I</td>
						<td>RAIPUR PASCHIMBAR</td>
						<td>721401</td>
						<td>9.49E+09</td>
						<td>GWHM1968@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>353</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>UDAYRAJPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - UDAYRAJPUR, P.O. -
							RADHABALLAVPUR,</td>
						<td>GOGHAT - I</td>
						<td>ISWARPUR</td>
						<td>721659</td>
						<td>9.48E+09</td>
						<td>ISWARPURBMACADEMY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>354</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GHOSHPUR PALLISHREE GIRLS
							HIGH SCHOOL.</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							GHOSHPUR, P.S. - KHANAKUL</td>
						<td>KHANAKUL - I</td>
						<td>KANAIDIGHI</td>
						<td>721444</td>
						<td>3.22E+09</td>
						<td>NACHINDAJKHIGHVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>355</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAULATPUR DALUIGACHA BHRATI
							VIDYALAY (GIRLS)</td>
						<td>HOOGHLY</td>
						<td>VILL. - DAULATPUR, P.O. -
							PARGOPALNAGAR</td>
						<td>SINGUR</td>
						<td>CHHATRI</td>
						<td>721429</td>
						<td>9.55E+09</td>
						<td>SANTUSATPAHI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>356</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JAJUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							JAJUR</td>
						<td>HARIPAL</td>
						<td></td>
						<td>721636</td>
						<td>3.23E+09</td>
						<td>SALGECHIAHIGHSCHOOL1974@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>357</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SAHAGANJ DUNLOP HINDI HIGH
							SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>DUNLOP ESTATE, P.O. -
							SAHAGUNJ,</td>
						<td>BANSBERIA (M)</td>
						<td></td>
						<td>721602</td>
						<td>3.22E+09</td>
						<td>HGSTSS@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>358</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PURBA AMARPUR NAGENDRA
							UPENDRA VIDYANIKETAN (HIGH SCHOOL)</td>
						<td>HOOGHLY</td>
						<td>VILL. - PURBA AMARPUR,
							P.O.- DHULEPUR,</td>
						<td>GOGHAT - II</td>
						<td></td>
						<td>721429</td>
						<td>3.22E+09</td>
						<td>EGRA.JLSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>359</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SARANGPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - SARANGPUR, P.O. -
							PAWNAN,</td>
						<td>POLBA - DADPUR</td>
						<td></td>
						<td>721401</td>
						<td>9.55E+09</td>
						<td>FIROJKHANMCD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>360</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BALAGARH HIGH SCHOOL (H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O.
							&amp; P.S. - BALAGARH</td>
						<td>BALAGARH</td>
						<td>KANAIDIGHI</td>
						<td>721444</td>
						<td>9.61E+09</td>
						<td>KDV3029@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>361</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>CHAMPDANI BAIDYANATH ADHYA
							BALIKA VIDYABHABAN</td>
						<td>HOOGHLY</td>
						<td>P.O. - BAIDYABATI,</td>
						<td>CHAMPDANI (M)</td>
						<td>SIDDHA-I</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>SIDDHASSV.VTC3034@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>362</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHHANDRA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - HARINKHOLA,
						</td>
						<td>ARAMBAG</td>
						<td>BRINDABANPUR-I</td>
						<td>721625</td>
						<td>9.78E+09</td>
						<td>HANSCHARAMDHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>363</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOWA ZIA UL HAQUE INSTITUTION
							(H.S)</td>
						<td>HOOGHLY</td>
						<td>VILL. - GOWA, P.O. - HOERA,</td>
						<td>CHINSURAH - MAGRA</td>
						<td>BADALPUR</td>
						<td>721452</td>
						<td>9.93E+09</td>
						<td>CHANDANPURBIRENDRA3037@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>364</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>PURBA THAKURANICHAK RABINDRA
							VIDYAYATAN HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - THAKURANICHAK,
						</td>
						<td>KHANAKUL - I</td>
						<td>MANJUSHREE</td>
						<td>721422</td>
						<td>3.22E+09</td>
						<td>DHSKHEJURDA@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>365</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BATANAL UNION HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - BATANAL,</td>
						<td>ARAMBAG</td>
						<td>AMTALIA</td>
						<td>721427</td>
						<td>3.22E+09</td>
						<td>GAHS1961@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>366</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DASGHARA HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. &amp;P.O. -
							DASGHARA</td>
						<td>DHANIAKHALI</td>
						<td>SITALPUR PASCHIM</td>
						<td>721633</td>
						<td>9.93E+09</td>
						<td>BJHS1951@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>367</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MADHURPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>P.O. - MADHURPUR</td>
						<td>ARAMBAG</td>
						<td>DHOBABERIA</td>
						<td>721427</td>
						<td>9.43E+09</td>
						<td>TAPANKUMARDAS038@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>368</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KAMALAPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - KAMALAPUR, P.O. -
							BORA,</td>
						<td>SINGUR</td>
						<td>SANTIPUR-II</td>
						<td>721137</td>
						<td>3.23E+09</td>
						<td>GEN.HHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>369</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KESHABPUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL. - KESHABPUR, P.O. -
							PURBA-KRISHNAPUR, VIA.- SAIDPUR,</td>
						<td>ARAMBAG</td>
						<td>HARIPUR</td>
						<td>721401</td>
						<td>9.43E+09</td>
						<td>MAISALISCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>370</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KSHIRKUNDI MADHYAMIK SIKSHA
							KENDRA</td>
						<td>HOOGHLY</td>
						<td>VILL. - KSHIRKUNDI, P.O +
							P.S. - PANDUA</td>
						<td></td>
						<td></td>
						<td>721452</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>371</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>TECHNIQUE POLYTECHNIC
							INSTITUTE</td>
						<td>HOOGHLY</td>
						<td>VILL. - PANCHROKHI, P.O. -
							SUGANDHYA,</td>
						<td>POLBA - DADPUR</td>
						<td>DHOBABERIA</td>
						<td>721442</td>
						<td>9.93E+09</td>
						<td>SOFIABAD.SP.2012@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>372</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>RADHAGOBINDANAGAR RAJMOHAN
							PAUL BALIKA VIDYALAYA</td>
						<td>HOOGHLY</td>
						<td>145, B.B.D.ROAD, P.O. -
							HINDMOTOR</td>
						<td>UTTARPARA KOTRUNG (M)</td>
						<td>SITALPUR PASCHIM</td>
						<td>721632</td>
						<td>3.23E+09</td>
						<td>KGMI.VOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>373</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ANUR HIGH SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL+P.O.- ANUR,</td>
						<td>GOGHAT - II</td>
						<td>AMARSHI-II</td>
						<td>721434</td>
						<td>3.22E+09</td>
						<td>MANGALAMMAV_Y@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>374</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SANKARBATI VIDYAMANDIR HIGH
							SCHOOL</td>
						<td>HOOGHLY</td>
						<td>VILL-SANKARBATI,
							P.O.-KHALISANI,</td>
						<td>POLBA - DADPUR</td>
						<td>NAICHANPUR-I</td>
						<td>721642</td>
						<td>9.74E+09</td>
						<td>AMITESH1968@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>375</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>PARMAR BALIKA VIDYALAYA (HIGH
							SCHOOL)</td>
						<td>HOOGHLY</td>
						<td>20/1 PARMAR ROAD, SANTINAGAR
							UTTARPARA, P.O.- BHADRAKALI</td>
						<td>UTTARPARA KOTRUNG (M)</td>
						<td>KALAGECHIA</td>
						<td>721432</td>
						<td>3.22E+09</td>
						<td>KJV1921@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>376</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ENGINEERING INSTITUTE FOR
							JUNIOR EXECUTIVE</td>
						<td>HOWRAH</td>
						<td>M.B. ROAD, DALALPUKUR</td>
						<td>HAORA (M CORP)</td>
						<td>JHOWDOGA</td>
						<td>743245</td>
						<td>3.22E+09</td>
						<td>JHOWDANGASAMMILANIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>377</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>RAMAKRISHNA MISSION
							SHILPAVIDYALAYA</td>
						<td>HOWRAH</td>
						<td>313A, G.T. ROAD, BELUR, P.O.
							BELUR MATH</td>
						<td>HAORA (M CORP)</td>
						<td>BOYRA</td>
						<td>743232</td>
						<td>9.56E+09</td>
						<td>MALIDAHAHIGHSCHOOL2010@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>378</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>UDAYNARAYANPUR SARADA CHARAN
							INSTITUTION</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - UDAY
							NARAYANPUR</td>
						<td>UDAYNARAYANPUR</td>
						<td>DIGHRAMALIKBERIA</td>
						<td>743234</td>
						<td>3.22E+09</td>
						<td>TASN.1143@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>379</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HOWRAH AKSHAYA SIKSHAYATAN</td>
						<td>HOWRAH</td>
						<td>1, JOY NARAYAN SANTRA LANE</td>
						<td>HAORA (M CORP)</td>
						<td>BELIAGHATA</td>
						<td>743423</td>
						<td>3.22E+09</td>
						<td>HEADMASTERDPHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>380</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>ANANDANAGAR HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. ANANDA NAGAR</td>
						<td>BALLY JAGACHHA</td>
						<td></td>
						<td>743401</td>
						<td>3.22E+09</td>
						<td>RRBHS1925@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>381</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BALLY JORA ASWATTHATALA
							VIDYALAYA</td>
						<td>HOWRAH</td>
						<td>GOSWAMI PARA ROAD, BALLY,</td>
						<td>BALLY (M)</td>
						<td>DULDULI</td>
						<td>743439</td>
						<td>3.22E+09</td>
						<td>VTC1150@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>382</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>DASNAGAR CHAPALA DEVI BALIKA
							VIDYALAYA, DASNAGAR</td>
						<td>HOWRAH</td>
						<td>P.O.&amp; P.S. - DASNAGAR</td>
						<td>HAORA (M CORP)</td>
						<td></td>
						<td>700128</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>383</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PALPARA GOBINDAJIU HIGH
							SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. - RANMAHAL, P.O. -
							DHULASIMLA,</td>
						<td>ULUBERIA - I</td>
						<td>SEHARA RADHANAGAR</td>
						<td>743442</td>
						<td>9.67E+09</td>
						<td>CHOTTOSEHARAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>384</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KHARIA MOYNAPUR HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. - KHARIA, P.O. - KHARIA
							MOYNAPUR</td>
						<td>ULUBERIA - I</td>
						<td></td>
						<td>743235</td>
						<td>3.22E+09</td>
						<td>SAKTIGARHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>385</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SASATI NAHALA KANTALDAHA
							ABINASH HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. - NAHALA, P.O. - SASATI</td>
						<td>SHYAMPUR - II</td>
						<td>JALESWAR-II</td>
						<td>743249</td>
						<td>3.22E+09</td>
						<td>HM.GHONJAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>386</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JOYPUR PHAKIRDAS INSTITUTION</td>
						<td>HOWRAH</td>
						<td>P.O. - JOYPUR PHKIRDAS</td>
						<td>AMTA - II</td>
						<td></td>
						<td>743292</td>
						<td>3.22E+09</td>
						<td>VTC1209@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>387</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td></td>
						<td>HAKOLA UMESH CHANDRA HIGH
							SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - BAKI
							HAKOLA</td>
						<td>PANCHLA BLOCK</td>
						<td>RUPAMARI</td>
						<td>743435</td>
						<td>9.93E+09</td>
						<td>PKBMCI.VTC1330@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>388</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BANTUL MAHAKALI HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - BANTUL</td>
						<td>BAGNAN - II</td>
						<td>SWARUPNAGARBANGALANE G.P</td>
						<td>743286</td>
						<td>3.22E+09</td>
						<td>HM.MKCBI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>389</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TENPUR NABASAN ANANTARAM HIGH
							SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. - TENPUR, P.O. - BAGNAN</td>
						<td>BAGNAN - I</td>
						<td></td>
						<td>700108</td>
						<td>25771227</td>
						<td>JBNHS.1969@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>390</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BALUHATI HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - BALUHATI</td>
						<td>DOMJUR</td>
						<td>SARISHA</td>
						<td>743368</td>
						<td>3.17E+09</td>
						<td>JBVTC11@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>391</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SHYAMPUR HIGH SCHOOL (H.S.)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - SHYAMPUR</td>
						<td>SHYAMPUR - I</td>
						<td>SWAMI VIVEKANANDA</td>
						<td>743347</td>
						<td>3.21E+09</td>
						<td>KAKDWIPBIRENDRAVIDYANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>392</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAGHUDEVBATI SADHARANER
							VIDYALAYA</td>
						<td>HOWRAH</td>
						<td>P.O. - RAGHUDEVBATI</td>
						<td>SANKRAIL</td>
						<td>MATLA-II</td>
						<td>743329</td>
						<td>3.22E+09</td>
						<td>CDSHS1933@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>393</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DR. KANAILAL BHATTACHARYYA
							COLLEGE</td>
						<td>HOWRAH</td>
						<td>RAMRAJATALA, DHARMATALA</td>
						<td>HAORA (M CORP)</td>
						<td>PRATAPADITYA NAGAR</td>
						<td>743347</td>
						<td>8.95E+09</td>
						<td>SAVIDYAMANDIR@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>394</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>NIMDIGHI HIGH MADRASAH</td>
						<td>HOWRAH</td>
						<td>P.O. ULUBERIA,</td>
						<td>ULUBERIA (M + OG)</td>
						<td>RAIDIGHI</td>
						<td>743383</td>
						<td>9.48E+09</td>
						<td>RSCKHS2010@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>395</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KHOROP HIGHSCHOOL
						</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - KHOROP</td>
						<td>AMTA - II</td>
						<td>FUTIGODA</td>
						<td>743338</td>
						<td>3.22E+09</td>
						<td>NIMPITHRAMKRISHNAVIDYABHAVAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>396</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JAGADISHPUR HIGH SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							JAGADISHPURHAT</td>
						<td>BALLY JAGACHHA</td>
						<td>GURGURIA BHUBANESWARI</td>
						<td>743383</td>
						<td>8.97E+09</td>
						<td>BJKHS59@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>397</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NAPATY HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>P.O. - SAPUIPARA</td>
						<td>BALLY JAGACHHA</td>
						<td></td>
						<td>700137</td>
						<td>3.32E+09</td>
						<td>HM.SARANGABADHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>398</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MOULA NETAJI VIDYALAYA</td>
						<td>HOWRAH</td>
						<td>MOULAP.O.- GANESHPUR
						</td>
						<td>SHYAMPUR - II</td>
						<td>NOAPUKURIA</td>
						<td>743503</td>
						<td>9.73E+09</td>
						<td>SATALKALSAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>399</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>DEULPUR HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>P.O. &amp; VILL. - DEULPUR</td>
						<td>PANCHLA</td>
						<td>SIKHARBALI-II</td>
						<td>743610</td>
						<td>3.32E+09</td>
						<td>KOTALPURMADHUSUDANHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>400</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>NAODA NAYAN CH. BIDYAPITH</td>
						<td>HOWRAH</td>
						<td>VILL. - NAODA, P.O. -
							AMARDAHA</td>
						<td>SHYAMPUR - II</td>
						<td>KHARI</td>
						<td>743349</td>
						<td>9.83E+09</td>
						<td>KHANRAPARAHIGHSCHOOLVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>401</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>HOWRAH JOGESH CHANDRA GIRLS
							HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>20 G. T. ROAD (S)</td>
						<td>HAORA (M CORP)</td>
						<td>FATEHPUR</td>
						<td>743504</td>
						<td>3.17E+09</td>
						<td>DOSTAPURHIGHSCHOOL1954@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>402</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SHIBPUR INDUSTRIAL TRAINING
							INSTITUTE</td>
						<td>HOWRAH</td>
						<td>P.O. - B. GARDEN</td>
						<td>HAORA (M CORP)</td>
						<td></td>
						<td>700140</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>403</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>TAJPUR M. N. ROY INSTITUTION
							(H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp;P.O. -
							TAJPUR</td>
						<td>AMTA - II</td>
						<td>NARAYANI TALA</td>
						<td>743391</td>
						<td>3.22E+09</td>
						<td>GGHS.CSC1548@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>404</td>
						<td>ETCM</td>
						<td>HSHM</td>
						<td></td>
						<td>SALKIA SHREE MISHRA VIDYALAYA
							(GIRLS')</td>
						<td>HOWRAH</td>
						<td>92 &amp; 93/1, SRI ARABIND
							ROAD, SALKIA</td>
						<td>HAORA (M CORP)</td>
						<td>KALIKAPUR-I</td>
						<td>743330</td>
						<td>3.22E+09</td>
						<td>SROYKBD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>405</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PANCHLA AZEEM MOAZZAM HIGH
							SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL: PANCHLA MIRBAZAR, P.O :
							PANCHLA</td>
						<td>PANCHLA</td>
						<td>FALTA</td>
						<td>743504</td>
						<td>9.15E+09</td>
						<td>BIKASHROYHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>406</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>JOARGORI UNION HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL- JOARGORINPO- JOARGORI</td>
						<td>ULUBERIA - II</td>
						<td>KASHINAGAR</td>
						<td>743349</td>
						<td>3.17E+09</td>
						<td>KGHS_VTC1555@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>407</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HOWRAH RAMKRISHNAPUR HIGH
							SCHOOL</td>
						<td>HOWRAH</td>
						<td>25, UMA CHARAN BHATTACHARJEE
							LANE,</td>
						<td>HAORA (M CORP)</td>
						<td>NETRA</td>
						<td>743368</td>
						<td>9.74E+09</td>
						<td>NHMWBSCVET@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>408</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BELKULAI CHANDRA KUMAR ADHAR
							CHANDRA VIDYAPITH</td>
						<td>HOWRAH</td>
						<td>BASUDEBPUR, BELKULAI</td>
						<td>ULUBERIA - II</td>
						<td></td>
						<td>743337</td>
						<td>3.22E+09</td>
						<td>JAYNAGAR2012@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>409</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td>ANANTAPUR SIDDHESWARI HIGH
							SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>ANANTAPUR</td>
						<td>SHYAMPUR - II</td>
						<td>LAKSHMIKANTAPUR</td>
						<td>743355</td>
						<td>9.83E+09</td>
						<td>MORAPAIST.PATRICKSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>410</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>HALLYAN HIGH SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp;P.O. -
							HALLYAN</td>
						<td>BAGNAN - II</td>
						<td></td>
						<td>743372</td>
						<td>9.8E+09</td>
						<td>WWW.KEYATALAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>411</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>AYAMA GAJONKOL HIGH SCHOOL
							(H.S)</td>
						<td>HOWRAH</td>
						<td>P.O. - GOHALBERIA,</td>
						<td>SHYAMPUR - I</td>
						<td>CHAKMANIK</td>
						<td>743377</td>
						<td>24700286</td>
						<td>MHKSV1950@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>412</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>CHALTTAKHLI RAYGUNAKAR BHARAT
							CHANDRA INSTITUTION</td>
						<td>HOWRAH</td>
						<td>HARISHPUR</td>
						<td>UDAYNARAYANPUR</td>
						<td>NOAPUKURIA</td>
						<td>743503</td>
						<td>3.17E+09</td>
						<td>NABASANTUSTU@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>413</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>KHAJNABAHALA HIGH MADRASAH</td>
						<td>HOWRAH</td>
						<td>NAUL</td>
						<td>SHYAMPUR - II</td>
						<td>NARAYANPUR</td>
						<td>743357</td>
						<td>3.21E+09</td>
						<td>NNV1582@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>414</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>KOLIA AMIR ALI HIGH SCHOOL
							(H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. - KOLIA, P.O. -
							NABAGRAM SIKIPUR,</td>
						<td>SHYAMPUR - I</td>
						<td>SRINARAYANPUR-PURNACHANDR</td>
						<td>743349</td>
						<td>9.78E+09</td>
						<td>PCSBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>415</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GUJARPUR GIRLS HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - GUJARPUR</td>
						<td>SHYAMPUR - I</td>
						<td>BHARATGARH</td>
						<td>743312</td>
						<td>9.87E+09</td>
						<td>MIHIRKRACHARYA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>416</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RASHPUR HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							RASHPUR,</td>
						<td>AMTA - I</td>
						<td>MATHUR</td>
						<td>743368</td>
						<td>3.17E+09</td>
						<td>MATHURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>417</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MUGKALYAN HIGH SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O.-
							MUGKALYAN</td>
						<td>BAGNAN - II</td>
						<td>BELSINGHA-II</td>
						<td>743504</td>
						<td>3.17E+09</td>
						<td>BELSINGHA1590@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>418</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GUJARPUR SHIBGANJ
							BISHALAKSHMI HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							DINGAKHOLA,</td>
						<td>SHYAMPUR - I</td>
						<td></td>
						<td>743337</td>
						<td></td>
						<td>WBSCVET1593</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>419</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BARAMAHARA JATINDRA VIDYAPITH</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - BARAMAHARA</td>
						<td>AMTA - I</td>
						<td>KULPI</td>
						<td>743351</td>
						<td>9.47E+09</td>
						<td>2013KULPI.JANAPRIYA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>420</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>JOYNAGAR PALLISREE
							VIDYANIKETAN (HIGH SCHOOL)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							JOYNAGAR,</td>
						<td>PANCHLA</td>
						<td>DURBACHATI</td>
						<td>743347</td>
						<td>9.73E+09</td>
						<td>DMV.GEN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>421</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TALBANDI BELAYET ALI HIGH
							SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. - TALBANDI, P.O. -
							DHUNKI,</td>
						<td>PANCHLA</td>
						<td>BUDHAKHALI</td>
						<td>743347</td>
						<td>3.21E+09</td>
						<td>RAJNARAJNAGARSGBVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>422</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GANGADHARPUR BALIKA
							VIDYAMANDIR</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							GANGADHARPUR</td>
						<td>PANCHLA</td>
						<td>SANKARPUR</td>
						<td>743399</td>
						<td>9.65E+09</td>
						<td>ATIKISM7@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>423</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KHARDAH HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>P.O. - TULSIBERIA
						</td>
						<td>AMTA - I</td>
						<td>BELSINGHA-II</td>
						<td>743504</td>
						<td>3.17E+09</td>
						<td>MAHIRAMPURHIGHSCHOOL1955@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>424</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>RADHAPUR HIGH SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - RADHAPUR</td>
						<td>SHYAMPUR - I</td>
						<td>BON HOOGHLY-II</td>
						<td>700103</td>
						<td>9.43E+09</td>
						<td>BALARAMPURSCHOOLNODAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>425</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SONAMUI FATEH SINGH NAHAR
							HIGH SCHOOL</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							SONAMUI,</td>
						<td>AMTA - I</td>
						<td></td>
						<td>743393</td>
						<td>3.21E+09</td>
						<td>MAIL@NDSS.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>426</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td></td>
						<td>BAGANDA JATADHARI HIGH SCHOOL
							(H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. - BAGANDA,</td>
						<td>SHYAMPUR - I</td>
						<td>NASKARPUR</td>
						<td>743377</td>
						<td>3.32E+09</td>
						<td>ARIAPARAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>427</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GANGADHARPUR VIDYAMANDIR</td>
						<td>HOWRAH</td>
						<td>VILL. &amp; P.O. -
							GANGADHARPUR</td>
						<td>PANCHLA</td>
						<td>GOSABA</td>
						<td>743370</td>
						<td>3.22E+09</td>
						<td>GOSABARRGSI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>428</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>GUJARPUR SURENDRANATH
							VIDYAPITH (H.S.)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp;P.O. -
							GUJARPUR,</td>
						<td>SHYAMPUR - I</td>
						<td>RISHIBANKIM CHANDRA</td>
						<td>743347</td>
						<td>9.15E+09</td>
						<td>GAKHS2008@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>429</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KOLORAH HIGH SCHOOL (H.S)</td>
						<td>HOWRAH</td>
						<td>VILL. &amp;P.O. -
							KOLORAH</td>
						<td>DOMJUR</td>
						<td>MADHUSUDANPUR</td>
						<td>743374</td>
						<td>9.73E+09</td>
						<td>BAIRAGI.DILIP1621@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>430</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>NARIT NAYARATNA INSTITUTION</td>
						<td>HOWRAH</td>
						<td>VILL + P.O. - NARIT</td>
						<td>AMTA - II</td>
						<td></td>
						<td>700141</td>
						<td>9.83E+09</td>
						<td>PALLABKRDUTTA10@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>431</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>PANCHARUL SRIHARI VIDYAMANDIR</td>
						<td>HOWRAH</td>
						<td>PANCHARUL, UDAYNARAYANPUR</td>
						<td>UDAYNARAYANPUR</td>
						<td>DHAPDHAPI-II</td>
						<td>743387</td>
						<td>3.22E+09</td>
						<td>DHSHS1857@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>432</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAMGARH M.S. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>P.O. - RAMGARH</td>
						<td>BINPUR - I</td>
						<td>PANCHTHUPI</td>
						<td>742161</td>
						<td>3.48E+09</td>
						<td>PTNI1904@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>433</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SEVAYATAN ITC, JHARGRAM</td>
						<td>JHARGRAM</td>
						<td>P.O. - SEVAYATAN, JHARGRAM</td>
						<td>JHARGRAM</td>
						<td>MALATIPUR</td>
						<td>732123</td>
						<td>3.51E+09</td>
						<td>GHS1938@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>434</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BELIABERAH K.C.M. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL +P.O. - BELIABERAH</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>BHINGOLE</td>
						<td>732123</td>
						<td>8.76E+09</td>
						<td>KRISHNADASGOSWAMI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>435</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PETBINDHI D.K.M. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - PETBINDHI</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>SAMSI</td>
						<td>732139</td>
						<td>3.51E+09</td>
						<td>SAMSISITADEVIBALIKAVIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>436</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHANDABILA S.C. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - CHANDABILA</td>
						<td>NAYAGRAM</td>
						<td></td>
						<td>732102</td>
						<td>9.78E+09</td>
						<td>SUBRATAKUMARSUKUL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>437</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BELPAHARI S.C. HIGH SCHOOL
							(H.S.)</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - BELPAHARI</td>
						<td>BINPUR - II</td>
						<td>PIRGANJ</td>
						<td>732102</td>
						<td>9.78E+09</td>
						<td>MAHANANDA7804@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>438</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>JHARGRAM K.K. INSTITUTION</td>
						<td>JHARGRAM</td>
						<td>RAGHUNATHPUR, P.O. - JHARGRAM</td>
						<td>JHARGRAM (M)</td>
						<td>SRIRAMPUR</td>
						<td>732121</td>
						<td>3.51E+09</td>
						<td>ASISH.HM.150@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>439</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>DAHIJURI MAHATMA VIDYAPITH</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - DAHIJURI</td>
						<td>BINPUR - I</td>
						<td>ALAL</td>
						<td>732102</td>
						<td>9.93E+09</td>
						<td>RCHM.MALDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>440</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KUSHMARH TENTULIA HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>P.O. - JAHANPUR</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>RAMKRISHNAPUR</td>
						<td>733141</td>
						<td>3.52E+09</td>
						<td>GOPALGANJRN.VTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>441</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DHANSOLE ADIBASI HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - DHANSOLE</td>
						<td>GOPIBALLAVPUR - I</td>
						<td>ELLAHABAD</td>
						<td>733121</td>
						<td>9.59E+09</td>
						<td>SIHOLEHIGHSCHOOL.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>442</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>KHALSEULI HIGH SCHOOL (H.S.)</td>
						<td>JHARGRAM</td>
						<td>P.O. - KHALSEULI</td>
						<td>JHARGRAM</td>
						<td>DWIPKHANDA</td>
						<td>733127</td>
						<td>9.73E+09</td>
						<td>DARALHATHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>443</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>RANTUA HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>P.O. - RANTUA</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>GANGARAMPUR</td>
						<td>733124</td>
						<td>3.52E+09</td>
						<td>KBHS1974@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>444</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BANPUKHURIA AHLADI HIGH
							SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp;P.O. -
							BANPUKHURIA</td>
						<td>BINPUR - I</td>
						<td>PATIRAM</td>
						<td>733133</td>
						<td>3.52E+09</td>
						<td>PHS1944@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>445</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td></td>
						<td>BINPUR HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>A.T.+P.O. - BINPUR,</td>
						<td>BINPUR - I</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>446</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DUDKUNDI BAPUJI SIKSHAYATAN
							(H.S)</td>
						<td>JHARGRAM</td>
						<td>P.O. - RAJABHASA</td>
						<td>JHARGRAM</td>
						<td></td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>KNJPSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>447</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>EKTAL D. M. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL - EKTAL P.O. - AGUIBONI</td>
						<td>JHARGRAM</td>
						<td>DHANKOIL</td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>LMCB8530@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>448</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td></td>
						<td>SARIA TRIBAL HIGH SCHOOL
							(H.S)</td>
						<td>JHARGRAM</td>
						<td>P.O. - SARIA</td>
						<td>GOPIBALLAVPUR - I</td>
						<td>KHOAR DANGA-I</td>
						<td>736202</td>
						<td>3.56E+09</td>
						<td>KDJHS13@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>449</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAGHUASOLE JUNSOLA NEHRU
							VIDYAPITH</td>
						<td>JHARGRAM</td>
						<td>BAGHUASOLE</td>
						<td>GOPIBALLAVPUR - II</td>
						<td></td>
						<td>736101</td>
						<td>3.58E+09</td>
						<td>COB.UBV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>450</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>JHARGRAM BIKASH BHARATI
							SIKHAYATAN</td>
						<td>JHARGRAM</td>
						<td>GARH SALBANI</td>
						<td>JHARGRAM</td>
						<td></td>
						<td>734102</td>
						<td>3.54E+09</td>
						<td>GHOOMBOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>451</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>KHARBANDHI S. C. HIGH SCHOOL
							(H.S)</td>
						<td>JHARGRAM</td>
						<td>AT. &amp; P.O. - KHARBANDHI ,
							P.S. - BELIABARAH</td>
						<td>GOPIBALLAVPUR - II</td>
						<td></td>
						<td>743235</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>452</td>
						<td>ETBC</td>
						<td>BCLS</td>
						<td>ETEM</td>
						<td>NAYAGRAM BANI BIDYAPITH</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O.-
							NAYAGRAM</td>
						<td>NAYAGRAM</td>
						<td>TENGRA</td>
						<td>743251</td>
						<td>3.22E+09</td>
						<td>TCHS1198@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>453</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>CHORCHITA CHORESWAR HIGH
							SCHOOL (H.S)</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp; P.O. - CHORCHITA</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>MOHAR</td>
						<td>721161</td>
						<td>3.22E+09</td>
						<td>MOHARBM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>454</td>
						<td>ETBC</td>
						<td>HSFN</td>
						<td>ETIA</td>
						<td>PATASHIMUL S.C. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>P.O. - JORANANDA</td>
						<td>JHARGRAM</td>
						<td>CHANDMONI-I</td>
						<td>732204</td>
						<td>9.73E+09</td>
						<td>KHANPURHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>455</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>GURUMA JANARDAN SMRITI
							VIDYAPITH (HIGH )</td>
						<td>JHARGRAM</td>
						<td>P.O. - GURUMA VAMAL</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>DHALPARA</td>
						<td>733126</td>
						<td>3.52E+09</td>
						<td>TPCUMVHILIDD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>456</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>DHADANGRI HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp;P.O. -
							DHADANGRI</td>
						<td>GOPIBALLAVPUR - II</td>
						<td>RAJIBPURABIRA</td>
						<td>743234</td>
						<td>953216-261052</td>
						<td>BBPHSVTC1057@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>457</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>PAIKAMBI NIGAMANANDA HIGH
							SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. - PAIKAMBI, P.O. - AMBI</td>
						<td>GOPIBALLAVPUR - II</td>
						<td></td>
						<td>743401</td>
						<td>3.22E+09</td>
						<td>BADURIADKMINSTITUTIN1155@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>458</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>CHHATINASOLE S.C. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>AT &amp;P.O. -
							CHHATINASOLE</td>
						<td>GOPIBALLAVPUR - I</td>
						<td>RANGABELIA</td>
						<td>743370</td>
						<td>3.22E+09</td>
						<td>HM.VOC.1549@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>459</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>RANARANI ADIBASI HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>P.O. - RANARANI</td>
						<td>BINPUR - I</td>
						<td></td>
						<td>711104</td>
						<td>3.33E+09</td>
						<td>KLB.COLLEGE@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>460</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MURARI S.C. HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL.- MURARI, P.O.
							- MUNIADA,</td>
						<td>BINPUR - II</td>
						<td>MATHURA</td>
						<td>721440</td>
						<td>9.73E+09</td>
						<td>BJKV.AC.IN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>461</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>LAUDAHA V.A.S.T. VIDYAPITH</td>
						<td>JHARGRAM</td>
						<td>AT &amp; P.O. - LAUDAHA,</td>
						<td>SANKRAIL</td>
						<td>AMALHANDA</td>
						<td>721137</td>
						<td>3.23E+09</td>
						<td>WBSCVET3040@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>462</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BHELAIDIHA S.C. &amp; TRIBES
							HIGH SCHOOL</td>
						<td>JHARGRAM</td>
						<td>VILL. P.O. - BHELAIDIHA,</td>
						<td>BINPUR - II</td>
						<td>MAITANA</td>
						<td>721433</td>
						<td>3.22E+09</td>
						<td>BATTALASCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>463</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>PANCHKAHANIA HIGH SCHOOL
							(H.S)</td>
						<td>JHARGRAM</td>
						<td>P.O. - ASANBANI</td>
						<td>GOPIBALLAVPUR - I</td>
						<td>GUABERIA</td>
						<td>721635</td>
						<td>3.22E+09</td>
						<td>DKBMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>464</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td>SABALMARA M.S.K.</td>
						<td>JHARGRAM</td>
						<td>VILL. - SABALMARA, P.O. -
							CHICHRA, VIA - JHARGRAM,</td>
						<td>JAMBONI</td>
						<td>LAUDA</td>
						<td>721449</td>
						<td>9.64E+09</td>
						<td>BANAMALICHATTAHIGHSCHOOL2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>465</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ORALI B.L.A. MADHYAMIK SIKSHA
							KENDRA</td>
						<td>JHARGRAM</td>
						<td>AT - P.O. - ORALI,
						</td>
						<td>BINPUR - II</td>
						<td>MAJILAPUR</td>
						<td>721450</td>
						<td>3.22E+09</td>
						<td>MBV.CONTAI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>466</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>KURICHAMATH MADHYAMIK SIKSHA
							KENDRA</td>
						<td>JHARGRAM</td>
						<td>VILL. - KURICHAMATH, P.O. -
							ALAMPUR,</td>
						<td>GOPIBALLAVPUR - I</td>
						<td>BALLUK-II</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>CKRBB3091@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>467</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ALANI LALIT SING MADHYAMIK
							SIKSHA KENDRA</td>
						<td>JHARGRAM</td>
						<td>VILL.- ALANI, P.O. -
							BANDH GORA,</td>
						<td></td>
						<td>MAHISAGOTE</td>
						<td>721401</td>
						<td>3.22E+09</td>
						<td>MAHISAGOTESSVIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>468</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BENASULIM.S.K.</td>
						<td>JHARGRAM</td>
						<td>VILL. &amp;P.O. -
							BENASULI,</td>
						<td>JAMBONI</td>
						<td>BRAJALALCHAK</td>
						<td>721659</td>
						<td>9.93E+09</td>
						<td>DKCHSV3050@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>469</td>
						<td>HSHM</td>
						<td></td>
						<td></td>
						<td>CITY COLLEGE SCHOOL</td>
						<td>KOLKATA/NORTH</td>
						<td>13,SURYA SEN STREET
						</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>700067</td>
						<td>3.32E+09</td>
						<td>MURARIPUKURSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>470</td>
						<td>HSHM</td>
						<td>ETEM</td>
						<td></td>
						<td>SHYAMBAZAR A.V. SCHOOL</td>
						<td>KOLKATA/NORTH</td>
						<td>88, SHYAMBAZAR STREET.</td>
						<td>KOLKATA (M CORP.)</td>
						<td>GHIRNIGAON</td>
						<td>733207</td>
						<td>9.73E+09</td>
						<td>ASHARUBASTIVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>471</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>SHREE GOPAL VIDYAMANDIR</td>
						<td>KOLKATA/NORTH</td>
						<td>11 G. C. ROAD COSSIPORE,</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>743411</td>
						<td>3.22E+09</td>
						<td>HMD.GIRLS131@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>472</td>
						<td>HSFN</td>
						<td>AGCF</td>
						<td></td>
						<td>RAMMOHAN VIDYAMANDIR FOR
							GIRLS</td>
						<td>KOLKATA/NORTH</td>
						<td>B/4/H/133, R. MULLIK GARDEN
							LANE</td>
						<td>KOLKATA (M CORP.)</td>
						<td>JAGADISHPUR</td>
						<td>743336</td>
						<td>9.78E+09</td>
						<td>ANSARUDDINMOLLICK1205@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>473</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>KUMAR ASHUTOSH INSTITUTION
							(MAIN) BOYS</td>
						<td>KOLKATA/NORTH</td>
						<td>10/1 &amp; 8E DUM DUM ROAD,</td>
						<td>KOLKATA (M CORP.)</td>
						<td>MAMJOAN</td>
						<td>741502</td>
						<td>3.47E+09</td>
						<td>19101213307.HSG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>474</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>MURARIPUKUR GOVT. SPONSORED
							H. S. SCHOOL</td>
						<td>KOLKATA/NORTH</td>
						<td>107 &amp; 108/4 ULTADANGA
							MAIN ROAD</td>
						<td>KOLKATA (M CORP.)</td>
						<td>KARANDIGHI-II</td>
						<td>733215</td>
						<td>3.53E+09</td>
						<td>VTC_KARANDIGHI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>475</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>BELEGHATASANTI SANGA
							VIDYAYATAN BOYS (H.S)</td>
						<td>KOLKATA/NORTH</td>
						<td>1/4, BARAWARITALAROAD</td>
						<td>KOLKATA (M CORP.)</td>
						<td>MONDALGHAT</td>
						<td>735132</td>
						<td>3.56E+09</td>
						<td>KMHSJAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>476</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>MAHARAJA COSSIMBAZAR
							POLYTECHNIC INSTITUTE</td>
						<td>KOLKATA/NORTH</td>
						<td>03, NANDALAL BOSE LANE, BAGH
							BAZAR</td>
						<td>KOLKATA (M CORP.)</td>
						<td>LATAGURI</td>
						<td>735219</td>
						<td>3.56E+09</td>
						<td>LHS2014JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>477</td>
						<td>HSFN</td>
						<td>ETEM</td>
						<td></td>
						<td>MAHENDRA NATH HIGH SCHOOL
							(H.S.)</td>
						<td>KOLKATA/SOUTH</td>
						<td>ASHOK ROAD, P.O. - GARIA</td>
						<td>KOLKATA (M CORP.)</td>
						<td>ITINDA PANITAR</td>
						<td>743292</td>
						<td>3.22E+09</td>
						<td>IUHSHSV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>478</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>BEHALA PARNASREE BIDYAMANDIR</td>
						<td>KOLKATA/SOUTH</td>
						<td>P.O. - PARNASREE PALLY</td>
						<td>KOLKATA (M CORP.)</td>
						<td>KUMIRDA</td>
						<td>721444</td>
						<td>9.78E+09</td>
						<td>SARPAIMODELINSTITUTION@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>479</td>
						<td>HSFN</td>
						<td></td>
						<td></td>
						<td>PUTIARY BRAJOMOHAN TEWARY
							INSTITUTION</td>
						<td>KOLKATA/SOUTH</td>
						<td>26, BANERJEE PARA ROAD</td>
						<td>KOLKATA (M CORP.)</td>
						<td>BAZARGAON-II</td>
						<td>733201</td>
						<td>9.78E+09</td>
						<td>DAMDAMAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>480</td>
						<td>HSFN</td>
						<td>ETIA</td>
						<td></td>
						<td>PASCHIM PUTIARY SUKHARANJAN
							VIDYAMANDIR (H.S)</td>
						<td>KOLKATA/SOUTH</td>
						<td>268, BANERJEE PARA ROAD</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>735101</td>
						<td>3.56E+09</td>
						<td>CENTRALGIRLSVOC8820@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>481</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BAIDYAPARA HIGH SCHOOL (H.S)</td>
						<td>KOLKATA/SOUTH</td>
						<td>BHUBAN MOHAN ROY ROAD, P.O. -
							BARISHA</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>700010</td>
						<td>3.32E+09</td>
						<td>BSSV.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>482</td>
						<td>HSCH</td>
						<td>BCTM</td>
						<td></td>
						<td>BANKIM GHOSH MEMORIAL GIRLS
							HIGH SCHOOL</td>
						<td>KOLKATA/SOUTH</td>
						<td>20, MOHANCHAND ROAD.</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>700060</td>
						<td>3.32E+09</td>
						<td>BHS125.2010@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>483</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BEHALA HIGH SCHOOL (H.S)</td>
						<td>KOLKATA/SOUTH</td>
						<td>6, BONOMALI NASKAR ROAD
							BEHALA</td>
						<td>KOLKATA (M CORP.)</td>
						<td></td>
						<td>700108</td>
						<td>25772415</td>
						<td>DD_AASV@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>484</td>
						<td>HSCH</td>
						<td>AGCF</td>
						<td></td>
						<td>A.J.C. BOSE POLYTECHNIC</td>
						<td>NORTH 24 PARGANAS</td>
						<td>BERACHAMPA, P.O. DEBALAYA</td>
						<td>DEGANGA</td>
						<td>BERACHAMPA-I</td>
						<td>743424</td>
						<td>7.41E+09</td>
						<td>CSSMAHAVIDYALAYAVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>485</td>
						<td>HSCH</td>
						<td>AGFF</td>
						<td></td>
						<td>R.K. MISSION BOYS HOME ITC,
							RAHARA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - RAHARA,</td>
						<td>KHARDAHA (M)</td>
						<td></td>
						<td>743222</td>
						<td>3.22E+09</td>
						<td>MASARADAMANI.VIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>486</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>WOMEN ITI, BANIPUR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - BANIPUR, HABRA,</td>
						<td>HABRA (M)</td>
						<td></td>
						<td>743222</td>
						<td>3.22E+09</td>
						<td>AKNAVM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>487</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>NABA BARRACKPUR PRAFULLA
							CHANDRA MAHAVIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>NEW BARRACKPORE,</td>
						<td>NEW BARRACKPUR (M)</td>
						<td></td>
						<td>700101</td>
						<td>3.33E+09</td>
						<td>PKDV101@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>488</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>ANANDA ASHRAM SARADA
							VIDYAPITH FOR GIRLS</td>
						<td>NORTH 24 PARGANAS</td>
						<td>104 B.T. ROAD,
							BANHOOGHLY,</td>
						<td>BARANAGAR (M)</td>
						<td></td>
						<td>700124</td>
						<td>3.33E+09</td>
						<td>BSBM1965@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>489</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>CHANDRAKETUGARH SAHIDULLHA
							SMRITI MAHAVIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>BERACHAMPA, P.O. - DEBALLAYA</td>
						<td>DEGANGA</td>
						<td></td>
						<td>700074</td>
						<td>25602282</td>
						<td>MOTIJHEELGIRLS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>490</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ITINDA UNION HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ITINDA</td>
						<td>BASIRHAT - I</td>
						<td></td>
						<td>700109</td>
						<td>3.33E+09</td>
						<td>USHUMGIRL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>491</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>BHABLA TANTRA SIR RAJENDRA
							HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - BHABLA,</td>
						<td>BASIRHAT (M)</td>
						<td>MINAKHAN</td>
						<td>743425</td>
						<td>9.73E+09</td>
						<td>JJHS1942@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>492</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ATAPUR KENARAM HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ATAPUR, VIA -
							SANDESHKHALI</td>
						<td>SANDESHKHALI - II</td>
						<td></td>
						<td>700051</td>
						<td>9.84E+09</td>
						<td>NCNVM2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>493</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>KHOLAPOTA SRI AUROBINDO
							TAPABAN PATHMANDIR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. KOLAPOTA</td>
						<td>BASIRHAT - II</td>
						<td>RAUTARA G.P</td>
						<td>743234</td>
						<td>3.22E+09</td>
						<td>NPHSVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>494</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>SANDESHKHALI RADHARANI HIGH
							SCHOOL (H.S.)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. SANDESHKHALI</td>
						<td>SANDESHKHALI - II</td>
						<td></td>
						<td>743337</td>
						<td>9.15E+09</td>
						<td>JPCPI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>495</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>AGARHATI GOURHARI VIDYAPITH
							(H.S.)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - AGARHATI</td>
						<td>SANDESHKHALI - I</td>
						<td>JAGULGACHI</td>
						<td>743502</td>
						<td>8.1E+09</td>
						<td>BAHHMADRASAH1574@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>496</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KHULNA P.C. LAW VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. KHULNA</td>
						<td>SANDESHKHALI - II</td>
						<td>MALLICKPUR</td>
						<td>700145</td>
						<td>3.32E+09</td>
						<td>MALLIKPURASHS_VTC1709@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>497</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>CHARGHAT MILAN MANDIR
							VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - CHARGHAT</td>
						<td>SWARUPNAGAR</td>
						<td>DIGHIRPAR</td>
						<td>743329</td>
						<td>3.22E+09</td>
						<td>RBHS.CANNING@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>498</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>PALLA K.P. C.H.S. SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. PALLA,</td>
						<td>BANGAON (M)</td>
						<td>ISWARIPUR</td>
						<td>743351</td>
						<td>9.73E+09</td>
						<td>MONALISACOMPUTER2002@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>499</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>DAKSHIN KORAKATI RATAN
							CHANDRA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. DAKSHIN
							KORAKATI, VIA - SANDESH KHALI,</td>
						<td>Sandeskhali 2</td>
						<td>RUDRA NAGAR</td>
						<td>743373</td>
						<td>9.65E+09</td>
						<td>MSGHORAISAGAR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>500</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BAIKUNTHAPUR SATISH SMRITI
							VIDYAMANDIR (CO-EDUCATIONAL)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - BAIKUNTHAPUR, P.O. -
							MASUNDA,</td>
						<td>AMDANGA</td>
						<td></td>
						<td>711101</td>
						<td>3.33E+09</td>
						<td>HJCGS@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>501</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>MAULANA ABUL KALAM AZAD
							MEMORIAL HIGH MADRASAH (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL CHHOTOJAGULIA PO
							CHHOTOJAGULIA</td>
						<td>BARASAT - I</td>
						<td>KAMALPUR</td>
						<td>711301</td>
						<td>7.6E+09</td>
						<td>RADHAPURHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>502</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ASHOKNAGAR MA SARADAMANI
							VIDYAPITH (FOR GIRLS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ASHOKNAGAR</td>
						<td>ASHOKNAGAR KALYANGARH (M)</td>
						<td>RAJHATI-I</td>
						<td>712417</td>
						<td>3.21E+09</td>
						<td>KUMARHAT2518@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>503</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KANCHRAPARA SARADA DEVI
							UCHCHA BALIKA VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KANCHARAPARA,
						</td>
						<td>KANCHRAPARA (M + OG)</td>
						<td>DUMUR DAHA NITYANANDAPUR-I</td>
						<td>712515</td>
						<td>3.21E+09</td>
						<td>DUMURDAHAHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>504</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>MADRAL SRIRAM VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. MADRAL</td>
						<td>BHATPARA (M + OG)</td>
						<td></td>
						<td>712222</td>
						<td>3.33E+09</td>
						<td>SNROYBALIKA@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>505</td>
						<td>HSCH</td>
						<td>BCTE</td>
						<td></td>
						<td>HATIARA HIGH MADRASAH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. HATIARA</td>
						<td>RAJARHAT GOPALPUR (M)</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>506</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BAJITPUR HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - MANGALGANJ</td>
						<td>BAGDA</td>
						<td>RAJYADHARPUR</td>
						<td>712203</td>
						<td>3.33E+09</td>
						<td>SIMLA2014HIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>507</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>DEBINEGAR BALIKA VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ASHOKENAGAR KALYANGARH</td>
						<td></td>
						<td></td>
						<td>712601</td>
						<td>3.21E+09</td>
						<td>0104PRKHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>508</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ASHOKENAGAR BHARATI BALIKA
							VIDYAMANDIR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>5 NO. SCHEME, P.O. -
							ASHOKENAGAR</td>
						<td>ASHOKNAGAR KALYANGARH (M)</td>
						<td>BALI</td>
						<td>712616</td>
						<td>3.21E+09</td>
						<td>DAMODARPUR03211220176@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>509</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KANCHRAPARAHIGH
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KANCHRAPARA</td>
						<td>KANCHRAPARA (M + OG)</td>
						<td></td>
						<td>712502</td>
						<td>26346435</td>
						<td>BGHSMAIL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>510</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BADURIA L.M.S. HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. BADURIA,</td>
						<td>BADURIA</td>
						<td></td>
						<td>712706</td>
						<td>9.93E+09</td>
						<td>FHMVTC2634@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>511</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KALYANGARH BIDHAN CHANDRA
							BIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KALYANGARH</td>
						<td>ASHOKNAGAR KALYANGARH (M)</td>
						<td>KUMARGANJ</td>
						<td>712611</td>
						<td>3.21E+09</td>
						<td>BHURKUNDAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>512</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>UTTAR AKHRATALA S.M.
							INSTITUTION</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. UTTAR AKHRATALA, P.O.
							CHAITAL</td>
						<td>MINAKHAN</td>
						<td></td>
						<td>712104</td>
						<td>3.37E+09</td>
						<td>SAHAGANJDUNLOPHINDIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>513</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KAMARHATI S. D.F. HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>KAMARHATI.</td>
						<td>KAMARHATI (M)</td>
						<td>CHAITANYAPUR</td>
						<td>721645</td>
						<td>3.22E+09</td>
						<td>SJV09011964@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>514</td>
						<td>HSCH</td>
						<td>BCLS</td>
						<td></td>
						<td>DHANYAKURIA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							DHANYAKURIA</td>
						<td>BASIRHAT - II</td>
						<td>NILKUNTHIA</td>
						<td>721627</td>
						<td>3.23E+09</td>
						<td>KHAMARCHAKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>515</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>SAPTAPALLI DESHBANDHU BALIKA
							VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - HABRA</td>
						<td>HABRA (M)</td>
						<td></td>
						<td>721139</td>
						<td>3.23E+09</td>
						<td>HMBMONDAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>516</td>
						<td>HSCH</td>
						<td>AGCF</td>
						<td></td>
						<td>JONEPUR (GIRLS) HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KANCHRAPARA</td>
						<td>BARRACKPUR - I</td>
						<td>KOTEBASH</td>
						<td>721626</td>
						<td>3.22E+09</td>
						<td>KPKHSVOCATIONAL.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>517</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KOLSUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL+PO : KOLSUR</td>
						<td>DEGANGA</td>
						<td>PADUMPUR-I</td>
						<td>721649</td>
						<td>8.35E+09</td>
						<td>HIGHSCHOOLJOYKRISHNAPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>518</td>
						<td>HSCH</td>
						<td>AGHC</td>
						<td></td>
						<td>TOKIPUR RAJLUXMI HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. TOKIPUR</td>
						<td>HASNABAD</td>
						<td>BIRULIA</td>
						<td>721650</td>
						<td>9.73E+09</td>
						<td>TAPANMAITI94@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>519</td>
						<td>HSCH</td>
						<td>ETCM</td>
						<td></td>
						<td>ASHOKENAGAR K. N. A.
							VIDYAMANDIR (FOR GIRLS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ASHOKENAGAR</td>
						<td>ASHOKNAGAR KALYANGARH (M)</td>
						<td>CHHATRI</td>
						<td>721429</td>
						<td>9.43E+09</td>
						<td>CVV.CHHATRI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>520</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>PRAFULLA KANAN DESHPRIYA
							VIDYAMANDIR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O:PRAFULLA KANAN
						</td>
						<td>RAJARHAT GOPALPUR (M)</td>
						<td>BIRBANDAR</td>
						<td>721430</td>
						<td>8.35E+09</td>
						<td>AJAYAANNADAVIDYAMANDIR47@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>521</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BIRA BALLAVPARA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL &amp; P.O.
							BIRABALLAVPARA</td>
						<td>HABRA - II</td>
						<td>MUGBERIA</td>
						<td>721425</td>
						<td>3.22E+09</td>
						<td>BHUPATINAGARKANYAVIDYALAY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>522</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KHANTURA PRITILATA SHIKSHA
							NIKETAN (FOR BOYS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. KHANTURA</td>
						<td>GOBARDANGA (M)</td>
						<td>NILKUNTHIA</td>
						<td>721653</td>
						<td>9.23E+09</td>
						<td>TULIA.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>523</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>PURBA BARASAT ADARSHA
							VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. KALIKAPUR , BARASAT</td>
						<td>BARASAT</td>
						<td>MAHAMMADPUR-II</td>
						<td>721601</td>
						<td>9.43E+09</td>
						<td>MANOHARPURBANDHAB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>524</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>HALISAHAR RABINDRA
							VIDYAMANDIR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - NABANAGAR</td>
						<td>HALISAHAR (M)</td>
						<td>SAHARA</td>
						<td>721448</td>
						<td>3.22E+09</td>
						<td>SHIPURKESHABESWARHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>525</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>AKRAMPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. &amp; VILL. - AKRAMPUR</td>
						<td>HABRA (M)</td>
						<td>AMARSHI-I</td>
						<td>721454</td>
						<td>3.22E+09</td>
						<td>AMARSHIRNHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>526</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>ATHPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>EAST GHOSH PARA ROAD P.O. -
							ATHPUR</td>
						<td>BHATPARA (M + OG)</td>
						<td>BAISHNABCHAK</td>
						<td>721158</td>
						<td>3.23E+09</td>
						<td>BMCHS.3342@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>527</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>SWAMI VIVEKANANDA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>GARSHYAMNAGAR II, P.O.
							SHYAMNAGAR.</td>
						<td>BARRACKPUR - I</td>
						<td>SARBERIA-II</td>
						<td>721211</td>
						<td>3.23E+09</td>
						<td>DSSV.VOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>528</td>
						<td>HSCH</td>
						<td>AGFF</td>
						<td></td>
						<td>GOPALNAGAR HARIPADA
							INSTITUTION (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - GOPALNAGAR</td>
						<td>BANGAON (M)</td>
						<td>PAPARARA-II</td>
						<td>721149</td>
						<td>3.22E+09</td>
						<td>BARBASHIHSSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>529</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>HSCH</td>
						<td>RAJBALLAVPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - MASLANDAPUR</td>
						<td>HABRA - I</td>
						<td>SAHEBGANJ-II</td>
						<td>713128</td>
						<td>3.45E+09</td>
						<td>OCHMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>530</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td></td>
						<td>MADARPUR SUBHAS HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL &amp; P.O. MADARPUR</td>
						<td>BARRACKPUR - I</td>
						<td>ADRA</td>
						<td>713428</td>
						<td>3.42E+09</td>
						<td>ADRAHATISCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>531</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>MAMABHAGINA BAPUJEE VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. MAMABHAGINA,</td>
						<td>BAGDA</td>
						<td>SARAITIKAR</td>
						<td>713101</td>
						<td>3.42E+09</td>
						<td>SVHSVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>532</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ASHOKENAGAR BOYS SECONDARY
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ASHOKENAGAR</td>
						<td>ASHOKNAGAR KALYANGARH (M)</td>
						<td>BELKASH</td>
						<td>713104</td>
						<td>3.42E+09</td>
						<td>BURDWANMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>533</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td></td>
						<td>D.T.D. SAHID SMRITI VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							DURGAMONDAP</td>
						<td>SANDESHKHALI - II</td>
						<td>KHATRA-I</td>
						<td>722140</td>
						<td>3.24E+09</td>
						<td>KHATRAGIRLS@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>534</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>BAMANPUKURIA S.M.M. HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - BAMANKUPUR</td>
						<td>MINAKHAN</td>
						<td>DOMDOMA</td>
						<td>731129</td>
						<td>3.46E+09</td>
						<td>VTC5531@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>535</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>BIRATI VIDYALAYA-
							BOYS</td>
						<td>NORTH 24 PARGANAS</td>
						<td>M.B. ROAD BIRATI</td>
						<td>NORTH DUM DUM (M)</td>
						<td>FULUR</td>
						<td>731234</td>
						<td>8.15E+09</td>
						<td>BARASIJAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>536</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>KURULIA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. HAT KURULIA</td>
						<td>BAGDA</td>
						<td>BARABAZAR</td>
						<td>723127</td>
						<td>8.97E+09</td>
						<td>BARABAZARGIRLSSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>537</td>
						<td>HSCH</td>
						<td>ETCM</td>
						<td></td>
						<td>JONEPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KANCHRAPARANJONEPUR ,</td>
						<td>KANCHRAPARA (M + OG)</td>
						<td>BANDWAN</td>
						<td>723129</td>
						<td>3.25E+09</td>
						<td>BGS.BDN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>538</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>ARBALIA J.V. HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ARBALIA</td>
						<td>BADURIA (M)</td>
						<td>TUMRASOLE</td>
						<td>723143</td>
						<td>9.93E+09</td>
						<td>BARABHUM2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>539</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>CHAMPAPUKURMADHYAMIK
							VIDYALAYA (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VIL. &amp;P.O. -
							CHAMPAPUKUR</td>
						<td>BASIRHAT - II</td>
						<td>BHANGRA</td>
						<td>723148</td>
						<td>9.43E+09</td>
						<td>SITALPURHIGHSCHOOL15@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>540</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>SHIBHATI HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL+PO - SHIBHATI</td>
						<td>BASIRHAT - I</td>
						<td>BELMA</td>
						<td>723126</td>
						<td>9.43E+09</td>
						<td>MALTHOREHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>541</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>PATIPUKUR GIRLS HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>85, S.K. DEB ROAD, PATIPUKUR</td>
						<td>SOUTH DUM DUM (M)</td>
						<td>PUARA</td>
						<td>723153</td>
						<td>9.93E+09</td>
						<td>KANTADIHVOC6132@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>542</td>
						<td>HSCH</td>
						<td>BCRS</td>
						<td></td>
						<td>BARANAGORE RAMESWAR HIGH
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>BARANAGAR</td>
						<td>BARANAGAR (M)</td>
						<td>PUNCHA</td>
						<td>723151</td>
						<td>9.64E+09</td>
						<td>SUJOYSINGH2007@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>543</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>NAHATA HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. + P.O. NAHATA</td>
						<td>BONGAON</td>
						<td>BOGDADNAGAR</td>
						<td>742202</td>
						<td>3.49E+09</td>
						<td>6762SHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>544</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>ARIJULLAPUR SIDDIKIA HIGH
							MADRASAH (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - RAMNATHPUR</td>
						<td>DEGANGA</td>
						<td>MAHADEV NAGAR</td>
						<td>742202</td>
						<td>9.8E+09</td>
						<td>VTC6784@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>545</td>
						<td>HSCH</td>
						<td>HSCH</td>
						<td>AGCF</td>
						<td>RAMSANKARPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							RAMSANKARPUR</td>
						<td>BONGAON</td>
						<td>MATHURAPUR</td>
						<td>732203</td>
						<td>9.73E+09</td>
						<td>HASSAN.MLD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>546</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td>BANAMALIPUR SANTOSH
							BHATTACHARYA MEMORIAL HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>BANAMALIPUR, P.O. - BARASAT,</td>
						<td>BARASAT (M)</td>
						<td>BRAJABALLAVPUR</td>
						<td>733121</td>
						<td>3.52E+09</td>
						<td>BADALPURHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>547</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>UDAYRAJPUR HARIHARPUR HIGH
							SCHOOL (H.S.)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>UDAYRAJPUR</td>
						<td>MADHYAMGRAM (M)</td>
						<td></td>
						<td>733202</td>
						<td>3.53E+09</td>
						<td>VTCGIRLS2008@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>548</td>
						<td>HSCH</td>
						<td>AGFF</td>
						<td></td>
						<td>DURGANAGAR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - RABINDRANAGAR</td>
						<td>NORTH DUM DUM (M)</td>
						<td></td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>KALIYAGANJCOLLAGE@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>549</td>
						<td>HSCH</td>
						<td>AGHC</td>
						<td></td>
						<td>JHOWDANGA SAMMILANI HIGH
							SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL+PO JHOWDANGA
						</td>
						<td>GAIGHATA</td>
						<td>BOCHADANGA</td>
						<td>733129</td>
						<td>9.43E+09</td>
						<td>PMHSVET8526@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>550</td>
						<td>HSCH</td>
						<td></td>
						<td></td>
						<td>NIMICHI RAMNARAYAN VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. NIMICHI</td>
						<td>MINAKHAN</td>
						<td>BARUA</td>
						<td>733134</td>
						<td>3.52E+09</td>
						<td>MPDBV1958@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>551</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td></td>
						<td>HAROA P.G HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O &amp; P.S- HAROA</td>
						<td>HAROA</td>
						<td>SONAPUR</td>
						<td>733202</td>
						<td>9.83E+09</td>
						<td>SONAPURHAT8534@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>552</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>ASHOKEGARH ADARSHA VIDYALAYA
							FOR BOYS (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>61, ASHOKEGARH,</td>
						<td>BARANAGAR (M)</td>
						<td></td>
						<td>700041</td>
						<td>3.32E+09</td>
						<td>PPSV41@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>553</td>
						<td>ETRA</td>
						<td>ETEM</td>
						<td></td>
						<td>CHOWBERIA DINABANDHU
							VIDYALAYA (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P. O. - CHOWBERIA</td>
						<td>BONGAON</td>
						<td></td>
						<td>743126</td>
						<td>3.33E+09</td>
						<td>MSRV1959@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>554</td>
						<td>ETRA</td>
						<td>ETEM</td>
						<td></td>
						<td>RANGHAT ANCHAL HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - BAIKOLA, P.O. -
							BANESHWARPUR</td>
						<td>BAGDA</td>
						<td>MAYAPUR</td>
						<td>743318</td>
						<td>9.83E+09</td>
						<td>BIRLAPURVIDYALAYA34@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>555</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>MALIDAHA HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							MALIDAHA</td>
						<td>BAGDA</td>
						<td>JAMGRAM-MONDALAI</td>
						<td>712146</td>
						<td>9.73E+09</td>
						<td>IMHS1856@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>556</td>
						<td>ETRA</td>
						<td></td>
						<td></td>
						<td>DUM DUM MOTIJHEEL GIRLS HIGH
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>20A, DUM DUM ROAD</td>
						<td>DUM DUM (M)</td>
						<td>KHANAKUL-I</td>
						<td>712412</td>
						<td>9.93E+09</td>
						<td>SEKENDARPURSCHOOL@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>557</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>TANGRA ADARSHA SIKSHA NIKETAN</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. TANGRA, P.O. TALSA</td>
						<td>HABRA - II</td>
						<td>SHYAMPUR</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>SHYAMPURHIGHSCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>558</td>
						<td>ETRA</td>
						<td></td>
						<td></td>
						<td>DUGDIA PALTADANGA HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - DUGDIA, P.O. - SHASON</td>
						<td>BARASAT - II</td>
						<td>BENGAI</td>
						<td>722141</td>
						<td>2552</td>
						<td>SAMANTAKHANDA.VOCSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>559</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>KRISHNAPUR ADARSHA
							VIDYAMANDIR (HS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>DUM DUM PARK,</td>
						<td></td>
						<td>SALBONI</td>
						<td>721147</td>
						<td>9.47E+09</td>
						<td>SLB36059@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>560</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>RUDRAPUR RADHABALLAV HIGH
							SCHOOL (HS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. RUDRAPUR</td>
						<td>BADURIA (M)</td>
						<td></td>
						<td>721101</td>
						<td>3.22E+09</td>
						<td>MIDNAPORETOWNSCHOOLHERITAGE@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>561</td>
						<td>ETRA</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>USHUMPUR ADARSHA UCHCHA
							VIDYALAYA FOR GIRLS</td>
						<td>NORTH 24 PARGANAS</td>
						<td>OSMANPUR, AGARPARA,</td>
						<td>PANIHATI (M)</td>
						<td>RADHAMOHANPUR-I</td>
						<td>721136</td>
						<td>3.22E+09</td>
						<td>BISHNUPURSRKV.DEBRA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>562</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>SAHEBKHALI NITYANANDA HIGH
							SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - SAHEBKHALI</td>
						<td>HINGALGANJ</td>
						<td></td>
						<td>713302</td>
						<td>2270053</td>
						<td>ASANSOLPOLYTECHNIC_MES@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>563</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>BERI GOPALPUR ADARSHA
							VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - RAMNAGAR,</td>
						<td>GAIGHATA</td>
						<td>BIKNA</td>
						<td>722155</td>
						<td>9.93E+09</td>
						<td>BIKNAKPSV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>564</td>
						<td>ETRA</td>
						<td></td>
						<td></td>
						<td>THAKURNAGAR HIGH (XI - XII)
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - THAKURNAGAR,
						</td>
						<td>GAIGHATA</td>
						<td>JAMNA</td>
						<td>713129</td>
						<td>9.73E+09</td>
						<td>HATBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>565</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>GUSTIA KSHETRA NATH HIGH
							SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>GUSTIA, P.O. - BADU</td>
						<td>BARASAT</td>
						<td></td>
						<td>741234</td>
						<td>3.33E+09</td>
						<td>GNVMHERE@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>566</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>BADURIA DILIP KUMAR MEMORIAL
							INSTITUTION</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. &amp; P.S. BADURIA</td>
						<td>BADURIA (M)</td>
						<td></td>
						<td>741201</td>
						<td>3.47E+09</td>
						<td>BHARATIVOCATIONALSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>567</td>
						<td>ETRA</td>
						<td>ETEM</td>
						<td>BCTE</td>
						<td>CHHOTOSEHARA HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							CHHOTOSEHARA, VIA NAZAT</td>
						<td>SANDESHKHALI - I</td>
						<td>MANINDRANAGAR</td>
						<td>742102</td>
						<td>3.48E+09</td>
						<td>MIT_1957@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>568</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td></td>
						<td>USHUMPUR ADARSHA UCHCHA
							VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - AGARPARA</td>
						<td>PANIHATI (M)</td>
						<td>BHABTA-I</td>
						<td>742134</td>
						<td>9.74E+09</td>
						<td>SHEIKH.ASIF2008@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>569</td>
						<td>ETRA</td>
						<td>ETEM</td>
						<td></td>
						<td>SAKTIGARH HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. &amp; P.S BONGAON</td>
						<td>BANGAON (M)</td>
						<td></td>
						<td>742140</td>
						<td>3.48E+09</td>
						<td>JEMOSCHOOL1940@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>570</td>
						<td>ETRA</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>NUTANGRAM SUBHASINI HIGH
							SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							NUTANGRAM,</td>
						<td>BONGAON</td>
						<td>KHARIA</td>
						<td>735101</td>
						<td>3.56E+09</td>
						<td>ITIJALPAIGURI99@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>571</td>
						<td>ETRA</td>
						<td>ETEM</td>
						<td></td>
						<td>KAMPA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. &amp; VILL. KAMPA</td>
						<td>BARRACKPUR - I</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>572</td>
						<td>ETIA</td>
						<td>BCRS</td>
						<td></td>
						<td>BERGOOM HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. BERGOOM,</td>
						<td>HABRA - I</td>
						<td></td>
						<td>700131</td>
						<td>25275389</td>
						<td>NBPCM.ORG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>573</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>RAIPUR NIRAMISHAADARSHA
							VIDYALAYA</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. SOHAI KUMARPUR</td>
						<td>DEGANGA</td>
						<td></td>
						<td>743701</td>
						<td>9.09E+09</td>
						<td>PALLAHEADMASTER@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>574</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>NEW BONGAON GIRLS HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>COLLEGE PARA, P.O. - BONGAON</td>
						<td>BANGAON (M)</td>
						<td></td>
						<td>743145</td>
						<td>3.33E+09</td>
						<td>KPASDUBV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>575</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>BONGAON GHOSH INSTITUTION
							(HIGH)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>COURT ROAD, P.O. - BONGAON</td>
						<td></td>
						<td></td>
						<td>700157</td>
						<td>3.33E+09</td>
						<td>VTC1033@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>576</td>
						<td>ETIA</td>
						<td>BCRS</td>
						<td></td>
						<td>DUM DUM MOTILAL VIDYAYATAN
							(HIGH SCHOOL)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>24/34, JESSORE ROAD,DUMDUM.</td>
						<td>NORTH DUM DUM (M)</td>
						<td></td>
						<td>743128</td>
						<td>3.33E+09</td>
						<td>ATHPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>577</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>ICHAPORE ACADEMY (H.S.)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>INCHAPORE MAJHERPARA, P.O.
							ICHAPORE</td>
						<td>NORTH BARRACKPUR (M)</td>
						<td></td>
						<td>700065</td>
						<td>9.43E+09</td>
						<td>DURGANAGARHIGH@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>578</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>PATHARGHATA HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL &amp; P.O. PATHARGHATA</td>
						<td>RAJARHAT</td>
						<td></td>
						<td>700108</td>
						<td>3.33E+09</td>
						<td>AGBFB.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>579</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>TANGRA COLONY HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL.+ P.O. - TANGRA COLONY,</td>
						<td>BONGAON</td>
						<td>MUG KALYANBENAPUR</td>
						<td>711312</td>
						<td>3.21E+09</td>
						<td>MUGKALYANHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>580</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>ARIADAHA MONIKUNTALA BALIKA
							VIDYALAYA (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>ADYAPEATH, P.O. -
							DAKSHINESWER,</td>
						<td>KAMARHATI (M)</td>
						<td>MAYAPUR-I</td>
						<td>712413</td>
						<td>3.21E+09</td>
						<td>MRKHS.1929@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>581</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>GOLABARI PALLIMONGAL HIGH
							SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - GOLABARI BAZAR,</td>
						<td>BARASAT - II</td>
						<td></td>
						<td>712416</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>582</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>GHONJA HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O &amp; VILL. - GHONJA</td>
						<td>GAIGHATA</td>
						<td>PADIMA-II</td>
						<td>721441</td>
						<td>9.73E+09</td>
						<td>DIGHAVIDYABHAWAN1947@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>583</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>BASIRHAT NAIHATI N. C. M
							SIKSHA NIKETAN</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - NAIHATI, P.O. -
							BADARTALA</td>
						<td>BASIRHAT (M)</td>
						<td></td>
						<td>721636</td>
						<td>3.23E+09</td>
						<td>RSGS.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>584</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>KAMARHATI PRABARTAK
							VIDYAPITH(BOYS)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>1 NO NIMTA ROAD, BELGHORIA,</td>
						<td>KAMARHATI (M)</td>
						<td>BRINDABANPUR-II</td>
						<td>721633</td>
						<td>9.43E+09</td>
						<td>CHAKNANPSNIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>585</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>JOYGRAM J.N. HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL &amp; P.O.-JOYGRAM,</td>
						<td>MINAKHAN</td>
						<td></td>
						<td>721441</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>586</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>BIRATI MAHAJATI VIDYAMANDIR
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>M.B. ROAD, MAHAJOTI NAGAR
							(I), P.O. - BIRATI</td>
						<td>NORTH DUM DUM (M)</td>
						<td>DAKSHIN NARIKELDA</td>
						<td>721648</td>
						<td>9.73E+09</td>
						<td>KCBBV40@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>587</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>MEDIA BASTUHARA HIGH SCHOOL
							(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL.-MEDIA, P.O.-KHANTURA,</td>
						<td>SWARUPNAGAR</td>
						<td>UTTAR SONAMUI</td>
						<td>721649</td>
						<td>3.23E+09</td>
						<td>SUBHASJANA929@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>588</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>BONGAON KABI KESHABLAL
							VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>SUBHASH NAGAR, P.O. -
							BONGAON,</td>
						<td>BANGAON (M)</td>
						<td>KULTIKRI</td>
						<td>721135</td>
						<td>3.22E+09</td>
						<td>KULTIKRISCHIGH1945@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>589</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>MINAKHAN JATINDRA NATH BAILKA
							VIDYALAYA(H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL &amp;
							P.O.-MINAKHAN,</td>
						<td>MINAKHAN</td>
						<td>BARAMURA</td>
						<td>721127</td>
						<td>9.8E+09</td>
						<td>SANMURAHVSSADAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>590</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>RAMPUR HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - RAMPUR, P.O. -
							ARKHALI AMDANGA,</td>
						<td>AMDANGA</td>
						<td>GOBARDHANPUR-VII</td>
						<td>721160</td>
						<td>9.74E+09</td>
						<td>VETWM3597@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>591</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>KAIJURI HIGH SCHOOL (H.S)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - KAIJURI,</td>
						<td>SWARUPNAGAR</td>
						<td>KALAGRAM</td>
						<td>721150</td>
						<td>9.73E+09</td>
						<td>KALAGRAMSKSV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>592</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>SODEPUR SUSHIL KRISHNA
							SIKSHAYATAN</td>
						<td>NORTH 24 PARGANAS</td>
						<td>SODEPUR BARASAT ROAD P.O.-
							SODEPUR.</td>
						<td>PANIHATI (M)</td>
						<td>UKHRA</td>
						<td>713363</td>
						<td>3.41E+09</td>
						<td>UKHRAKBINSTITUTION@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>593</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>LAKSHMIPUR SWAMIJI SEVA
							SANGHA HIGH SCHOOL.</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL -
							LAKSHMIPUR,PO.-GOBARDANGA</td>
						<td>HABRA - I</td>
						<td>CHURULIA</td>
						<td>713368</td>
						<td>9.83E+09</td>
						<td>CHNK.VTC4027@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>594</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>DAKSHIN NANGLA K. U.
							INSTITUTION</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KUMRA-KASHIPUR,</td>
						<td>HABRA - I</td>
						<td>KETUGRAM</td>
						<td>713140</td>
						<td>9.43E+09</td>
						<td>HMKSAMI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>595</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>PURBA KHEJUR BERIA M.C.
							INSTITUTION</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - PURBA
							KHEJUR BERIA,</td>
						<td>HINGALGANJ</td>
						<td>BARSHAL</td>
						<td>722142</td>
						<td>9.43E+09</td>
						<td>CHOUSALVTC5038@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>596</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>KASHIMPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - ADI KASHIMPUR,
							DUTTAPUKUR</td>
						<td>BARASAT - I</td>
						<td>DHANSIMLA</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>DHANSIMLAVIDYABHAWANHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>597</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>NABAJIBAN COLONY NABIJIBAN
							VIDYAMANDIR</td>
						<td>NORTH 24 PARGANAS</td>
						<td>NABAJIBAN COLONY, P.O.-
							BISHARPARA,</td>
						<td>NORTH DUM DUM (M)</td>
						<td>INDPUR</td>
						<td>722136</td>
						<td>3.24E+09</td>
						<td>INDPURGOENKA1930@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>598</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>JATIA HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. &amp; VILL-JATIA,</td>
						<td>BARRACKPUR - I</td>
						<td>KURUNNAHAR</td>
						<td>731303</td>
						<td>9.43E+09</td>
						<td>KURUNNAHARHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>599</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>BASIRHAT HARIMOHAN DALAL
							GIRLSHIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>S.N. MAJUMDER RD., P.O. - BASIRHAT,</td>
						<td>BASIRHAT (M)</td>
						<td>PANIGHATA</td>
						<td>741181</td>
						<td>9.47E+09</td>
						<td>PANIGHATAUDMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>600</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>GUMA RABINDRA VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - GUMA,</td>
						<td>HABRA - II</td>
						<td>CHAPRA-II</td>
						<td>741123</td>
						<td>3.47E+09</td>
						<td>ISLAMGONJHIGHMADRASAH1942@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>601</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>NARAYANPUR HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL - NARAYANPUR, P.O.-
							LAKSHMIPUL, VIA. - BIRA BALLAVPARA,</td>
						<td>HABRA - I</td>
						<td>NATNA</td>
						<td>741160</td>
						<td>3.47E+09</td>
						<td>NATNAHIGHSCHOOL6264@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>602</td>
						<td>ETIA</td>
						<td>BCRS</td>
						<td>ETEM</td>
						<td>MALANGAPARA K.C.B. INSTITUTION</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - SWARUPNAGAR</td>
						<td>SWARUPNAGAR</td>
						<td></td>
						<td>741202</td>
						<td>3.47E+09</td>
						<td>NASRAVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>603</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>SHAH JALALI BARKATIA HIGH
							MADRASAH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>VILL. - HIZLIA, P.O. - ASHOKENAGAR</td>
						<td>HABRA - II</td>
						<td></td>
						<td>741222</td>
						<td>3.47E+09</td>
						<td>CRAVTC6281@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>604</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>KALYAN NAGAR VIDYAPITH</td>
						<td>NORTH 24 PARGANAS</td>
						<td>P.O. - KALYAN NAGAR,
						</td>
						<td>KHARDAHA (M)</td>
						<td></td>
						<td>741222</td>
						<td>3.47E+09</td>
						<td>CPV6338@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>605</td>
						<td>ETIA</td>
						<td>BCLS</td>
						<td></td>
						<td>BARANAGAR MAYAPITH NARI
							SIKSHA ASHRAM</td>
						<td>NORTH 24 PARGANAS</td>
						<td>35, MAYRADANGA ROAD</td>
						<td>BARANAGAR (M)</td>
						<td>BHAT JUNGLA</td>
						<td>741101</td>
						<td>9.8E+09</td>
						<td>RANAPRATAP76@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>606</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>JYOTINAGAR BIDYASREE NIKETAN
							(HIGHER SECONDARY)</td>
						<td>NORTH 24 PARGANAS</td>
						<td>41, JYOTINAGAR, P.O.- I.S.I,</td>
						<td>BARANAGAR (M)</td>
						<td>HINGNARA</td>
						<td>741223</td>
						<td>9.93E+09</td>
						<td>19101628004.HSC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>607</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>CHAMPAGACHI HIGH SCHOOL</td>
						<td>NORTH 24 PARGANAS</td>
						<td>CHAMPAGACHI, P.O. -
							MACHIBHANGA</td>
						<td>RAJARHAT</td>
						<td>SAGARPARA</td>
						<td>742306</td>
						<td>3.48E+09</td>
						<td>VTC6834@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>608</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HOOMGORH CHANDABILA HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - CHANDABILA, P.O. -
							HOOMGARH</td>
						<td>GARBETA - II</td>
						<td>RUKUNPUR</td>
						<td>742166</td>
						<td>9.78E+09</td>
						<td>RUKANPURHIGHSCHOOL_6836@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>609</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>LALAT GANGADHAR PATHSALA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - LALAT, BELDA</td>
						<td>DANTAN - II</td>
						<td>GURA PASHLA</td>
						<td>742184</td>
						<td>9.73E+09</td>
						<td>GPSKSNVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>610</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ITI, MEDINIPUR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - VIDYASAGAR UNIVERSITY,
							VILL. - RANGAMATI</td>
						<td>MEDINIPUR (M)</td>
						<td>RANINAGAR-II</td>
						<td>742308</td>
						<td>9.73E+09</td>
						<td>NABIPURSARALABALA1@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>611</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BILASBARH ANGUA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KISMAT ANGUA,</td>
						<td>KESHPUR</td>
						<td>SIMULIA</td>
						<td>713123</td>
						<td>7.8E+09</td>
						<td>BANWARIBADSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>612</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOVT. ITI HIJLI</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>IIT CAMPUS, KHARAGPUR
							TECHNOLOGY</td>
						<td>KHARAGPUR (M)</td>
						<td></td>
						<td>742101</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>613</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td></td>
						<td>BANERJEEDANGA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - AMLAGORA</td>
						<td>GARBETA - I</td>
						<td>KATLAMARI-I</td>
						<td>742308</td>
						<td>3.48E+09</td>
						<td>KATLAMARIHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>614</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BIRSINGHA BHAGABATI VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. &amp; VILL. - BIRSINGHA</td>
						<td>GHATAL</td>
						<td>UTTAR LAXMIPUR</td>
						<td>732207</td>
						<td>9.73E+09</td>
						<td>ULPHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>615</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NARAJOLE MOHENDRA ACADEMY</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - NARAJOLE,</td>
						<td>DASPUR - I</td>
						<td>MOTIHARPUR</td>
						<td>732126</td>
						<td>3.51E+09</td>
						<td>DIBHSSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>616</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BASANTAPUR JHARESWAR BANI
							BHAVAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O - UCHITPUR,</td>
						<td>Sabang</td>
						<td>AIHO</td>
						<td>732121</td>
						<td>3.51E+09</td>
						<td>PATHAKACHINTA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>617</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KAPGARI SEVA BHARATI
							VIDYAYATAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							KAPGARI,</td>
						<td>JAMBONI</td>
						<td>PARANPUR</td>
						<td>732204</td>
						<td>3.51E+09</td>
						<td>MLD.PHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>618</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SORRONG MADHUSUDAN VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL+P.O. - SORRONG</td>
						<td>DANTAN - I</td>
						<td>SAMBALPUR</td>
						<td>732102</td>
						<td>9.59E+09</td>
						<td>HARIPURKOSRMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>619</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KULTIKRI S.C. HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KULTIKURI</td>
						<td>SANKRAIL</td>
						<td></td>
						<td>732101</td>
						<td>3.51E+09</td>
						<td>VTC.7784@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>620</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SAHARDA KALIPADA VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SAHARDA</td>
						<td>PINGLA</td>
						<td>KALIGRAM</td>
						<td>732150</td>
						<td>3.51E+09</td>
						<td>KHARBAHNAGRILHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>621</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PAKURSENI GANA BHARATI
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - TENTULIA - BHUMJAN</td>
						<td>NARAYANGARH</td>
						<td>BAIRGACHHI-I</td>
						<td>732102</td>
						<td>9.8E+09</td>
						<td>RHMHS1969@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>622</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MONOHARPUR SRI RAMKRISHNA
							HIGH SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							MONOHARPUR,</td>
						<td>CHANDRAKONA - I</td>
						<td>SAHAJADPUR</td>
						<td>732124</td>
						<td>8.67E+09</td>
						<td>SHAHNAWAJ.MALDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>623</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>JARA HIGH SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - JARA</td>
						<td>CHANDRAKONA - I</td>
						<td>MAHARAJPUR</td>
						<td>732102</td>
						<td>8.12E+09</td>
						<td>MKHS.MALDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>624</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSFN</td>
						<td>PALASHCHABRI NIGAMANANDA HIGH
							SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILLAGE- RAMPUR,
							POST-KARASIA,</td>
						<td>CHANDRAKONA - II</td>
						<td>KAHALA</td>
						<td>732205</td>
						<td>9.61E+09</td>
						<td>HASSAN.MLD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>625</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MOHISHAGERIA A.M.A. HIGH
							MADRASAH (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - GOLAR</td>
						<td>KESHPUR</td>
						<td>BAGICHAPUR</td>
						<td>733125</td>
						<td>9.85E+09</td>
						<td>HARIRAMPUR.ASDM.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>626</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>HSCH</td>
						<td>NEKURSENI VIVEKANANDA
							VIDYABHAVAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - NEKURSENI</td>
						<td>NARAYANGARH</td>
						<td>TAPANCHANDIPUR</td>
						<td>733127</td>
						<td>3.52E+09</td>
						<td>THS8254@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>627</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DABACHA NABAKOLA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - SATBNKURA</td>
						<td>GARBETA - III</td>
						<td>HILI</td>
						<td>733126</td>
						<td>3.52E+09</td>
						<td>HILIRAMANATHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>628</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHAGABATI DEVI VOCATIONAL
							INSTITUTE.</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KHAKURDA</td>
						<td>NARAYANGARH</td>
						<td>SHIBPUR</td>
						<td>733121</td>
						<td>3.52E+09</td>
						<td>BHSALOK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>629</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td></td>
						<td>CHANDRAKONA JIRAT HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - CHANDRAKONA</td>
						<td>CHANDRAKONA (M)</td>
						<td>ELLAHABAD</td>
						<td>733121</td>
						<td>7.87E+09</td>
						<td>BELPUKURHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>630</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>GOLGRAM R.B.B.M.H. HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - GOLGRAM</td>
						<td>DEBRA</td>
						<td>SHIBPUR</td>
						<td>733121</td>
						<td>9.74E+09</td>
						<td>HARIPUR8261@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>631</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>HAT SARBERIA DR. B. C. ROY
							SMRITI SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O - SARBERIA</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>733101</td>
						<td>3.52E+09</td>
						<td>BLGKDAS@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>632</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>IRHPALA KRISHNA MOHAN
							INSTITUTION (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL:- IRHPALA ,P.O:- IRHPALA
							,</td>
						<td>GHATAL</td>
						<td></td>
						<td>733124</td>
						<td>3.52E+09</td>
						<td>GMPHSQ33@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>633</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KHARAGPUR ATULMONI
							POLYTECHNIC HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>MALANCHA ROAD, P.O. - NIMPURA</td>
						<td>KHARAGPUR (M)</td>
						<td>CHAK BHRIGU</td>
						<td>733101</td>
						<td>3.52E+09</td>
						<td>BLGLMAUV49@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>634</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PINGLA KRISHNA KAMINI
							INSTITUTION</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - PINGLA</td>
						<td>PINGLA</td>
						<td>BOLLA</td>
						<td>733158</td>
						<td>9.73E+09</td>
						<td>BAHICHALKHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>635</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td>JAHALDA HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - JAHALDA</td>
						<td>DANTAN - II</td>
						<td>RAMKRISHNAPUR</td>
						<td>733141</td>
						<td>9.8E+09</td>
						<td>DANGARHATVTC8273@GAMIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>636</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BALICHAK B.H. INSTITUTION</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BALICHAK</td>
						<td>DEBRA</td>
						<td>GANGURIA</td>
						<td>733125</td>
						<td>3.52E+09</td>
						<td>SNROY_DAULATPUR@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>637</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAGHASTY UNION H.S.C. HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BAGHASTY</td>
						<td>KESHIARY</td>
						<td>BELBARI-II</td>
						<td>733124</td>
						<td>9.47E+09</td>
						<td>THANGAPARAHIGHSCHOOL.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>638</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MALJAMUNA K.P. SMRITI
							VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MALJAMUNA</td>
						<td>DANTAN - I</td>
						<td>BAGICHAPUR</td>
						<td>733125</td>
						<td>3.52E+09</td>
						<td>BETNARKHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>639</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>GARHBETA HIGH SCHOOL HIGHER
							SECONDARY</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - GARHBETA</td>
						<td>GARBETA - I</td>
						<td>NAJIRPUR</td>
						<td>733133</td>
						<td>9.47E+09</td>
						<td>NAZIRPURHIGHSCHOOL1951@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>640</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ANTALA SITALA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BALICHAK</td>
						<td>DEBRA</td>
						<td>MALANCHA</td>
						<td>733127</td>
						<td>3.52E+09</td>
						<td>BALAPURHIGHSCHOOL1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>641</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAMPURA DESHAPRAN VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - DARRA,</td>
						<td>PINGLA</td>
						<td>CHAK BHRIGU</td>
						<td>733102</td>
						<td>3.52E+09</td>
						<td>NGHSBLG2012@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>642</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOPALI I.M. HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - SALUA</td>
						<td>KHARAGPUR - I</td>
						<td>GANGARAMPUR</td>
						<td>733124</td>
						<td>9.43E+09</td>
						<td>RAGHABPURHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>643</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td></td>
						<td>GOPINATHPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - SAMSAD GOPINATHPUR,</td>
						<td>NARAYANGARH</td>
						<td>GANGURIA</td>
						<td>733125</td>
						<td>9.74E+09</td>
						<td>ALIASRAF.ALI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>644</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>JHANJIA GOPAL CHANDRA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL+P.O. - JHANJIA</td>
						<td>DEBRA</td>
						<td>UDAY</td>
						<td>733140</td>
						<td>7.87E+09</td>
						<td>MONDALMAMINUR100@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>645</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>ANTRI S.V. ADIBASI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - RAUTARAPUR</td>
						<td>DANTAN - I</td>
						<td></td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>ITIKALIYAGANJVTC8505@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>646</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BELDA GANGADHAR ACADEMY</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BELDA</td>
						<td>NARAYANGARH</td>
						<td>BANGALBARI</td>
						<td>733134</td>
						<td>9.93E+09</td>
						<td>BANGALBARIHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>647</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BISHNUPUR ADARSHA SIKSHA
							NIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - JATRA BISHNUPUR ,
							VILL. ,BISHNUPUR</td>
						<td>SALBANI</td>
						<td>DOMAHANA</td>
						<td>733215</td>
						<td>9.73E+09</td>
						<td>RHMHS.1973@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>648</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BISHNUPUR UNION HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BISHNUPUR BAZAR</td>
						<td>SABANG</td>
						<td>KAMALABARI-I</td>
						<td>733130</td>
						<td>3.52E+09</td>
						<td>KARNAJORAHS1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>649</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAIPAT HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - CHAIPAT</td>
						<td>DASPUR - II</td>
						<td>GOURI</td>
						<td>733123</td>
						<td>3.52E+09</td>
						<td>HATIA09@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>650</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DANTAN HIGHER SECODARY
							MULTIPURPOSE SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - DATAN</td>
						<td>DANTAN - I</td>
						<td></td>
						<td>733134</td>
						<td>9.43E+09</td>
						<td>BIPLABDAS50@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>651</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DUBRA ADARSHA VIDYAMANDIR
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DUBRA</td>
						<td>JAMBONI</td>
						<td></td>
						<td>733134</td>
						<td>3.52E+09</td>
						<td>CORONATION.RAIGANJ@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>652</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>GOUTAM S. SATPATI BINAPANI
							VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-+ P.O. - SATPATI</td>
						<td>SALBANI</td>
						<td>HEMTABAD</td>
						<td>733144</td>
						<td>9.61E+09</td>
						<td>HMSHS132@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>653</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JOTEGHANASHYAM NILMONI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							JOTEGHANASHYAM</td>
						<td>DASPUR - II</td>
						<td>BANGALBARI</td>
						<td>733130</td>
						<td>9.47E+09</td>
						<td>BKUNDU.MCA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>654</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KESHIARY HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KESHIARY</td>
						<td>KESHIARY</td>
						<td>CHOPRA</td>
						<td>733207</td>
						<td>9.73E+08</td>
						<td>KALIGANJ54@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>655</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KONARPUR SITALANANDA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KUTHI KONARPUR</td>
						<td>GHATAL</td>
						<td>DURGAPUR</td>
						<td>733143</td>
						<td>9.43E+09</td>
						<td>RAJGRAMHIGHSCHOOL.UD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>656</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>MOHANPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MOHANPUR</td>
						<td>MOHANPUR</td>
						<td>PARARPAR</td>
						<td>736121</td>
						<td>9.47E+09</td>
						<td>WBSCVET8753@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>657</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MONGLAPOTA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - MONGLAPOTA, P.O. -
							KHARKUSMA,</td>
						<td>GARBETA - I</td>
						<td>RANGLI BAZNA</td>
						<td>735213</td>
						<td>3.56E+09</td>
						<td>RBMSHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>658</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>MOUPAL DESHAPRAN VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL- MOUPALP.O. -
							MOUPAL,</td>
						<td>SALBANI</td>
						<td>PADAMATI-II</td>
						<td>735305</td>
						<td>3.56E+09</td>
						<td>BHOTEPATTIHBLHIGHSCHOOL@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>659</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NANDANPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - SEKENDARI</td>
						<td>DASPUR - I</td>
						<td>ARABINDO</td>
						<td>735211</td>
						<td>8.1E+09</td>
						<td>MDGMHS.VTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>660</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PRATAPPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. PANCHMAROPRATAPPUR</td>
						<td>GHATAL</td>
						<td>FALAKATA-I</td>
						<td>735211</td>
						<td>9.2E+11</td>
						<td>RABI.SUKLA78@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>661</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SONAKHALI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SONAKHANLI</td>
						<td>DASPUR - II</td>
						<td>SAKOAJHORA-II</td>
						<td>735210</td>
						<td>9.43E+09</td>
						<td>GOSSAIRHATRMHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>662</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TENPUR THAKAMOYE VIDYAPTH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - TENPUR</td>
						<td>CHANDRAKONA - II</td>
						<td>JATESWAR-I</td>
						<td>735216</td>
						<td>9.61E+09</td>
						<td>DHULAGAON123@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>663</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>TILANTAPARA U.M.M HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							TILANTAPARA</td>
						<td>SABANG</td>
						<td>KHAGRABARI-II</td>
						<td>735224</td>
						<td>3.56E+09</td>
						<td>TETATULIRK.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>664</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TUTRANGA ANCHAL SIKSHA
							NIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - TUTRANGA, P.O. -
							THAKURCHAK,</td>
						<td>NARAYANGARH</td>
						<td></td>
						<td>735101</td>
						<td>3.56E+09</td>
						<td>DESHBANDHUNAGAR.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>665</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>UJAN HARIPADA HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- UJAN,P.O. - AKNAGERIA,</td>
						<td>PINGLA</td>
						<td>SITAI-I</td>
						<td>736167</td>
						<td>9.93E+09</td>
						<td>SITAIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>666</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAJNAGAR UNION HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - CHETUA RAJNAGAR</td>
						<td>DASPUR - I</td>
						<td>DEWANHAT</td>
						<td>736134</td>
						<td>3.58E+09</td>
						<td>DEWANHATVTC9259@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>667</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BRAHMANKHALISA SWARUPANANDA
							ADARSHA VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BRAHMANKHALISA</td>
						<td>DANTAN - II</td>
						<td>GOSAIRHAT</td>
						<td>736172</td>
						<td>8.17E+09</td>
						<td>GOSAIRHATHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>668</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BELDA PRAVATI BALIKA
							VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>BELDA</td>
						<td>NARAYANGARH</td>
						<td>SHIKARPUR</td>
						<td>736146</td>
						<td>9.43E+09</td>
						<td>KCBARMANMTB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>669</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NAYAGRAM THANA BALIKA
							VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KHARIKA MATHANI</td>
						<td>NAYAGRAM</td>
						<td>&nbsp;</td>
						<td>735301</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>670</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SANMURAH VIDEKANANDA SIKSHA
							SADAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>SANMURAH</td>
						<td>GARBETA - I</td>
						<td>&nbsp;</td>
						<td>736101</td>
						<td>3.58E+09</td>
						<td>RAMBHOLA1941@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>671</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BAKHRABAD BHARATI VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>BAKKHRABAD</td>
						<td>NARAYANGARH</td>
						<td>CHILAKHANA-I</td>
						<td>736159</td>
						<td>3.58E+09</td>
						<td>CHIGHSCHOOL1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>672</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BAGNABARH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BAGNABARH,
						</td>
						<td>PINGLA</td>
						<td>NISHIGANJ-I</td>
						<td>736157</td>
						<td>9.43E+09</td>
						<td>NISHIGANJNISHIMOYEEHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>673</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ARJUNI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>ARJUNI</td>
						<td>DEBRA</td>
						<td>FULBARI</td>
						<td>735210</td>
						<td>7.38E+09</td>
						<td>VOCATIONAL9278@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>674</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>MADANMOHANCHAK CHOUDHURY
							INSTITUTION</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>MADANMOHONCHAK</td>
						<td>NARAYANGARH</td>
						<td></td>
						<td>736135</td>
						<td>3.58E+09</td>
						<td>WBSCVET9284@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>675</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DANICHAK SANGATHANI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL - DANICHAK, P.O. -
							JASORAJPUR,</td>
						<td>PINGLA</td>
						<td>LATAPOTA</td>
						<td>735211</td>
						<td>9.64E+09</td>
						<td>KUSHIARBARIHHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>676</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KALARA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KALARA</td>
						<td>DASPUR - I</td>
						<td>UNISHBISHA</td>
						<td>736171</td>
						<td>9.93E+09</td>
						<td>PATAKAMARI.R.N.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>677</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RASKUNDU HIGH SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>RASKUNDU</td>
						<td>GARBETA - III</td>
						<td>HAZRAHAT-II</td>
						<td>736146</td>
						<td>9.65E+09</td>
						<td>HARISHCHANDRAHIGHSCHOOL9293@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>678</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KHARAGPUR PRIYANATH ROY
							VIDYANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>MALANCHA, RAKHAJANGAL</td>
						<td>KHARAGPUR (M)</td>
						<td>SAHEBGANJ</td>
						<td>736176</td>
						<td>3.58E+09</td>
						<td>SAHEBGANJ.6901@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>679</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SALBONI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>CHAKTARINI</td>
						<td>SALBANI</td>
						<td>CHANDAMARI</td>
						<td>736157</td>
						<td>9.48E+09</td>
						<td>PNHSO1035@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>680</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>TELIPUKUR H.S.SCHOOL
						</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>SULTANPUR</td>
						<td>KHARAGPUR - II</td>
						<td>KHAGRABARI</td>
						<td>736179</td>
						<td>3.58E+09</td>
						<td>MANINDRANATHHIGHSCHOOL11953@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>681</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NACHIPUR ADIBASI HIGH SCHOOL
							(H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>NACHIPUR</td>
						<td>KESHIARY</td>
						<td></td>
						<td>736135</td>
						<td>3.58E+09</td>
						<td>DHSVOC9302@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>682</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JAFALA ADARSHA VIDYAYATAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - JAFALA, P.O. - JAKPUR</td>
						<td>KHARAGPUR - I</td>
						<td>SHIKARPUR</td>
						<td>736146</td>
						<td>9.47E+09</td>
						<td>PSPRADIPSAHA1@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>683</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RADHAMOHANPUR VIVEKANANDA
							HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O &amp; VILL. -
							RADHAMOHANPUR</td>
						<td>DEBRA</td>
						<td>JAMALDAHA</td>
						<td>735303</td>
						<td>3.58E+09</td>
						<td>JAMALDAHATDHIGHSCHOOLCOOB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>684</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAMJIBANPUR BABULAL
							INSTITUTION (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>RAMJIBANPUR</td>
						<td>RAMJIBANPUR (M)</td>
						<td>GOSANIMARI-I</td>
						<td>736145</td>
						<td>3.58E+09</td>
						<td>GOSANIMARIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>685</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHANKURI UNION HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>CHANDKURI</td>
						<td>SABANG</td>
						<td>BIDHANNAGAR-II</td>
						<td>734426</td>
						<td>9.83E+09</td>
						<td>MADATIHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>686</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>LAKSHIPARI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - LAKSHIPARI</td>
						<td>PINGLA</td>
						<td>ST. MARY-I</td>
						<td>734224</td>
						<td>9.16E+09</td>
						<td>ITITUNGDARJEELING@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>687</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DHANYAGACHHI HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT + P.O. - DHANYAGACHHI</td>
						<td>CHANDRAKONA - II</td>
						<td></td>
						<td>734101</td>
						<td>9.8E+09</td>
						<td>SCHOOLRKSP1944@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>688</td>
						<td>ETCE</td>
						<td></td>
						<td></td>
						<td>DHANESWARPUR GOPAL CHANDRA
							SIKSHA SADAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- DHANESWARPUR,P.O. -
							DHANESWARPUR,</td>
						<td>PINGLA</td>
						<td>BERGOOM I G.P</td>
						<td>743252</td>
						<td>3.22E+09</td>
						<td>LSSSHSHSVOCATIONAL2010@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>689</td>
						<td>ETCE</td>
						<td></td>
						<td></td>
						<td>KALAGRAM SAHID KSHUDIRAM
							SMRITI VIDYAPITH (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>KALAGRAM</td>
						<td>KESHPUR</td>
						<td></td>
						<td>700112</td>
						<td>3.33E+09</td>
						<td>VTC1371@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>690</td>
						<td>ETCE</td>
						<td></td>
						<td></td>
						<td>BRAHMANBASAN HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BRAHMAN BASAN</td>
						<td>DASPUR - I</td>
						<td>KOLORA-II</td>
						<td>711411</td>
						<td>3.33E+09</td>
						<td>KOLORAHHIGHSCHOOL1907@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>691</td>
						<td>ETCE</td>
						<td>ETIA</td>
						<td></td>
						<td>BORUNA SATSANGA JUNIOR HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-BORUNA, P.O. - CHAIPAT,</td>
						<td>DASPUR - II</td>
						<td>GODARDIHI</td>
						<td>722203</td>
						<td>3.24E+09</td>
						<td>VOCATIONAL.DADHIMUKHA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>692</td>
						<td>ETCE</td>
						<td></td>
						<td></td>
						<td>SUKUMAR SENGUPTA MAHAVIDYALA.</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KESHPUR</td>
						<td>KESHPUR</td>
						<td>PARA</td>
						<td>723155</td>
						<td>9.93E+09</td>
						<td>RAJUMAJEE111@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>693</td>
						<td>ETCE</td>
						<td>ETEM</td>
						<td></td>
						<td>KHAJRA SATISH CHANDRA
							MEMORIAL HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>KUSHGERIA</td>
						<td>KESHIARY</td>
						<td>DOMKAL</td>
						<td>742303</td>
						<td>9.15E+09</td>
						<td>ISRAFILHAQUE57@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>694</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td></td>
						<td>GARH HARIPUR GAJENDRA NARAYAN
							HIGHER SECONDARY SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - PUYAN, P.O. - GARH
							HARIPUR,</td>
						<td>DANTAN - II</td>
						<td></td>
						<td>743263</td>
						<td>9.83E+09</td>
						<td>AKRAMPURHIGHSCHOOL1063@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>695</td>
						<td>ETBC</td>
						<td>AGFF</td>
						<td></td>
						<td>SHYAMCHANDPUR SITARAMJEW
							VIDYAMANDIR (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							SHYAMCHANDPUR</td>
						<td>KESHPUR</td>
						<td>KAWGACHI-I</td>
						<td>743127</td>
						<td>9.24E+09</td>
						<td>VTC1068@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>696</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>DHALHARA PAGLIMATA HIGH
							SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - PARSURA</td>
						<td>KESHPUR</td>
						<td>CHAVBERIA-I</td>
						<td>743290</td>
						<td>3.22E+09</td>
						<td>CDV.VOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>697</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>DASAGRAM SATISH CHANDRA
							SARBARTHA SADHAK SIKSHASADAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - DASAGRAM,</td>
						<td>SABANG</td>
						<td>RONGHAT</td>
						<td>743270</td>
						<td>3.22E+09</td>
						<td>RANGHATHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>698</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td></td>
						<td>NAYABASAT PARBATIMOYEE
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - NAYABASAT</td>
						<td>GARBETA - III</td>
						<td>ICHHAPUR-II</td>
						<td>743287</td>
						<td>3.22E+09</td>
						<td>THAKURNAGARHS1949@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>699</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>ROHINI CRD HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							ROHINI,</td>
						<td>SANKRAIL</td>
						<td></td>
						<td>743235</td>
						<td>9.78E+09</td>
						<td>NIRABKABI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>700</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>DEBRA UCHCHATARA MADHYAMIK
							VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - GANGARAMCHAK, P.O. - CHAKSHYAMPORE</td>
						<td>DEBRA</td>
						<td>KUMRA G.P</td>
						<td>743271</td>
						<td>03216-241100</td>
						<td>DNKUINS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>701</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td></td>
						<td>NARAYANGARH NABADWIP BALIKA
							VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MAKRAMPUR BAZAR</td>
						<td>NARAYANGARH</td>
						<td>SIKHARBALI-II</td>
						<td>743610</td>
						<td>3.32E+09</td>
						<td>TILOTTAMABALIKAVIDYALAYA@GNAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>702</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>ALOKEKENDRA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - ALOKEKENDRA,
						</td>
						<td>DEBRA</td>
						<td>RISHIBANKIM CHANDRA</td>
						<td>743347</td>
						<td>8.02E+09</td>
						<td>BHUBANNAGAR_SCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>703</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>KHIRINDA PRABUDDHA BHARATI
							HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KHIRINDA, P.O. -
							KRISNNAPRIYA</td>
						<td>PINGLA</td>
						<td>NAMKHANA</td>
						<td>743357</td>
						<td>3.21E+09</td>
						<td>NUHSC2138@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>704</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>KRISHNAPUR RAHMANIA HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KRISHNAPUR</td>
						<td>CHANDRAKONA - II</td>
						<td>BHOGABANPUR</td>
						<td>700135</td>
						<td>3.22E+09</td>
						<td>BHAGOWANPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>705</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>HOOMGARH GIRLS HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - HOOMGARH,</td>
						<td>GARBETA - II</td>
						<td>RAGHUDEBPUR</td>
						<td>711322</td>
						<td>3.37E+09</td>
						<td>BCKACV2066@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>706</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>RAGHUNATHPUR SAROJ MOHAN
							SMRITI VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DHARAMPUR,</td>
						<td>DASPUR - I</td>
						<td>BALIPUR</td>
						<td>712401</td>
						<td>3.21E+09</td>
						<td>KALLOLBAG@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>707</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>PUYAN P. L. KANYA VIDYAPITH
							(HIGH) SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT. - PUYAN, P.O. - GARH
							HARIPUR</td>
						<td>DANTAN - II</td>
						<td>ANIYA</td>
						<td>712701</td>
						<td>9.93E+09</td>
						<td>AKUNIBG2547@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>708</td>
						<td>ETBC</td>
						<td>ETCM</td>
						<td></td>
						<td>GOMAKPOTA GUNA DHAR
							VIDYAMANDIR (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - GOMAKPOTA, P.O. -
							NARAYANCHAK, P.S. - DASPUR</td>
						<td></td>
						<td>RAJBALHAT-I</td>
						<td>712408</td>
						<td>3.21E+09</td>
						<td>RAJBALHAT2568@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>709</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>KADRA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KADRA</td>
						<td>GARBETA - III</td>
						<td>MOGRA-II</td>
						<td>712148</td>
						<td>3.33E+09</td>
						<td>RAMGOPAL2573@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>710</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>NABINMAHESHPUR KRISHNANAGAR
							K.B. HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KRISHNANAGAR, P.O. -
							FATEHPUR,</td>
						<td>DASPUR - I</td>
						<td>TALPUR</td>
						<td>712410</td>
						<td>3.21E+09</td>
						<td>TALPURPATHSALA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>711</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>SAOTIA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							SAITIA,</td>
						<td>MOHANPUR</td>
						<td>HARIPAL ASHUTOSH</td>
						<td>712405</td>
						<td>3.21E+09</td>
						<td>SOMASANTRA55@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>712</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>DEULI KALASBARH RAMKRISHNA
							VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KALASBARH,
						</td>
						<td>SABANG</td>
						<td>BATANOL</td>
						<td>712615</td>
						<td>3.21E+09</td>
						<td>BATANALHIGHSCHOOL2700@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>713</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>CHHOTAKHELNA SURENDRA SMRITI
							VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - CHHOTAKHELNA, P.O. -
							MALIGRAM,</td>
						<td>PINGLA</td>
						<td></td>
						<td>721636</td>
						<td>3.23E+09</td>
						<td>HAMILTON1852@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>714</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>BALA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BALA</td>
						<td>CHANDRAKONA - II</td>
						<td>GARKAMALPUR</td>
						<td>721628</td>
						<td>3.22E+09</td>
						<td>MRHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>715</td>
						<td>ETBC</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td>DEBAGRAM MAHADEB HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DEBAGRAM</td>
						<td>SALBANI</td>
						<td>PARAMANANDAPUR</td>
						<td>721644</td>
						<td>3.23E+09</td>
						<td>PARAMANANDAPUR.1942@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>716</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>SARISHA KUNARPUR ANCHAL HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KUNARPUR,</td>
						<td>NARAYANGARH</td>
						<td>SAGARBARH</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>KANSHARIBHAUMIK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>717</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>BALARAMGARH HIGH MADRASAH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - BALARAMGARH, P.O. -
							RATHIPUR,</td>
						<td>GHATAL</td>
						<td>JAMNA-II</td>
						<td>721140</td>
						<td>3.22E+09</td>
						<td>PINGLAKKI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>718</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>KONGORERAIMA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							KONGORERAIMA,</td>
						<td>KESHPUR</td>
						<td>KENDUGARI</td>
						<td>721506</td>
						<td>9.93E+09</td>
						<td>DAHS1972@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>719</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>MURAR ASHUTOSH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - RAMGARH</td>
						<td>BINPUR - I</td>
						<td>KESHPUR</td>
						<td>721150</td>
						<td>3.23E+09</td>
						<td>SSMAHAVIDYALAYA04@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>720</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>MARX MRITYU SHATA BARSHIKI
							VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. ,MONOHORPUR,
							P.O. - GOPMAHAL</td>
						<td>GHATAL</td>
						<td>HARIPUR</td>
						<td>721443</td>
						<td>3.22E+09</td>
						<td>SCHOOLHARIPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>721</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>METYAL JANAKALYAN NIHARBALA
							SIKSHASADAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - TARAFBARPANDA, P.O. - DIBARPANDA</td>
						<td>NARAYANGARH</td>
						<td>KUSUMDA-I</td>
						<td>721140</td>
						<td>9.73E+09</td>
						<td>PALLABBATABYAL@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>722</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td></td>
						<td>KANTORE MAHADEB HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KANTORE</td>
						<td>GARBETA - II</td>
						<td>SRIRAMPUR</td>
						<td>741319</td>
						<td>3.45E+09</td>
						<td><a
								href="mailto:PRAHLADRUPAM@GMAIL.COM">PRAHLADRUPAM@GMAIL.COM</a></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>723</td>
						<td>ETBC</td>
						<td>ETCE</td>
						<td>HSCH</td>
						<td>KHELAR GAJENDRA HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KHELAR, P.O. -
							BONPATNA</td>
						<td>KHARAGPUR - I</td>
						<td></td>
						<td>713409</td>
						<td>3.45E+09</td>
						<td>KALNAMAHARAJA1868@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>724</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>GOBINDANGAR GANDHI
							SATABARSHIKI VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. ,GOBINDANAGAR,
							P.O. - CHENCHUA GOBINDANAGAR</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>713304</td>
						<td>3.41E+09</td>
						<td>ACHSASANSOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>725</td>
						<td>ETBC</td>
						<td>AGHC</td>
						<td></td>
						<td>NANDARIA SHASTRI SMRITI
							VIDYAPITH (X CLASS)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT. - NANDARIA, P.O. -
							SAIYADPUR,</td>
						<td>SALBANI</td>
						<td>HATAGRAM</td>
						<td>722173</td>
						<td>9.78E+09</td>
						<td>AKSMVTC5007@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>726</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>JHIKURIA BANI VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - JHIKURIA</td>
						<td>DEBRA</td>
						<td>DHEKO</td>
						<td>721507</td>
						<td>9.78E+09</td>
						<td>DHEKORKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>727</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>KESHABCHAK DESHGOURAB HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KESHABCHAK</td>
						<td>DASPUR - II</td>
						<td>BARIKUL</td>
						<td>722162</td>
						<td>9.93E+09</td>
						<td>CHHENDAPATHAR.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>728</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td>BALITORA BASANBALA ADARSA
							VIDYAPITH (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - BALITORA, P.O. -
							SEKENDARI,</td>
						<td>DASPUR - I</td>
						<td>BIKRAMPUR</td>
						<td>722151</td>
						<td>3.24E+09</td>
						<td>BRDHSVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>729</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>BELIGERIA S. C.HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT &amp; P.O. -
							BALIGERIA,</td>
						<td>NAYAGRAM</td>
						<td>MOYNAPUR</td>
						<td>722122</td>
						<td>3.24E+09</td>
						<td>KRBI1862@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>730</td>
						<td>ETBC</td>
						<td>ETCE</td>
						<td></td>
						<td>KORIASOLE HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. ,KORIASOLE,
							P.O. - HARIATARA</td>
						<td>KHARAGPUR - I</td>
						<td>BANASURIA</td>
						<td>722133</td>
						<td>9.48E+09</td>
						<td>BANASHURIASCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>731</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>UPALDA SARBODAY MADHYAMIK
							SIKSHANIKETEN (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							UPALDA,</td>
						<td>PINGLA</td>
						<td></td>
						<td>722122</td>
						<td>3.24E+09</td>
						<td>BISHNUPURHIGHSCHOOL1879@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>732</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>PANCHBERIA LOHANIA HIGH
							MADRASAH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - PACHABERIA, P.O. -
							INDA</td>
						<td>KHARAGPUR (M)</td>
						<td>PANCHMURA</td>
						<td>722156</td>
						<td>9.65E+09</td>
						<td>PANCHMURAHIGHSCHOOLHS1924@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>733</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>RANICHAK DESHAPRAN HIGH
							SCHOOL(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - RANICHAK, P.S. -
							DASPUR</td>
						<td></td>
						<td>MAYURESWAR</td>
						<td>731218</td>
						<td>3.46E+09</td>
						<td>MHS5527@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>734</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>RADHAKANTAPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							RADHAKANTAPUR,DASPUR,</td>
						<td>DASPUR - I</td>
						<td>AHMADPUR</td>
						<td>731201</td>
						<td>9.53E+09</td>
						<td>NIMGARIA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>735</td>
						<td>ETBC</td>
						<td>BCLS</td>
						<td></td>
						<td>DHADIKA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DHADIKA</td>
						<td>GARBETA - I</td>
						<td>JALUNDI</td>
						<td>731215</td>
						<td>3.46E+09</td>
						<td>PHS5603.BIRBHUM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>736</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td></td>
						<td>DASPUR VIVEKANANDA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - DASPUR,</td>
						<td>DASPUR - I</td>
						<td>BARAMASYA RAMNAGAR</td>
						<td>723151</td>
						<td>9.43E+09</td>
						<td>RAMNAGARHIGHSCHOOL.6027@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>737</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>KHASLA INDUMATI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KHASLA, P.O. - JATRA
							BISHNUPUR</td>
						<td>SALBANI</td>
						<td>JOYPUR</td>
						<td>723201</td>
						<td>9.73E+09</td>
						<td>RBBHS.VTC6061@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>738</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>AKCHARA DESHBANDHU HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - AKCHARA</td>
						<td>GARBETA - I</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>739</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>DEULI SUDHIR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - DEULI, P.O. -
							BELDA,</td>
						<td>NARAYANGARH</td>
						<td>PALASHIPARA</td>
						<td>741155</td>
						<td>9.73E+09</td>
						<td>19100905005.HS.BOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>740</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td></td>
						<td>BANDIPUR GHANARAMPUR HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BANDIPUR</td>
						<td>CHANDRAKONA - II</td>
						<td></td>
						<td>741159</td>
						<td>9.93E+09</td>
						<td>APURBAKRRAUT21@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>741</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>JUGISOLE ARJUN SMRITI
							VIDYAPITH (HIGH)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - JHARIA</td>
						<td>NAYAGRAM</td>
						<td>NOKARI</td>
						<td>741201</td>
						<td>3.47E+09</td>
						<td>WBSCVET6297@YHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>742</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>ASANDA SIKSHA NIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>ASAND SIKSHA NIKETAN, P.O. -
							LALNAGAR,</td>
						<td>NARAYANGARH</td>
						<td></td>
						<td>741248</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>743</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>GOBINDAPUR MAKRAMPUR S.S.S.
							NIKETAN (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MAKRAMPUR BAZAR</td>
						<td>NARAYANGARH</td>
						<td>MURAGACHHA</td>
						<td>741154</td>
						<td>3.47E+09</td>
						<td>MGHS1868@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>744</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>GOKULPUR BIDHAN CHANDRA
							VIDYABHABAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - AMBA, P.O. -
							SAMRAIPUR</td>
						<td>KHARAGPUR - I</td>
						<td>DEBAGRAM</td>
						<td>741137</td>
						<td>3.47E+09</td>
						<td>DSAVEDU244@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>745</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>BHAIRABPUR RAMGATI
							VIDYANIKETAN HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BANKA</td>
						<td>CHANDRAKONA - I</td>
						<td>BELPUKUR</td>
						<td>741139</td>
						<td>9.43E+09</td>
						<td>DSPS.1956@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>746</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>PINGLASH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL - PINGLASH P.O. -
							KHALAKPUR</td>
						<td>CHANDRAKONA - II</td>
						<td>BADKULLA-I</td>
						<td>741121</td>
						<td>9.43E+09</td>
						<td>BADKULLA.UNITED.AC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>747</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>MOHAR BRAHMAMOYEE HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MOHAR</td>
						<td>SABANG</td>
						<td>KALIGANJ</td>
						<td>741150</td>
						<td>3.47E+09</td>
						<td>WWW.ABUSIRTIC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>748</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>NABIN MANUA ISWAR
							CHANDRAHIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - NABIN MANUA, P.O. -
							SITAPUR</td>
						<td>DASPUR - II</td>
						<td>JOGTAI-II</td>
						<td>742201</td>
						<td>9.73E+09</td>
						<td>AURANGABAD.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>749</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>GOLAR SUSHILA VIDYAPITH HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - GOLAR,
							VIA-NERADEUL</td>
						<td>KESHPUR</td>
						<td>RANINAGAR-I</td>
						<td>742308</td>
						<td>3.48E+09</td>
						<td>RANINAGAR6778@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>750</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>RATNESWARBATI NETAJI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							RATNESWARBATI,</td>
						<td>GHATAL</td>
						<td>HATINAGAR</td>
						<td>742102</td>
						<td>3.48E+09</td>
						<td>VOCNHS6800@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>751</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>SAGARPUR SIR ASHUTOSH HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SAGARPUR</td>
						<td>DASPUR - I</td>
						<td>MANINDRANAGAR</td>
						<td>742102</td>
						<td>3.48E+09</td>
						<td>DIPANKAR.SRKR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>752</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>JALSARA RAMAKRISHNA HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - JALSARA, P.O. -
							RADHANAGAR</td>
						<td>GHATAL</td>
						<td>PATKELDANGA</td>
						<td>742122</td>
						<td>9.43E+09</td>
						<td>GOURIPURHHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>753</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>SRIRAMPUR VIDYASAGAR SIKSHA
							MANDIR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-SRIRAMPUR,P.O. - JOTBANI</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>732207</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>754</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>BENEDIGHI JANAKALYAN HIGH
							SCHOOL (X CLASS )</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - LUTUNIA</td>
						<td>SABANG</td>
						<td></td>
						<td>733101</td>
						<td>3.52E+09</td>
						<td>DIAMOND.BKHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>755</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>BILKUA SAPTAGRAM HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - BILKUA, P.O. -
							KALOANDA,</td>
						<td>SABANG</td>
						<td></td>
						<td>733129</td>
						<td>3.52E+09</td>
						<td>KSSHSVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>756</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>BONAI BASANTI BIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BONAI,</td>
						<td>SABANG</td>
						<td>MALANGI</td>
						<td>735215</td>
						<td>3.57E+09</td>
						<td>HHSVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>757</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>JALCHAK NATESWARI NETAJI
							VIDYAYATAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - JALCHAK</td>
						<td>PINGLA</td>
						<td>BANARHAT-I</td>
						<td>735202</td>
						<td>3.56E+09</td>
						<td>VOCBHS8776@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>758</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>DHANYAKHAL SWAMI SATYANANDA
							VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - UTTAR
							DHANYAKHAL,</td>
						<td>DASPUR - I</td>
						<td>PATKATA</td>
						<td>735121</td>
						<td>3.56E+09</td>
						<td>PRINCIPALJPI@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>759</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>MARHTALA SATYESWAR
							INSTITUTION</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							MARHTALA,</td>
						<td>DEBRA</td>
						<td>SAKOAJHORA-I</td>
						<td>735212</td>
						<td>3.56E+09</td>
						<td>ANUPAMTALUKDAR60600@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>760</td>
						<td>ETBC</td>
						<td>ETIA</td>
						<td></td>
						<td>SHYAMCHAK JNANEDRA HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-GALIMPUR, P.O.-SHYAMCHAK</td>
						<td>DEBRA</td>
						<td>MOYNAGURI</td>
						<td>735224</td>
						<td>3.56E+09</td>
						<td>MSHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>761</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>NEDHUA KRISHNA BALARAM
							VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - NEDHUA, P.O. - NEDHUA
							BAZAR</td>
						<td>SABANG</td>
						<td></td>
						<td>736206</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>762</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>BARBASHI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BARABASHI</td>
						<td>KHARAGPUR - II</td>
						<td>BANESWAR</td>
						<td>736133</td>
						<td>3.58E+09</td>
						<td>BKHS9253.VTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>763</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>GURGURIPAL HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - GURGURIPAL.</td>
						<td>MIDNAPORE</td>
						<td>BHANU KUMARI-II</td>
						<td>736131</td>
						<td>9.73E+09</td>
						<td>BAKSHIRHATVTC9261@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>764</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>MALBANDI ASHUTOSH VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT - P.O. - MALBANDI</td>
						<td>GARBETA - I</td>
						<td>&nbsp;</td>
						<td>736146</td>
						<td>3.58E+09</td>
						<td>MAIL2MTBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>765</td>
						<td>ETBC</td>
						<td>ETEM</td>
						<td></td>
						<td>MAYTA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							MAYTA</td>
						<td>GARBETA - I</td>
						<td></td>
						<td>736146</td>
						<td>3.58E+09</td>
						<td>MTBVVM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>766</td>
						<td>ETBC</td>
						<td></td>
						<td></td>
						<td>KHIRAI SAHID SMRITI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KHIRAI
							(PINGLA)</td>
						<td>PINGLA</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>767</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>PINDRUI KADAMBINI
							INDRANARAYAN VIDYANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - PINDRUI</td>
						<td>PINGLA</td>
						<td></td>
						<td>700041</td>
						<td>3.32E+09</td>
						<td>SUJITKUMARBARUI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>768</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>ETCE</td>
						<td>BARISHA VIDYASAGAR VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - BARISHA, P.O. - BAGNABARH</td>
						<td>PINGLA</td>
						<td>BERACHAMPA-II</td>
						<td>743424</td>
						<td>3.22E+09</td>
						<td>AJCVTC1001@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>769</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>TATARPUR HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							TATARPUR,</td>
						<td>CHANDRAKONA - I</td>
						<td></td>
						<td>700118</td>
						<td>3.33E+09</td>
						<td>ITC.RAHARA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>770</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td>MANGLAPUR SARATCHANDRA
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MANGLAPUR</td>
						<td>GARBETA - I</td>
						<td></td>
						<td>743422</td>
						<td>3.22E+09</td>
						<td>SIRRAJENDRA1911@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>771</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>SARISHA KHOLA SAMIRUDDIN HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SARISHA
							KHOLA</td>
						<td>KESHPUR</td>
						<td>JAGANNATHPUR</td>
						<td>743401</td>
						<td>3.22E+09</td>
						<td>BADURIALMSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>772</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>DEULA BAPUJI SIKSHASADAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - DEULA,P.O. -
							SALJORA</td>
						<td>NARAYANGARH</td>
						<td>DHANYA KURIA</td>
						<td>743437</td>
						<td>3.22E+09</td>
						<td>DHANYAKURIAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>773</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td>BARAGERIA R.A.M.
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BARAGERIA,</td>
						<td>PINGLA</td>
						<td>MASLANDAPUR-II G.P</td>
						<td>743289</td>
						<td>3.22E+09</td>
						<td>RHSVOC1070@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>774</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>MEUDIPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KULIAR,</td>
						<td>KHARAGPUR - II</td>
						<td>BAGDAH</td>
						<td>743232</td>
						<td>3.22E+09</td>
						<td>MBBV1072@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>775</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>JANKAPUR HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT ,P.O. - JANKAPUR
						</td>
						<td>DANTAN - II</td>
						<td>CHAMPA PUKUR</td>
						<td>743291</td>
						<td>3.22E+09</td>
						<td>CMADHYAMIK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>776</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>HSHM</td>
						<td>DHAGARI HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT - DHANGHORI, P.O. - KISMAT
							DHANGHORI</td>
						<td>SANKRAIL</td>
						<td>SANGRAMPUR SHIBHATI</td>
						<td>743292</td>
						<td>7.6E+09</td>
						<td>VOCATIONAL.SHS1089@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>777</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KASHINATHPUR J.K. HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KASHINATHPUR</td>
						<td>DASPUR - II</td>
						<td>CHAVBERIA-II</td>
						<td>743290</td>
						<td>9.78E+09</td>
						<td>NAHATAHIGHSCHOOL1949@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>778</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>BARDAI RABINDRA ADARSHA
							VIDYAMANDIR (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - UPARJAGATPUR</td>
						<td>NARAYANGARH</td>
						<td></td>
						<td>700129</td>
						<td>3.33E+09</td>
						<td>UDAYRAJPURHARIHARPURSCHOOL@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>779</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KULYA ABINASH CHANDRA
							MEMORIAL HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KULYA, P.O. -
							JOTNARAYAN,</td>
						<td>DEBRA</td>
						<td>CHAITAL</td>
						<td>743456</td>
						<td>9.43E+09</td>
						<td>NIMICHIRAMNARAYANVIDYALAYA1954@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>780</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>RASIKGANJA VIDYASAGAR HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - NIMTALA</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>700055</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>781</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>NIMPUR BARANGI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - NIMPUR, P.O. -
							BARANGI,</td>
						<td>DANTAN - I</td>
						<td>RAMNAGAR</td>
						<td>743273</td>
						<td>3.22E+09</td>
						<td>BGAVHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>782</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>SUNDARAH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - SUNDARAR, P.O. -
							DHALBELUN,</td>
						<td>KESHIARY</td>
						<td></td>
						<td>700109</td>
						<td>3.33E+09</td>
						<td>ADARSHABOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>783</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BANDHUCHAK GAYAPRASAD SIKSHA
							NIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT. - BANDHUCHAK, P.O. -
							BANDHUCHAK,</td>
						<td>DANTAN - II</td>
						<td></td>
						<td>700056</td>
						<td>9.83E+09</td>
						<td>KPVVOCATIONAL2012@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>784</td>
						<td>ETAT</td>
						<td>ETIA</td>
						<td></td>
						<td>NAYAGRAM HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - NAYAGRAM, P.O. -
							NAYAGRAM BENASULI</td>
						<td>MIDNAPORE</td>
						<td>CHANDPUR</td>
						<td>700135</td>
						<td>9830530431</td>
						<td>CHAMPAGACHIHIGHSCHOOL2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>785</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>GOALTORE GIRLS HIGH SCHOOL
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp; P.O. - GOALTORE</td>
						<td>GARBETA - II</td>
						<td></td>
						<td>700103</td>
						<td>24772441</td>
						<td>RKMITC2009@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>786</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>KANCHANTALA SANTADAS
							NALINIKANTA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MOGRA, P.S. - KESHPUR</td>
						<td></td>
						<td>PATHARKHALI</td>
						<td>743611</td>
						<td>7.87E+09</td>
						<td>PATHANKHALIADARSHAVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>787</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>TURKA HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - TURKA KASBA</td>
						<td>DANTAN - II</td>
						<td>KALATALAHAT</td>
						<td>743504</td>
						<td>9.43E+09</td>
						<td>KHANDALIASCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>788</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>MANIKBANDH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - URIASAI</td>
						<td>GARBETA - III</td>
						<td>ANDHARMANIK</td>
						<td>743503</td>
						<td>3.32E+09</td>
						<td>JULPIAHSVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>789</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>KHANDIBANDH KOKILMONI HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KHANDIBANDH, P.O. -
							RAUTARA,</td>
						<td>SALBANI</td>
						<td>KRISHNACHANDRAPUR</td>
						<td>743354</td>
						<td>9.73E+09</td>
						<td>KRISHNACHANDRAPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>790</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MUNDAMARI USHANANDA VIDYAPITH
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT &amp; P.O. -
							MUNDAMARI,</td>
						<td>PINGLA</td>
						<td>PRATAPADITYA NAGAR</td>
						<td>743347</td>
						<td>7.5E+09</td>
						<td>AJVIDYANIKETANJ@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>791</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KALIAPARA RAMKRISHNA
							VIDYABHABAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KALIAPARA, P.O. -
							BALDA</td>
						<td>KESHIARY</td>
						<td>LAKSHMI-NARAYANPUR UTTAR</td>
						<td>743336</td>
						<td>9.43E+09</td>
						<td>JADAVUR.VOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>792</td>
						<td>ETAT</td>
						<td>BCLS</td>
						<td></td>
						<td>PIRAKATA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							PIRAKATA</td>
						<td>SALBANI</td>
						<td>JAGULGACHI</td>
						<td>743502</td>
						<td>8.97E+09</td>
						<td>GHATAKPUKURVTC1699@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>793</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>MENKAPUR KRISHNA PRASAD
							UCHCHA VIDYALAYA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT - P.O. - MENKAPUR</td>
						<td>DANTAN - I</td>
						<td></td>
						<td>711104</td>
						<td>3.33E+09</td>
						<td>EIJE_DALALPUKUR@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>794</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KHUNKHUNYA BAMACHARAN SIKSHA
							SADAN HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KHUNKHUNYA,
						</td>
						<td>SABANG</td>
						<td></td>
						<td>711316</td>
						<td>9.83E+09</td>
						<td>VTC2035@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>795</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>AYMA GOPALPUR M.S.K.</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - GOPALPUR, P.O. -
							JANARDANPUR</td>
						<td>KHARAGPUR - II</td>
						<td>JAGADISHPUR</td>
						<td>711114</td>
						<td>3.21E+09</td>
						<td>JAGADISHPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>796</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>JOTEGOURANGA M.S.K</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - JOTEGOURANGA, P.O. -
							SONAKHALI</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>711103</td>
						<td>3.33E+09</td>
						<td>SITIBEC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>797</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BAMANDA VIDYASAGAR VIDYAPITH
							(M.S.K)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - BAMANDA</td>
						<td>DANTAN - II</td>
						<td>JOARGORI</td>
						<td>711303</td>
						<td>3.33E+09</td>
						<td>JUHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>798</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>GHOSEDIHA HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							GHOSEDIHA,</td>
						<td>KESHPUR</td>
						<td>BALICHATURY</td>
						<td>711315</td>
						<td>9.73E+09</td>
						<td>AYAMAGAJONKOLHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>799</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KHASBARH HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - NALDIHI, P.O. -
							RAUTA,</td>
						<td>KESHPUR</td>
						<td>RASHPUR</td>
						<td>711401</td>
						<td>3.21E+09</td>
						<td>RASHPURHIGHSCHOOL1876@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>800</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>UTTARBIL BIDHAN CHANDRA
							SIKSHAYATAN (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. &amp;VILL. -
							UTTARBILL,<span style='mso-spacerun:yes'>��</span></td>
						<td>GARBETA - I</td>
						<td>SERAJBATI</td>
						<td>711401</td>
						<td>9.9E+09</td>
						<td>VIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>801</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>KHARAGPUR AZIZIA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT- BHAWANIPUR GATE, P.O. -
							KHARAGPUR,</td>
						<td>KHARAGPUR (M)</td>
						<td>KHARDAHA</td>
						<td>711401</td>
						<td>9.56E+09</td>
						<td>SFNHS_2123@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>802</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>BCLS</td>
						<td>KUAI HIGH SCHOOL (H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - NERADEUL,</td>
						<td>KESHPUR</td>
						<td>GANGADHARPUR</td>
						<td>711302</td>
						<td>3.21E+09</td>
						<td>WBSCVET2133@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>803</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>PASANG HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. + P.O. - PASANG,</td>
						<td>DEBRA</td>
						<td>BERABERI</td>
						<td>712407</td>
						<td>3.21E+09</td>
						<td>DM1960.SNM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>804</td>
						<td>ETAT</td>
						<td></td>
						<td></td>
						<td>BANKHATI RAMKRISHNA HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - BANKHATI, P.O. -
							DHARA,</td>
						<td>GARBETA - I</td>
						<td>PURBA RAMNAGAR</td>
						<td>712410</td>
						<td>3.21E+09</td>
						<td>RNBPCHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>805</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>GOALTORE HIGH SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT ,P.O. - GOALTORE
						</td>
						<td>GARBETA - II</td>
						<td>BHANGAMORAH</td>
						<td>712410</td>
						<td>3.21E+09</td>
						<td>BHANGAMORANKNCMINST@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>806</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KUMARCHAK MAHENDRA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - KUMARCHAK, P.O. -
							RANICHAK,</td>
						<td>DASPUR - II</td>
						<td>NABAGRAM</td>
						<td>712246</td>
						<td>26731777</td>
						<td>NABAGRAMVIDYAPITH1777@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>807</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td>DEWANCHAK DESH BANDHU SIKSHA
							NIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- DEWAN CHAK,
							P.O. - CHOWKA, SUB DIV -
							GHATAL</td>
						<td>GHATAL</td>
						<td></td>
						<td>712105</td>
						<td>3.33E+09</td>
						<td>GARBATI2546@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>808</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>BASUDEVPUR VIDYASAGAR
							BIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- BASUDEVPUR,
							P.O. - SANKARPUR,</td>
						<td>DASPUR - I</td>
						<td>HARIPUR KINKARBATI</td>
						<td>712407</td>
						<td>3.21E+09</td>
						<td>KAIVOC2548@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>809</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>KHANJAPUR UNION HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KHANJAPUR,</td>
						<td>DASPUR - II</td>
						<td>ANANDANAGAR</td>
						<td>712409</td>
						<td>3.21E+09</td>
						<td>ANANDANAGARACROY.VTC2550@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>810</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BABLA SOHAGPUR UPENDRA
							VIDYABHABAN (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - SOHAGPUR, P.O. -
							BABLA,</td>
						<td>DANTAN - II</td>
						<td>BIGHATI</td>
						<td>712124</td>
						<td>3.33E+09</td>
						<td>BKMS2577@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>811</td>
						<td>ETAT</td>
						<td>AGHC</td>
						<td></td>
						<td>DUBGOHAL VIVEKANANDA
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - DUBGOHAL, P.O. -
							JAKPUR,</td>
						<td>KHARAGPUR - II</td>
						<td>BAKULIA DHOBAPARA</td>
						<td>712123</td>
						<td>3.21E+09</td>
						<td>IRHCAV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>812</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td></td>
						<td>SAURI BHOLANATH VIDYAMANDIR
							(H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - SAURI,</td>
						<td>DANTAN - II</td>
						<td></td>
						<td>712235</td>
						<td>26741254</td>
						<td>KONNAGARHIGHSCHOOL1854@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>813</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>AHARMUNDA J.N.M. BIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KASHIPUR,</td>
						<td>NARAYANGARH</td>
						<td></td>
						<td>712250</td>
						<td>3.33E+09</td>
						<td>RBKCHS1961@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>814</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>MIDNAPUR TOWN SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - MIDNAPORE,
						</td>
						<td>MEDINIPUR (M)</td>
						<td></td>
						<td>712248</td>
						<td>8.65E+09</td>
						<td>RHSVOCATIONAL2007@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>815</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>BISHNUPUR SRI RAMKRISHNA
							VIDYAYATAN (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- BISHNUPUR,
							P.O. - MATH BISHNUPUR,</td>
						<td>DEBRA</td>
						<td>CHAMPADANGA</td>
						<td>712401</td>
						<td>8.98E+09</td>
						<td>VOCCHS96@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>816</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>UCHITPUR PALLIPRAN HIGH
							SCHOOL (H.S)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- UCHITPUR,
							P.O. - KEPUR,</td>
						<td>SABANG</td>
						<td>ITACHUNA-KHANNYAN</td>
						<td>712147</td>
						<td>3.21E+09</td>
						<td>RAKESHGHOSH30@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>817</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>PANCHGERIA NETAJI VIDYAYATAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - UTTARBARH,</td>
						<td>PINGLA</td>
						<td>DASGHARA-II</td>
						<td>712402</td>
						<td>3.21E+09</td>
						<td>DASGHARA.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>818</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td></td>
						<td>PARBATIPUR MUKUNDAPUR
							DESHAPRAN HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - PARBATIPUR, P.O. -
							BALAKROUTH,</td>
						<td>DASPUR - I</td>
						<td></td>
						<td>721401</td>
						<td>3.22E+09</td>
						<td>KMB.CONTAI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>819</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>RAMPUR MANUA K.K.I.R.R.
							INSTITUTION</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-RAMPUR,P.O-PALASPAI</td>
						<td>DASPUR - II</td>
						<td>SATILAPUR</td>
						<td>721455</td>
						<td>9.73E+09</td>
						<td>ISLAMPURHIGHSCHOOL3011@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>820</td>
						<td>ETAT</td>
						<td>AGHC</td>
						<td></td>
						<td>BHISINDIPUR YUKTESWAR
							VIDYAYATAN (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - KHELNA,</td>
						<td>SABANG</td>
						<td>HOREKHALI</td>
						<td>721658</td>
						<td>3.22E+09</td>
						<td>PARBATIPURPATITPABANIHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>821</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KHARAGPUR UTKAL VIDYAPITH
							(H.S.)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT - P.O. - KHARAGPUR</td>
						<td>KHARAGPUR (M)</td>
						<td>SRIRAMPUR</td>
						<td>721440</td>
						<td>3.22E+09</td>
						<td>TIKRAPARA3015@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>822</td>
						<td>ETAT</td>
						<td>AGFF</td>
						<td></td>
						<td>BADALPUR HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- NASRA, P.O. -
							BADALPUR,</td>
						<td>SABANG</td>
						<td>NAIPUR</td>
						<td>721439</td>
						<td>3.22E+09</td>
						<td>NSSI123@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>823</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KOTAI BASUDEVPUR SATI KUMAR
							SIKSHANIKETAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KOTAIGARH,</td>
						<td>NARAYANGARH</td>
						<td>KALAGECHIA</td>
						<td>721432</td>
						<td>9.73E+09</td>
						<td>KEUCHIANILKANTHAVIDYANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>824</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>SANGARH MADHYAMIK
							SIKSHAKENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - RAGHUNATHCHAK,
						</td>
						<td>PINGLA</td>
						<td>MATHURA</td>
						<td>721456</td>
						<td>3.22E+09</td>
						<td>CHAKRASUL.IN.SIKSHANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>825</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>BHOGDANDA MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - GURUNGANJ</td>
						<td>PINGLA</td>
						<td>BIBHISANPUR</td>
						<td>721458</td>
						<td>3.22E+09</td>
						<td>BHSVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>826</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>KADAMDIHA MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- KADAMDIHA,
							P.O. - NARDA,</td>
						<td>SANKRAIL</td>
						<td>BYABATTARHAT PASCHIM</td>
						<td>721648</td>
						<td>9.47E+09</td>
						<td>BAHS37@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>827</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>DASAGRAM MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							DASAGRAM,</td>
						<td>SABANG</td>
						<td>JUKHIA</td>
						<td>721626</td>
						<td>9.73E+09</td>
						<td>GOBINDACHAKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>828</td>
						<td>ETAT</td>
						<td>AGFF</td>
						<td></td>
						<td>KALABATI PERUABAD HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - AMJORE,</td>
						<td>GARBETA - II</td>
						<td>LAKSHI</td>
						<td>721430</td>
						<td>9.73E+09</td>
						<td>HABIBUR.RAHAMAN1973@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>829</td>
						<td>ETAT</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>TUKURIA RAMKRISHNA HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. - TUKURIA, P.O. -
							KUAPUR</td>
						<td>CHANDRAKONA - II</td>
						<td>KAKHARDA</td>
						<td>721668</td>
						<td>7.6E+09</td>
						<td>KAKHARDAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>830</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>DHARENDA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. P.O. - DHARENDA,</td>
						<td>KHARAGPUR - I</td>
						<td>NAYAPUT</td>
						<td>721401</td>
						<td>3.22E+09</td>
						<td>NAYAPUT.SKHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>831</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>PANCHGECHIA JOYRAMCHAK
							GOSTHABIHARI VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - PANCHGECHIA,</td>
						<td>DASPUR - II</td>
						<td>MARISHDA</td>
						<td>721427</td>
						<td>9.47E+09</td>
						<td>BBBHSCHOOLVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>832</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td>KHEPAL N.C.K.B. HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL.- KHEPAL, P.O.
							- KAPASDA,</td>
						<td>SABANG</td>
						<td>JOYNAGAR</td>
						<td>721635</td>
						<td>3.22E+09</td>
						<td>JOYNAGARHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>833</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>ADASIMLA DESHAPRAN VIDYAPITH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							ADASIMLA,</td>
						<td>SABANG</td>
						<td></td>
						<td>721102</td>
						<td>3.22E+09</td>
						<td>ITI.RANG@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>834</td>
						<td>ETAT</td>
						<td>ETEM</td>
						<td></td>
						<td>DHOBABERIA HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O. - CHANDABILA, VIA -
							GARBETA,</td>
						<td>GARBETA - I</td>
						<td>NIJ-NARAJOLE</td>
						<td>721211</td>
						<td>3.23E+09</td>
						<td>NARAJOLE.MAHENDRA.ACADEMY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>835</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>DINGAL NABADWIPCHANDRA
							VIDYANIKETAN (HIGH SCHOOL)</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL + P.O. - DINGAL,</td>
						<td>DEBRA</td>
						<td></td>
						<td>721304</td>
						<td>3.22E+09</td>
						<td>KAPHSVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>836</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>ABDULLA MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL - ABDULLA, P.O.-PINDRUI,</td>
						<td>PINGLA</td>
						<td>DUAN-II</td>
						<td>721124</td>
						<td>3.22E+09</td>
						<td>BALICHAK_BHAJAHARI@REDIFF.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>837</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>AMLAGORA M.S.K.</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL - AMLAGORA, GARBETA -
							I,</td>
						<td>GARBETA - I</td>
						<td>GARHBETA</td>
						<td>721127</td>
						<td>3.23E+09</td>
						<td>GHSVOC3544@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>838</td>
						<td>ETAT</td>
						<td>AGAH</td>
						<td></td>
						<td>NAYA MADHYAMIK SIKSHA KENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL + P.O. - NAYA,</td>
						<td>PINGLA</td>
						<td>ALIKOSHA</td>
						<td>721133</td>
						<td>9.68E+09</td>
						<td>HM.AHS2012@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>839</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>CHHATARKOLE VIDYASAGAR
							MADHYAMIK SIKSHAKENDRA</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL+P.O.-CHHALARKOLE</td>
						<td>SABANG</td>
						<td>AGUIBONI</td>
						<td>721517</td>
						<td>9.93E+09</td>
						<td>EKTALDM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>840</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>GARHBETA UMA DEVI GIRLS HIGH
							SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL+P.O.- GARHBETA</td>
						<td>GARBETA - I</td>
						<td>JOT GHANASHYAM</td>
						<td>721153</td>
						<td>9.73E+09</td>
						<td>JNHS3569@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>841</td>
						<td>ETAT</td>
						<td>ETBC</td>
						<td>BCLS</td>
						<td>SURATPUR SRI AUROBINDA
							SATABARSIKI VIDYAMANDIR</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>P.O.- HARIRAMPUR,</td>
						<td>DASPUR - I</td>
						<td>KHARKUSMA</td>
						<td>721127</td>
						<td>9.8E+09</td>
						<td>MONGLAPOTA_SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>842</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td>MUNDALIKA VIDYAPITH ( HIGH
							SCHOOL )</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL- MUNDALIKA,
							P.O.-AMRITPUR,</td>
						<td>KESHPUR</td>
						<td></td>
						<td>721146</td>
						<td>9.8E+09</td>
						<td>NHS1945@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>843</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>KASANDA ANCHALIK HIGH
							MADRASAH</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL-KASANDA, P.O.- JARA,</td>
						<td>CHANDRAKONA - I</td>
						<td>GOCHATI</td>
						<td>721146</td>
						<td>3.23E+09</td>
						<td>SONAKHALIHS1885@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>844</td>
						<td>ETAT</td>
						<td>ETCM</td>
						<td></td>
						<td>BARAKALANKAI HIGH SCHOOL</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>AT+P.O.-BARAKALANKAI,</td>
						<td>NARAYANGARH</td>
						<td>JAMNA-II</td>
						<td>721140</td>
						<td>3.22E+09</td>
						<td>UJANHARIPADAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>845</td>
						<td>ETAT</td>
						<td>ETIA</td>
						<td></td>
						<td>KESHRAMBHA VIDYASAGAR
							VIDYABHABAN</td>
						<td>PASCHIM MIDNAPORE</td>
						<td>VILL+P.O.- KESHRAMBHA,</td>
						<td>DANTAN - II</td>
						<td>RASKUNDU</td>
						<td>721127</td>
						<td>3.23E+09</td>
						<td>CKRCYCTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>846</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>VIDYASAGAR PRIMARY TEACHERS
							TRAINING INSTITUTE</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DHAMIT, P.O. -
							AMDAN,</td>
						<td>PANSKURA</td>
						<td>GOBINDANAGAR</td>
						<td>721139</td>
						<td>3.23E+09</td>
						<td>RATULIAHSSCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>847</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td>AGFF</td>
						<td>TAMLUK HAMILTON HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>PARBATIPUR, P.O. - TAMLUK</td>
						<td>TAMLUK (M)</td>
						<td>KUMRCHAK</td>
						<td>721652</td>
						<td>3.23E+09</td>
						<td>CHAKSIMULIA_KVIDYAPITH@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>848</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td></td>
						<td>VIDYASAGAR ITC</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DURGACHAK, HALDIA</td>
						<td>HALDIA (M)</td>
						<td>DERIACHAK</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>DSAV1948@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>849</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>CONTAI K.M. VIDYA BHAVAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. &amp; P.S. - CONTAI</td>
						<td>CONTAI (M)</td>
						<td>GHOSHPUR</td>
						<td>721152</td>
						<td>9.73E+09</td>
						<td>USB3059@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>850</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HARIA SIVA PRASAD INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HARIA,</td>
						<td>KHEJURI - I</td>
						<td>RAGHUNATHBARI</td>
						<td>721134</td>
						<td>3.23E+09</td>
						<td>RRTHS1915@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>851</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>BHIMESWARI UCHCHA SIKSHAYATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BHIMESWARI BAZAR.</td>
						<td>BHAGAWANPUR - I</td>
						<td>SRIRAMPUR-I</td>
						<td>721651</td>
						<td>3.23E+09</td>
						<td>SAHS.PURBAMEDINIPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>852</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PANSKURA BRADLEY BIRT HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>PANSKURA,</td>
						<td>PANSKURA</td>
						<td></td>
						<td>721422</td>
						<td>3.22E+09</td>
						<td>ASTICHAKHM3063@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>853</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td>KALAI GOBARDHAN HIGH SCHOOL
							(H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - CHAKRADHABAN,
						</td>
						<td>PANSKURA</td>
						<td>ITABERIA</td>
						<td>721454</td>
						<td>9.73E+09</td>
						<td>BRKHS.CHAND@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>854</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEMARI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DEMARIHAT</td>
						<td>SAHID MATANGINI</td>
						<td>BALISAI</td>
						<td>721423</td>
						<td>3.22E+09</td>
						<td>DEBU_DEBA_DABU@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>855</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGHC</td>
						<td>ISLAMPUR HIGH SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- ISLAMPUR P.O. -
							CHAULKHOLA</td>
						<td>RAMNAGAR - II</td>
						<td>BASUDEVBERIA</td>
						<td>721626</td>
						<td>3.22E+09</td>
						<td>BARBARIAHAZRAVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>856</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DIGHA VIDYABHAWAN (H.S.
							GENERAL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. -
							ALANKARPUR,BLOCK-RAMNAGAR-I,</td>
						<td>RAMNAGAR - I</td>
						<td>DEPAL</td>
						<td>721453</td>
						<td>3.32E+10</td>
						<td>DEPALDBCV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>857</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>PARBATIPUR PATIT PABANI HIGH
							SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GOLAPCHAK</td>
						<td>SUTAHATA</td>
						<td>CHAITANYAPUR-I</td>
						<td>721152</td>
						<td>7.8E+09</td>
						<td>MAGURIJAGANNATHCHAKHIGHSCHOOL9@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>858</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>BALYAGOBINDAPUR JNAN-KARMA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BALYAGOBINDRAPUR</td>
						<td>POTASHPUR - II</td>
						<td></td>
						<td>721401</td>
						<td>3.22E+09</td>
						<td>KISHORENAGARSSSADAN@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>859</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td></td>
						<td>TIKRAPARA A. M. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - TIKRAPARA, P.O. -
							PRATAPDIGHI</td>
						<td>POTASHPUR - II</td>
						<td>GOPALNAGAR</td>
						<td>721134</td>
						<td>9.13E+09</td>
						<td>BATHANBERIA.SNV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>860</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>PANIPARUL MUKTESWAR HIGH
							SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PANIPARUL</td>
						<td>EGRA - II</td>
						<td>BASANTIA</td>
						<td>721442</td>
						<td>03220 253250</td>
						<td>BGMHS3078@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>861</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>CHALTI NAGENDRA VIDYAPITH
							(HIGH)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - CHATTI, P.O. -
							BASANTIA.</td>
						<td>DESHOPRAN</td>
						<td>GOBINDANAGAR</td>
						<td>721139</td>
						<td>9.43E+09</td>
						<td>SANMA.BAKULDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>862</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>GIMAGERIA WELFARE HIGH
							MADRASAH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - GIMAGERIA, P.O. -
							SRIRAMPURN - CONTAI.</td>
						<td>CONTAI - I</td>
						<td>PULSITA</td>
						<td>721154</td>
						<td>3.23E+09</td>
						<td>KSHETRAHATSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>863</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ISWARPUR B.M. ACADEMY (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - ISWARPUR</td>
						<td>CHANDIPUR</td>
						<td>AMRITBERIA</td>
						<td>721648</td>
						<td>03228-219340</td>
						<td>BAHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>864</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NACHINDA JIBANKRISHNA HIGH
							SCHOOL(H. S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NACHINDA BAZAR</td>
						<td>CONTAI - III</td>
						<td>BAMUNIA</td>
						<td>721450</td>
						<td>3.22E+09</td>
						<td>HMBARABANTALIA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>865</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>RASAN NEHRU VIDYAPITH (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RASAN</td>
						<td>EGRA - I</td>
						<td>BASUDEVPUR</td>
						<td>721632</td>
						<td>3.23E+09</td>
						<td>BMNHS.NDK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>866</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MAHISHADAL RAJ HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAHISHADAL</td>
						<td>MAHISADAL</td>
						<td>BHAGABANPUR</td>
						<td>721601</td>
						<td>9.47E+09</td>
						<td>ANUSTUP_BERA@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>867</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>RAMCHANDRAPUR RAISUDDIN HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RACHANDRAPUR (MOYNA)</td>
						<td>MOYNA</td>
						<td>CHOWKHALI</td>
						<td>721633</td>
						<td>3.23E+09</td>
						<td>BOROJHIGHSCHOOLHS@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>868</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SALGECHIA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - SALGECHIA, P.O. -
							TAMLUK</td>
						<td>TAMLUK (M)</td>
						<td>ANANTAPUR-II</td>
						<td>721653</td>
						<td>3.23E+09</td>
						<td>CHANSERPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>869</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>VIDYASAGAR TECHNICAL COLLEGE</td>
						<td>PURBA MIDNAPORE</td>
						<td>PNB BULDING (2ND &amp; 3RD
							FLOOR), P.O. - MECHEDA</td>
						<td>SAHID MATANGINI</td>
						<td>RAGHUNATHPUR-II</td>
						<td>721627</td>
						<td>9.73E+09</td>
						<td>GHS1969@YMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>870</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>HALDIA GOVT. SP. X-CLASS
							SECONDARY SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KHANJANCHAK</td>
						<td>HALDIA (M)</td>
						<td></td>
						<td>721646</td>
						<td>9.73E+09</td>
						<td>GGJSIKSHANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>871</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>EGRA J. L. HIGH SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - EGRA</td>
						<td>EGRA (M)</td>
						<td>KESHAPAT</td>
						<td>721641</td>
						<td>3.23E+09</td>
						<td>JASRACHARUBALAHIGHSCHOOL.2012@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>872</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CONTAI RAHMANIA HIGH MADRASAH
							(H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DARUA</td>
						<td>CONTAI (M)</td>
						<td>KALINDI</td>
						<td>721455</td>
						<td>3.22E+09</td>
						<td>KUHS2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>873</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KANAIDIGHI DESHAPRAN
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KANAIDIGHI</td>
						<td>CONTAI - III</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>874</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>PARAMANANDAPUR JAGANNATH
							INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O. - PARAMANANDAPUR</td>
						<td>MOYNA</td>
						<td>KAKHARDA</td>
						<td>721137</td>
						<td>3.23E+09</td>
						<td>KRISHNAGANJKSVIDYALAYA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>875</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>NAIPUR SANTI SUDHA
							INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NAIPUR</td>
						<td>POTASHPUR - I</td>
						<td>HERIA</td>
						<td>721430</td>
						<td>3.22E+09</td>
						<td>KRISHNANAGAR.MN.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>876</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>MOYNA PURNANADA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MOYNA</td>
						<td>MOYNA</td>
						<td>KADUA</td>
						<td>721453</td>
						<td>9.73E+09</td>
						<td>MANIKABASANHIGHSCHOOL3103@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>877</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SIMULBERIA JOGENDRA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RAGHURAMPUR</td>
						<td>SUTAHATA</td>
						<td>R.B.C.</td>
						<td>721448</td>
						<td>3.22E+09</td>
						<td>WBNSNHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>878</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SIDDHA SASHI SRIPATI VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SIDDHA</td>
						<td>KOLAGHAT</td>
						<td>SABAJPUR</td>
						<td>721401</td>
						<td>3.22E+09</td>
						<td>SSS_SABAJPUT.CODE3106@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>879</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td>HSCH</td>
						<td>TAMLUK HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>TA - PARBATIPUR P.O. - TAMLUK</td>
						<td>TAMLUK (M)</td>
						<td>HERIA</td>
						<td>721430</td>
						<td>3.22E+09</td>
						<td>SUBHASPALLIKBVIDYABHABAN1964@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>880</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>HANSCHARAM.D. HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HANSCHARA</td>
						<td>CHANDIPUR</td>
						<td>HAUR G.P</td>
						<td>721131</td>
						<td>9.43E+09</td>
						<td>GHOSHPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>881</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>CHANDANPUR BIRENDRA SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - UTTAR BADALPUR</td>
						<td>CONTAI - I</td>
						<td>DARIAPUR</td>
						<td>721442</td>
						<td>9.56E+09</td>
						<td>CHSCHAMPATALA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>882</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>DAKSHINCHAK HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KHEJURDA</td>
						<td>EGRA - II</td>
						<td>KHODAMBARI-II</td>
						<td>721650</td>
						<td>3.22E+09</td>
						<td>KSSTTIVET@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>883</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GHORAGHATA ADARSHA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GHORAGHATA</td>
						<td>DESHOPRAN</td>
						<td>MAJILAPUR</td>
						<td>721450</td>
						<td>9.73E+09</td>
						<td>DUHS1973@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>884</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOPALGANJ PRIYANATH
							BANIBHABAN (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MECHADA</td>
						<td>KOLAGHAT</td>
						<td>KHARUI-I</td>
						<td>721134</td>
						<td>9.48E+09</td>
						<td>NITISHCHAKRABORTTY@YMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>885</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td>HSCH</td>
						<td>BAGDOBA JALPAI HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - BAGDOBA JALPAI ,P.O. -
							NARGHAT L.S.</td>
						<td>NANDA KUMAR</td>
						<td>BARATALA</td>
						<td>721431</td>
						<td>3.22E+09</td>
						<td>KHEJURICOLLEGE1999@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>886</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BATTALA ANANDAMOYEE HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BATTALA</td>
						<td>RAMNAGAR - II</td>
						<td>TIKASHI</td>
						<td>721430</td>
						<td>9.73E+09</td>
						<td>WBSCVET3121@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>887</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHOWANICHAK AGHORECHAND HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BHOWANICHAK, VIA,-
							DEULBARH,</td>
						<td>DESHOPRAN</td>
						<td>HALDIA-I</td>
						<td>721446</td>
						<td>3.22E+09</td>
						<td>MAIL.SADIHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>888</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DORO KRISHNANAGAR BANI MANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. &amp; VILL. - DORO
							KRISHNAGAR</td>
						<td>SUTAHATA</td>
						<td>GARKAMALPUR</td>
						<td>721628</td>
						<td>3.22E+09</td>
						<td>VTC.3135@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>889</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>HAKOLA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- HAKOLA, P.O. - MECHADA</td>
						<td>SAHID MATANGINI</td>
						<td>BARATALA</td>
						<td>721431</td>
						<td>9.73E+09</td>
						<td>BARATALAGSV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>890</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>MAISALI TRAILOKYA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DHANGAON, CONTAI</td>
						<td>CONTAI - I</td>
						<td>KUKRAHATI</td>
						<td>721658</td>
						<td>3.22E+09</td>
						<td>FARUKIA3145@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>891</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MURISAHI VIDYASAGAR HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MURISAHI</td>
						<td></td>
						<td>NATSHAL-II</td>
						<td>721603</td>
						<td>3.22E+09</td>
						<td>NATSHALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>892</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>SAFIABAD SITAL PRASAD
							VIDYAMANDIR (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SAFIABAD</td>
						<td>DESHOPRAN</td>
						<td>GARBARI-II</td>
						<td>721430</td>
						<td>9.73E+09</td>
						<td>VOCATIONAL3147@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>893</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>ETEM</td>
						<td>KALYANCHAK GOURMOHAN
							INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KALYANCHAK</td>
						<td>NANDA KUMAR</td>
						<td>KHARUI-I</td>
						<td>721134</td>
						<td>8.16E+09</td>
						<td>JAHSVOCL3148@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>894</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>NAIKURI THAKURDAS INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - NAIKURI</td>
						<td>TAMLUK</td>
						<td>MOYNA-II</td>
						<td>721629</td>
						<td>9.65E+09</td>
						<td>MANAS_BERA74@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>895</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MANGALAMARO MANGALA ACADEMY</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							MANGALAMARO,</td>
						<td>POTASHPUR - I</td>
						<td>SIDDHA-II</td>
						<td>721139</td>
						<td>9.65E+09</td>
						<td>GOPALNAGARBLBIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>896</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEOLY ADARSHA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PASCHIM NAICHANPUR</td>
						<td>MOYNA</td>
						<td>BASUDEVPUR</td>
						<td>721452</td>
						<td>8.17E+09</td>
						<td>BHAWANICHAKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>897</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALAGACHIA JAGADISH VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KALAGACHIA</td>
						<td>KHEJURI - I</td>
						<td>DHALHARA</td>
						<td>721636</td>
						<td>9.8E+09</td>
						<td>BGANESHS2015@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>898</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RATULIA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RATULIA</td>
						<td>PANSKURA</td>
						<td>BRINDABANCHAK</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>PARAMANANDAPURRAMANATHVIDYAPITH1923@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>899</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>CHAKSIMULIA KAMAKHYA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KUMARCHAK</td>
						<td>NANDA KUMAR</td>
						<td>SANTIPUR-II</td>
						<td>721137</td>
						<td>9.15E+09</td>
						<td>RBVHIGHSCHOOL1962@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>900</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DERIACHAK SRI AUROBINDO
							VIDYAMATH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DERIACHAK,</td>
						<td>KOLAGHAT</td>
						<td>GOPALPUR</td>
						<td>721454</td>
						<td>9.73E+09</td>
						<td>HM.GURV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>901</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>USATPUR SAUDAMINI BIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MEGHADAMNGAR</td>
						<td>PANSKURA</td>
						<td>PANIPARUL</td>
						<td>721448</td>
						<td>3.22E+09</td>
						<td>FORCEDUM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>902</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KEUCHIA NILKANTHA
							VIDYANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KEUCHIA</td>
						<td>KHEJURI - I</td>
						<td>KHEJURI</td>
						<td>721431</td>
						<td>9.73E+09</td>
						<td>KASARIA.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>903</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAGHUNATHBARI RAMTARAK HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RAGHUNATHBARI</td>
						<td>PANSKURA</td>
						<td>BATHUARY</td>
						<td>721422</td>
						<td>9.43E+09</td>
						<td>PAHARPURHEADMASTER@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>904</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SRIRAMPUR AGRICULTURAL HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SRIRAMPUR MIDNAPUR</td>
						<td>TAMLUK</td>
						<td>AURAI</td>
						<td>721427</td>
						<td>3.22E+09</td>
						<td>NAMALDIHAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>905</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGFF</td>
						<td>ASTICHAK S.J. VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - ASTICHAK</td>
						<td>EGRA - II</td>
						<td>BIBHISANPUR</td>
						<td>721144</td>
						<td>9.73E+09</td>
						<td>SIULIPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>906</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAJARPURRAMKRISHNA
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-UTTARKHAMAR P.O. -
							ALUKARANBARH,</td>
						<td>BHAGAWANPUR - II</td>
						<td>PANCHROL</td>
						<td>721447</td>
						<td>3.22E+09</td>
						<td>VOCATIONALPHS3166@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>907</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>WEST KRANJI VIDYASAGAR HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KARANJI</td>
						<td>RAMNAGAR - II</td>
						<td>GARBARI-I</td>
						<td>721655</td>
						<td>3.22E+09</td>
						<td>BALAICHANDRAVIDYAPITHHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>908</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BARBARIA HAZRA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BARBARIA</td>
						<td>BHAGAWANPUR - II</td>
						<td>BISHNUBAR-II</td>
						<td>721627</td>
						<td>9.74E+09</td>
						<td>MGSSN14@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>909</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BANAMALICHATTA HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BANAMALICHATTA</td>
						<td>CONTAI - III</td>
						<td>BISHNUBAR-II</td>
						<td>721627</td>
						<td>3.23E+09</td>
						<td>KELOMALSHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>910</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>HSCH</td>
						<td>CHAKRASUL I.N. SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - LALUA</td>
						<td>POTASHPUR - II</td>
						<td>MUGBERIA</td>
						<td>721425</td>
						<td>3.22E+09</td>
						<td>MGHS.3173@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>911</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DEPAL BANESWAR CHARUBALA
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DEPAL SASANBARH P.O.
							- DEPAL</td>
						<td>RAMNAGAR - II</td>
						<td>PANCHET</td>
						<td>721438</td>
						<td>3.22E+09</td>
						<td>PANCHETGARHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>912</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>MAJILAPUR BIRENDRA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DAKSHIN DAUKI</td>
						<td>CONTAI - I</td>
						<td>KUMRCHAK</td>
						<td>721649</td>
						<td>3.23E+09</td>
						<td>VOCATIONAL.BHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>913</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAGURI JAGANNATHCHAK HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAGURI JAGANNATHCHAK</td>
						<td>PANSKURA</td>
						<td>MANJUSHREE</td>
						<td>721422</td>
						<td>3.22E+09</td>
						<td>BALIGHAIFDHS.VOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>914</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KISHORENAGAR SACHINDRA SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KISHORENAGAR, P.O. -
							CONTAI</td>
						<td>CONTAI (M)</td>
						<td>ITAMOGRA-I</td>
						<td>721632</td>
						<td>9.15E+09</td>
						<td>DAKSHINKASIMNAGARHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>915</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BATHANBERIA SRINIBASH
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-BATHANBERIA, P.O.-
							KOLAGHAT</td>
						<td>KOLAGHAT</td>
						<td>DEULPOTA</td>
						<td>721654</td>
						<td>9.8E+09</td>
						<td>KARABI.BCA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>916</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DIGHA D. J. SIKSHASADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SARIPUR</td>
						<td>RAMNAGAR - I</td>
						<td>KHANYADIHI</td>
						<td>721641</td>
						<td>3.23E+09</td>
						<td>KPKHSSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>917</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>CONTAI TOWN R.C. VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - CONTAI</td>
						<td>CONTAI (M)</td>
						<td>PANSKURA-I</td>
						<td>721647</td>
						<td>3.23E+09</td>
						<td>PCLCHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>918</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DAKSHIN CHANGRACHAK SUKANTA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DAKSHIN CHANGRCHAK</td>
						<td>MOYNA</td>
						<td>PURUSOTTTAMPUR</td>
						<td>721152</td>
						<td>9.73E+09</td>
						<td>SUMITDAS1968@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>919</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAIJAPUR GOUR MOHAN HIGH
							SCHOOL (HS)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SAFIABAD</td>
						<td>DESHOPRAN</td>
						<td>BASUDEVPUR</td>
						<td>721643</td>
						<td>9.73E+09</td>
						<td>KHANCHI.GA.VIDYAPITH.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>920</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KHAMARCHAKHIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KHAMARCHAK P.O. -
							NILKUNTHIA,</td>
						<td>TAMLUK</td>
						<td>ARGOAL</td>
						<td>721456</td>
						<td>9.73E+09</td>
						<td>JABDAVV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>921</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAKULDA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BAKULDA</td>
						<td>PANSKURA</td>
						<td>AMDABAD-I</td>
						<td>721430</td>
						<td>8.54E+09</td>
						<td>SSV3211@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>922</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>PATNA<span style='mso-spacerun:yes'>�� </span>ADARSHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. PATNA, P.O. PAS. PATNA</td>
						<td>CHANDIPUR</td>
						<td>SRIRAMPUR-II</td>
						<td>721651</td>
						<td>9.73E+09</td>
						<td>KRVIDYABHABAN.TAMLUK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>923</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>HANSCHARA S.B.M GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HANSCHARA</td>
						<td>CHANDIPUR</td>
						<td>BASUDEVBERIA</td>
						<td>721456</td>
						<td>9.47E+09</td>
						<td>MANIKJOREKKHS1926@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>924</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KANTHI JATIYA VIDYALAYA FOR
							GIRLS</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - CONTAI</td>
						<td>CONTAI (M)</td>
						<td>HARIPUR</td>
						<td>721452</td>
						<td>3.22E+09</td>
						<td>SATMILEHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>925</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KSHETRAHAT HARADHAN
							INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PAYAG</td>
						<td>KOLAGHAT</td>
						<td>NANDIGRAM</td>
						<td>721631</td>
						<td>9.73E+09</td>
						<td>NBMTSIKSHANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>926</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAR AMRITBERIA HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MIRPUR</td>
						<td>MAHISADAL</td>
						<td>KALYANPUR</td>
						<td>721632</td>
						<td>9.43E+09</td>
						<td>SCHOOLKARAK000@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>927</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td>BARABANTALIA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BARABANTALIA</td>
						<td>DESHOPRAN</td>
						<td></td>
						<td>721152</td>
						<td>9.47E+09</td>
						<td>PRATAPPORE.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>928</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BASUDEVPUR M.N. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NANDAKUMAR</td>
						<td>NANDA KUMAR</td>
						<td>DERIACHAK</td>
						<td>721137</td>
						<td>3.23E+09</td>
						<td>JAFULYDESHPRAN1948@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>929</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BHAGWANPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BHAGWANPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>BHOGPUR</td>
						<td>721151</td>
						<td>3.23E+09</td>
						<td>K_GHORAI@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>930</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>BORAJ HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILLL. &amp; P.O. - BORAJ</td>
						<td>CHANDIPUR</td>
						<td>BASANTIA</td>
						<td>721442</td>
						<td>3.22E+09</td>
						<td>BASANTIAHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>931</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>CHANSERPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - CHANSERPUR</td>
						<td>TAMLUK</td>
						<td>RADHAPUR</td>
						<td>721626</td>
						<td>9.43E+09</td>
						<td>HARIPURHIGHSCHOOL2014@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>932</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHATRA KUNJARANI BANI BHAVAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.-CHATRA, P.O. -
							RAMTARAKHAT</td>
						<td>SAHID MATANGINI</td>
						<td>TALGACHHARI-I</td>
						<td>721441</td>
						<td>3.22E+09</td>
						<td>RBV.RAMNAGAR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>933</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEURIBARH KIRANPRAVA
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SUKRULLAPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>GOBRA</td>
						<td>721441</td>
						<td>3.22E+09</td>
						<td>SABBIRKOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>934</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOBINDAPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GOBINDAPUR</td>
						<td>SAHID MATANGINI</td>
						<td></td>
						<td>721152</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>935</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td></td>
						<td>GOKULNAGAR G.J. SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - TEKHALIBAZAR</td>
						<td>NANDIGRAM - I</td>
						<td>MAHAMMADPUR</td>
						<td>721631</td>
						<td>3.22E+09</td>
						<td>MSNS.HEADMASTER@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>936</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>JASRA CHARUBALA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - JASORA</td>
						<td>PANSKURA</td>
						<td>GARBARI-I</td>
						<td>721655</td>
						<td>9.43E+09</td>
						<td>PORACHINGRAVOC3336@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>937</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KALINDI UNION HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KALINDI</td>
						<td>RAMNAGAR - II</td>
						<td>CHOWKHALI</td>
						<td>721633</td>
						<td>9.78E+09</td>
						<td>VOC.CHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>938</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KISMAT NAIKUNDI GRAM
							PANCHAYET HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GOPALPUR</td>
						<td>MAHISHADAL</td>
						<td>PADUMPUR-I</td>
						<td>721649</td>
						<td>9.73E+09</td>
						<td>KURPAIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>939</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td>ETEM</td>
						<td>KRISHNAGANJ KRISHI SILPA
							VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HOGLA</td>
						<td>SAHID MATANGINI</td>
						<td>BAKCHA</td>
						<td>721642</td>
						<td>9.33E+09</td>
						<td>MAJSV1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>940</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>KRISHNANAGAR M.N. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							KRISHNANAGAR (CONTAI)</td>
						<td>KHEJURI - I</td>
						<td>PATASHPUR</td>
						<td>721439</td>
						<td>9.73E+09</td>
						<td>PATASHPURHCVVOC3353@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>941</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KUMARPUR HATESWAR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DUMDAN</td>
						<td>PANSKURA</td>
						<td>PRATAPPUR-I</td>
						<td>721634</td>
						<td>3.23E+09</td>
						<td>DHULIAPURP.S.BANIMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>942</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td>AGCF</td>
						<td>LAKSHYA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - LAKSHYA</td>
						<td>MAHISADAL</td>
						<td>BOYAL-I</td>
						<td>721656</td>
						<td>9.47E+09</td>
						<td>NARAYANCHAKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>943</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAHISAGOTE SAHID SMRITI
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAHISAGOTE</td>
						<td>CONTAI - I</td>
						<td>PULSITA</td>
						<td>721154</td>
						<td>9.85E+09</td>
						<td>DHHSVOC_3398@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>944</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MANIKABASAN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + P.O. -
							MANIKABASAN,</td>
						<td>RAMNAGAR - II</td>
						<td>JUMKI.</td>
						<td>721448</td>
						<td>9.93E+09</td>
						<td>CHIRULIA.BIBARTAN.BIDYABHAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>945</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NEGUA SUNDARNARAYAN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.+P.O. - NEGUA</td>
						<td>EGRA - I</td>
						<td>BARUTTARHINGLY</td>
						<td>721654</td>
						<td>9.43E+09</td>
						<td>BHS.HALDIA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>946</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAJKUMARI. S. GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>SANKARARA,P.O. -
							TAMLUK</td>
						<td>TAMLUK (M)</td>
						<td>RAGHUNATHPUR-II</td>
						<td>721627</td>
						<td>9.47E+09</td>
						<td>SONAPETYAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>947</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td>ETEM</td>
						<td>SABAJPUT SAMBODHI
							SIKSHATIRTHA</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SABAJPUT</td>
						<td>CONTAI - I</td>
						<td>MAHAMMADPUR-II</td>
						<td>721601</td>
						<td>9.73E+09</td>
						<td>RITARANIMAJI85@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>948</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>SUBHASPALLI KUNJA BEHARI
							VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - JARARNAGAR, P.O. -
							HARIA,</td>
						<td>KHEJURI - I</td>
						<td>VIVEKANANDA</td>
						<td>721422</td>
						<td>3.22E+09</td>
						<td>HM.NSAA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>949</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>BIBHISHANPUR HIGH SCHOOL
							(H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BIBHISHANPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>SOUTHKANDA</td>
						<td>721456</td>
						<td>9.84E+09</td>
						<td>VOCATIONALBRAJAKISHOREPUR3456@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>950</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GHOSHPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - HAUR</td>
						<td>PANSKURA</td>
						<td>PIASALA</td>
						<td>721157</td>
						<td>3.23E+09</td>
						<td>HOOMGARHHIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>951</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BYABATTARHATADARSHA
							HIGH SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BYABATTARHAT</td>
						<td>NANDA KUMAR</td>
						<td></td>
						<td>721302</td>
						<td>3.22E+09</td>
						<td>SECRETARY_HITC@YMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>952</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>FULESWAR DURMUTH HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - FULESWAR</td>
						<td>DESHOPRAN</td>
						<td>RADHANAGAR</td>
						<td>721514</td>
						<td>9.64E+09</td>
						<td>SANTANUDHR3@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>953</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td>AGFF</td>
						<td>CHAMPATALA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,BARA
							SUBARNANAGAR P.O. - CHAMPATALA</td>
						<td>DESHOPRAN</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>954</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>KABI SUKANTA SECONDARY T. T.
							INSTITUTE</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							REAPARA</td>
						<td>NANDIGRAM - II</td>
						<td>ANIKOLA</td>
						<td>721426</td>
						<td>9E+09</td>
						<td>SORRONGVTC3514@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>955</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td>ETEM</td>
						<td>DURMUTH CHANDBERIA ADARSHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - CHANDBERIA, P.O. -
							CONTAI,</td>
						<td>CONTAI - III</td>
						<td>BELIABERA</td>
						<td>721517</td>
						<td>9.93E+09</td>
						<td>BKCMHS.VOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>956</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>CHAKNAN PALLISHREE
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							CHAKNAN</td>
						<td>CHANDIPUR</td>
						<td>PET BINDHI</td>
						<td>721517</td>
						<td>9.73E+09</td>
						<td>VTCWM.3517@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>957</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>ETBC</td>
						<td>DESHDATTABARH UNITED HIGH
							SCHOOL (H.S )</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							DESHDATTABARH</td>
						<td>CONTAI - I</td>
						<td>GOBARDHANPUR-VII</td>
						<td>721131</td>
						<td>3.23E+09</td>
						<td>SKV65.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>958</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>KHARUI UNION HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. + P.O. - KHARUI</td>
						<td>SAHID MATANGINI</td>
						<td>BELPAHARI</td>
						<td>721501</td>
						<td>9E+09</td>
						<td>BELPAHARIVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>959</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>GOBINDA CHAK SRI DURGA HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SUKRULLAPUR</td>
						<td>BHAGAWANPUR - II</td>
						<td></td>
						<td>721507</td>
						<td>3.22E+09</td>
						<td>KKI1924@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>960</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MANDAR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MANDAR</td>
						<td></td>
						<td>DAHIJURI</td>
						<td>721504</td>
						<td>3.22E+09</td>
						<td>DMV_3522@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>961</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td></td>
						<td>KHEJURI COLLEGE</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. + P.O. - BARATALA</td>
						<td>KHEJURI - II</td>
						<td>PAKURSENI</td>
						<td>721437</td>
						<td>9.55E+09</td>
						<td>UJJWALDEY62@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>962</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>TENTULBARI JATINDRA NARAYAN
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - TIKASHI</td>
						<td>KHEJURI - I</td>
						<td>MANOHARPUR-II</td>
						<td>721232</td>
						<td>3.23E+09</td>
						<td>MANOHARPURSRKHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>963</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td>AGFF</td>
						<td>KAMARDA CHARU BHAGABATI
							BALIKA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KAMARDA, P.O. - BARA
							KAMARDA</td>
						<td>NANDA KUMAR</td>
						<td>JARA</td>
						<td>721232</td>
						<td>3.23E+09</td>
						<td>NAYEKJ14@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>964</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td>KULANJARA DESHABANDHU
							VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KULANJARA</td>
						<td>DESHOPRAN</td>
						<td>BASANCHERA</td>
						<td>721201</td>
						<td>3.23E+09</td>
						<td>PNHSHM60@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>965</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>NAIKURI DHARANIDHAR BALIKA
							VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NAIKURI</td>
						<td>TAMLUK</td>
						<td>BELIABERA</td>
						<td>721517</td>
						<td>9.78E+09</td>
						<td>KTHS1962@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>966</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PANSKURA GIRLS HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PANSKURA</td>
						<td>PANSKURA (M)</td>
						<td>GOLARH</td>
						<td>721260</td>
						<td>9.43E+09</td>
						<td>VTC3528@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>967</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>GOPIMOHONBARH GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>GOPIMOHONBARH, BHAGWANPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>HEMCHANDRA</td>
						<td>721445</td>
						<td>9.43E+09</td>
						<td>BDVI3531@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>968</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td></td>
						<td>KAMARDA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KAMARDA BAZAR</td>
						<td>KHEJURI - I</td>
						<td></td>
						<td>721201</td>
						<td>3.23E+09</td>
						<td>JIRATVTC3532@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>969</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>GHORAT HAKURIA AJOY VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GOBINDAPUR</td>
						<td>SAHID MATANGINI</td>
						<td>GOLEGRAM</td>
						<td>721136</td>
						<td>3.22E+09</td>
						<td>GOLGRAMHIGH1930@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>970</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>PAUSHI BAIKUNTHA SMRITI
							MILANI VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>PAUSHI</td>
						<td>BHAGAWANPUR - II</td>
						<td>SARBERIA-II</td>
						<td>721146</td>
						<td>3.23E+09</td>
						<td>SARBERIA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>971</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALABERIA P.K. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KALABERIA P.O. -
							CHARABARH</td>
						<td>BHAGAWANPUR - I</td>
						<td>IRPALA</td>
						<td>721222</td>
						<td>9.64E+09</td>
						<td>IRHPALAVTC3536@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>972</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SADI R. N. HIGH SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>SADIHAT</td>
						<td>RAMNAGAR - I</td>
						<td>POROLDA</td>
						<td>721443</td>
						<td>3.22E+09</td>
						<td>SIDDHARTHA.CONTAI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>973</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JOYKRISHNAPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - JOYKRISHNAPUR, P.O. -
							SIMULIA</td>
						<td>TAMLUK</td>
						<td>BAGHASTY</td>
						<td>721133</td>
						<td>9.48E+09</td>
						<td>MOUSAMKGP@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>974</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td></td>
						<td>MAHISHADAL GAYESWARI GIRLS
							HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAHISHADAL</td>
						<td>MAHISADAL</td>
						<td>ALIKOSHA</td>
						<td>721451</td>
						<td>3.23E+09</td>
						<td>VTC3543@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>975</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>RUKMINIPUR KANAILAL VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>RUKMINIPUR, BALIAGHAI (EGRA),</td>
						<td>EGRA - II</td>
						<td>JALIMANDA</td>
						<td>721124</td>
						<td>9.93E+09</td>
						<td>INDRANILSAHA77@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>976</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BARATALA GRAM SANGHA
							VIDYANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							BARATALA</td>
						<td>KHEJURI - II</td>
						<td>CHUBKA</td>
						<td>721513</td>
						<td>3.22E+09</td>
						<td>KHSHS2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>977</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>ETEM</td>
						<td>MAYACHAR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. + P.O. - MAYACHAR</td>
						<td>MAHISADAL</td>
						<td>KULIANA</td>
						<td>721517</td>
						<td>9.73E+09</td>
						<td>VETWM3548@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>978</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BIRULIA PITAMBAR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BIRULIA</td>
						<td>NANDIGRAM - II</td>
						<td>KSHIRAI-VI</td>
						<td>721124</td>
						<td>9.61E+09</td>
						<td>GHORAI.ALOK@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>979</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DARIALA BHIMCHARAN HIGH
							SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>DARIALA, BURARIHAT</td>
						<td>SAHID MATANGINI</td>
						<td>GOPALI</td>
						<td>721145</td>
						<td>9.74E+09</td>
						<td>GOPALIIMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>980</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>HSCH</td>
						<td>HIJLI GOPICHAK HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - GOPOCHAK</td>
						<td>KHEJURI - II</td>
						<td>KHURSI</td>
						<td>721437</td>
						<td>9.47E+09</td>
						<td>GOPINATHPUR19200916902@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>981</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BELECHATA UPENDRA SMRITI
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - LAKSHI</td>
						<td>KHEJURI - I</td>
						<td>BELDA-II</td>
						<td>721424</td>
						<td>3.23E+09</td>
						<td>BGA.BELDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>982</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DHEKUA FARUKIA HIGH MADRASAH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							DHEKUA</td>
						<td>SUTAHATA</td>
						<td>BINPUR</td>
						<td>721514</td>
						<td>9.61E+09</td>
						<td>BHS_3559@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>983</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td>ETEM</td>
						<td>NATSHAL HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - NATSHAL P.O. -
							GEONKHALI</td>
						<td>MAHISADAL</td>
						<td>BISHNUPUR</td>
						<td>721147</td>
						<td>9.73E+09</td>
						<td>BISHNUPUR.ASN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>984</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td></td>
						<td>BARABARI SRI KRISHNA HIGH
							SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>BARABARI (SOUTH)</td>
						<td>BHAGAWANPUR - II</td>
						<td>BISNUPUR</td>
						<td>721144</td>
						<td>9.47E+09</td>
						<td>VETWM3561@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>985</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>JAMITYA ADARSHA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							JAMITYA</td>
						<td>SAHID MATANGINI</td>
						<td>CHAIPAT</td>
						<td>721148</td>
						<td>3.23E+09</td>
						<td>CHAIPATHIGHSCHOOL1910@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>986</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DAKSHIN MOYNA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DAKSHIN MOYNA</td>
						<td>MOYNA</td>
						<td>DUBRA</td>
						<td>721505</td>
						<td>9.8E+09</td>
						<td>DAVMVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>987</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KOLA UNION HIGH SCHOOL
							KOLAGHAT</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KOLAGHAT</td>
						<td>KOLAGHAT</td>
						<td>MANIK-PARA</td>
						<td>721513</td>
						<td>3.22E+09</td>
						<td>DBS.HS1955@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>988</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOPALNAGAR BEHARILAL
							BIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>GOPALNAGAR, GOPALNAGARHAT</td>
						<td>KOLAGHAT</td>
						<td>SATPATI</td>
						<td>721516</td>
						<td>3.22E+09</td>
						<td>GSSBVSATPATI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>989</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td></td>
						<td>DHANYASRI K. C. HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DHANYASRI, P.O. -
							SRIKRISHNAPUR</td>
						<td>CHANDIPUR</td>
						<td>KESHIARY</td>
						<td>721133</td>
						<td>3.23E+09</td>
						<td>KESHIARYHIGH1945@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>990</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BHAWANICHAK HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P. O. - BASUDEBPUR</td>
						<td>EGRA - II</td>
						<td>DEWANCHAK-I</td>
						<td>721232</td>
						<td>3.23E+09</td>
						<td>HIGHSCHOOLKONARPURSITALANANDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>991</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAR-KHANDAGRAM GANESH HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BAR-KHANDAGRAM, -
							P.O. DHALHARA</td>
						<td>SAHID MATANGINI</td>
						<td>MOHANPUR</td>
						<td>721436</td>
						<td>3.22E+09</td>
						<td>BIGTECH.SPAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>992</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>PARAMANANDAPUR RAMANATH
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-PARAMANANDAPUR
							P.O-SITALA PARAMANADAPUR</td>
						<td>KOLAGHAT</td>
						<td>MONOHARPUR-I</td>
						<td>721212</td>
						<td>3.23E+09</td>
						<td>SCHOOLPRATAPPURHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>993</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>RAMCHANDRAPUR BAIKUNTHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BURARIHAT</td>
						<td>SAHID MATANGINI</td>
						<td>TUTRANGA</td>
						<td>721424</td>
						<td>9.47E+09</td>
						<td>TUTRANGAANCHALSIKSHANIKETAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>994</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>POURA PATHABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>KSHUDIRAMNAGAR, HALDIA</td>
						<td>HALDIA (M)</td>
						<td>RAJNAGAR</td>
						<td>721211</td>
						<td>3.23E+09</td>
						<td>RAJNAGARUNIONHIGHSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>995</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>GOPALPUR U.R. VIDYALAYA (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - GOPALPUR, P.O. - HAT
							GOPALPUR</td>
						<td>POTASHPUR - I</td>
						<td>KHARIKAMATHANI</td>
						<td>721159</td>
						<td>3.22E+09</td>
						<td>NTBV3589@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>996</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KULTIKRI PRAHLAD VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>KULTIKRI-ARANGA</td>
						<td>EGRA - II</td>
						<td>BAKRABAD</td>
						<td>721424</td>
						<td>9.74E+09</td>
						<td>BKD.SCHOOL1@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>997</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>KULBERIA BHIMDEV ADARSHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KULBERIA</td>
						<td>TAMLUK</td>
						<td>JALCHAK-I NO.-IX</td>
						<td>721155</td>
						<td>9.73E+09</td>
						<td>BHS3593@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>998</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KASARIA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>KASARIA,</td>
						<td>KHEJURI - II</td>
						<td>PET BINDHI</td>
						<td>721517</td>
						<td>9.93E+09</td>
						<td>BJNVHS1965@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>999</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PAHARPUR J.J. ADARSHA
							VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>PIRIJKHANBAR</td>
						<td>EGRA - II</td>
						<td></td>
						<td>721166</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1000</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SARPAI MODEL INSTITUTION</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O-SARPAI</td>
						<td>CONTAI - III</td>
						<td>PANCHBERIA</td>
						<td>721146</td>
						<td>3.23E+09</td>
						<td>KALARAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1001</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>NAMALDIHA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NAMALDIHA</td>
						<td>DESHOPRAN</td>
						<td></td>
						<td>721301</td>
						<td>3.22E+09</td>
						<td>KGP.PNRV3601@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1002</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SIULIPUR-PASCHIMBAR HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>SIULIPUR, PASCHIMBAR</td>
						<td>BHAGAWANPUR - I</td>
						<td>KALIARA-I</td>
						<td>721149</td>
						<td>9.93E+09</td>
						<td>TELIPUKURHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1003</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PANCHROL HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PANCHROL</td>
						<td>EGRA - I</td>
						<td>NACHHIPUR</td>
						<td>721133</td>
						<td>9.43E+09</td>
						<td>NAHS3607@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1004</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>BAJKUL BALAI CHANDRA
							VIDYAPITH (HIGH SCHOOL )</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BAJKUL, P.O. - KISMAT
							BAJKUL,</td>
						<td>BHAGAWANPUR - II</td>
						<td>DANRRA</td>
						<td>721467</td>
						<td>3.22E+09</td>
						<td>CUHS02267@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1005</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BEGUNABARI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- BEGUNABARI, P.O. -
							LAKSHI,</td>
						<td>KHEJURI - I</td>
						<td>SALBONI</td>
						<td>721514</td>
						<td>9.93E+09</td>
						<td>JBBS3612@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1006</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KUMVACHAK PALLISRI BIDYAHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - PURBA
							SRIRAMPUR</td>
						<td>MAHISADAL</td>
						<td>JALCHAK-I NO.-IX</td>
						<td>721155</td>
						<td>9.48E+09</td>
						<td>DSUNDARRAI9@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1007</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAMUDPUR GOBINDA SMRITI
							SISKHA NIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - MAMUDPUR. P.O. -
							TEGHARI JOTAVIRAM</td>
						<td>TAMLUK</td>
						<td>BANDIPUR-II</td>
						<td>721201</td>
						<td>9.93E+09</td>
						<td>VETWM3618@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1008</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KELOMAL SANTOSHINI HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KELOMAL</td>
						<td>TAMLUK</td>
						<td>DHANESWARPUR-III</td>
						<td>721166</td>
						<td>9.61E+09</td>
						<td>VETWM3619@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1009</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>MAHAMMADPUR SATYA SMRITI
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NANDAKUMAR</td>
						<td>NANDA KUMAR</td>
						<td>SARBERIA-I</td>
						<td>721211</td>
						<td>9.73E+09</td>
						<td>BRAHMANBASANHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1010</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>AGFF</td>
						<td>MUGBERIA GANGADHAR HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BHUPATINAGAR</td>
						<td>BHAGAWANPUR - II</td>
						<td>DHALHARA</td>
						<td>721150</td>
						<td>9.73E+09</td>
						<td>DHALHARAPAGLIMATAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1011</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td>AGFF</td>
						<td>PANCHETGARH HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							PANCHETGARH</td>
						<td>POTASHPUR - II</td>
						<td>DASGRAM</td>
						<td>721467</td>
						<td>3.22E+09</td>
						<td>DSSS1940@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1012</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BOHICHBERIA HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BOHICHBERIA</td>
						<td>NANDA KUMAR</td>
						<td>KHARBANDHI</td>
						<td>721507</td>
						<td>9.93E+09</td>
						<td>KHARBANDHIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1013</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KAKHARDA RAMKRISHNA HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- KAKHARDA P.O. -
							DEMARIHAT ,</td>
						<td>SAHID MATANGINI</td>
						<td>NAYAGRAM</td>
						<td>721159</td>
						<td>3.22E+09</td>
						<td>HM.NBBP@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1014</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td></td>
						<td>BALIGHAI FAKIR DAS HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BALIGHAI</td>
						<td>EGRA - II</td>
						<td>ROHINI</td>
						<td>721143</td>
						<td>9.47E+09</td>
						<td>ROHINICRD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1015</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAKSHIN KASIMNAGAR HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DAKSHIN
							KASIMNAGAR,</td>
						<td>MAHISADAL</td>
						<td>BISHNUPUR</td>
						<td>721147</td>
						<td>9.73E+09</td>
						<td>VETWM3685@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1016</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BARSUKLALCHAK HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BARSULALCHAK, P.O. -
							KUMARPUR</td>
						<td>HALDIA</td>
						<td>DASPUR-II</td>
						<td>721211</td>
						<td>3.23E+09</td>
						<td>VETWM3704@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1017</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KHANYADIHI P.K. HIGHER
							SECONDARY SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KHANYADIHI</td>
						<td>KOLAGHAT</td>
						<td>BIRSINGHA</td>
						<td>721212</td>
						<td>3.23E+09</td>
						<td>JRKHS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1018</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHHATRI VIVEKANANDA
							VIDYABHAWAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - CHHATRI</td>
						<td>EGRA - I</td>
						<td>JALCHAK-II NO.-X</td>
						<td>721155</td>
						<td>3.22E+09</td>
						<td>JALCHAKNNV49@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1019</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NAYAPUT SUDHIR KUMAR HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. NAYAPUT,</td>
						<td>CONTAI - I</td>
						<td>SATYAPUR</td>
						<td>721156</td>
						<td>3.22E+09</td>
						<td>MARHTALASCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1020</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PURBA CHILKA LALCHAND HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT- P.O. PURBACHILKA
						</td>
						<td>PANSKURA</td>
						<td>JARA</td>
						<td>721242</td>
						<td>9.73E+09</td>
						<td>TATARPURHIGHSCHOOL.TATARPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1021</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>HARIJHAMA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							HARIJHAMA,</td>
						<td>PANSKURA</td>
						<td>SALIKOTHA</td>
						<td>721435</td>
						<td>8.35E+09</td>
						<td>MENKAPURKRISHNAPRASADUVHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1022</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KHANCHI GUNADHAR ADARSHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KHANCHI</td>
						<td>NANDA KUMAR</td>
						<td>KADRA UTTARBIL</td>
						<td>722138</td>
						<td>9.68E+09</td>
						<td>BRKHS3792@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1023</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KAMINACHAK SASIBHUSAN
							KANAILAL VIDYATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,KAMINACHAK,
							P.O. - DERIACHAK</td>
						<td>PANSKURA</td>
						<td>GOALTORE</td>
						<td>721128</td>
						<td>3.23E+09</td>
						<td>GOALTOREVTC3793@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1024</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGFF</td>
						<td>BAHITRAKUNDA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BAHITRAKUNDA</td>
						<td>CONTAI - III</td>
						<td>SAURI KOTEBAR</td>
						<td>721466</td>
						<td>3.23E+09</td>
						<td>SAURISCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1025</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAGHADARI DESHAPRAN HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - EKTARPUR, P.O. -
							BHUPATINAGAR</td>
						<td>BHAGAWANPUR - II</td>
						<td>BURAL</td>
						<td>721155</td>
						<td>9.73E+09</td>
						<td>UCHITPOREPALLIPRAN@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1026</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>HIRAPUR K. K. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - HIRAPUR, P.O. -
							DERIACHAK</td>
						<td>KOLAGHAT</td>
						<td></td>
						<td>713103</td>
						<td>3.42E+09</td>
						<td>SHISHUNIKETAN@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1027</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>CONTAI HARISABHA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT. - HATABARI, P.O. - CONTAI</td>
						<td>CONTAI (M)</td>
						<td>KENDA</td>
						<td>713342</td>
						<td>8.16E+09</td>
						<td>KENDAHSHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1028</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ABASBARI PITABAS SARADA
							PRASANNA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - ABASBARI, P.O. -
							BARSIMULBARI,</td>
						<td>CHANDIPUR</td>
						<td></td>
						<td>713201</td>
						<td>3.43E+09</td>
						<td>DGPTARAKNATHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1029</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>ALINAN SAHID MATANGINI BHAWAN
							BALIKA VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - ALINAN.</td>
						<td>SAHID MATANGINI</td>
						<td></td>
						<td>713305</td>
						<td>3.41E+09</td>
						<td>PRINCIPAL_KANYAPURPOLYTECHNIC@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1030</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>CHAKBHABANI MADAN KISHORE
							NIRODAMAYEE VIDYAYATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							CHAKBHABANI</td>
						<td>POTASHPUR - II</td>
						<td></td>
						<td>713305</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1031</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KUMARCHAK JANAKALYAN
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-KUMARCHAK,P.O. -
							BARAKUMARCHAK ,</td>
						<td>MOYNA</td>
						<td>JITPUR-UTTARRAMPUR</td>
						<td>713335</td>
						<td>3.41E+09</td>
						<td>NCPROOP@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1032</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td>DAUDPUR SIKSHASADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DAUDPUR, P.O. -
							DAUDPUR (NANDI),</td>
						<td>NANDIGRAM - I</td>
						<td>JITPUR-UTTARRAMPUR</td>
						<td>713335</td>
						<td>3.41E+09</td>
						<td>D.BANERJE@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1033</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SAORABERIA JALPAI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MATILALCHAK,</td>
						<td>NANDA KUMAR</td>
						<td>SARAITIKAR</td>
						<td>713102</td>
						<td>3.42E+09</td>
						<td>VIDYASAGAR_SCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1034</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MUGBERIA GIRLS HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O-MUGBERIA</td>
						<td>BHAGAWANPUR - II</td>
						<td>BAHULA</td>
						<td>713322</td>
						<td>3.41E+09</td>
						<td>SUBRATAROY976@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1035</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>AJAYA ANNADA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							AJAYA,</td>
						<td>KHEJURI - I</td>
						<td>KHANDRA</td>
						<td>713363</td>
						<td>3.41E+09</td>
						<td>KHANDRAHS4022@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1036</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGFF</td>
						<td>DHANGHARA JNANENDRA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DHANGHARA,
						</td>
						<td>CONTAI - III</td>
						<td>GOPE GANTAR-I</td>
						<td>713146</td>
						<td>3.42E+09</td>
						<td>VTC4025@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1037</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td></td>
						<td>MOYNA VIVEKANANDA KANYA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PARAMANANDAPUR,</td>
						<td>MOYNA</td>
						<td>GOBINDAPUR</td>
						<td>713407</td>
						<td>9.43E+09</td>
						<td>HATGOSCHOOL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1038</td>
						<td>ETCM</td>
						<td>AGFF</td>
						<td></td>
						<td>AMARSHI B.C. GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - AMARSHI,</td>
						<td>POTASHPUR - I</td>
						<td>JAMNA</td>
						<td>713422</td>
						<td>3.42E+09</td>
						<td>D_AVIJIT@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1039</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DAYALCHAK B. B. J VIDYAPITH
							(HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DAYALCHAK BHUNIACHAK,
							P.O. - MAHADOLE,</td>
						<td>PANSKURA</td>
						<td>GALSI</td>
						<td>713406</td>
						<td>3.42E+09</td>
						<td>GSV4033@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1040</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>TENTUILA SARRANG NARENDA NATH
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - JAHALDA,</td>
						<td>EGRA - I</td>
						<td>AJHAPUR</td>
						<td>713166</td>
						<td>3.45E+09</td>
						<td><a href="mailto:NMPBHS@YAHOO.CO.IN">NMPBHS@YAHOO.CO.IN</a>
						</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1041</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DUMARDARI MUCHIRAM
							HARISCHANDRA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							DUMARDARI,</td>
						<td>BHAGAWANPUR - II</td>
						<td>BAGHAR-II</td>
						<td>713141</td>
						<td>3.42E+09</td>
						<td>TGHS1900@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1042</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>MAKARAMPUR NILKANTHA SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							MAKARAMPUR,</td>
						<td>POTASHPUR - I</td>
						<td></td>
						<td>713213</td>
						<td>3.43E+09</td>
						<td>RPVVDGP@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1043</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td>HSCH</td>
						<td>KALA GECHIA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MOYNA KALAGECHIA,</td>
						<td>MOYNA</td>
						<td>SARAITIKAR</td>
						<td>713104</td>
						<td>3.42E+09</td>
						<td>KRISHNAPUR4041@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1044</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SAGARBARH BANDHAB SATYESWAR
							VIDYABHAWAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SAGARBARH</td>
						<td>KOLAGHAT</td>
						<td>KALEKHANTALA-II</td>
						<td>713513</td>
						<td>3.45E+09</td>
						<td>PARULIAVOC4047@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1045</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JABDA VIDYASAGAR VIDYAPITYH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - JABDA,</td>
						<td>POTASHPUR - II</td>
						<td></td>
						<td>713101</td>
						<td>3.42E+09</td>
						<td>HARIJANBURDWAN2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1046</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SUBDI SITANATH VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O-SUBDI,</td>
						<td>NANDIGRAM - II</td>
						<td>GOPALBERA</td>
						<td>713427</td>
						<td>9.43E+09</td>
						<td>KENDURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1047</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>GHASIPUR VIVEKANANDA
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. GHASIPUR,</td>
						<td>MAHISADAL</td>
						<td>RAMNAGAR</td>
						<td>713152</td>
						<td>03452 252 315</td>
						<td>PPDHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1048</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SAPUYA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BASANCHAK</td>
						<td>HALDIA</td>
						<td>PANURIA</td>
						<td>713315</td>
						<td>9.43E+09</td>
						<td>GOURANGDI4059@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1049</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SASTHAPALLI SAMBHUNATH HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DANGARTULSI, P.O. -
							PATASHPUR</td>
						<td>POTASHPUR - I</td>
						<td>PALITA</td>
						<td>713143</td>
						<td>9.59E+09</td>
						<td>PALITAHIGHSCHOOL4065@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1050</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KAMALPUR ADARSHA VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KAMALPUR,</td>
						<td>NANDIGRAM - II</td>
						<td>JAHAN NAGAR</td>
						<td>713513</td>
						<td>3.45E+09</td>
						<td>JAHANNAGARKHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1051</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NIGAMANANDA VIDYAPITH (HIGH
							SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - JOYRAMCHAK, P.O. -
							JOYBALARAMPUR</td>
						<td>SAHID MATANGINI</td>
						<td>KHANDAGHOSH</td>
						<td>713142</td>
						<td>9.59E+09</td>
						<td>4071KHANDAGHOSH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1052</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>UTTAR JIANDA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - UTTAR
							JIANDA</td>
						<td>KOLAGHAT</td>
						<td>SATGACHHIA-I</td>
						<td>713422</td>
						<td>8.64E+09</td>
						<td>SAJAL.GSH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1053</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAJBAJIA ISWARCHANDRA
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,BAJBAJIA,
							P.O. - DAKSHIN KALAMDAN,</td>
						<td>KHEJURI - I</td>
						<td>KARUI</td>
						<td>713143</td>
						<td>8E+09</td>
						<td>DIPAKESHIKA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1054</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALAGONDA RAJANI VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - CHANGRA
							KALAGONDA</td>
						<td>TAMLUK</td>
						<td>PARAJ</td>
						<td>713403</td>
						<td>3.42E+09</td>
						<td>PARAJHBMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1055</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PATNA BAIKUNTHA SIKSHASADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - AJAYA.</td>
						<td>KHEJURI - I</td>
						<td>UCHALAN</td>
						<td>713427</td>
						<td>9.64E+09</td>
						<td>AKLAKHIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1056</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>DHANYAGHAR BHUTNATH ADARSHA
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DHANYAGHAR</td>
						<td>NANDA KUMAR</td>
						<td></td>
						<td>713130</td>
						<td>3.45E+09</td>
						<td>HMKBBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1057</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HALUDBARI HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - CHAUDDACHULLI, P.O. - HALUDBARI</td>
						<td>KHEJURI - II</td>
						<td>BARABAINAN</td>
						<td>713421</td>
						<td>9.73E+09</td>
						<td>BUSKS021@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1058</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BHUPATINAGAR KANYA VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. &amp; P.S. -
							BHUPATINAGAR</td>
						<td>BHAGAWANPUR - II</td>
						<td>CHANAK</td>
						<td>713131</td>
						<td>3.45E+09</td>
						<td>KNAJHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1059</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>UTTAR AMTALIA GITA RANI
							VIDYABHAWAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + P.O. -UTTAR AMTALIA,</td>
						<td>DESHOPRAN</td>
						<td>PATULI</td>
						<td>713512</td>
						<td>3.45E+09</td>
						<td>PATULIHIGHSCHOOL9@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1060</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>DAKSHIN CHANCHIARA MADHYAMIK
							SIKSHA KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,DAKSHIN
							CHANCHIARA, P.O. - PRATAPPUR</td>
						<td>PANSKURA</td>
						<td></td>
						<td>713409</td>
						<td>3.45E+09</td>
						<td>VOCATIONAL4084@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1061</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NILKUNTHIA VIJOYA M.S,K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - NILKUNTHIA</td>
						<td>TAMLUK</td>
						<td></td>
						<td>713202</td>
						<td>3.43E+09</td>
						<td>DURGAPURPROJECTSBOYSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1062</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KARIJBAR DESHAPRAN M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KARIJBAR, P.O. -
							KAJLI,</td>
						<td>CONTAI - III</td>
						<td>KAICHAR-II</td>
						<td>713143</td>
						<td>3.45E+09</td>
						<td>BBSMHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1063</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>MANIKJORE KAMINI KUMARI HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MANIKJORE,</td>
						<td>BHAGAWANPUR - II</td>
						<td>BHATAR</td>
						<td>713125</td>
						<td>0342 2322276</td>
						<td>BHATARMPHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1064</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>ATBATI ANNAPURNA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - ATBATI</td>
						<td>EGRA - II</td>
						<td></td>
						<td>713101</td>
						<td>3.42E+09</td>
						<td>VIKASHSONKAR2011@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1065</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JAGATPUR SASHIBHUSAN
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							JAGATPUR,</td>
						<td>MAHISADAL</td>
						<td>AMARUN-II</td>
						<td>713125</td>
						<td>9.23E+09</td>
						<td>KCKNHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1066</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEBIPUR MILAN VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DEBIPUR,</td>
						<td>NANDIGRAM - I</td>
						<td>KARUI</td>
						<td>713143</td>
						<td>3.45E+09</td>
						<td>VTC4110@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1067</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PADUMPUR SAIFUDDIN HIGH
							MADRASAH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - PADUMPUR ,P.O. -
							SIMULIA</td>
						<td>TAMLUK</td>
						<td></td>
						<td>713347</td>
						<td>9.48E+09</td>
						<td>KOUSHIKDGP@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1068</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MANDARPUR HIGH MADRASAH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O. - MANDARPUR,</td>
						<td>RAMNAGAR - II</td>
						<td>SAMUDRAGARH</td>
						<td>713519</td>
						<td>3.45E+09</td>
						<td>SAMUDRAGARHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1069</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ARISANDA SWAMI SATYANANDA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - ARISANDA</td>
						<td>KOLAGHAT</td>
						<td>ATGHARIA SIMLAN</td>
						<td>713425</td>
						<td>3.45E+09</td>
						<td>SAKV_1933@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1070</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>HSCH</td>
						<td>BARGODA ANNADACHARAN
							BANIMANDIR (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.BARGODA,</td>
						<td>NANDA KUMAR</td>
						<td></td>
						<td>713102</td>
						<td>3.42E+09</td>
						<td>RMDVHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1071</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>TULIA SITALA MODEL HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HARIDASPUR,
						</td>
						<td>TAMLUK</td>
						<td>KRISHNADEBPUR</td>
						<td>713405</td>
						<td>9.43E+09</td>
						<td>KRISHNADEVPURHIGHSCHOOL4BOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1072</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KHONDAKHOLA VIVEKANANDA
							VIDYAPITH (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KHONDAKHOLA, P.O. -
							RAGHUNATHBARI</td>
						<td>PANSKURA</td>
						<td>RAMNAGAR</td>
						<td>713152</td>
						<td>3.45E+09</td>
						<td>RAMNAGARHIGHSCHOOL1909@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1073</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MECHOGRAM PURNA CHANDRA
							BALIKA VIDYAYATAN (HIGH) SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,DAKSHIM
							MECHOGRAM</td>
						<td>PANSKURA</td>
						<td>GOPALPUR</td>
						<td>713212</td>
						<td>3.43E+10</td>
						<td>GHS1884@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1074</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>PALSA CHINTAMANI SMRITI
							VIDYAMANDIR (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. PALSA, P.O. - DALPARA</td>
						<td>PANSKURA</td>
						<td>MAJHIGRAM</td>
						<td>713143</td>
						<td>3.45E+09</td>
						<td>MAJIGRAMBHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1075</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>AJRA AMULYA RATAN GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - AJRA, P.O. -
							CHAMPI,</td>
						<td>MAHISADAL</td>
						<td>CHHATNA</td>
						<td>722132</td>
						<td>3.24E+09</td>
						<td>ITICHHATNA@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1076</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGHC</td>
						<td>BAHADURPUR DESHAPRAN
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BAHADURPUR,</td>
						<td>BHAGAWANPUR - II</td>
						<td>SALDA</td>
						<td>722122</td>
						<td>3.24E+09</td>
						<td>RAJAGRAM5010@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1077</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td></td>
						<td>DAHSHIN HATIGECHIA PANDAB
							BASAN KANAILAL VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DAKSHIN HATIGECHIA,
							P.O. - DAKSHIN DAMODOR,</td>
						<td>NANDA KUMAR</td>
						<td>PUANDARPUR</td>
						<td>722155</td>
						<td>3.24E+09</td>
						<td>PURRANDARPURHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1078</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SURA MAHAMAYA BALIKA
							VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - SURANANKAR, P.O. -
							PANSKURA</td>
						<td>PANSKURA (M)</td>
						<td>GANGAJALGHATI</td>
						<td>722133</td>
						<td>3.24E+09</td>
						<td>AKDVMAIL@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1079</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>SATMILE HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SATMILE</td>
						<td>CONTAI - I</td>
						<td>BELIATORE</td>
						<td>722203</td>
						<td>9.43E+09</td>
						<td>BHSVTC5020@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1080</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>RANIHATI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - RANIHATI, P.O. -
							PRATAPPORE</td>
						<td>PANSKURA (M)</td>
						<td>RAMSAGAR</td>
						<td>722147</td>
						<td>3.24E+09</td>
						<td>SCHOOL.RAMSAGAR1918@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1081</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SALIKA GARCHAK RAKHAL ADARSHA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SALIKA GARCHAK,</td>
						<td>TAMLUK</td>
						<td>HIRBANDH</td>
						<td>722121</td>
						<td>9.43E+09</td>
						<td>HIRBANDHHIGHSCHOOL5023@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1082</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BALLUK HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BALLUK, P.O. -
							BALLUKHAT</td>
						<td>SAHID MATANGINI</td>
						<td>INDAS-I</td>
						<td>722205</td>
						<td>3.24E+09</td>
						<td>INDASHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1083</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NANDIGRAM B.M.T SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - NANDIGRAM</td>
						<td>NANDIGRAM - I</td>
						<td>BRAHMANDIHA</td>
						<td>722173</td>
						<td>3.24E+09</td>
						<td>RCP03242@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1084</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAJNAGARHIGH SCHOOL
						</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O-GOLGHAT</td>
						<td>PANSKURA</td>
						<td>BELUTRASULPUR</td>
						<td>722205</td>
						<td>9.15E+09</td>
						<td>RHM_5028@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1085</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td></td>
						<td>SIMULIA UZIRAN GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL &amp; P.O - SIMULIA</td>
						<td>TAMLUK</td>
						<td></td>
						<td>722101</td>
						<td>3.24E+09</td>
						<td>BANKURABANGA.VIDYALAYVTC5029@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1086</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAHARPUR TAPSHILI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VIL. - DAHARPUR, P.O. -
							TAMLUK.</td>
						<td>TAMLUK (M)</td>
						<td>SAHASPUR</td>
						<td>722205</td>
						<td>9.43E+09</td>
						<td>SHASHPURDNSI@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1087</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>RADHABALLAVPUR BHIMA CHARAN
							BASU VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - RADHABALLAVPUR, P.O.
							- RADHABALLAVPUR</td>
						<td>TAMLUK (M)</td>
						<td>BARJORA</td>
						<td>722202</td>
						<td>3.24E+09</td>
						<td>BARJORAHIGHSCHOOL1962@HOTMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1088</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>DAKSHIN ANUKHA MOKSHADA
							VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DAKSHIN ANUKHA, P.O.
							- MOYNA</td>
						<td>MOYNA</td>
						<td>PAKHANNAA</td>
						<td>722208</td>
						<td>3.24E+09</td>
						<td>BHSCHM.GENERAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1089</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>MANOHARPUR BANDHAB HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - MANOHARPUR, P.O. -
							ILASHPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>DHANARA</td>
						<td>722140</td>
						<td>9.43E+09</td>
						<td>ALAKESHPATI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1090</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SUBDI DEVJANI GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - SUBDI</td>
						<td>NANDIGRAM - II</td>
						<td>DHULAI</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>DHULAIRKMVIDYAMANDIR1948@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1091</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KHALISABHANGA HIGH SCHOOL(HS)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							KHALISABHANGA,</td>
						<td>CONTAI - I</td>
						<td>RAIPUR</td>
						<td>722134</td>
						<td>3.24E+09</td>
						<td>GRHSHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1092</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MOYNA VIVEKANANDA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - CHONGRA,</td>
						<td>MOYNA</td>
						<td>GOPALPUR</td>
						<td>722136</td>
						<td>9.73E+09</td>
						<td>HMGPR@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1093</td>
						<td>ETCM</td>
						<td>HSHM</td>
						<td>ETEM</td>
						<td>KANCHANPUR MILAN VIDYAPITH
							(HS)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - KANCHANPUR</td>
						<td>MAHISADAL</td>
						<td>GORABARI</td>
						<td>722135</td>
						<td>3.24E+09</td>
						<td>GORABARIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1094</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGFF</td>
						<td>KARAK S.S. HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KALYANPUR,
						</td>
						<td>NANDA KUMAR</td>
						<td></td>
						<td>722122</td>
						<td>9.48E+09</td>
						<td>MUNINAGARRKV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1095</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DWARIBERIA ADARSHA SIKSHA
							SADAN (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DWARIBERIA, P.O. -
							DWARIBERIA,</td>
						<td>HALDIA</td>
						<td>DIHIPARA</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>RUCM5055@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1096</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>PRATAPPORE HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - PRATAPPORE</td>
						<td>PANSKURA (M)</td>
						<td>DHANSIMLA</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>SONAMUKHIBJSHCOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1097</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HALDIA PUNARBASAN
							VIDYANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>DURGACHAK BBLOCK,
							P.O. - DURGACHAK, HALDIA</td>
						<td>HALDIA (M)</td>
						<td>BHAKTABUNDH</td>
						<td>722133</td>
						<td>3.24E+09</td>
						<td>UHS5058@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1098</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JAFULY DESHPRAN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - JAFULYNPOST - JAFULY -
							BIBICHAK</td>
						<td>KOLAGHAT</td>
						<td>FAL BIBARDA</td>
						<td>722152</td>
						<td>3.24E+09</td>
						<td>BSVIDYAPITH.2011@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1099</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>RADHABALLAV CHAK SARADAMAYEE
							VIDYAPITH (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - RADHABALLAV CHAK,
							P.O. - BARAKUMAR CHAK,</td>
						<td>MOYNA</td>
						<td>UTTARBAR</td>
						<td>722138</td>
						<td>3.24E+09</td>
						<td>BAITALGPVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1100</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KALIKAKHALI SARADESWARI
							BALIKA VIDYAPITH (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MATHCHANDIPUR,
						</td>
						<td>CHANDIPUR</td>
						<td>GOBINDADHAM</td>
						<td>722155</td>
						<td>9.73E+09</td>
						<td>BIHARJURIAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1101</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DUMRA INDRANARAYAN BALIKA
							VIDYALAYA (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.-DUMRA, P.O. - HOGLA</td>
						<td>SAHID MATANGINI</td>
						<td>KANTABARI</td>
						<td>722144</td>
						<td>9.8E+09</td>
						<td>PURUSOTTAMPURHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1102</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BHOGPUR KENARAM MEMORIAL HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- BHOGPUR P.O. - BHOGPUR</td>
						<td>KOLAGHAT</td>
						<td>PRARBERA</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>BARCHATRA5079@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1103</td>
						<td>ETCM</td>
						<td>AGHC</td>
						<td></td>
						<td>BASANTIA HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BASANTIA,</td>
						<td>DESHOPRAN</td>
						<td>GOGRA</td>
						<td>722132</td>
						<td>9.47E+09</td>
						<td>VTCCHANDRA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1104</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>BCRS</td>
						<td>TILKHOJA BAIKUNTHA BIDYAYATAN
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.&amp; P.O. -
							TILKHOJA</td>
						<td>MOYNA</td>
						<td></td>
						<td>722122</td>
						<td>9.93E+09</td>
						<td>PK85141@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1105</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MADHABPUR INDRANARAYAN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							MADHABPUR,</td>
						<td>BHAGAWANPUR - II</td>
						<td>LAKSHMISAGAR</td>
						<td>722160</td>
						<td>9.48E+09</td>
						<td>VTC5085@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1106</td>
						<td>ETCM</td>
						<td>AGCM</td>
						<td></td>
						<td>MALIDA BHUSAN CHANDRA HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - MALIDA, P.O. - JASORA</td>
						<td>PANSKURA</td>
						<td>SARENGA</td>
						<td>722150</td>
						<td>3.24E+09</td>
						<td>SARENGAMSV5086@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1107</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAJNAGAR RAMCHANDRA ADARSHA
							VIDYAPITH (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - RAJNAGAR, P.O. -
							JALPAI</td>
						<td>NANDA KUMAR</td>
						<td>KENJAKURA</td>
						<td>722139</td>
						<td>9.56E+09</td>
						<td>KDBVHEADMISTRESS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1108</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BETKALLA MILANI VIDYANIKETAN
							(HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BETKALLA,</td>
						<td>NANDA KUMAR</td>
						<td>ROUTHKHANDA</td>
						<td>722138</td>
						<td>3.24E+09</td>
						<td>CDHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1109</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HARIPUR HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - HARIPUR, P.O. -
							MADHABPUR</td>
						<td>BHAGAWANPUR - II</td>
						<td>SALDA</td>
						<td>722138</td>
						<td>3.24E+09</td>
						<td>JPHS.EDU@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1110</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PARULIA MODERN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - PARULIA, P.O. - JAMUA
							SANKARPUR,</td>
						<td>DESHOPRAN</td>
						<td>PURBANABASON</td>
						<td>722207</td>
						<td>3.24E+09</td>
						<td>NHS1982@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1111</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DULALPUR KSHIROD CHANDRA
							GIRLS SCHOOL (HIGH )</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DULALPUR, P.O. -
							KHALISHABHANGA</td>
						<td>CONTAI - I</td>
						<td>KHATRA-I</td>
						<td>722140</td>
						<td>3.24E+09</td>
						<td>KHATRA.HIGHSCHOOL.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1112</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BAHIRI BRADLEY BIRT HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DEULBARH, P.S. -
							MARISDA</td>
						<td>CONTAI - III</td>
						<td>DIHIPARA</td>
						<td>722208</td>
						<td>3.24E+09</td>
						<td>PALASDANGAHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1113</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DONACHAK DESHAPRAN BIRENDRA
							MEMORIAL HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - DONACHAK,</td>
						<td>MOYNA</td>
						<td>NARRAH</td>
						<td>722155</td>
						<td>3.24E+09</td>
						<td>NARRAHHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1114</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGCF</td>
						<td>BANPUR M.S.K.</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BANPUR, P.O. - KHARUI</td>
						<td>SAHID MATANGINI</td>
						<td>ABINASHPUR</td>
						<td>731121</td>
						<td>3.46E+09</td>
						<td>ABINASHPURSRIRAMHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1115</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PURBABAGUMAI M.S.K.</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - PURBABAGUMAI, P.O. -
							DAYALDASI,</td>
						<td>NANDA KUMAR</td>
						<td>NOKRACONDA</td>
						<td>731125</td>
						<td>9.83E+09</td>
						<td>NAKRACONDAVTC5505@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1116</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BARSPATI M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KAKGECHHIA</td>
						<td>TAMLUK</td>
						<td>CHINPAI</td>
						<td>731104</td>
						<td>3.46E+09</td>
						<td>CHINPAI5507@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1117</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>NAREKELDAHA M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - NAREKELDAHA, P.O. -
							ASNAN</td>
						<td>MOYNA</td>
						<td>BAUTIA</td>
						<td>731243</td>
						<td>9.43E+09</td>
						<td>UNIQ_SUMIT@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1118</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>ETEM</td>
						<td>UTTAMPUR M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - UTTAMPUR, P.O. -
							RAMCHANDRAPUR</td>
						<td>MOYNA</td>
						<td>LABPUR-I</td>
						<td>731303</td>
						<td>3.46E+09</td>
						<td>LABPURJLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1119</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>PURBA DAKSHIN MOYNA M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - PURBA
							DAKSHIN MOYNA</td>
						<td>MOYNA</td>
						<td>AHMADPUR</td>
						<td>731201</td>
						<td>3.46E+09</td>
						<td>AJD.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1120</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KESHABPUR JALPAI GADADHAR
							JOGENDRA MILAN VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KESHABPUR JALPAI,</td>
						<td>MAHISADAL</td>
						<td>CHANDIDAS NANOOR</td>
						<td>731301</td>
						<td>9.47E+09</td>
						<td>NANOOR5512@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1121</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>LALPUR MUKTESWAR GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - LALPUR, P.O. -
							PANIPARUL,</td>
						<td>EGRA - II</td>
						<td>PAIKAR-I</td>
						<td>731221</td>
						<td>3.47E+09</td>
						<td><a
								href="mailto:PHSBIRBHUM@GMAIL.COM">PHSBIRBHUM@GMAIL.COM</a></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1122</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BODHRA PANTHESWARI HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BODHRA</td>
						<td>RAMNAGAR - I</td>
						<td>MAHAMMAD BAZAR</td>
						<td>731127</td>
						<td>3.46E+09</td>
						<td>KAIJILIHCHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1123</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAMNAGAR BALIKA VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RAMNAGAR,</td>
						<td>RAMNAGAR - I</td>
						<td></td>
						<td>731123</td>
						<td>9.43E+09</td>
						<td>DUBRAJPURRBSDHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1124</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SHIPUR KESHABESWAR HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SHIPUR</td>
						<td>EGRA - I</td>
						<td>KALITHA</td>
						<td>731220</td>
						<td>3.47E+09</td>
						<td>KALITHAHIGHSCHOOL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1125</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>ARJUNI SRI SRI RAMKRISHNA
							ADARSHA VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - ARJUNI, P.O. -
							GARIA,</td>
						<td>EGRA - I</td>
						<td>KALITHA</td>
						<td>731220</td>
						<td>3.47E+09</td>
						<td>AMAIPUR.M.HMSDRASAH@GAMIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1126</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>CHANDPUR HAROCHARAN
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							CHANDPUR,</td>
						<td>POTASHPUR - I</td>
						<td>KIRNAHAR-II</td>
						<td>731302</td>
						<td>9.47E+09</td>
						<td>KSCHS1895@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1127</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>AMARSHI RAGHUNATH HIGH SCHOOL
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - AMARSHI</td>
						<td>POTASHPUR - I</td>
						<td>JAYDEV-KENDULI</td>
						<td>731124</td>
						<td>9.47E+09</td>
						<td>AMRITA4107@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1128</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>BARBAJITPUR BALIKA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BARBAJITPUR, P.O. -
							BARBASUDEVPUR</td>
						<td>HALDIA</td>
						<td>KURUMGRAM</td>
						<td>731242</td>
						<td>3.47E+09</td>
						<td>MHSBIR110@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1129</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>JUKHIA KUMAR NARAYAN
							BANIMANDIR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - JUKHIA BAZAR,
						</td>
						<td>BHAGAWANPUR - II</td>
						<td>HETAMPUR</td>
						<td>731124</td>
						<td>9.43E+09</td>
						<td>VOCHRHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1130</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MADHABPUR MAHENDRA NATH GIRLS
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - MADHABPUR</td>
						<td>BHAGAWANPUR - II</td>
						<td>POURANDARPUR</td>
						<td>731129</td>
						<td>7.06E+09</td>
						<td>SAJINA5546@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1131</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>NEKURSUNI KRISHI SILPA SIKSHA
							SADAN (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - BAMAN BARH</td>
						<td>POTASHPUR - II</td>
						<td>BAHIRI PANCHSOWA</td>
						<td>731240</td>
						<td>3.46E+09</td>
						<td>PRV.VTC.5547@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1132</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>GOBRA I.N.K.M. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - GOBRA</td>
						<td>RAMNAGAR - I</td>
						<td>JHIKADDA</td>
						<td>731218</td>
						<td>3.46E+09</td>
						<td>PSRKV.5559@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1133</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>GOKULNAGAR TRILOCHAN
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BARAGOKULNAGAR</td>
						<td>MOYNA</td>
						<td>PANRUI</td>
						<td>731121</td>
						<td>9.56E+09</td>
						<td>BHOLAGORIAHIGHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1134</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>AMDABAD HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - AMDABAD</td>
						<td>NANDIGRAM - II</td>
						<td>HATIA</td>
						<td>731201</td>
						<td>9.93E+09</td>
						<td>LAGHOSAHIGHSCHOOL1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1135</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MABARAKPUR A. M. S. C. HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,MABARAKPUR,
							P.O. - MAHAMMADPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>MOLLARPUR-II</td>
						<td>731216</td>
						<td>9.73E+09</td>
						<td>SOUMYAJIT.ROY28@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1136</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>DUBAI RASIKNAGAR VIVEKANANDA
							VIDYAYATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - RASIKNAGAR, P.O. -
							MAISHALI,</td>
						<td>BHAGAWANPUR - II</td>
						<td>BEKO</td>
						<td>723121</td>
						<td>8.15E+09</td>
						<td>VIDYASAGAR.VIDYAPITH2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1137</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAHAMMADPUR SIBNARAYAN
							SIKSHAYATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - RAMPUR, SUB
							DIV-HALDIA,</td>
						<td>NANDIGRAM - I</td>
						<td>DUBRA</td>
						<td>723155</td>
						<td>9E+09</td>
						<td>VTC6007@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1138</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAMPAINAGAR SCHEDULED CAST
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-CHAMPAINAGAR,P.O. -
							UDBADAL,</td>
						<td>BHAGAWANPUR - II</td>
						<td>NOWAHATU</td>
						<td>723213</td>
						<td>9.93E+09</td>
						<td>JIUDARUHIGHSCL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1139</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>AGHC</td>
						<td>CHAKGARUPOTA S.S. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - CHAKGARUPOTA, P.O. -
							DOBANDI,</td>
						<td>TAMLUK</td>
						<td>BEKO</td>
						<td>723121</td>
						<td>9.93E+09</td>
						<td>BEKOANCHALHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1140</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>ABASBERIA ADARSHA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - ABASBERIA, P.O. -
							NABA TAJPUR,</td>
						<td>BHAGAWANPUR - I</td>
						<td>KASHIPUR</td>
						<td></td>
						<td>3.25E+09</td>
						<td>PKRAJSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1141</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HATISHAL R. M. VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.- HATISHAL,
							P.O. - JIAKHALI,</td>
						<td>PANSKURA</td>
						<td>NAYADIH</td>
						<td>723212</td>
						<td>8.02E+09</td>
						<td>KUSHIVET6012@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1142</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>JUNBANI RABINDRA VIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - JUNBONI</td>
						<td>CONTAI - I</td>
						<td></td>
						<td>723101</td>
						<td>3.25E+09</td>
						<td>PMMHS1932@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1143</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>UTTAR KHASDA IDEAL ACADEMY</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - DHANGAON,</td>
						<td>CONTAI - I</td>
						<td>CHELYAMA</td>
						<td>723146</td>
						<td>8.12E+09</td>
						<td>CHELYAMABC6017@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1144</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAMPUR VIVEKANANDA MISSION
							VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - CHAITANYAPUR,
						</td>
						<td>SUTAHATA</td>
						<td>KHAJURA</td>
						<td>723133</td>
						<td>9.8E+09</td>
						<td>MADHUTATIVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1145</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>ASNAN HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - NARIKELDAHA P.O. -
							ASNAN,</td>
						<td>MOYNA</td>
						<td>JANARDANDI</td>
						<td>723160</td>
						<td>9.93E+09</td>
						<td>HMJANARDANDIH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1146</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SRIRAMPUR UTTAMA SUNDARI
							GIRLS HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O.
							- SRIRAMPUR,</td>
						<td>TAMLUK</td>
						<td>SINDRI</td>
						<td>723127</td>
						<td>9.93E+09</td>
						<td>SINDRIHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1147</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAGMARI NARIKALYAN SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.- BAGMARI, P.O.
							- PRATAPDIGHI,</td>
						<td>POTASHPUR - II</td>
						<td></td>
						<td>723101</td>
						<td>3.25E+09</td>
						<td>CHITTARANJANGIRLSHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1148</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PORACHINGRA G. A. VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - PORACHINGRA</td>
						<td>BHAGAWANPUR - II</td>
						<td>RAKHERA BISHPURIA</td>
						<td>723130</td>
						<td>9.43E+09</td>
						<td>RAKHERAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1149</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DEULPOTA HIGH SCHOOL.</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - DEULPOTA P.O. -
							BARBASUDEBPUR,</td>
						<td>HALDIA</td>
						<td>SIMLA DHANARA</td>
						<td>723132</td>
						<td>9.73E+09</td>
						<td>SIMLAMAHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1150</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHOWKHALI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAJNABERIA</td>
						<td>CHANDIPUR</td>
						<td>GHATBERA-KEROWA</td>
						<td>723153</td>
						<td>9.93E+09</td>
						<td>GHATBERAKEROWAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1151</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KANCHANNAGAR DIDARUDDIN
							BIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KANCHANNAGAR P.O. -
							SAMSABAD,</td>
						<td>NANDIGRAM - I</td>
						<td>BARABAZAR</td>
						<td>723127</td>
						<td>3.25E+09</td>
						<td>BARABAZARVTC6029@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1152</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAISHNACHAK M.C. HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							BAISHNABCHAK,</td>
						<td>KOLAGHAT</td>
						<td>NOWAHATU</td>
						<td>723213</td>
						<td>9.43E+09</td>
						<td>KOTSHILAGIRLSHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1153</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>KURPAI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							KURPAI,</td>
						<td>TAMLUK</td>
						<td>BANDWAN</td>
						<td>723129</td>
						<td>3.25E+09</td>
						<td>DRANJHAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1154</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>HARASANKAR GARKILLA SANTAMAYI
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HARASANKAR,
						</td>
						<td>TAMLUK</td>
						<td></td>
						<td>723202</td>
						<td>3.25E+09</td>
						<td>JHALDA.GIRLS.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1155</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>MIRJANAGAR ARONGKIARANA
							JOGYESWAR SMRITI VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MIRJANAGAR,
						</td>
						<td>MOYNA</td>
						<td>CHAKALTORE</td>
						<td>723153</td>
						<td>9E+09</td>
						<td>KORADIH6038@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1156</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>KESHABPUR BHABATARAN BANI
							MANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							KESHABPUR,</td>
						<td>MAHISADAL</td>
						<td>NAPARA</td>
						<td>723151</td>
						<td>9.73E+09</td>
						<td>NAPARANETAJIACD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1157</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TAKAPURA ADARSHA VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - AMDABAD</td>
						<td>NANDIGRAM - II</td>
						<td>MANGALDA MOUTORE</td>
						<td>723133</td>
						<td>9.93E+09</td>
						<td>BNJMANGALDA@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1158</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>EKTARPUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							EKTARPUR</td>
						<td>BHAGAWANPUR - I</td>
						<td>RAKHERA BISHPURIA</td>
						<td>723130</td>
						<td>8.12E+09</td>
						<td>BISHPURIAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1159</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>RAMCHAK RAMESWAR VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							RAMCHAK (MOYNA),</td>
						<td>MOYNA</td>
						<td>MATHA</td>
						<td>723143</td>
						<td>9.73E+09</td>
						<td>PANDITRMAAV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1160</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>PATASPUR HAROCHARAN VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT- KASBA PATASPUR, P.O. - PATASPUR</td>
						<td>POTASHPUR - II</td>
						<td>BARA GRAM</td>
						<td>723103</td>
						<td>9.73E+09</td>
						<td>VTC6055@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1161</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BASUDEVPUR KANYA GURUKUL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.- BASUDEVPUR,
							P.O. - NANDAKUMAR,</td>
						<td>NANDA KUMAR</td>
						<td>JOYPUR</td>
						<td>723201</td>
						<td>9.93E+09</td>
						<td>VTC6057@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1162</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HIRAPUR DASAGRAM HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - HIRAPUR ,</td>
						<td>RAMNAGAR - I</td>
						<td>MANGALDA MOUTORE</td>
						<td>723145</td>
						<td>9.93E+09</td>
						<td>VOCATIONAL.6060@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1163</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>MUDIBARH VIVEKANANDA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - MUDIBARH,
						</td>
						<td>MOYNA</td>
						<td>PUNCHA</td>
						<td>723151</td>
						<td>9.73E+09</td>
						<td>RC.COLLEGE50@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1164</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>HARINARAYANCHAK VIDYAMANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - BIJAYRAMCHAK,
						</td>
						<td>PANSKURA</td>
						<td>GOURANDIH</td>
						<td>723121</td>
						<td>9.43E+09</td>
						<td>TSHS2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1165</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>BAJKUL JANAKALYAN
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- BAJKUL, P.O. - KISMAT
							BAJKUL,</td>
						<td>BHAGAWANPUR - II</td>
						<td></td>
						<td>723101</td>
						<td>3.25E+09</td>
						<td>NCVTC6066@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1166</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BARTANA PRAVATI ASHRAM HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT ,P.O. -
							BARTANA,</td>
						<td>EGRA - I</td>
						<td>DALDALI</td>
						<td>723101</td>
						<td>9.8E+09</td>
						<td>CBHS1952@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1167</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KANPUR SRIGURU SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KANPUR, P.O. -
							PATASHPUR</td>
						<td>POTASHPUR - II</td>
						<td>BELMA</td>
						<td>723126</td>
						<td>9.43E+09</td>
						<td>BELMASSRNHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1168</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>DABUAPUKUR HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O.
							- DABUAPUKUR,</td>
						<td>PANSKURA</td>
						<td>SIRKABAD</td>
						<td>723154</td>
						<td>9.74E+09</td>
						<td>PURULIA.SIRKABAD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1169</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KEUTGERIA VIDYASAGAR HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KEUTGERIA,
						</td>
						<td>EGRA - II</td>
						<td>HURA</td>
						<td>723130</td>
						<td>9E+09</td>
						<td>HURAHIGHSCHOOL6084@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1170</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>KALINDI UNION GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT - P.O. - KALINDI,
						</td>
						<td>RAMNAGAR - II</td>
						<td>BELA</td>
						<td>723143</td>
						<td>9.93E+09</td>
						<td>HMMALTI6088@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1171</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BARGODA GODAR KRISHNA SMRITI
							VIDYANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							BARGODA GODAR,</td>
						<td>NANDA KUMAR</td>
						<td>KUMARI</td>
						<td>723131</td>
						<td>9.48E+09</td>
						<td>KUMARIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1172</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>LAKSHYA GIRLS HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + P.O. - LAKSHYA</td>
						<td>MAHISADAL</td>
						<td>KESHARGARH</td>
						<td>723130</td>
						<td>9.65E+09</td>
						<td>KESHARGARHVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1173</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DHULIAPUR PALLEESHREE BANI
							MANDIR</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							DHULIAPUR,</td>
						<td>PANSKURA</td>
						<td>BERO</td>
						<td>723133</td>
						<td>9.43E+09</td>
						<td>SRCAVIDYALAYA35@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1174</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>NARAYANCHAK HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. ,NARAYANCHAK,
							P.O. - TERAPEKHIA,</td>
						<td>NANDIGRAM - II</td>
						<td>MARU MOSINA</td>
						<td>723202</td>
						<td>9.68E+09</td>
						<td>WBSCVET6098@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1175</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MUKTAMALA ARYA KANYA
							VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KAURCHANDI, P.O. -
							AMALHARA,</td>
						<td>KOLAGHAT</td>
						<td>KUILAPAL</td>
						<td>723129</td>
						<td>8.77E+09</td>
						<td>KSSHSVOCATIONAL@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1176</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>GOBINDANAGAR MUSLIM HIGH
							SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - GOBINDANAGAR, P.O. -
							GOLGHAT,</td>
						<td>PANSKURA</td>
						<td>MANGURIA LALPUR</td>
						<td>723130</td>
						<td>9.93E+09</td>
						<td>HURATHANAMAACADEMY@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1177</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DARUA GANDHI SMRITI JR. HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							DARUA</td>
						<td>CONTAI (M)</td>
						<td>GAGNABAID</td>
						<td>723121</td>
						<td>9.48E+09</td>
						<td>ABITTU_007@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1178</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>ANANTAPUR BANI NIKETAN GIRLS
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - ANANTAPUR, P.O. -
							CHANSERPUR,</td>
						<td>TAMLUK</td>
						<td>ANARA</td>
						<td>723126</td>
						<td>9.93E+09</td>
						<td>ANARAVTC6107@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1179</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SHYAMSUNDARPUR PATNA KRISHNA
							CHARAN BALIKA VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - HARIKRISHNAPUR, P.O.
							- S.S.PATNA,</td>
						<td>PANSKURA</td>
						<td>BABUGRAM</td>
						<td>723133</td>
						<td>9.48E+09</td>
						<td>BABUGRAMSAMMILANIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1180</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>ASUTIA SAROJINI VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O- ASUTIA,</td>
						<td>BHAGAWANPUR - I</td>
						<td>RAIBANDH</td>
						<td>723133</td>
						<td>9.8E+09</td>
						<td>NDDHS6116@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1181</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SULTANPUR STRI SIKSHA NIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SULTANPUR BAZAR</td>
						<td>CHANDIPUR</td>
						<td>MURADIH</td>
						<td>723156</td>
						<td>9.93E+09</td>
						<td>WBSCVET6179@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1182</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MANUA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL.- MANUA, P.O. -
							SAJINAGECHAYA,</td>
						<td>KOLAGHAT</td>
						<td></td>
						<td>723133</td>
						<td>9.93E+09</td>
						<td>GDLIVTC6191@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1183</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MOHAMMADPUR D.U. SENIOR
							MADRASHA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - MOHAMMADPUR, P.O. -
							NILPUR,</td>
						<td>NANDIGRAM - I</td>
						<td>FATEPUR</td>
						<td>741249</td>
						<td>3.47E+09</td>
						<td>19101711401.HSB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1184</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KANAKPUR MADRASAH SHIKSHA
							KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KANAKPUR, P.O. -
							PANSKURA,</td>
						<td>PANSKURA (M)</td>
						<td>MAYURHAT-II</td>
						<td>741505</td>
						<td>9.47E+09</td>
						<td>19101205505HSC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1185</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>AHAMMADPUR SRIKANTA MADHYAMIK
							SIKSHA KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - AHAMMADPUR, P.O. -
							DAKSHIN KALYANPUR,</td>
						<td>RAMNAGAR - II</td>
						<td>MAYAPUR BARMANPUKUR-I</td>
						<td>741313</td>
						<td>3.47E+09</td>
						<td>VOCATIONALBPHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1186</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>AYMA BARBARIA MADANMOHAN
							M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							AYMABARBARIA,</td>
						<td>POTASHPUR - I</td>
						<td>SARATI</td>
						<td>741235</td>
						<td>9.23E+09</td>
						<td>CKHSKALYANI1960@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1187</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>HIJALBERIA M.S.K.</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. -
							HIJALBERIA,</td>
						<td>TAMLUK</td>
						<td>TATLA-II</td>
						<td>741222</td>
						<td>3.47E+09</td>
						<td>DHANICHAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1188</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td></td>
						<td>70 NO. JALPAI MADHAYMIK
							SIKSHAKENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KALAPEENIA, P.O. -
							DHANYAGHAR</td>
						<td>NANDA KUMAR</td>
						<td>PALSUNDA-I</td>
						<td>741156</td>
						<td>3.47E+09</td>
						<td>PALSUNDA.VOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1189</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td>BCRS</td>
						<td>AMULYA BIDYABHABAN HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							RAINE,</td>
						<td>kolaghat</td>
						<td>DHUBULIA-I</td>
						<td>741139</td>
						<td>3.47E+09</td>
						<td>DITYA2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1190</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td>ETEM</td>
						<td>BARBARIA BALIKA VIDYALAYA
							(HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp;P.O. -
							BARBARIA,</td>
						<td>BHAGAWANPUR - II</td>
						<td>KRISHNAGANJ</td>
						<td>741506</td>
						<td>3.47E+09</td>
						<td>KRISHNAGANJ.VOC6273@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1191</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RANICHAK PRASANNA KUMAR
							SIKSHANIKATAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - TAKAPURA,</td>
						<td>NANDIGRAM - II</td>
						<td></td>
						<td>741250</td>
						<td>9.43E+09</td>
						<td>CDSVOC6276@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1192</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DEULIA HIRARAM HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + POST - DEULIA,</td>
						<td>KOLAGHAT</td>
						<td></td>
						<td>741302</td>
						<td>9.43E+09</td>
						<td>NABADWIPSIKSHAMAINDIR6280@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1193</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>CHIRULIA BIBARTAN BIDYABHABAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT ,P.O. - CHIRULIA
						</td>
						<td>EGRA - I</td>
						<td>DOGACHHI</td>
						<td>741101</td>
						<td>3.47E+09</td>
						<td>KRISHNAGARHIGHSCHOOL@KRISHNAGARHIGHSCHOOL.ORG</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1194</td>
						<td>ETCM</td>
						<td>ETIA</td>
						<td></td>
						<td>BARSUNDRA HIGH SCHOOL (H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - BARSUNDRA, P.O. -
							ISWARDAHA JALPAI,</td>
						<td>HALDIA</td>
						<td></td>
						<td>741250</td>
						<td>3.33E+09</td>
						<td>19102401002.HSC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1195</td>
						<td>ETCM</td>
						<td>AGPM</td>
						<td></td>
						<td>KAKRA BALIKA VIDYAPITH (JR.
							HIGH)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - KAKRA,</td>
						<td>BHAGWANPUR - 1</td>
						<td>NAKASHIPARA</td>
						<td>741126</td>
						<td>9.23E+09</td>
						<td>NAKASHIPARAHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1196</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>AMJADNAGAR ASHUTOSH-UMESH
							SIKSHASADAN (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - AMJADNAGAR, P.O. -
							KAMARDA BAZAR,</td>
						<td>KHEJURI - I</td>
						<td>SILINDA-II</td>
						<td>741223</td>
						<td>9.8E+09</td>
						<td>MAILS2WBSCVET6295@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1197</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td>ETEM</td>
						<td>GURUKUL VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - KAURCHANDI, P.O. -
							AMALHARA,</td>
						<td>KOLAGHAT</td>
						<td>BAGULA-II</td>
						<td>741502</td>
						<td>3.47E+09</td>
						<td>BAGULAHSD2009@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1198</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>2ND PART JALPAI SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. - 2ND JALPAI, P.O. -
							BARAGHUNI,</td>
						<td>CHANDIPUR</td>
						<td>HARINGHATA-I</td>
						<td>741249</td>
						<td>9.09E+09</td>
						<td>LAUPALAKALPATARUHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1199</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>UTTAR KACHUA MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - SHYAMPUR,</td>
						<td>RAMNAGAR - II</td>
						<td>SWARUPGANJ</td>
						<td>741315</td>
						<td>3.47E+09</td>
						<td>HEADSBV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1200</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td>ETEM</td>
						<td>SRIKRISHNAPUR SITALA GIRLS
							HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL &amp; P.O. -
							SRIKRISHNAPUR,</td>
						<td>CHANDIPUR</td>
						<td>BETNA GOBINDAPUR</td>
						<td>741505</td>
						<td>3.47E+10</td>
						<td>HANSKHALIHIGHSCHOOLVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1201</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>SONAPETYA HIGH SCHOOL ( H.S.)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - SONAPETYA, P.O.-
							GOBINDAPUR,</td>
						<td>SAHID MATANGINI</td>
						<td>KASTODANGA-II</td>
						<td>741257</td>
						<td>8.1E+09</td>
						<td>NRHS6341@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1202</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PASCHIM AGRANYA M.S.K</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- KALSI</td>
						<td>POTASHPUR - II</td>
						<td>PATIKABARI</td>
						<td>741126</td>
						<td>9.9E+09</td>
						<td>PATIKABARIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1203</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JERTHAN GAYAPRASAD VIDYAPITH
							(HIGH)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL. &amp; P.O. - JERTHAN</td>
						<td>EGRA - I</td>
						<td>RAMNAGAR-I</td>
						<td>741201</td>
						<td>3.47E+09</td>
						<td>RMBSN6422@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1204</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>GOALDA SUKANTA MADHYAMIK
							SHIKSHA KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT - GOALDA, P.O.- SRIRAMPUR,</td>
						<td>POTASHPUR - I</td>
						<td>PLASSEY-II</td>
						<td>741157</td>
						<td>3.47E+09</td>
						<td>PLASSEY.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1205</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>CHANDIA MADHYAMIK SIKSHA
							KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-CHANDIA, P.O.-
							RAIPURPASCHIMBAR,</td>
						<td>CONTAI - I</td>
						<td>NASHIPUR</td>
						<td>742169</td>
						<td>3.48E+09</td>
						<td>NASHIPURHIGHSCHOOLMSD@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1206</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>TEPARPARA SASHIBHUSANHIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- PATASHPUR,</td>
						<td>POTASHPUR - I</td>
						<td>SOMPARA-I</td>
						<td>742163</td>
						<td>9.78E+09</td>
						<td>DOPUKURIAHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1207</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td></td>
						<td>GOBINDAPUR MADHYAMIK
							SIKSHAKENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- GOBINDAPUR, P.O.-
							RADHABALLAVPUR</td>
						<td>TAMLUK</td>
						<td>NABAGRAM</td>
						<td>742184</td>
						<td>9.43E+09</td>
						<td>NABAGRAMHIGHSCHOOL2013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1208</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>PANIA SARADABARH R.K. SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- PANIA,</td>
						<td>POTASHPUR - II</td>
						<td>SAGARDIGHI</td>
						<td>742226</td>
						<td>9.43E+09</td>
						<td>SAGARDIGHIS.N.HIGHSCHOOLVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1209</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAJARAMPUR SAGAR SMRITI
							VAIDIC VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - RAJARAMPUR, P.O.-
							KHAGDA BIRGRAM,</td>
						<td>CHANDIPUR</td>
						<td>MAHISASHTHALI</td>
						<td>742135</td>
						<td>3.48E+09</td>
						<td>BHAGABANGOLAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1210</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td></td>
						<td>MAHAMMADPUR DESHAPRAN
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - MAHAMMADPUR,
						</td>
						<td>BHAGAWANPUR - I</td>
						<td>AHIRON</td>
						<td>742223</td>
						<td>9.47E+09</td>
						<td>BANGABARIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1211</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>NAZIR BAZAR HARENDRA HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O. - NAZIR BAZAR,
						</td>
						<td>BHAGAWANPUR - II</td>
						<td>JARUR</td>
						<td>742225</td>
						<td>(03483)266157</td>
						<td>MAIL2SRIKANTABATI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1212</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>LAKSHI AVINABA VIDYALAYA</td>
						<td>PURBA MIDNAPORE</td>
						<td>AT - VILL.+ P.O.- LAKSHI</td>
						<td>KHEJURI - I</td>
						<td>BURWAN-I</td>
						<td>742132</td>
						<td>9.73E+09</td>
						<td>BURWAN.NS.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1213</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAMPI HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + P.O.- CHAMPI,
						</td>
						<td>MAHISADAL</td>
						<td>LALGOLA</td>
						<td>742148</td>
						<td>9.43E+09</td>
						<td>BIJUBLACK@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1214</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td></td>
						<td>KISHORECHAK BANAMALI HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O- NAMALBARD,</td>
						<td>KOLAGHAT</td>
						<td>BANNYESWAR</td>
						<td>742227</td>
						<td>7.41E+09</td>
						<td>SHEIKDIGHIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1215</td>
						<td>ETCM</td>
						<td>HSFN</td>
						<td></td>
						<td>NACHINDA J.K. GIRLS' HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL - NACHINDA, P.O.-
							NACHINDA BAZAR,</td>
						<td>CONTAI - III</td>
						<td>MAHISASHTHALI</td>
						<td>742135</td>
						<td>9.93E+09</td>
						<td>SHM1965HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1216</td>
						<td>ETCM</td>
						<td>AGCF</td>
						<td></td>
						<td>UTTARBARH HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- CHABUKIA
							UTTARBARH,</td>
						<td>BHAGAWANPUR - I</td>
						<td></td>
						<td>742213</td>
						<td>3.48E+09</td>
						<td>HMJHS1877@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1217</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>DHAKRABANKA DESHAPRAN
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O.- DHAKRABANKA,</td>
						<td>POTASHPUR - I</td>
						<td></td>
						<td>742103</td>
						<td>3.48E+09</td>
						<td>SMCVPVOC@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1218</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td></td>
						<td>BHOLSARA DWARIKANATH HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- AMRITBERIA,
						</td>
						<td>MAHISADAL</td>
						<td>HARIHARPARA</td>
						<td>742166</td>
						<td>3.48E+09</td>
						<td>HARIHARPARAHIGHSCHOOL6795@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1219</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSFN</td>
						<td>JOYNAGAR HIGH SCHOOL (HS)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- DORO JOYNAGAR ,
						</td>
						<td>SUTAHATA</td>
						<td></td>
						<td>742123</td>
						<td>3.48E+09</td>
						<td>JRBSVM@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1220</td>
						<td>ETCM</td>
						<td>HSHM</td>
						<td>ETEM</td>
						<td>PICHALDA HIGH SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-PICHALDA, P.O.-
							ASHUTIABARH,</td>
						<td>CHANDIPUR</td>
						<td>AMARKUNDA</td>
						<td>742136</td>
						<td>9.43E+09</td>
						<td>AKKVM.6798@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1221</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JUKIVERI MATANGINI VIDYAPITH
							(HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- JUKIVERI, P.O.- RAIPUR
							PASCHIMBAR, VIA CONTAI,</td>
						<td>CONTAI - III</td>
						<td>BALIA</td>
						<td>742237</td>
						<td>9E+09</td>
						<td>BALIAHIGHSCHOOLVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1222</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHANDANPUR ANANDA INSTITUTION
							(H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- CHANDANPUR,
						</td>
						<td>POTASHPUR - II</td>
						<td>CHANCHANDA</td>
						<td>742224</td>
						<td>9.15E+09</td>
						<td>CHACHANDABJHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1223</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KANCHANPUR JALPAI MADHYAMIK
							SIKSHA KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL-KANCHANPUR, P.O.-
							KESHABOUR JALPAI,</td>
						<td>MAHISADAL</td>
						<td>BIPRASEKHAR</td>
						<td>742132</td>
						<td>9.93E+09</td>
						<td>SAMATARI2015@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1224</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>KASTHAKHALI HARIPADA SMRITI
							MADHYAMIK SIKSHA KENDRA</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- KASTHAKHALI, P.O.-
							ISWARDAHAJALPAI,</td>
						<td>HALDIA</td>
						<td>AZIMGONG GOLA</td>
						<td>742406</td>
						<td>3.48E+09</td>
						<td>VTC6818@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1225</td>
						<td>ETCM</td>
						<td>ETCE</td>
						<td>AGHC</td>
						<td>KOREKHALI MILANI
							SIKSHANIKETAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- MAJANBERIA,</td>
						<td>CHANDIPUR</td>
						<td>PADAMKANDI</td>
						<td>742159</td>
						<td>3.48E+09</td>
						<td>PURAPARA.VOC6819@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1226</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAUDPUR N.S.A. ADARSHA
							VIDYALAYA (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>P.O.- URDHABPUR,</td>
						<td>EGRA - II</td>
						<td>SIMULIA</td>
						<td>713123</td>
						<td>3.48E+09</td>
						<td>SIMULIATPI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1227</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>SUKHAKHOLA VIVEKANANDA SIKSHA
							SADAN</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL &amp; P.O.- SUKHAKHOLA,
							VIA - ARGOAL,</td>
						<td>POTASHPUR - II</td>
						<td>JAMUR</td>
						<td>742235</td>
						<td>3.48E+09</td>
						<td>WWW.BARALARAMDASSENHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1228</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAKNAN MILANI BALIKA
							VIDYAPITH (HIGH SCHOOL)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O.- CHAKNAN,
						</td>
						<td>CHANDIPUR</td>
						<td>DADPUR</td>
						<td>742189</td>
						<td>9.43E+09</td>
						<td>DADPURHIGHSCHOOL.6825@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1229</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BRAJAKISHOREPUR DESHAPRAN
							GANGARAM HIGH SCHOOL (H.S)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- BRAJAKISHOREPUR, P.O-
							ARGOAL,</td>
						<td>POTASHPUR - II</td>
						<td>TENTULIA</td>
						<td>742302</td>
						<td>9.43E+09</td>
						<td>GHSVOC6826@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1230</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KAMALPUR-MAJID-JAHIR-ISLAMIYA
							MADRASHA (JUNIOR HIGH)</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL+P.O- KAMALPUR,
						</td>
						<td>NANDIGRAM - II</td>
						<td>EROALI</td>
						<td>742147</td>
						<td>9.73E+09</td>
						<td>KANDURIAHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1231</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BAHIRI PURNIMA GIRLS HIGH
							SCHOOL</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL + P.O- DEULBARH,
						</td>
						<td>CONTAI - III</td>
						<td>GOKARNA-I</td>
						<td>742136</td>
						<td>9.47E+09</td>
						<td>GOKARNAPMHIGHSCHOOL20013@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1232</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHIRULIA SRINATH CHANDRA
							VIDYAPITH</td>
						<td>PURBA MIDNAPORE</td>
						<td>VILL- CHIRULIA, P.O-
							MAHESPUR,</td>
						<td>EGRA - II</td>
						<td>RANGAMATI CHANDPARA</td>
						<td>742405</td>
						<td>3.48E+09</td>
						<td>MADHUPUR_MRSV@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1233</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>JYOTIRMOY BOSE VOCATIONAL
							TRAINING CENTRE</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. CHAORA, P.O. SARISHA ,</td>
						<td>DIAMOND HARBOUR - II</td>
						<td>KAZIGRAM</td>
						<td>732103</td>
						<td>9.83E+09</td>
						<td>IMPSCET@LIVE.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1234</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>BIRLAPUR VIDYALAYA (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - BIRLAPUR</td>
						<td>BUDGE BUDGE - I</td>
						<td>MAHABARI</td>
						<td>733121</td>
						<td>9.78E+09</td>
						<td>KUSHKARIKBBSVOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1235</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>R.K. MISSION ITC, NARENDRAPUR</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - NARENDRAPUR</td>
						<td>RAJPUR SONARPUR (M)</td>
						<td>HARSURA</td>
						<td>733140</td>
						<td>9.8E+09</td>
						<td>RAMPURHIGHSCHOOLVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1236</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>TILOTTAMA BALIKA VIDYALAYA
							(H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL.-DURGAPUR,P.O.-DURGAPUR-BARUIPUR,</td>
						<td>BARUIPUR</td>
						<td></td>
						<td>733101</td>
						<td>3.52E+09</td>
						<td>HM.KGHS@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1237</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>KAKDWIP BIRENDRA VIDYANIKETAN
							(H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KAKDWIP</td>
						<td>KAKDWIP</td>
						<td></td>
						<td>733124</td>
						<td>9.43E+09</td>
						<td>JYOTIRMOY.HM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1238</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>CANNING DAVID SASSOON HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>MITHAKHALI, CANNING TOWN</td>
						<td>CANNING - I</td>
						<td>RADHIKAPUR</td>
						<td>733129</td>
						<td>9.93E+09</td>
						<td>RADHIKAPURHIGHSCHOOL.1941@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1239</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>SUNDARBAN ADARSHA VIDYAMANDIR</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - KAKDWIP</td>
						<td>KAKDWIP</td>
						<td>PURBA KANTHALBARI</td>
						<td>736204</td>
						<td>3.56E+09</td>
						<td>SLBHS.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1240</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>RAIDIGHI SRIFALTALA
							CHANDRAKANTA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - SRIFALTALA, P.O.-
							RAIDIGHI</td>
						<td>MATHURAPUR - II</td>
						<td>DEOGAON</td>
						<td>735213</td>
						<td>3.56E+09</td>
						<td>DEOGAONHS70@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1241</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>DAKSHIN KASHINAGAR HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - DAKSHIN
							KASHINAGAR,</td>
						<td>PATHARPRATIMA</td>
						<td>RUIDANGA</td>
						<td>735211</td>
						<td>9.93E+09</td>
						<td>ATPUKURI.HS@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1242</td>
						<td>ETIA</td>
						<td></td>
						<td></td>
						<td>NIMPITH RAMAKRISHNA
							VIDYABHAVAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O.-NIMPITH ASHRAM,
						</td>
						<td>JAYNAGAR - II</td>
						<td>BARASOLMARI</td>
						<td>735211</td>
						<td>9.43E+09</td>
						<td>SINGIJANIHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1243</td>
						<td>ETIA</td>
						<td>ETEM</td>
						<td></td>
						<td>BHUBANESWARI JOYKRISHNA HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - BHUBANESWARI BAZAR</td>
						<td>KULTALI</td>
						<td>FULBARI</td>
						<td>735210</td>
						<td>9.73E+09</td>
						<td>KSHETIHIGHSCHOOLHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1244</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>SARANGABAD HIGH SCHOOL (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL - SARANGABAD, P.O. -
							SARANGABAD, VIA - BUDGE BUDGE</td>
						<td>MAHESHTALA (M)</td>
						<td></td>
						<td>743437</td>
						<td>3.22E+09</td>
						<td>ARBALIAJVHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1245</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>SATAL KALSA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KALSA</td>
						<td>FALTA</td>
						<td>HAROA</td>
						<td>743425</td>
						<td>9.73E+09</td>
						<td>HAROA.P.G.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1246</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>PATHANKHALIADARHA
							VIDYAPITH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL &amp; P.O. - PATHANKALI</td>
						<td>GOSABA</td>
						<td>KASHIMPUR</td>
						<td>743248</td>
						<td>3.33E+09</td>
						<td>KASHIMPURHIGH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1247</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>BHUBANNAGAR HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - BHUBANNAGAR</td>
						<td>KAKDWIP</td>
						<td></td>
						<td>700137</td>
						<td>3.32E+08</td>
						<td>BADAMTALAHM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1248</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>JAYNAGAR P.C. PAUL
							INSTITUTION</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - TILIPARA
							P.O.-JAYNAGAR MAJILPUR</td>
						<td>JAYNAGAR MAZILPUR (M)</td>
						<td>BANESWARPUR-II</td>
						<td>711314</td>
						<td>03214-263168</td>
						<td>GSNV125@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1249</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KOTALPUR MADHUSUDAN HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KUNDARALI</td>
						<td>BARUIPUR</td>
						<td>BISHNUBAR-I</td>
						<td>721630</td>
						<td>9.93E+09</td>
						<td>NTI1938@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1250</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KHANRAPARA HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KHARI</td>
						<td>MATHURAPUR - II</td>
						<td>HAUR G.P</td>
						<td>721152</td>
						<td>3.23E+09</td>
						<td>HATESWAR.HIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1251</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>DOSTAPUR HIGH SCHOOL (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - DOSTAPUR</td>
						<td>FALTA</td>
						<td>JORAKEUDI SOLIDIHA</td>
						<td>721147</td>
						<td>9.73E+09</td>
						<td>NIRMAL.DEEP@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1252</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>CHATTA SUBID ALI INSTITUTE
							(H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - CHATTA KALIKAPUR</td>
						<td>THAKURPUKUR MAHEHSTALA</td>
						<td>MAKRAMPUR</td>
						<td>721437</td>
						<td>3.22E+09</td>
						<td>UKM111068@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1253</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KHANDALIA HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KALATALAHAT</td>
						<td>DIAMOND HARBOUR - II</td>
						<td>BENACHAPRA</td>
						<td>721121</td>
						<td>3.23E+09</td>
						<td>MHSHS1970@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1254</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>GOCHARAN GIRLS HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - GOCHARAN</td>
						<td>JAYNAGAR - I</td>
						<td>ERAL</td>
						<td>713144</td>
						<td>3.45E+09</td>
						<td>ERALHIGHSCH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1255</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>RANGABELIA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - RANGABELIA</td>
						<td>GOSABA</td>
						<td>SIMULIA-I</td>
						<td>713143</td>
						<td>3.45E+09</td>
						<td>MATHRUNNCINS@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1256</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KALIKAPUR B.D. BALIKA
							VIDYALAYA</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - KALIKAPUR</td>
						<td>SONARPUR</td>
						<td>TALDANGRA</td>
						<td>722152</td>
						<td>265310</td>
						<td>TALDANGRA5006@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1257</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>FALTA VIVEKANANDA ADARSHA
							VIDYALAYA</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - FALTA</td>
						<td>FALTA</td>
						<td>UDAIPUR JOINAGAR</td>
						<td>723155</td>
						<td>9.93E+09</td>
						<td>UDAYPURHIGHSCHOOL6065@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1258</td>
						<td>ETEM</td>
						<td>ETAT</td>
						<td></td>
						<td>JULPIA ANDHARMANIK HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - ANDHARMANIK</td>
						<td>BISHNUPUR - I</td>
						<td></td>
						<td>741101</td>
						<td>3.47E+09</td>
						<td>ITCBPC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1259</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>BADAMTALA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>35/A, K.P. MONDAL RD, BUDGE
							BUDGE</td>
						<td>BUDGE BUDGE (M)</td>
						<td></td>
						<td>742139</td>
						<td>9.47E+09</td>
						<td>RAHSVET6756@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1260</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KASHINAGAR GIRLS HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. &amp; VILL. - KASHINAGAR</td>
						<td>MATHURAPUR - II</td>
						<td>HARIDASMATI</td>
						<td>742165</td>
						<td>3.48E+09</td>
						<td>BHSMSD1962@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1261</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>DADPUR GUNJUR PUR D. U. S.
							SENIOR MADRASAH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - UTTAR BALLAVPUR</td>
						<td>MANDIRBAZAR</td>
						<td>JAJAN</td>
						<td>742140</td>
						<td>3.48E+09</td>
						<td>JKHSVTC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1262</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KRISHNACHANDRAPUR HIGH SCHOOL
							H.S</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - KRISHNACHANDRAPUR</td>
						<td>MATHURAPUR - I</td>
						<td></td>
						<td>742213</td>
						<td>3.48E+09</td>
						<td>JMHMADRASAH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1263</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>JNAN CHANDRA GHOSH
							POLYTECHNIC (FALTA EXTN. - COMMUNITY POLYTECHNIC)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>FALTA,SECTOR-III,NKALATALAHAT</td>
						<td>DIAMOND HARBOUR - II</td>
						<td>SATUI CHOWRIGECHHA</td>
						<td>742405</td>
						<td>8.35E+09</td>
						<td>MONDAL.PIJUSH333@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1264</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>NETRA HIGH MADRASAH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL.&amp; P.O. -
							NETRA</td>
						<td>DIAMOND HARBOUR - I</td>
						<td>MOTHABARI</td>
						<td>732207</td>
						<td>9.93E+09</td>
						<td>MOTHABARIHIGHSCHOOL702@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1265</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>JOYNAGAR INSTITUTIONS FOR
							GIRLS</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>JOYNAGAR MOZILPUR</td>
						<td>JAYNAGAR MAZILPUR (M)</td>
						<td>ARAIDANGA</td>
						<td>732204</td>
						<td>3.51E+09</td>
						<td>ARAIDANGADBM@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1266</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>MORAPAI ST. PATRICKS HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							MORAPAI</td>
						<td>MAGRAHAT - I</td>
						<td>LAXMIPUR</td>
						<td>732207</td>
						<td>9.73E+09</td>
						<td>AZAMAN4U@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1267</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>AKSHAYNAGAR JNANADAMOYEE
							VIDYANIKETAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. + P.O. -
							AKSHAYNAGAR,</td>
						<td>KAKDWIP</td>
						<td>DEBIPUR</td>
						<td>732125</td>
						<td>3.51E+09</td>
						<td>BRMMMV@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1268</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>BHANGAR A.H. HIGH MADRASAH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>BHANGAR</td>
						<td>BHANGAR - I</td>
						<td>JATESWAR-II</td>
						<td>735216</td>
						<td>9.73E+09</td>
						<td>JATESWAR.HIGH.SCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1269</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>KEYATALA HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							KEYATALA</td>
						<td>BARUIPUR</td>
						<td>GARALBARI</td>
						<td>735132</td>
						<td>9.93E+09</td>
						<td>BEBERUBARITFHS1983.JAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1270</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>MUCHISHA HARIDAS KRISHI SILPA
							VIDYAPITH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>MUCHISHA</td>
						<td>BUDGE BUDGE - II</td>
						<td>BIRPARA-I</td>
						<td>735204</td>
						<td>3.56E+09</td>
						<td>BIRPARAHIGHSCHOOL8764@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1271</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>NABASAN TUSTUCHARAN HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL.-NABASAN, P.O. -
							BHATHERIA</td>
						<td>FALTA</td>
						<td>CHOWDHURYHAT</td>
						<td>736168</td>
						<td>253264</td>
						<td>CVVM_CHT@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1272</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>NAMKHANA NARAYAN VIDYAMANDIR
							(H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - NARAYANPUR, P.O. -
							NAMKHANA</td>
						<td>NAMKHANA</td>
						<td></td>
						<td>735122</td>
						<td>3.56E+09</td>
						<td>HALDIBARIHIGHSCHOOLCOOB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1273</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>PURNACHANDRAPUR CHANDMONI
							SIKSHA BHABAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>PURNACHANDRAPUR</td>
						<td>PATHARPRATIMA</td>
						<td>&nbsp;</td>
						<td>736135</td>
						<td>3.58E+09</td>
						<td>DINHATASDJHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1274</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>MAHESPUR JASODA VIDYAPITH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O.- ANANDABAD,</td>
						<td>BASANTI</td>
						<td>PER MEKHLIGANJ</td>
						<td>735122</td>
						<td>9.43E+09</td>
						<td>DEWANGANJHIGHSCHOOLHSCOOB@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1275</td>
						<td>ETEM</td>
						<td></td>
						<td></td>
						<td>MATHUR J.M. HIGH SCHOOL
							(H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>MATHUR, RAMNAGAR</td>
						<td>DIAMOND HARBOUR - II</td>
						<td>NAXALBARI</td>
						<td>734429</td>
						<td>9.43E+09</td>
						<td>DPN150478@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1276</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BELSINGHA SIKSHAYATAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							BESINGHA</td>
						<td>FALTA</td>
						<td></td>
						<td>700084</td>
						<td>3.32E+09</td>
						<td>MAHENDRANATHHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1277</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>BUGHMARI ISLAMIA HIGH
							MADRASAH (HIGHER SECONDARY )</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - BUGFHMARI, P.O. -
							DEWANCHAK</td>
						<td>BARUIPUR</td>
						<td></td>
						<td>700002</td>
						<td>3.33E+09</td>
						<td>SREEGOPALVIDYAMANDIR0033@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1278</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KULPI JANAPRIYA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. P.O. - KULPI</td>
						<td>KULPI</td>
						<td></td>
						<td>700010</td>
						<td>23632681</td>
						<td>HMRAMMOHAN@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1279</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DURBACHATI MILAN VIDYAPITH
							(H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>AT - RADHAKRISHNANAGAR, P.O.
							- DURBACHATI.</td>
						<td>PATHARPRATIMA</td>
						<td></td>
						<td>700060</td>
						<td>3.32E+09</td>
						<td>BPBIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1280</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RAJNAGAR SRINATHGRAM BANI
							VIDYAPITH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O-RAJNAGAR,</td>
						<td>NAMKHANA</td>
						<td></td>
						<td>700008</td>
						<td>3.32E+09</td>
						<td>ABASU.2011@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1281</td>
						<td>ETCM</td>
						<td>HSHM</td>
						<td></td>
						<td>MADARPARA HIGH MADRASAH</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O -DHOLAHAT</td>
						<td>MATHURAPUR - I</td>
						<td></td>
						<td>700023</td>
						<td>3.32E+09</td>
						<td>BGMGHS@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1282</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MAHIRAMPUR HIGH SCHOOL (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O - MAHIRAMPUR,
						</td>
						<td>FALTA</td>
						<td></td>
						<td>743233</td>
						<td>3.22E+09</td>
						<td>WITIBANIPUR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1283</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>BALARAMPUR MANMATHA NATH
							VIDYAMANDIR</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - BONHOOGHLY, VIA
							NARENDRAPUR,</td>
						<td>SONARPUR</td>
						<td>KHOLAPOTA</td>
						<td>743428</td>
						<td>03217-249486</td>
						<td>KHOLAPOTASATP@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1284</td>
						<td>ETCM</td>
						<td>BCLS</td>
						<td>ETEM</td>
						<td>NARAYANITALA DHANESWAR SIKSHA
							SADAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. SOUTH SHIBPUR, P.O. -
							FRESERGANJ, VIA NAMKHANA</td>
						<td>NAMKHANA</td>
						<td>SANDESHKHALI</td>
						<td>743446</td>
						<td>9.13E+09</td>
						<td>SRHS59@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1285</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>ARIAPARA HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - MOHANPUR, P.O. -
							ARYAPARA,</td>
						<td>BUDGE BUDGE - II</td>
						<td>SARBERIA AGARHATI</td>
						<td>743329</td>
						<td>9.8E+09</td>
						<td>AGARHATIGOURHARIVIDYAPITH@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1286</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GOSABA R. R. GOVT. SPONSORED
							INSTITUTION</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - GOSABA</td>
						<td>GOSABA</td>
						<td>KHULNA</td>
						<td>743446</td>
						<td>9.73E+09</td>
						<td>KPCLV12@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1287</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td></td>
						<td>GOBINDARAMPUR ASWINI KUMAR
							HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							GOBINDARAMPUR,</td>
						<td>KAKDWIP</td>
						<td>CHARGHAT G.P</td>
						<td>743247</td>
						<td>3.22E+09</td>
						<td>CMMVVOC1016@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1288</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>SHIBKALI NAGAR ISHAN MEMORIAL
							HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							SHIBKALINAGAR,</td>
						<td>KAKDWIP</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1289</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETEM</td>
						<td>BHADRAPARA GILARCHAT HIGH
							SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - GILARCHAT,</td>
						<td>MATHURAPUR - II</td>
						<td>MARICHA</td>
						<td>743711</td>
						<td>9.43E+09</td>
						<td>BSSVM67@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1290</td>
						<td>ETCM</td>
						<td>AGAH</td>
						<td>ETEM</td>
						<td>GANIPUR HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - GANIPUR, P.S. -
							MAHESHTALA</td>
						<td>MAHESHTALA (M)</td>
						<td>MALLPOTA</td>
						<td>743297</td>
						<td>8.7E+09</td>
						<td>JIS_BISHU_MCA@YAHOO.CO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1291</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>CHAK PANCHGHORA SITANATH HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - PASCHIM CHAK
							PANCHGHORA, P.O. - PUNPUA,</td>
						<td>JAYNAGAR - I</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1292</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DHAMUA BALIKA VIDYALAYA</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							DHAMUA,</td>
						<td>MAGRAHAT - II</td>
						<td></td>
						<td>743222</td>
						<td>3.22E+09</td>
						<td>ABBV1965@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1293</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>RADHANAGAR B. N. M.
							INSTITUTION</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL.- RADHANAGAR,
							P.O. - SHYAMPUR,</td>
						<td>MAGRAHAT - II</td>
						<td></td>
						<td>743145</td>
						<td>3.33E+09</td>
						<td>KANCH1949@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1294</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>JADAVPUR HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL-JADAVPUR,
							P.O.-JADAVPURHAT,</td>
						<td>MATHURAPUR - I</td>
						<td></td>
						<td>743272</td>
						<td>3.22E+09</td>
						<td>BIDHANBIDYAPITH1963@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1295</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>GHATAKPUKUR HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - BHANGAR GOBINDAPUR</td>
						<td>BHANGAR - I</td>
						<td>CHAITAL</td>
						<td>743456</td>
						<td>9.33E+09</td>
						<td>WRITE2UASMI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1296</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>MALLIKPUR ABDUS SHOKUR HIGH
							SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - MALLIKPUR</td>
						<td>BARUIPUR</td>
						<td></td>
						<td>700058</td>
						<td>3.33E+09</td>
						<td>KSDFHS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1297</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>RAIBAGHINI HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - PASCHIM DIGHIRPAR,</td>
						<td>CANNING - I</td>
						<td></td>
						<td>743263</td>
						<td>9.43E+09</td>
						<td>WBSCVET1046.HS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1298</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>G.N. HARI NARAYANI VIDYPITH
							(H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - NALIAKHALI, P.O. -
							HEROBHANGA,</td>
						<td>CANNING - I</td>
						<td>KAMPA-CHAKLA</td>
						<td>743145</td>
						<td>3.33E+09</td>
						<td>JGHSCHOOL.1959@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1299</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>MULTI PEARY SREEMANTA
							INSTITUTION (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. - MULTI</td>
						<td>MAGRAHAT - II</td>
						<td>KOLSUR</td>
						<td>743438</td>
						<td>3.22E+09</td>
						<td>KOLSURHIGHSCHOOL2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1300</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KULPI KALIKA VIDYAPITH (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL &amp; P.O. - SHYAM BASUR
							CHAK,</td>
						<td>KULPI</td>
						<td>AMLANI</td>
						<td>743429</td>
						<td>3.22E+09</td>
						<td>VTC1052@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1301</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>KASTE KUMARI HIGH SCHOOL
							(H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - KASTEKUMARI, P.O. -
							PASCHIM CHAMNI</td>
						<td>BISHNUPUR - I</td>
						<td></td>
						<td>743273</td>
						<td>3.22E+09</td>
						<td>KPSNVOCATIONAL.1059@REDIFFMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1302</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td>ETIA</td>
						<td>DHAPDHAPI HIGH SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - DHAPDHAPI,</td>
						<td>BARUIPUR</td>
						<td></td>
						<td>743201</td>
						<td></td>
						<td><a href="mailto:PBAB.1963@GMAIL.COM">PBAB.1963@GMAIL.COM</a>
						</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1303</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td></td>
						<td>DEBNAGAR MOKSHODA DINDA
							HIGHER SECONDARY SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - DEBNAGAR VILL.-
							DEBNAGAR</td>
						<td>NAMKHANA</td>
						<td></td>
						<td>743136</td>
						<td>3.33E+09</td>
						<td>HVIDYAMANDIR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1304</td>
						<td>ETCM</td>
						<td>HSCH</td>
						<td></td>
						<td>NAMKHANA UNION HIGH
							SCHOOL(HS)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - SHIBNAGAR ABAD,</td>
						<td>NAMKHANA</td>
						<td></td>
						<td>743262</td>
						<td>9.93E+09</td>
						<td>SHUBHRO.SARKAR@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1305</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>HATUGANJ MAHA RAJA NARENDRA
							KRISHNA HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							HATUGANG,</td>
						<td>MAGRAHAT I</td>
						<td>MAMUDPUR</td>
						<td>743166</td>
						<td>9.43E+09</td>
						<td>MSHSNAIHATI@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1306</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>PARULIA SRI RAMKRISHNA HIGH
							SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. - PARULIA, P.O. -
							DARIKRISHNA NAGAR,</td>
						<td>DIAMOND HARBOUR - I</td>
						<td></td>
						<td>743222</td>
						<td>3.22E+09</td>
						<td>ABSSHM2014@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1307</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>KARANJALI B.K. INSTITUTION</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							KARANJALI,</td>
						<td>KULPI</td>
						<td>DURGAMANDAP</td>
						<td>743446</td>
						<td>9.73E+09</td>
						<td>DTDSSVHIGHSCHOOL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1308</td>
						<td>ETCM</td>
						<td>BCRS</td>
						<td>ETEM</td>
						<td>SUNDARBAN BALIKA VIDYANIKETAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>GANESHPUR, P.O. - KAKDWIP</td>
						<td>KAKDWIP</td>
						<td>BAMANPUKUR</td>
						<td>743425</td>
						<td>########</td>
						<td>BAMANPUKURIA_VOC1081@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1309</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>DAKSHIN BARASAT SRI SRI
							SARADAMONI BALIKA VIDYALAYA (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - DAKSHIN BARASAT</td>
						<td></td>
						<td></td>
						<td>700051</td>
						<td>3.33E+09</td>
						<td>BIRATIVIDYALAYABOYS@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1310</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>BURUL HIGH SCHOOL</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp;P.O. -
							BURUL,</td>
						<td>BUDGE BUDGE - II</td>
						<td>BOYRA</td>
						<td>743232</td>
						<td>7.8E+09</td>
						<td>KAUSHIK_GHO1@YAHOO.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1311</td>
						<td>ETCM</td>
						<td></td>
						<td></td>
						<td>DAYAPUR P.C.SEN HIGH
							SCHOOL (H.S)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL. &amp; P.O. -
							DAYAPUR,</td>
						<td>GOSABA</td>
						<td></td>
						<td>743145</td>
						<td>9.43E+09</td>
						<td>HMJHS1956@YAHOO.IN</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1312</td>
						<td>ETCM</td>
						<td>BCTM</td>
						<td></td>
						<td>SUNDARBAN JANAKALYAN SANGHA
							VIDYANIKETAN</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>P.O. - RUDRANAGAR,
						</td>
						<td>SAGAR</td>
						<td></td>
						<td>700036</td>
						<td>3.33E+09</td>
						<td>WBSCVET1105@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1313</td>
						<td>ETCM</td>
						<td>ETEM</td>
						<td></td>
						<td>COMPANYCHAR MAHESWARI HIGH
							SCHOOL (H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL+P.O. COMPANYCHAR,</td>
						<td>SAGAR</td>
						<td>NOOR NAGAR</td>
						<td>743423</td>
						<td>9.14E+09</td>
						<td>ASHMVOC@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					<tr>
						<td>1314</td>
						<td>ETCM</td>
						<td>ETBC</td>
						<td>HSCH</td>
						<td>BHAGOWANPUR HIGH SCHOOL(H.S.)</td>
						<td>SOUTH 24 PARGANAS</td>
						<td>VILL.-BHAGOWANPUR,
							P.O.-PACCAPOLERHAT,</td>
						<td>BHANGAR - II</td>
						<td>PALLA</td>
						<td>743290</td>
						<td>9.74E+09</td>
						<td>RAMSANKARPUR.VOCATIONAL@GMAIL.COM</td>
						<td></td>
						<td>Nil</td>
						<td></td>
					</tr>
					</tbody>
				</table>
			

			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function () {
		$('#data_table').DataTable({
			"lengthMenu": [[25, 50, -1], [25, 50, "All"]]
		});
	});
</script>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>