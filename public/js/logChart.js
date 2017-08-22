// console.log('log chart js');

// var myCanvas = document.getElementById('myCanvas');

// myCanvas.width = 400;
// myCanvas.height = 400;

// let ctx = myCanvas.getContext('2d');
// ctx.fillStyle= "#ff0000";
// let radius = myCanvas.height / 2;
// ctx.translate(radius, radius);
// radius = radius * 0.9;
// setInterval(drawClock,1000);

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






// var day = moment("2017-06-10");
// console.log(day.format('YYYY-MM-DD: X'));
// var start = moment('2017-06-10 21:07:34');
// var end = moment('2017-06-10 21:08:13');
// var startSec = start.format('X')- day.format("X");
// var endSec = end.format('X') - day.format('X');
// console.log('start second: '+startSec);
// console.log('end second:'+endSec);

const data2 = [{start:"2017-06-10 10:45:17",end:"2017-06-10 10:46:14"},
{start:"2017-06-10 10:46:35",end:"2017-06-10 10:47:41"},

{start:"2017-06-10 10:47:41",end: "2017-06-10 10:48:45"},
{start:"2017-06-10 12:01:51",end: "2017-06-10 13:40:17"},
];


function toSecond(start,end){
	const startTime = moment(start);
	const endTime = moment(end);
	const theDate = moment(startTime.format('YYYY-MM-DD'));
	const startSec = startTime.format('X') - theDate.format('X');
	const endSec = endTime.format('X')- theDate.format('X');
	const oo = {"start" : startSec, "end" : endSec};
	return oo;

}



o2('machine1',data2);
o2('machine2',data2);
function o2(e,data) {
	let oo = document.createElement('canvas');
	let c = oo.getContext('2d');
	oo.width = $("#"+e).width();
	const separator = oo.width;
	oo.height=oo.width*.1;

c.rect(0,0,oo.width,oo.height/2);
c.stroke();

c.fillStyle = "#3897da"; // color of the time interval boxes

for(i in data) {

	const log = toSecond(data[i].start,data[i].end); // convert datetime values to seconds

	const startTime = log.start * oo.width/86400;
	const endTime = log.end * oo.width/86400;
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