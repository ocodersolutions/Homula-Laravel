function customchart(data){
	
	dataPoints  =  [
		{ x: 1, y: 7100 },
		{ x: 2, y: 5500},
		{ x: 3, y: 5000 },
		{ x: 4, y: 6500 },
		{ x: 5, y: 9500 },
		{ x: 6, y: 6800 },
		{ x: 7, y: 2800 },
		{ x: 8, y: 3400 },
		{ x: 9, y: 1400}
	];
	var calculated = [];
	for(x=0; x< data.length; x++){
		//calculated.push(data[x]);
		calculated.push({
		x: x+1, 
            y: parseInt(data[x]), 
		});
		//obj[news.title] = news.link;
	}	
	//alert(calculated);		
	//alert(dataPoints[4]['x']);		
	var chart = new CanvasJS.Chart("chartContainer",
	{
		
		axisY:{    
			valueFormatString:  "#,##0.##", // move comma to change formatting
			prefix: "$"
		},
		data: [
			{        
				type: "column",
				dataPoints: calculated
			}
		]
	});
	
	chart.render();
}