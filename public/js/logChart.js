console.log('log chart js');

var myCanvas = document.getElementById('myCanvas');

myCanvas.width = 400;
myCanvas.height = 400;

let ctx = myCanvas.getContext('2d');
ctx.fillStyle= "#ff0000";
let radius = myCanvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.9;
setInterval(drawClock,1000);

function drawClock(){
	drawFace(ctx,radius);
	drawNumbers(ctx,radius);
	drawTime(ctx,radius);
}

function drawTime(ctx,radius){
	var now = new Date();
	var hour = now.getHours();
	var minute = now.getMinutes();
	var second = now.getSeconds();
	//hour
	hour = hour%12;
	hour=(hour*Math.PI/6)+(minute*Math.PI/(6*60))+(second*Math.PI/(360*60));
	  drawHand(ctx, hour, radius*0.5, radius*0.07,"#000000");
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07,"#000000");
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02,"#ff0000");
}

function drawHand(ctx,pos,length,width,color){
	ctx.strokeStyle = color;
	ctx.beginPath();
	ctx.lineWidth = width;
	ctx.lineCap = "round";
	ctx.moveTo(0,0);
	ctx.rotate(pos);
	ctx.lineTo(0,-length);
	ctx.stroke();
	ctx.rotate(-pos);
}

function drawNumbers(ctx,radius){
	var ang;
	var num;
	ctx.font = radius * 0.15 +"px arial";
	ctx.textBaseline="middle";
	ctx.textAlign = "center";
	for(num = 1; num < 13; num++){
		 ang = num * Math.PI / 6;
		 ctx.rotate(ang);
		 ctx.translate(0,-radius*0.85);
		 ctx.rotate(-ang);
		 ctx.fillText(num.toString(),0,0);
		 ctx.rotate(ang);
		 ctx.translate(0,radius*0.85);
		 ctx.rotate(-ang);
	}
}


function drawFace(ctx, radius){
	var grad;
	ctx.beginPath();
	ctx.arc(0,0, radius,0, 2*Math.PI);
	ctx.fillStyle = "#ffffff";
	ctx.fill();

	grad = ctx.createRadialGradient(0,0,radius*.95,0,0,radius*1.05);
	grad.addColorStop(0,'#333');
	grad.addColorStop(0.5,'#fff');
	grad.addColorStop(1,'#333');
	ctx.strokeStyle = grad;
	ctx.lineWidth = radius * 0.1;
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(0,0,radius*0.1,0, 2*Math.PI);
	ctx.fillStyle = "#333";
	ctx.fill();
}



function drawLine(ctx, startX, startY, endX, endY){
    ctx.beginPath();
    ctx.moveTo(startX,startY);
    ctx.lineTo(endX,endY);
    ctx.stroke();
}

function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.stroke();
    ctx.fill();
}

function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(centerX,centerY);
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.closePath();
    ctx.fill();
}


let oo = document.getElementById('o2');
let c = oo.getContext('2d');
oo.width=500;
oo.height=50;
c.fillStyle = "#0000ff";
c.fillRect(20,0,60,50);
c.fillRect(140,0,80,50);
//c.fillRect(250,0,205,50);
c.fillRect(255,0,5,50);


