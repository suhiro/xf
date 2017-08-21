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



const data2 = [{start:"3600",end:"9600"},
{start:"19600",end:"17200"},
{start:"53600",end:"56000"}];




o2('machine1',data2);
o2('machine2',data2);
function o2(e,data) {
	let oo = document.createElement('canvas');
	let c = oo.getContext('2d');
	//oo.width=$(window).width();
	oo.width = $("#"+e).width();
	const separator = oo.width;
	oo.height=oo.width*.1;

c.rect(0,0,oo.width,oo.height/2);
c.stroke();

c.fillStyle = "#3897da"; // color of the time interval boxes

for(i in data) {
	const startTime = data[i].start * oo.width/86400;
	const endTime = data[i].end * oo.width/86400;
	const barWidth = endTime - startTime;
	c.fillRect(startTime,0,barWidth,oo.height/2);
}


c.textAlign = "center";
c.textBaseline = "top";
c.fillStyle = "#000000";
c.font = ".8em arial";
	for ( i = 1; i < 24; i++){ // draw the | for time clicks 
	drawLine(c,separator/24*i,oo.height/2,separator/24*i,oo.height/2*1.5);
	c.fillText(i, separator/24 * i, oo.height/2*1.5);
	}

$(oo).appendTo("#"+e); // assignt the graphic to div element
}






var myVinyls =  {
	"Classical music" : 10,
	"Alternative rock": 14,
	"Pop" : 2,
	"Jazz" :12
};

let myCanvas2 = document.getElementById('c2');
let ct = myCanvas2.getContext('2d');
c2.width = 500;
c2.height = 500;
ct.fillStyle = '#ffffff';
ct.fillRect(0,0,500,500);
