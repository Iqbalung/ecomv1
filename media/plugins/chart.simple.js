/****************************************
* by Kamvret
****************************************/

Array.prototype.getRandom= function(cut){
    var i= Math.floor(Math.random()*this.length);
    if(cut && i in this){
        return this.splice(i, 1)[0];
    }
    return this[i];
}

var CreateChart = function (options){
	console.log('Pilih class');
}

CreateChart.pie = function (options){
	var settings = {};
	settings.id = options.id || '';
	settings.data = options.data || [];
	settings.colors = ['aqua','blue', 'fuchsia', 'gray', 'green', 
				'lime', 'maroon', 'navy', 'olive', 'orange', 'purple', 'red', 
				'silver', 'teal', 'yellow'];
				
	settings.labelSize = options.labelSize || 20;
	settings.legend = options.legend || false;
	settings.legendLocation = options.legendLocation || 'right';
	settings.labelDisplay = options.labelDisplay || 'right';
	settings.legendSize = options.legendSize || 13;
	settings.label = options.label || false;
	settings.donut = options.donut || false;
	settings.donutSize = options.donutSize || 0;
	settings.labelColor = options.labelColor || 'white';
	settings.typeValue = options.typeValue || 'white';
	
	var selector = 0;
	if(settings.id != ''){
		selector = settings.id;
	}
	
	if(!selector){
		return console.log('Selector tidak terdefinisikan, gunakan config `id`'); 
	}
	var canvas = document.getElementById(selector);
	if(canvas == null){
		return console.log('Selector tidak ditemukan'); 
	}
	var ctx = canvas.getContext("2d");
	
	var x = 0;
	var y = 0;
	
	if(!settings.legend){
		x = canvas.width;
		y = canvas.height;
	} else {
		switch(settings.legendLocation){
			
			default:
				x = canvas.height;
				y = canvas.height;
		}
	}
	var center = [ x / 2, y / 2];
	var radius = Math.min(x, y) / 2;
	var lastPosition = 0, total = 0; Arc = 0;
	var data = settings.data;
	for (var i = 0; i < data.length; i++) { total += data[i]['value']; }
	var colors = settings.colors;
	var labelSize = settings.labelSize;
	var legendSize = settings.legendSize;
	var offset = Math.PI/2;
	var donutSize = 0;
	var rad = 0;
	
	if(!settings.donut){
		rad = 0.5;
	} else if(settings.donutSize==0){
		donutSize = radius/2;
		rad = 0.75;
	} else {
		donutSize = settings.donutSize;
		rad = 0.75;
	}
	
	var lradius = radius * rad;
	var color_random = colors.getRandom();
	
	for (var i = 0; i < data.length; i++) {
		var color = '';
		if(typeof data[i]['color'] != "undefined"){
			color = data[i]['color'];
		} else {
			color = color_random;
		}
		Arc = Math.PI*(2*data[i]['value']/total);
		ctx.fillStyle = color;
		ctx.beginPath();
		ctx.moveTo(center[0],center[1]);
		ctx.arc(center[0],center[1],radius,lastPosition-offset,lastPosition+Arc-offset,false);
		if(settings.donut){
			ctx.arc(center[0],center[1],donutSize,lastPosition+Arc-offset,lastPosition-offset,true);
		}
		ctx.lineTo(center[0],center[1]);
		
		ctx.fill();
		lastPosition += Arc;
	}

	if(settings.donut) {
		ctx.beginPath();
	  	ctx.fillStyle = 'black';
	  	ctx.textAlign = 'center';
		ctx.font = "15px Sans-serif";
	  	ctx.fillText('Unit', center[0], center[1]);
	  	ctx.fill();
	} 

	if(settings.legend){
		var lastY = 20;
		for (var i = 0; i < data.length; i++) {
			var color = '';
			if(typeof data[i]['color'] != "undefined"){
				color = data[i]['color'];
			} else {
				color = color_random;
			}
			switch(settings.legendLocation){
				default:
				ctx.beginPath();
				/* ctx.shadowColor = "black";
				ctx.shadowOffsetX = 2;
				ctx.shadowOffsetY = 2;
				ctx.shadowBlur = 3;
				 */
				ctx.fillStyle = color;
				ctx.fillRect(x+10,lastY,10,10);
				
				ctx.fillStyle = 'black';
				ctx.textAlign = 'left';
				ctx.font = legendSize+"px Sans-serif";
				ctx.fillText(data[i]['label'], x+25, lastY+8);
				ctx.fill();
			}
			lastY += 20;
		}
	}
	
	if(settings.label){
		var lastPosition = 0, total = 0, langle = 0, Arc = 0;
		for (var i = 0; i < data.length; i++) { total += data[i]['value']; }
		var label = '';
		var value = '';
		for (var i = 0; i < data.length; i++) {
			Arc = Math.PI*2*(data[i]['value']/total);
			langle = lastPosition + Arc / 2 + Math.PI + offset; 
			if(settings.labelDisplay == 'center'){
				var dx = center[0];  
				var dy = center[1]+ labelSize * 0.5;
			}else{
				var dx = center[0] + lradius * Math.cos(langle);
				var dy = center[1] + lradius * Math.sin(langle);	
			}
			ctx.fillStyle = settings.labelColor;
			/* ctx.shadowColor = "black";
			ctx.shadowOffsetX = 2;
			ctx.shadowOffsetY = 2;
			ctx.shadowBlur = 3; */
			ctx.textAlign = 'center';
			ctx.font = labelSize + "px Sans-serif";
			switch(settings.typeValue){
				case 'percent':
					var percent = (data[i]['value']/total)*100;
					if(typeof data[i]['valueLabel'] != 'undefined' && typeof data[i]['valueLabel']!=''){
						value = data[i]['valueLabel'];
					} else {
						value2 = '('+data[i]['value']+')';
						value = percent.toFixed(2)+" %";
					}
				break;
				default: value = data[i]['value'];
			}
			if(!(settings.labelDisplay == 'center' && i > 0) ){
				ctx.fillText(value, dx, dy);		
				ctx.fillText(value2, dx, dy+20);		
			} 
			
			if(typeof data[i]['label'] != "undefined"){
				label = data[i]['label'];
			} else {
				label = '';
			}
			if(!settings.legend){
				if(settings.labelDisplay != 'center'){
					ctx.fillText(label, dx, dy+labelSize);
				}
			}
			lastPosition += Arc;
		}
		
	}
}

