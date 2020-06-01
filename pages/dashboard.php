<?php
	require_once "../model/controller.php";
	$model = new Model;
	$database = new Database;
	$learners = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted'"));
	$inschool = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted' AND category_of_learner LIKE '%INSCHOOL%'"));
	$osc = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted' AND category_of_learner LIKE '%OSC%'"));
	$osa = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted' AND category_of_learner LIKE '%OSA%'"));
	$osy = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted' AND category_of_learner LIKE '%OSY%'"));

	date_default_timezone_set('Asia/Manila');
	$year =  date("Y");
	$month_list = ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12'];
	$string_month = array('01' =>"January", '02' =>"February", '03' =>"March", '04' =>"April", '05' =>"May", '06' =>"June", '07' =>"July",'08' =>"August",'09' =>"September", '10' =>"October", '11' =>"November", '12' =>"December");
	$data_graph = "";
	$counted = 0;

	foreach($month_list as $month) {
	
		$sql = "SELECT COUNT(tbl_learners.member_id) AS quantity FROM tbl_learners WHERE EXTRACT(YEAR FROM tbl_learners.date_created)='$year' AND EXTRACT(MONTH FROM tbl_learners.date_created)='$month'";
		$quantity = $model->displayRecord($sql);
		$qty = 0;
		if($quantity[0]['quantity'] == null) {
			$qty = 0;
		}
		else {
			$qty = $quantity[0]['quantity'];
		}
		$counted++;
		if($counted %2== 1) {
			$data_graph .= "{Month:'".$string_month[$month]."', Total:".$qty.", Color:'#FCD202'}, ";
		}
		else {
			$data_graph .= "{Month:'".$string_month[$month]."', Total:".$qty.", Color:'#FF6600'}, ";
		}
	}
	$data_graph = substr ($data_graph, 0, -2);
    $data_graph = "[".$data_graph."];";
?>
<!DOCTYPE html>
<html>
<head>
  	<?php require_once "../include/css.php"; ?>
	<style>
		.panel-success {
			border-color: #b3f180;
		}
		hr {
			margin-top: 0px;
    		margin-bottom: 15px;
			border-top: 1px solid #afaaaa;
		}
		.form-control {
			background-color: #e2e2e2;
		}
	</style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand"><img src="../images/als.png" width="50px" height="50px" style="margin-top:-12px; margin-left:-18px"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
             <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li ><a href="registration.php"><i class="fa fa-edit"></i> Registration</a></li>
			  <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i>  Records <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					 <li><a href="masterlist.php">Master List</a></li>
					<li class="divider"></li>
					<li><a href="inschool.php">In school</a></li>
					<li class="divider"></li>
					<li><a href="osc.php">Out of school children</a></li>
					<li class="divider"></li>
					<li><a href="osa.php">Out of school adult</a></li>
					  <li class="divider"></li>
					<li><a href="osy.php">Out of school youth</a></li>
				  </ul>
            </li>
			  <li ><a href="recyclebin.php"><i class="fa fa-flask"></i> Recycle Bin</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="light-blue user-menu">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle" >

						<span class="user-info" id="position_d">
							<img class="user-image" src="../images/Female.png" alt="Users Photo">
							<label id="fullname"><?php echo $user_data[0]['fullname']; ?></label>
						</span>

						<i class="fa fa-caret-down"></i>
					</a>

					<ul class="dropdown-menu dropdown-user" style="width:200px">
						<h5 style="margin-left: 10px;">Settings</h5>
						<li class="divider"></li>
						<li>
							<a href="myaccount.php">
								<i class="fa fa-user green"></i>
								My Account
							</a>
						</li>

						<li class="divider"></li>
						<li>
							<a href="../model/logout.php">
								<i class="fa fa-sign-out green"></i>
								Log out
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
	 
  <!-- Full Width Column -->
  <div class="content-wrapper">
	  <div class="container-fluid"  style="width:90%;" >
		  <br>
		 <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				<img src="../images/widget.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">Widgets</h4>
			 </div>
			  <div class="panel-body">
				<div class="col-lg-4 col-xs-4">
				  <div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?php echo $learners; ?></h3>
					  <p>Total Learners</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="masterlist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
			 	<div class="col-lg-4 col-xs-4">
				  <div class="small-box bg-blue">
					<div class="inner">
					  <h3><?php echo $inschool; ?></h3>
					  <p>Total In school</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="inschool.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
		  		<div class="col-lg-4 col-xs-4">
				  <div class="small-box bg-purple">
					<div class="inner">
					  <h3><?php echo $osc; ?></h3>
					  <p>Total OSC</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="osc.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
	  			<div class="col-lg-4 col-xs-4">
				  <div class="small-box bg-yellow">
					<div class="inner">
					  <h3><?php echo $osa; ?></h3>
					  <p>Total OSA</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="osa.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
				<div class="col-lg-4 col-xs-4">
				  <div class="small-box bg-red">
					<div class="inner">
					  <h3><?php echo $osy; ?></h3>
					  <p>Total OSY</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="osy.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
			  </div>
			</div>
		  <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				<img src="../images/record_chart.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">Graph Representation</h4>
			 </div>
			  <div class="panel-body">
				  <div id="chartdiv2" style="width: 100%; height: 550px;"></div>
			</div>
		</div>
		  <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				<img src="../images/bar.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">Graph Representation</h4>
			 </div>
			  <div class="panel-body">
				  <div id="chartdiv" style="width: 100%; height: 550px;"></div>
			</div>
		</div>

    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="border-top: 1px solid #b3f180; background-color: #d0f1e2">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2018-2019</strong> Deped Escalante City
    </div>
    <!-- /.container -->
	</footer>
