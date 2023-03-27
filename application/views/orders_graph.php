<html>
<head>
 <script src="<?php echo asset_url(); ?>/libs/echarts/dist/echarts-en.min.js"></script>
		
		<script>
		<?php
		if(!empty($fromdate) && !empty($todate)){	
			
			$prev = date('Y-m-d',strtotime($fromdate));	
			$today = date('Y-m-d',strtotime($todate));
		}
		else{
			$prev = date("Y-m-d",strtotime("-1 month"));
			$today = date("Y-m-d");
		}
		
		$dates = $this->home_db->arrange_dates($prev, $today);
		?>
$(function () {
    "use strict";
   
        var myChart = echarts.init(document.getElementById('basic-bar'));
		<?php 
				$i = 0;
			foreach ($dates as $r){ 
					$i = $i+1;
				$val = "th";
				switch(substr( $i, -1)){
					case 1: $val = "st";
							break;
					case 2: $val = "nd";
							break;
					case 3: $val = "rd";
							break;
				}
				$first = reset($r);
				$last = end($r);
				$resf = $this->master_db->countRec("","orders"," where DATE(ordered_date) between '$fromdate' and '$todate' and status=1");
                //echo $this->db->last_query();exit;
				$rese = $this->master_db->countRec("","orders"," where DATE(ordered_date) between '$fromdate' and '$todate' and status=-1");?>
        var option = {
                grid: {
                    left: '1%',
                    right: '2%',
                    bottom: '3%',
                    containLabel: true
                },

                tooltip : {
                    trigger: 'axis'
                },

                legend: {
                    data:['Success Orders','Failed Orders','Total Orders']
                },
               
                color: ["#1e88e5", "#00acc1","#000"],
                calculable : true,
		
                xAxis : [
                    {
                        type : 'category',
                        data : ["<?php echo $i.$val;?> week"]
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
			
                series : [
                    {
                        name:'Success Orders',
                        type:'bar',
						data:[<?php echo $resf;?>],
						markPoint : {
							data : [
								{type : '<?php echo $resf;?>', name: 'Min'},
							]
						},
						markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
                    {
                        name:'Failed Orders',
						type:'bar',
						data:[<?php echo $rese;?>],
						markPoint : {
							data : [
								{type : '<?php echo $rese;?>', name: 'Max'},
							]
						},
						markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
					{
                        name:'Total Orders',
						type:'bar',
						data:[<?php echo $resf+$rese;?>],
						markPoint : {
							data : [
								{type : '<?php echo $resf+$rese;?>', name: 'Min	'},

							]
						},
						markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    }
                ]
				
            };
			<?php }?>
        myChart.setOption(option);
        $(function () {

                $(window).on('resize', resize);
                $(".sidebartoggler").on('click', resize);

                function resize() {
                    setTimeout(function() {

                        myChart.resize();
                        stackedChart.resize();
                        stackedbarcolumnChart.resize();
                        barbasicChart.resize();
                    }, 200);
                }
            });
});
			
		
  </script>
<body>
  <div id="basic-bar"></div>
</body>
</html>