CreateChart.batang = function (options){
	var settings = {};
	settings.id = options.id || '';
	settings.data = options.data || [];
	settings.colors = ['aqua','blue', 'fuchsia', 'gray', 'green', 
				'lime', 'maroon', 'navy', 'olive', 'orange', 'purple', 'red', 
				'silver', 'teal', 'yellow'];
				
	settings.labelSize = options.labelSize || 20;
	settings.legend = options.legend || false;
	settings.legendLocation = options.legendLocation || 'right';
	settings.labelDisplay = options.labelDisplay || 'right';
	settings.legendSize = options.legendSize || 13;
	settings.label = options.label || false;
	settings.labelColor = options.labelColor || 'white';
	settings.typeValue = options.typeValue || 'white';
	
	
	
	var selector = 0;
	if(settings.id != ''){
		selector = settings.id;
	}
	
	if(!selector){
		return console.log('Selector tidak terdefinisikan, gunakan config `id`'); 
	}
	var canvas = document.getElementById(selector);
	if(canvas == null){
		return console.log('Selector tidak ditemukan'); 
	}
	var ctx = canvas.getContext("2d");
	
	var x = 0;
	var y = 0;
	
	var center = [ x / 2, y / 2];
	var lastPosition = 0, total = 0; Arc = 0;
	var data = settings.data;
	for (var i = 0; i < data.length; i++) { total += data[i]['value']; }
	var colors = settings.colors;
	var labelSize = settings.labelSize;
	var legendSize = settings.legendSize;
	var offset = Math.PI/2;
	

	lebar = 30; 
	lastX = lebar+10;
	var w = canvas.width;
	var h = canvas.height;
	var color_random = colors.getRandom();

	max = 0;
	for (var i = 0; i < data.length; i++) {
		if ( data[i]['value'] >= max)
			max = data[i]['value'];
	}

	nilai_kali = h / max;

	if(nilai_kali <1 ) nilai_kali =1;
	if(nilai_kali >=10 ) nilai_kali =10;

	var lastGroup = null;

	if(settings.legendLocation == 'top') 
	{
		batas_nilai = 130;
	} else {
		batas_nilai = 0;
	}
	
	for (var i = 0; i < data.length; i++) {

		ctx.beginPath();

		var color = '';

		if(typeof data[i]['color'] != "undefined"){
			color = data[i]['color'];
		} else {
			color = color_random;
		}
		lastX+=(10+lebar);
		ctx.rect(lastX, h-30- data[i]['value'] *nilai_kali, lebar, data[i]['value'] *nilai_kali );
      	ctx.fillStyle = color;
      	ctx.fill();

      	if(data[i].group != lastGroup && lastGroup != null){
			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'left';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText(data[i].group, lastX+15, h-10);
	      	ctx.fill();
		}

		if(lastGroup == null && data[i].group != lastGroup  ) {
			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'left';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText(data[i].group, lastX+15, h-10);
	      	ctx.fill();
	    }
		
		ycx = h-30- data[i]['value'] *nilai_kali -5;
		if(ycx<100) ycx = batas_nilai+(data[i].value+'').length * 7;

	    ctx.beginPath();
      	ctx.fillStyle = 'white';
      	var rectWidth = 17;
      	var rectHeight = (data[i].value+'').length * 7;
      	var rectX = lastX+7;
      	var rectY = ycx+2;
      	ctx.rect( rectX, rectY-rectHeight, rectWidth,  rectHeight);
      	ctx.fill();
      	ctx.closePath()

	    ctx.beginPath();
      	ctx.fillStyle = 'black';
      	ctx.textAlign = 'left';
		ctx.font = legendSize+"px Sans-serif";

		ctx.translate(lastX +20, ycx);
		ctx.rotate(-Math.PI/2);
      	ctx.fillText(data[i].value, 0, 0);
		ctx.rotate(Math.PI/2);
		ctx.translate(-1*(lastX +20), -1*(ycx));
      	ctx.fill();

	    lastGroup = data[i].group;
	}

	// garis grafik horizontal
	ctx.beginPath();
    ctx.moveTo(50, h-30);
    ctx.lineTo(w-110, h-31 );
    ctx.stroke();

    // garis grafik vertical
    ctx.beginPath();
    ctx.moveTo(50, 120);
    ctx.lineTo(50, h-31 );
    ctx.stroke();


    ctx.beginPath();
  	ctx.fillStyle = '#555';
  	ctx.textAlign = 'left';
	ctx.font = "15px Sans-serif";
	ctx.translate(30,230);
	ctx.rotate(-Math.PI/2);
  	ctx.fillText('Jumlah Unit', 0, 0);
	ctx.rotate(Math.PI/2);
  	ctx.fill();

	
	if(settings.legend ){

		if(settings.legendLocation == 'top') 
		{
			ctx.beginPath();	
			ctx.translate(-30,-230);
	      	ctx.fillStyle = '#eeefef';
			ctx.rect(0, 0, 1000, 130);
	     	ctx.fill();

			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'left';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText('Keterangan :', x+25, 14);
	      	ctx.fill();
		} else if (settings.legendLocation == 'right') 
		{
			ctx.beginPath();	
			ctx.translate(-30,-230);
	      	ctx.fillStyle = '#eeefef';
			ctx.rect(w-400, 0, 400, 400);
	     	ctx.fill();

			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'left';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText('Keterangan :', (w-400)+25, 14);
	      	ctx.fill();
		}

		var lastY = 14 + 14;
		var lastGroup = null;
		var maxY = 0;
		for (var i = 0; i < data.length; i++) {
			var color = '';
			if(typeof data[i]['color'] != "undefined"){
				color = data[i]['color'];
			} else {
				color = color_random;
			}
			switch(settings.legendLocation){
				case 'top':

					ctx.beginPath();
					ctx.fillStyle = color;

					if(data[i].group != lastGroup && lastGroup != null){
						if(maxY < lastY)
							maxY = lastY;
						lastY = 14+14;
						x+=225;
					}

					lastGroup = data[i].group

					ctx.fillRect(x+10,lastY,10,10);
					
					ctx.fillStyle = 'black';
					ctx.textAlign = 'left';
					ctx.font = legendSize+"px Sans-serif";
					//ctx.fillText(data[i]['label'], x+25, lastY+8);
					c = wrapText(ctx, data[i]['label'], x+25, lastY+8, 210,14);
					lastY += (c+1)*7;
					ctx.fill();
					break;
				case 'right':

					xx= w - 400;
					ctx.beginPath();
					ctx.fillStyle = color;

					lastGroup = data[i].group

					ctx.fillRect(xx+10,lastY,10,10);
					
					ctx.fillStyle = 'black';
					ctx.textAlign = 'left';
					ctx.font = legendSize+"px Sans-serif";
					c = wrapText(ctx, data[i]['label'], xx+25, lastY+8, 210,14);
					lastY += (c+1)*7;
					ctx.fill();
					break;
				default:
				
			}

			lastY += 14;
		}

	}
	
	if(settings.label){
	}
}



