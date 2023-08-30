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
						<li class="breadcrumb-item active">Other STT</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="pt-5 pb-5">
	<div class="container">
		<table class="table table-striped table-bordered table-hover" style="font-size:12px;">
			<tbody>
				<tr>
					<th style="width:50px">SERIAL</th>
					<th>DISCIPLINE<br>
						<i>(Click to view detail )</i>
					</th>
					<th style="width:200px;">NUMBER OF COURSES</th>
				</tr>
				<tr>
					<td>1</td>
					<td><strong><a href="academic/stvt/course_catalogue/et">ENGINEERING &amp; TECHNOLOGY (ET)</a></strong></td>
					<td>8</td>
				</tr>

				<tr>
					<td>2</td>
					<td><strong><a href="javascript:void(0)"> AGRICULTURE (AG)</a></strong></td>
					<td>0</td>
				</tr>

				<tr>
					<td>3</td>
					<td><strong><a href="academic/stvt/course_catalogue/hs"> HOME SCIENCE (HS)</a></td>
					<td>5</td>
				</tr>

				<tr>
					<td>4</td>
					<td><strong><a href="academic/stvt/course_catalogue/bc"> BUSINESS &amp; COMMERCE (BC)</a></strong></td>
					<td>1</td>
				</tr>

				<tr>
					<td>5</td>
					<td><strong><a href="javascript:void(0)"> PARAMEDICAL (PM)</a></strong></td>
					<td>0</td>
				</tr>

			</tbody>
		</table>
		
		<br><br>

		<!-- <h3>List of STVT Institutes</h3>
		<div class="table-responsive">
			<table id="data_table" class="table table-striped table-bordered table-hover" style="font-size:12px;">
				<thead>
					<tr>
						<td>Sl. No.</td>
						<td>Courses Running</td>
						<td>Course Type</td>
						<td>Institute</td>
						<td>District</td>
						<td>Address</td>
						<td>MUNICIPALITY/ BLOCK</td>
						<td>PANCHAYET</td>
						<td>PIN </td>
						<td>INSTITUTE PHONE</td>
						<td>Institute EMAIL</td>
						<td>Lab Availibility</td>
						<td>Hostel Availiblity</td>
						<td>View Institute location on map</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>FA,DTP,CA,OP,AOP,ADTP</td>
						<td>BOCE</td>
						<td>Dhupguri Commercial College</td>
						<td>Alipurduar</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td>CF,FAS,CA,FBS</td>
						<td>STVT</td>
						<td>Institute of Technical Studies</td>
						<td>Bankura</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>3</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Modern Phonetic Commercial College</td>
						<td>Bankura</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>4</td>
						<td>FAS,DTP,CA,ET,GDNW,ARM</td>
						<td>STVT</td>
						<td>Ramakrishna Vivekananda Mission Rural Vocational Training Institute, Joyrambati</td>
						<td>Bankura</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>5</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Taramaa Type - Stenography Commercial College</td>
						<td>Bankura</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>6</td>
						<td>HSC/Beau,GDNW</td>
						<td>STVT</td>
						<td>Siliguri Bodhi Bharati Vocational Institute - Cooch Behar</td>
						<td>Cooch Behar</td>
						<td>By Lane Sunity Road, Opp. Dr. Satish Sarkar, Ward No. 20, Coochhehar Sadar</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>7</td>
						<td>FAS,CA,HN,FBS</td>
						<td>STVT</td>
						<td>Datapro-Aisect N.B. Group</td>
						<td>Dakshin Dinajpur</td>
						<td>Datapro-AISECT House, Shibtali, Balurghat</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>8</td>
						<td>CF,DTP,CM,DEO,FAS,HSC/Beau,AS,GDNW,CA,HN</td>
						<td>STVT</td>
						<td>Deshbandhu Institute of Vocational Training, Siliguri</td>
						<td>Darjeeling</td>
						<td>Tarashankar Road, Deshbandhupara, Siliguri</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>9</td>
						<td>OP</td>
						<td>BOCE</td>
						<td>Holy Cross Institute</td>
						<td>Darjeeling</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>10</td>
						<td>HO,HHC,FBS</td>
						<td>STVT</td>
						<td>Kanchanjungha Institute of Management and Technology</td>
						<td>Darjeeling</td>
						<td>Champasari More, Champasari, Jupto Nagar. P.O. - Pradhan Nagar, Siliguri - 734003</td>
						<td></td>
						<td></td>
						<td>734003</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>11</td>
						<td>CF,DEO,FAS,HSC/Beau,CA</td>
						<td>STVT</td>
						<td>Siliguri Bodhi Bharati Vocational Institute - Siliguri</td>
						<td>Darjeeling</td>
						<td>24, A.T. Mukherjee Road, Collegepare, P.O. - Siliguri</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>12</td>
						<td>FA,CA,OP,AOP</td>
						<td>BOCE</td>
						<td>Sumiran Commercial College</td>
						<td>Darjeeling</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>13</td>
						<td>DTP</td>
						<td>BOCE</td>
						<td>Boinchee College of Commerce</td>
						<td>Hooghly</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>14</td>
						<td>DEO,FAS,CA,DTPM</td>
						<td>STVT</td>
						<td>Institute of Computer Study</td>
						<td>Hooghly</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>15</td>
						<td>DTP,CA,OP</td>
						<td>BOCE</td>
						<td>Khanyan Commercial Services</td>
						<td>Hooghly</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>16</td>
						<td>DTP,FA</td>
						<td>BOCE</td>
						<td>The Serampore Commercial Academy</td>
						<td>Hooghly</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>17</td>
						<td>DTP,CA,OP</td>
						<td>BOCE</td>
						<td>Tribeni Commercial College</td>
						<td>Hooghly</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>18</td>
						<td>DTP,FAS</td>
						<td>STVT</td>
						<td>Ananda Niketan </td>
						<td>Howrah</td>
						<td>Bagnan</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>19</td>
						<td>CF,CM,DEO,DTP,HSC/Beau</td>
						<td>STVT</td>
						<td>Aptitude Education LLP</td>
						<td>Howrah</td>
						<td>Vill+P.O. - Nabghara, Amta Junction Road, P.S. - Sankrail, Diat. - Howrah, Pin - 711322</td>
						<td></td>
						<td></td>
						<td>711322</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>20</td>
						<td>DTP,FAS,CA,DTPM</td>
						<td>STVT</td>
						<td>Cosmic Computer Academy</td>
						<td>Howrah</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>21</td>
						<td>DTP,FAS,CM,CF,CA,HN</td>
						<td>STVT</td>
						<td>Datavision, Bagnan</td>
						<td>Howrah</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>22</td>
						<td>AC,CSA,RACM</td>
						<td>STVT</td>
						<td>Don Bosco Self Employment Research Institute</td>
						<td>Howrah</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>23</td>
						<td>FAS,DEO,CF,AC,HN,DTPM</td>
						<td>STVT</td>
						<td>Eits Inforech </td>
						<td>Howrah</td>
						<td>Registry Office Goli, P.O. + P.S. - Bagnan, Dist - Howrah, Pin - 711 303</td>
						<td></td>
						<td></td>
						<td>711 303</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>24</td>
						<td>HO,HHC,FBS</td>
						<td>STVT</td>
						<td>Fortune Institute of Hotel Management</td>
						<td>Howrah</td>
						<td>140/2 Carry Road, Howrah- 711104</td>
						<td></td>
						<td></td>
						<td>711104</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>25</td>
						<td>CM,FAS,CA,HN</td>
						<td>STVT</td>
						<td>One World International Institute</td>
						<td>Howrah</td>
						<td>Nona, Uluberia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>26</td>
						<td>AS,HSC/Beau</td>
						<td>STVT</td>
						<td>Institute of Allied Health Sciences</td>
						<td>Kolkata</td>
						<td>Becharam Chatterjee Street</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>27</td>
						<td>CF,DTP,FAS,CA</td>
						<td>STVT</td>
						<td>Introduction</td>
						<td>Kolkata</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>28</td>
						<td>FAS,DTP,CA</td>
						<td>STVT</td>
						<td>La Mare Institute for Information Technology</td>
						<td>Kolkata</td>
						<td>69 Middle Road, Entally</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>29</td>
						<td>DTP,CM,DEO,CF,FAS,HN</td>
						<td>STVT</td>
						<td>Lalani Computer Academy Pvt. Ltd</td>
						<td>Kolkata</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>30</td>
						<td>FAS,DEO,CA</td>
						<td>STVT</td>
						<td>Nistha Institute of Skill Development Pvt. Ltd.</td>
						<td>Kolkata</td>
						<td>P-64, C.I.T. Road, Scheme- VIIM, Kolkata - 700054</td>
						<td></td>
						<td></td>
						<td>700054</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>31</td>
						<td>HSC/Beau,FAS,CF</td>
						<td>STVT</td>
						<td>P.L.Academy</td>
						<td>Kolkata</td>
						<td>5/1, Heramba Das Land</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>32</td>
						<td>RACM,FAS,HSC/Beau,DTPM,HN</td>
						<td>STVT</td>
						<td>Srimati Techno Institute </td>
						<td>Kolkata</td>
						<td>114/2B Hazra Road, Near Kalighat Fire Brigade</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>33</td>
						<td>FA,OC,CA,AOP</td>
						<td>BOCE</td>
						<td>Suffee Commercial College</td>
						<td>Kolkata</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>34</td>
						<td>CM,DTP,FAS,GDNW</td>
						<td>STVT</td>
						<td>Ashraful Aulia Institute of Technology</td>
						<td>Malda</td>
						<td>PO-Kutub Sahar</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>35</td>
						<td>FAS,CA</td>
						<td>STVT</td>
						<td>Datapro-Aisect N.B. Group Gazole Branch</td>
						<td>Malda</td>
						<td>Bidrohi More, P.O. - Gazole, P.S. - Gazole, Dist. - Malda, Pin - 732124</td>
						<td></td>
						<td></td>
						<td>732124</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>36</td>
						<td>CA,HN</td>
						<td>STVT</td>
						<td>Dukhulal Nibaran Chandra College</td>
						<td>Murshidabad</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>37</td>
						<td>CSA,AC,CA,HN,ARM,ET</td>
						<td>STVT</td>
						<td>Gobindapur Polytechnic College</td>
						<td>Murshidabad</td>
						<td>Vill- Gobindapur,P.O. - Juginda, P.S. - Domkal, Dist. - Murshidabad Pin - 742406</td>
						<td></td>
						<td></td>
						<td>742406</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>38</td>
						<td>DEO,AS,HSC/Beau,CA,HHC,GDNW</td>
						<td>STVT</td>
						<td>Indradhanu Mahila Samiti </td>
						<td>Murshidabad</td>
						<td>Chuanpur (Talboganpara), P.O + P.S. - Berhampore, Dist. - Murshidabad, Pin - 742101</td>
						<td></td>
						<td></td>
						<td>742101</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>39</td>
						<td>FAS,CA</td>
						<td>STVT</td>
						<td>Microsolve Computer Training Centre</td>
						<td>Murshidabad</td>
						<td>17/5/2, Mohan Roy Para Road, P.O.- Khagra, P.S.- Berhampore, Dist. - Murshidabad, Pin - 742103</td>
						<td></td>
						<td></td>
						<td>742103</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>40</td>
						<td>AC, CA, DTP, FAS</span></td>
						<td>STVT</td>
						<td>Microsolve Computer Training Centre</td>
						<td>Murshidabad</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>41</td>
						<td>DTP,FAS,CF,CM,CA,HN</td>
						<td>STVT</td>
						<td>Datavision, Eruli Nadia</td>
						<td>Nadia</td>
						<td>Eruli,P.S. - Gangnapur, Dist. - Nadia, Pin -741253</td>
						<td></td>
						<td></td>
						<td>741253</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>42</td>
						<td>CF,DTP,FAS,CM,CA</td>
						<td>STVT</td>
						<td>ICON Computer Academy, Bethuadahari</td>
						<td>Nadia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>43</td>
						<td>CF,DTP,FAS,CA</td>
						<td>STVT</td>
						<td>ICON Computer Academy, Plassey</td>
						<td>Nadia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>44</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Ideal Commercial Institute </td>
						<td>Nadia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>45</td>
						<td>CF,CA</td>
						<td>STVT</td>
						<td>Mothabari Computer Training Institute</td>
						<td>Nadia</td>
						<td>Vill + P.O. - Mothabari, P.S. - Kaliachak</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>46</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Public Commercial Institution </td>
						<td>Nadia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>47</td>
						<td>CSO,CSO,RACM,WGE,FP,ARM,HN,ET</td>
						<td>STVT</td>
						<td>Sri Aurobinda Engineering Institute, Kalyani</td>
						<td>Nadia</td>
						<td>Kalyani</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>48</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Subhas Chandra Commercial College</td>
						<td>Nadia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>49</td>
						<td>CF,CM,HSC/Beau,CA,HHC,GDNW</td>
						<td>STVT</td>
						<td>Amdanga Rural &amp; Youth Welfare Organisation</td>
						<td>North 24-Parganas</td>
						<td>B.D.O. Office More Rafipur , P.O. + P.S. - Amdanga, Dist. - 24 Pgs (N), Pin - 743221</td>
						<td></td>
						<td></td>
						<td>743221</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>50</td>
						<td>DTP,FAS,CA,HN</td>
						<td>STVT</td>
						<td>Balibhara Vivekananda Yuva Mahamandal</td>
						<td>North 24-Parganas</td>
						<td>P.O. - Nabanagar</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>51</td>
						<td>CF,DTP,FAS,CA,DTPM,HN</td>
						<td>STVT</td>
						<td>Basirhat Rural Society of Computer Education</td>
						<td>North 24-Parganas</td>
						<td>Prantik Club, College Para, PO-Basirhat College</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>52</td>
						<td>CF,DTP,FAS,CA,DTPM,HN</td>
						<td>STVT</td>
						<td>Bhebia Rural Society of Computer Education</td>
						<td>North 24-Parganas</td>
						<td>Bhebia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>53</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>G.S. Commercial College</td>
						<td>North 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>54</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Gobardanga Commercial College</td>
						<td>North 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>55</td>
						<td>CSA,FP,AC,CSO,CF,DTP,CA,DTPM</td>
						<td>STVT</td>
						<td>Rabindra Path Bhaban</td>
						<td>North 24-Parganas</td>
						<td>52 Old Nimta Road</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>56</td>
						<td>DTP,FAS,WGE,AM,CA,GDNW,ET</td>
						<td>STVT</td>
						<td>Ramakrishna Vivekananda Mission - Barrackpore</td>
						<td>North 24-Parganas</td>
						<td>Riverside Road, Barrackpore</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>57</td>
						<td>CF,DTP,FAS,AC,CA</td>
						<td>STVT</td>
						<td>Shrishti Computer Academy</td>
						<td>North 24-Parganas</td>
						<td>10/L M.B.Road, 1st Floor, Belgharia</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>58</td>
						<td>DTP,CF,FAS,CA</td>
						<td>STVT</td>
						<td>Sri Sarada Math</td>
						<td>North 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>59</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>The United Commercial Institute</td>
						<td>North 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>60</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Andal Commercial Institute</td>
						<td>Paschim Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>61</td>
						<td>HO,HHC,FBS</td>
						<td>STVT</td>
						<td>Asansol Society of Hospitality Management</td>
						<td>Paschim Bardhaman</td>
						<td>Purbasha Lane, Near Rudra Hyundai Showroom, Ushagram, Asansol, Dist. - Paschim Bardhaman,Pin - 713303</td>
						<td></td>
						<td></td>
						<td>713303</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>62</td>
						<td>DTP,FA,CA,OP,AOP,ADTP</td>
						<td>BOCE</td>
						<td>Burnpur Commercial Institute</td>
						<td>Paschim Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>63</td>
						<td>DTP,FAS,CA</td>
						<td>STVT</td>
						<td>Destiny Computer Education Centre</td>
						<td>Paschim Bardhaman</td>
						<td>Opp Balbodhan Ground N.R. R Road, Rail par, Asansol</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>64</td>
						<td>DEO,HO,FAS,CA,HN,ET,GDNW,FBS,HHC</td>
						<td>STVT</td>
						<td>Durgapur P.C.Roy Intitute of Entrepreneurship Development</td>
						<td>Paschim Bardhaman</td>
						<td>Durgapur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>65</td>
						<td>FA,DTP,CA,OP,AOP,ADTP</td>
						<td>BOCE</td>
						<td>Kulti Institute of Commerce</td>
						<td>Paschim Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>66</td>
						<td>HSC/Beau,CF,CM,RACM,WGE,ET</td>
						<td>STVT</td>
						<td>Swami Vivekananda Vani Prachar Samity</td>
						<td>Paschim Bardhaman</td>
						<td>6, Vidyasagar Avenue, B-Zone, Durgapur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>67</td>
						<td>DTP,ADTP</td>
						<td>BOCE</td>
						<td>Universal Phonetic Commercial Institute</td>
						<td>Paschim Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>68</td>
						<td>DTP,FAS,CF,CA,HN</td>
						<td>STVT</td>
						<td>Datavision, Keshpur</td>
						<td>Paschim Medinipur</td>
						<td>Keshpur, Dist. - Paschim Medinipur, Pin - 721150</td>
						<td></td>
						<td></td>
						<td>721150</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>69</td>
						<td>HHC</td>
						<td>STVT</td>
						<td>International School of Management Science</td>
						<td>Paschim Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>70</td>
						<td>CF,DTP,FAS,DEO,CA</td>
						<td>STVT</td>
						<td>West Bengal Scheduled Castes, Tribes &amp; Minority Welfare Association</td>
						<td>Paschim Medinipur</td>
						<td>Rabindranagar, PO-Midnapur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>71</td>
						<td>HSC/Beau,CF,FAS,CA,GDNW,HHC</td>
						<td>STVT</td>
						<td>Academic Commons</td>
						<td>Purba Bardhaman</td>
						<td>Vill+P.O. - Galsi,P.S. - Galsi, Dist. - Purba Bardhaman, Pin - 713406</td>
						<td></td>
						<td></td>
						<td>713406</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>72</td>
						<td>FAS,CA</td>
						<td>STVT</td>
						<td>Cyber Research &amp; Training Institute</td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>73</td>
						<td>CF</td>
						<td>STVT</td>
						<td>Kalpana Educational Trust</td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>74</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Netaji Institute of Commerce</td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>75</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Pitman Commmercial Institute</td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>76</td>
						<td>DTP,CA,ADTP</td>
						<td>BOCE</td>
						<td>Popular Institute of Commerce</td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>77</td>
						<td>L3ETECH,XRTECH, MLTECH, RTECH, CCTECH</td>
						<td>STVT</td>
						<td>Rural Training Centre, Purba Bardhaman, Office of the District Magistrate</td>
						<td>Purba Bardhaman</td>
						<td>Joyrambati</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>78</td>
						<td>CM,DTP,FAS,CA</td>
						<td>STVT</td>
						<td>The Academy of Eniac Computers </td>
						<td>Purba Bardhaman</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>79</td>
						<td>HSC/Beau,CA</td>
						<td>STVT</td>
						<td>Cat Intortech</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>80</td>
						<td>AS,RACM,AC</td>
						<td>STVT</td>
						<td>Contai P.T. Survey School</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>81</td>
						<td>FAS,CF,DTP,AC,CM,CA</td>
						<td>STVT</td>
						<td>Contai Rural Organisation for Youth Awareness &amp; Learning</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>82</td>
						<td>FAS,DEO,CA,HN</td>
						<td>STVT</td>
						<td>Digital Software Research Centre</td>
						<td>Purba Medinipur</td>
						<td>Mangalamaro</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>83</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Matangini Commercial Institute</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>84</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Moyna Type Writing College</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>85</td>
						<td>CF,FAS,CA</td>
						<td>STVT</td>
						<td>MS Infotech</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>86</td>
						<td>AC,WGE,FP,ARM,ET</td>
						<td>STVT</td>
						<td>Nandigram Bhutnath Institute of Technology PVT.ITI</td>
						<td>Purba Medinipur</td>
						<td>Vill + P.O. - Reapara, P.S. - Nandigram, Dist. - Purba Medinipur Pin - 721650</td>
						<td></td>
						<td></td>
						<td>721650</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>87</td>
						<td>DTP,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Phonetic Commercial College</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>88</td>
						<td>DTP,FA,CA,ADTP</td>
						<td>BOCE</td>
						<td>S.B. Commercial Institute</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>89</td>
						<td>HSC/Beau,RACM,WGE,MMF,ET,GDNW,DPM</td>
						<td>STVT</td>
						<td>Vidyasagar Technical College</td>
						<td>Purba Medinipur</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>90</td>
						<td>DTP,AS,GDNW,DTPM</td>
						<td>STVT</td>
						<td>Bahumukhi Bisarani</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>91</td>
						<td>FA,DTP,CA,OP</td>
						<td>BOCE</td>
						<td>Baruipur Friends CommercialInstitute</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>92</td>
						<td>DTP ,FA,CA,OP</td>
						<td>BOCE</td>
						<td>Canning Commercial &amp; Training College</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>93</td>
						<td>AS,HSC/Beau,DEO,RACM,FAS,DTP,AC,CM,HHC,CA,HN,DTPM,GDNW</td>
						<td>STVT</td>
						<td>Delta Computer Centre</td>
						<td>South 24-Parganas</td>
						<td>Diamond Harbour, Toll Tax, Employment Exchange Road</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>94</td>
						<td>DTP,CA,OP,AOP</td>
						<td>BOCE</td>
						<td>Ideal Commercial College </td>
						<td>South 24-Parganas</td>
						<td>Kadamtala, Jalpaiguri</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>95</td>
						<td>MMF,FP,ET</td>
						<td>STVT</td>
						<td>IISD Edu World </td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>96</td>
						<td>CF,DTP,FAS,RACM,CA</td>
						<td>STVT</td>
						<td>J.S.- Software</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>97</td>
						<td>AC,RACM,WGE,CA,ET,ARM</td>
						<td>STVT</td>
						<td>Jyotirmoy Basu Vocational Training Centre</td>
						<td>South 24-Parganas</td>
						<td>Vill.- Chaora, P.O. Sarisha</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>98</td>
						<td>FA,CA</td>
						<td>BOCE</td>
						<td>People's Commercial College</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>99</td>
						<td>HSC/Beau,DEO,CF,FAS,GDNW</td>
						<td>STVT</td>
						<td>S.N. Educare</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr'>
						<td>100</td>
						<td>GDNW</td>
						<td>STVT</td>
						<td>Sarisha Ramakrishna Mission Sarada Mandir</td>
						<td>South 24-Parganas</td>
						<td>P.O. - Sarisha, P.O. - Diamond Harbour</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>101</td>
						<td>DTP,FA,OP,CA</td>
						<td>BOCE</td>
						<td>Southern Type Trainee College</td>
						<td>South 24-Parganas</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>102</td>
						<td>HO,CF,CM,DEO,DTP,AC,CA,HN,FBS</td>
						<td>STVT</td>
						<td>Vision Institute of Skill Development</td>
						<td>South 24-Parganas</td>
						<td>114D, Garia Main Road. Jadavpur, Kolkata - 700075</td>
						<td></td>
						<td></td>
						<td>700075</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div> -->
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