</div>
<?php require_once "../include/js.php"; ?>
<script>
	
	var legend = "";
	var chart2 = "";
	var inschool = "<?php echo $inschool; ?>";
	var osc = "<?php echo $osc; ?>";
	var osa = "<?php echo $osa; ?>";
	var osy = "<?php echo $osy; ?>";
	var chartData2 = [
		{
			"category": "In School",
			"quantity": inschool,
			"color": "#04D215"
		},
		{
			"category": "Out of school children",
			"quantity": osc,
			"color": "#CD0D74"
		},
		{
			"category": "Out of school adult",
			"quantity": osa,
			"color": "#FCD202"
		},
		{
			"category": "Out of school youth",
			"quantity": osy,
			"color": "#FF6600"
		}
	];
	AmCharts.ready(function () {
		chart2 = new AmCharts.AmPieChart();
		chart2.dataProvider = chartData2;
		chart2.addTitle("Graph of learners", 16);
		chart2.titleField = "category";
		chart2.valueField = "quantity";
		chart2.colorField = "color",
		chart2.sequencedAnimation = true;
		chart2.startEffect = "elastic";
		chart2.innerRadius = "30%";
		chart2.startDuration = 2;
		chart2.labelRadius = 15;
		chart2.balloonText = "<span style='font-size:20px'><b>[[title]]: </b>[[value]]</span>";
		// the following two lines makes the chart 3D
		chart2.depth3D = 10;
		chart2.angle = 15;
		legend = new AmCharts.AmLegend();
		legend.align = "center";
		legend.markerType = "square";
		chart2.addLegend(legend);
		chart2.addListener("clickSlice", function(event){
			//console.log(event);
			/*
			var category = event.dataItem.dataContext.category;
			$("#myModal").modal("show");
			$("#mtitle").html('<i class="fa fa-book"></i> '+category+" Books");

			$.ajax({
				url: "model/dashboard.php",
				dataType:'json',
				type: "POST",
				data:{ 
					action:category,
				},
				success: function(data) {
					console.log(data);
					record(data);
				},
				error: function(){
					alert("error");
				}
			});
			*/
		});
		// WRITE
	chart2.write("chartdiv2");
	});
	
	
	var chart;
	var chartData = <?php echo $data_graph; ?>;
	var chart = AmCharts.makeChart("chartdiv", {
		type: "serial",
		dataProvider: chartData,
		categoryField: "Month",
		depth3D: 15,
		angle: 30,

		categoryAxis: {
			labelRotation: 30,
			gridPosition: "start"
		},

		valueAxes: [{
			title: "Total"
		}],

		graphs: [{

			valueField: "Total",
			colorField: "Color",
			type: "column",
			lineAlpha: 0,
			fillAlphas: 1,
			balloonText: "<span style='font-size:18px'>Month: <b>[[Month]]</b><br>Total: <b>[[value]]</b></span>"
		}],

		chartCursor: {
			cursorAlpha: 0,
			zoomable: false,
			categoryBalloonEnabled: false
		}
	});
	chart.addTitle("Monthly registration on <?php echo $year; ?>", 16);
	$(document).ready(function() {
		
		$('#date_of_birth').datepicker({
		  autoclose: true
		});
		$('#date_mapped').datepicker({
		  autoclose: true
		});
		$('#date_attendance').datepicker({
		  autoclose: true
		});
		
		$("#registration_form").on('submit',(function(e) {

			e.preventDefault();

			$.ajax({
				url: "../model/learners.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					console.log(data);
					if(data == "true") {
						$.confirm({
							title: 'Error Message',
							content: 'Registration was successfully saved.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-blue',
								keys: ['enter'],
								}
							}
						});
					}
					else {
						$.confirm({
							title: 'Error Message',
							content: 'Registration not save.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-blue',
								keys: ['enter', 'esc'],
								}
							}
						});
					}
					$("#registration_form")[0].reset();

				},
				error: function(){
					$.confirm({
						title: 'Error Message',
						content: 'There was an error.',
						icon: 'fa fa-exclamation-triangle',
						theme: 'bootstrap',
						 type: 'red',
						buttons: {
							Okay: {
							text: 'Okay',
							btnClass: 'btn-blue',
							keys: ['enter', 'esc'],
							}
						}
					});
				}
			});
		}))
	});

</script>
</body>
</html>