CreateChart.bar = function (options){
	var settings = {};
	settings.id = options.id || '';
	settings.data = options.data || [];
	settings.colors = ['aqua','blue', 'fuchsia', 'gray', 'green', 
				'lime', 'maroon', 'navy', 'olive', 'orange', 'purple', 'red', 
				'silver', 'teal', 'yellow'];
				
	settings.labelSize = options.labelSize || 20;
	settings.legend = options.legend || false;
	settings.isGroup = options.isGroup || false;
	settings.legendLocation = options.legendLocation || 'right';
	settings.labelDisplay = options.labelDisplay || 'right';
	settings.legendSize = options.legendSize || 13;
	settings.label = options.label || false;
	settings.labelColor = options.labelColor || 'white';
	settings.typeValue = options.typeValue || 'white';
	
	
	
	var selector = 0;
	if(settings.id != ''){
		selector = settings.id;
	}
	
	if(!selector){
		return console.log('Selector tidak terdefinisikan, gunakan config `id`'); 
	}
	var canvas = document.getElementById(selector);
	if(canvas == null){
		return console.log('Selector tidak ditemukan'); 
	}
	var ctx = canvas.getContext("2d");
	
	var x = 0;
	var y = 0;
	
	var center = [ x / 2, y / 2];
	var lastPosition = 0, total = 0; Arc = 0;
	var data = settings.data;
	for (var i = 0; i < data.length; i++) { total += data[i]['value']; }
	var colors = settings.colors;
	var isGroup = settings.isGroup;
	var labelSize = settings.labelSize;
	var legendSize = settings.legendSize;
	var offset = Math.PI/2;
	

	lebar = 30; 
	lastY = lebar+10;
	
	canvas.height = (lastY*(data.length+2)) +lebar +15;

	var w = canvas.width;
	var h = canvas.height;
	x = parseInt(w/4);
	var color_random = colors.getRandom();



	var lastGroup = null;

	var ci = 0;
	max = 0;
	for (var i = 0; i < data.length; i++) {
		if ( data[i]['value'] >= max)
			max = data[i]['value'];
	}
	
	for (var i = 0; i < data.length; i++) {

		ctx.beginPath();

		var color = '';

		if(data[i].group != lastGroup && lastGroup != null){
      		ci = 0;
      	}

		if(!isGroup) {
			if(typeof data[ci]['color'] != "undefined"){
				color = data[ci]['color'];
			} else {
				color = color_random;
			}
		} else {
			if(typeof data[ci]['color'] != "undefined"){
				color = data[ci]['color'];
			} else {
				color = color_random;
			}
		}

		nilai_kali = w/max;

		if(nilai_kali < 1) nilai_kali =1;
		if(nilai_kali > 15) nilai_kali = 15;

		lastY+=(10+lebar);
      	ctx.fillStyle = color;
		ctx.rect( x, lastY, data[i]['value'] *nilai_kali,  lebar);
      	ctx.fill();

      	if(data[i].group != lastGroup && lastGroup != null){
			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'right';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText(data[i].group, x-20, lastY+20);
	      	ctx.fill();
		}

		if(lastGroup == null && data[i].group != lastGroup  ) {
			ctx.beginPath();
	      	ctx.fillStyle = 'black';
	      	ctx.textAlign = 'right';
			ctx.font = legendSize+"px Sans-serif";
	      	ctx.fillText(data[i].group, x-20, lastY+20);
	      	ctx.fill();
	    }

	    ci++;
		pxc = data[i]['value'] *nilai_kali + 10 +x;
		if(pxc >= w) pxc = w- (data[i].value+'').length * 6 - 10 ;
      	
      	ctx.beginPath();
      	ctx.fillStyle = 'white';
      	var rectWidth = (data[i].value+'').length * 7;
      	var rectHeight = 17;
      	var rectX = pxc-3;
      	var rectY = lastY+6;
      	ctx.rect( rectX, rectY, rectWidth,  rectHeight);
      	ctx.fill();
      	ctx.closePath();

	    ctx.beginPath();
      	ctx.fillStyle = 'black';
      	ctx.textAlign = 'left';
		ctx.font = legendSize+"px Sans-serif";
      	ctx.fillText(data[i].value, pxc,lastY+20);
      	ctx.fill();


	    lastGroup = data[i].group;
	}


	console.log(lastY +lebar +15);


	ctx.beginPath();
    ctx.moveTo(x, 30);
    ctx.lineTo(x, h-10 );
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(x-30, canvas.height-30);
    ctx.lineTo(w-30, canvas.height-30 );
    ctx.stroke();



    ctx.beginPath();
  	ctx.fillStyle = '#555';
  	ctx.textAlign = 'right';
	ctx.font = "15px Sans-serif";
  	ctx.fillText('Jumlah Unit', w-30, canvas.height-40);
  	ctx.fill();


	
	if(settings.legend){
	}
	
	if(settings.label){
	}
}


 function wrapText(context, text, x, y, maxWidth, lineHeight) {
	var words = text.split(' ');
	var line = '';

	var jml_baris = 0;
	for(var n = 0; n < words.length; n++) {
	  var testLine = line + words[n] + ' ';
	  var metrics = context.measureText(testLine);
	  var testWidth = metrics.width;
	  if (testWidth > maxWidth && n > 0) {
	    context.fillText(line, x, y);
	    line = words[n] + ' ';
	    y += lineHeight;
	    jml_baris ++;
	  }
	  else {
	    line = testLine;
	  }
	}

	context.fillText(line, x, y);

	return jml_baris;
}
