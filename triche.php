
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="fr"><head><title>Jouer au jeu du solitaire gratuit en ligne</title>

<meta name="DESCRIPTION" content="Jouer gratuitment au jeu du solitaire electronique en ligne">
<meta name="KEYWORDS" content="jouer jeu solitaire, solitare jeu, solitaire jeu, jeu electronique solitaire">
<meta name="robots" content="index,follow">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Language" content="fr">
<link href="style3colonnes1000.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!-- Original: Erik Gos (erik.gos@hiva.kuleuven.ac.be) -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- Begin
var pos=new Array(49);
var jumps=new Array();
var boardType="Solitaire";
var numMoves=0;
var finished=false;
var selectnum=false;
var autosolve=false;
var running=false;
var basenum=0;
var destnum=0;
var destnum1=0;
var destnum2=0;
var destnum3=0;
var destnum4=0;
var delaynum=500;
if (document.images) {
blank = new Image(19,19);
blank.src = "blank.gif";
empty = new Image(19,19);
empty.src = "empty.gif";
emptysel = new Image(19,19);
emptysel.src = "emptysel.gif";
peg = new Image(19,19);
peg.src = "peg.gif";
pegact = new Image(19,19);
pegact.src = "pegact.gif";
}
function display(pos,basenum,destnum) {
selectnum=false;
if (!basenum && !destnum) {
for (var i=0; i<pos.length; i++) {
if (pos[i]==-1) document.images["img"+i].src=blank.src;
else if (pos[i]==1) document.images["img"+i].src=peg.src;
else document.images["img"+i].src=empty.src;
}
}
else {
document.images["img"+basenum].src=empty.src;
document.images["img"+(basenum+destnum/2)].src=empty.src;
document.images["img"+(basenum+destnum)].src=peg.src;
for (var i=0; i<pos.length; i++) {
if (document.images["img"+i].src==emptysel.src)
document.images["img"+i].src=empty.src;
}
}
if (numMoves>1) win();
}
function move(num) {
var curNumMoves=numMoves; if (!document.images)
alert("Your browser does not support the 'document.images' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
else if (autosolve && running) {}
else if (autosolve && !finished) {
if (confirm('La fonction \'Solution\' est interrompue. Voulez-vous essayer vous-même?'))
newGame();
}
else if (selectnum) {
if (num!=basenum && num!=basenum+destnum1 && num!=basenum+destnum2 &&
num!=basenum+destnum3 && num!=basenum+destnum4)
alert("Choisir la destination ou cliquer à nouveau sur le pion d'origine!");
else if (num==basenum) {
document.images["img"+basenum].src=peg.src;
if (destnum1!=0)
document.images["img"+(basenum+destnum1)].src=empty.src;
if (destnum2!=0)
document.images["img"+(basenum+destnum2)].src=empty.src;
if (destnum3!=0)
document.images["img"+(basenum+destnum3)].src=empty.src;
if (destnum4!=0)
document.images["img"+(basenum+destnum4)].src=empty.src;
selectnum=false;
}
else if (num==basenum+destnum1) movePeg(basenum,destnum1)
else if (num==basenum+destnum2) movePeg(basenum,destnum2)
else if (num==basenum+destnum3) movePeg(basenum,destnum3)
else if (num==basenum+destnum4) movePeg(basenum,destnum4)
}
else if (pos[num]==0) {
}
else if ((num==3 || num==10) && pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
else if ((num==45 || num==38) && pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
else if ((num==21 || num==22) && pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if ((num==26 || num==27) && pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (num==4 || num==11 || num==19 || num==20) {
if (pos[num-1]==1 && pos[num-2]==0 && pos[num+7]==1 && pos[num+14]==0)
selPeg(num,-2,14);
else if (pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
}
else if (num==2 || num==9 || num==14 || num==15) {
if (pos[num+1]==1 && pos[num+2]==0 && pos[num+7]==1 && pos[num+14]==0)
selPeg(num,2,14);
else if (pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if (pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
} else if (num==28 || num==29 || num==37 || num==44) {
if (pos[num+1]==1 && pos[num+2]==0 && pos[num-7]==1 && pos[num-14]==0)
selPeg(num,2,-14);
else if (pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if (pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
}
else if (num==33 || num==34 || num==39 || num==46) {
if (pos[num-1]==1 && pos[num-2]==0 && pos[num-7]==1 && pos[num-14]==0)
selPeg(num,-2,-14);
else if (pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
}
else if (num==16 || num==17 || num==18 || num==23 || num==24 || num==25 || num==30 || num==31 || num==32) {
var cond1=(pos[num-1]==1 && pos[num-2]==0);
var cond2=(pos[num-7]==1 && pos[num-14]==0);
var cond3=(pos[num+1]==1 && pos[num+2]==0);
var cond4=(pos[num+7]==1 && pos[num+14]==0);
if ((cond1 && (cond2 || cond3 || cond4)) ||
(cond2 && (cond1 || cond3 || cond4)) ||
(cond3 && (cond1 || cond2 || cond4)))
{
basenum=num;
destnum1=destnum2=destnum3=destnum4=0;
document.images["img"+basenum].src=pegact.src;
if (cond1) {
destnum1=-2;
document.images["img"+(basenum+destnum1)].src=emptysel.src;
}
if (cond2) {
destnum2=-14;
document.images["img"+(basenum+destnum2)].src=emptysel.src;
}
if (cond3) {
destnum3=2;
document.images["img"+(basenum+destnum3)].src=emptysel.src;
}
if (cond4) {
destnum4=14;
document.images["img"+(basenum+destnum4)].src=emptysel.src;
}
selectnum=true;
}
else if (cond1) movePeg(num,-2);
else if (cond2) movePeg(num,-14);
else if (cond3) movePeg(num,2);
else if (cond4) movePeg(num,14);
}
if (curNumMoves!=numMoves) display(pos,basenum,destnum);
else if (finished) win();
}
function selPeg(num,ofset1,ofset2) {
basenum=num;
destnum1=ofset1;
destnum2=ofset2;
destnum3=destnum4=0;
document.images["img"+basenum].src=pegact.src;
document.images["img"+(basenum+destnum1)].src=emptysel.src;
document.images["img"+(basenum+destnum2)].src=emptysel.src;
selectnum=true;
}
function movePeg(num,ofset) {
pos[num+ofset]=1;
pos[num+ofset/2]=pos[num]=0
basenum=num;
destnum=ofset;
numMoves++;
}
function win() {
var cnt=0;
for(var i=0; i<pos.length; i++) {
if (pos[i]!=-1) cnt+=pos[i];
}
if (cnt==1 && autosolve) {
if (confirm('Après la fonction \'Solution\' voulez-vous essayer vous-même?'))
newGame();
}
else if (cnt==1 && pos[24]==1) {
finished=true;
if (confirm('Vous avez trouvé la meilleure solution! Voulez-vous rejouer?')) newGame();
}
else if (cnt==1) {
finished=true;
if (confirm('Bravo! voulez-vous rejouer?')) newGame();
}
else {
var legalMoves=false;
var num=0;
while (num<pos.length && !legalMoves) {
if (pos[num]==1 &&
(((num==2 || num==9 || num==14 || num==15 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==21 || num==22 || num==28 || num==29 || num==37 ||
num==44) && pos[num+1]==1 && pos[num+2]==0) ||
((num==4 || num==11 || num==19 || num==20 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==26 || num==27 || num==33 || num==34 || num==39 ||
num==46) && pos[num-1]==1 && pos[num-2]==0) ||
((num==2 || num==9 || num==14 || num==15 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==4 || num==11 || num==19 || num==20 || num==3 ||
num==10) && pos[num+7]==1 && pos[num+14]==0) ||
((num==33 || num==34 || num==39 || num==46 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==45 || num==38 || num==28 || num==29 || num==37 ||
num==44) && pos[num-7]==1 && pos[num-14]==0)))
legalMoves=true;
num++;
}
if (!legalMoves) {
finished=true;
if (confirm('Impossible de continuer! Voulez-vous rejouer?')) newGame();
}
}
}
function newGame() {
if (autosolve && running) {}
else if (document.images) {
autosolve=false;
finished=false;
if (boardType=="Cross") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[16]=pos[17]=pos[18]=pos[24]=pos[31]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Plus") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[17]=pos[22]=pos[23]=pos[24]=1;
pos[25]=pos[26]=pos[31]=pos[38]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Fireplace") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[2]=pos[3]=pos[4]=pos[9]=pos[10]=1;
pos[11]=pos[16]=pos[17]=pos[18]=1;
pos[23]=pos[25]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Up Arrow") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[3]=pos[9]=pos[10]=pos[11]=pos[15]=1;
pos[16]=pos[17]=pos[18]=pos[19]=1;
pos[24]=pos[31]=pos[37]=pos[38]=1;
pos[39]=pos[44]=pos[45]=pos[46]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Pyramid") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[16]=pos[17]=pos[18]=pos[22]=1;
pos[23]=pos[24]=pos[25]=pos[26]=1;
pos[28]=pos[29]=pos[30]=pos[31]=1;
pos[32]=pos[33]=pos[34]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Diamond") {
for (var i=0; i<pos.length; i++) pos[i]=1;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[2]=pos[4]=pos[14]=pos[20]=pos[24]=0;
pos[28]=pos[34]=pos[44]=pos[46]=0;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Solitaire") {
for (var i=0; i<pos.length; i++) pos[i]=1;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[24]=0;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
numMoves=0;
running=true;
changeBoard();
running=false;
solveArray();
display(pos);
}
else
alert("Your browser does not support the 'document.images' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
}
function initArray() {
this.length=initArray.arguments.length;
for (var i=0; i<this.length; i++) {
this[i] = initArray.arguments[i];
}
}
function drawPreview(start,end) {
i=start;
j=end;
baseref=jumps[start];
offset=jumps[start+1];
pos[baseref]=pos[baseref+offset/2]=0;
pos[baseref+offset]=1;
document.images["img"+baseref].src=pegact.src;
document.images["img"+(baseref+offset)].src=emptysel.src;
solveRunning=setTimeout('drawJump(i,j)',delaynum);
}
function drawJump(start,end) {
i=start; j=end;
baseref=jumps[start];
offset=jumps[start+1];
document.images["img"+baseref].src=empty.src;
document.images["img"+(baseref+offset/2)].src=empty.src;
document.images["img"+(baseref+offset)].src=peg.src;
if (start+2==end) {
document.buttonsform.solve.value="Résoudre";
running=false;
finished=true;
setTimeout('win()',delaynum);
}
else solveRunning=setTimeout('drawPreview(i+2,j)',delaynum);
}
function solve() {
if (!document.images)
alert("Your browser does not support the 'document.images' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
else if (autosolve && running) {
clearTimeout(solveRunning);
document.buttonsform.solve.value="Résoudre";
running=false;
}
else {
document.buttonsform.solve.value=" Stop ";
newGame();
autosolve=true;
running=true;
solveRunning=setTimeout('drawPreview(0,jumps.length)',delaynum);
}
}
function changeBoard() {
formName=document.buttonsform;
if (!running) {
boardType=formName.options[formName.options.selectedIndex].value;
newGame();
}
else {
optlength=formName.options.length;
for (var m=0; m<optlength; m++) {
if (formName.options[m].value==boardType) {
formName.options.selectedIndex=m;
break;
}
}
}
}
function solveArray() {
if (boardType=="Cross") {
jumps = new initArray(17,-2,31,-14,18,-2,15,2,10,14);
}
else if (boardType=="Plus") {
jumps = new initArray(23,-2,25,-2,10,14,24,-2,21,2,
38,-14,23,2,26,-2); }
else if (boardType=="Fireplace") {
jumps = new initArray(17,2,4,14,25,-14,2,2,4,14,
19,-2,10,14,24,-2,9,14,22,2);
}
else if (boardType=="Up Arrow") {
jumps = new initArray(46,-14,31,2,45,-14,44,-14,30,2,33,-2,
18,-14,4,-2,16,2,2,14,15,2,18,-2,31,
-14,16,2,19,-2,10,14);
}
else if (boardType=="Pyramid") {
jumps = new initArray(23,14,25,14,28,2,34,-2,37,-14,39,-14,
16,14,18,-2,31,-2,29,-14,15,2,17,14,
26,-2,31,-14,10,14);
}
else if (boardType=="Diamond") {
jumps = new initArray(30,14,44,2,32,2,34,-14,18,-14,4,-2,
16,-2,14,14,46,-14,20,-2,2,14,28,2,
38,-14,17,-2,15,14,29,2,31,2,33,-14,
19,-2,24,-2,10,14,25,-2,22,2);
}
else if (boardType=="Solitaire") {
jumps = new initArray(38,-14,33,-2,46,-14,25,14,44,2,46,-14,
11,14,20,-2,17,2,34,-14,20,-2,
15,2,2,14,23,-14,4,-2,2,14,
37,-14,28,2,31,-2,14,14,28,2,
17,-2,15,14,29,2,31,2,33,-14,19,-2,
24,-2,10,14,25,-2,22,2);
}
}
// End -->
</script>
</head>
<body onload="window.newGame">
<div style="text-align: center;"><a name="haut"></a><!-- DEBUT ENTETE --></div>
<div id="global">
<div id="entete">
<div id="barrehaut"></div>
<div id="logo"><a href="http://www.rene-84.com/"><img style="border: 0px solid ; width: 268px; height: 64px;" alt="rene-84.com, portail generaliste de Provence" src="images/banniere.jpg"></a></div>
<div id="bannierepub"><!-- PUBLICITE -->
<script language="JavaScript" type="text/javascript" src="http://www.wipub.com/ban_468.php?id_affilie=4138"></script><!-- FIN PUBLICITE --></div>
</div>
<!-- FIN ENTETE -->
<div id="corps">
<div id="corpsgauche">
<div id="texte">
<h1 style="color: rgb(255, 102, 102); text-align: center;">JOUER
AU JEU DU SOLITARE<small><small> </small></small></h1>
<br>
<span><font style="font-size: 9pt;" size="2"><font face="Verdana, sans-serif"><strong>Jouer</strong>
à ce </font></font></span><span style="font-weight: normal;"><span><font style="font-size: 9pt;" size="2"><font face="Verdana, sans-serif"><strong>jeu
gratuit</strong>
du <span style="font-weight: bold;">solitaire&nbsp;<strong></strong>
</span>é</font></font><span><font style="font-size: 9pt;" size="2"><font face="Verdana, sans-serif">lectronique </font></font></span><font style="font-size: 9pt;" size="2"><font face="Verdana, sans-serif"><strong>en
ligne</strong>, demande beaucoup
de réflexion. &nbsp; &nbsp; &nbsp; &nbsp;<span style="color: rgb(204, 0, 0); font-weight: bold;"> Faire un
clic gauche de sourie sur la boule choisie</span><br style="color: rgb(204, 0, 0); font-weight: bold;">
<br>
</font></font></span></span>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="text-align: center; vertical-align: middle;">
<center>
<script language="JavaScript">
<!-- Begin
document.write(
"<center>\n"+
"<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n"+
"<tr><td valign=\"top\" align=\"center\">\n"+
"<table bgcolor=\"#ffffbb\" border=\"1\">\n"+
"<tr><td align=\"center\">\n"+
"<h2 align=\"center\"><font face=\"Verdana, Arial, Helvetica\" color=\"#000080\">\n"+
"Solitaire\n"+
"</h2></font>\n"+
"<p>\n"+
"<table border=\"1\" bgcolor=\"#007777\" cellpadding=\"15\" cellspacing=\"0\">\n"+
"<tr><td align=\"center\">");
if (navigator.appName != "Microsoft Internet Explorer") {
document.write(
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img0\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img1\">\n"+
"<a href=\"#\" onClick=\"window.move(2);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img2\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(3);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img3\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(4);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img4\"></A>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img5\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img6\"><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img7\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img8\">\n"+
"<a href=\"#\" onClick=\"window.move(9);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img9\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(10);return false\" onMouseOver=\"window.status='';\n"+
"return ???a?????????c?????????????????????????????????????`???????????|U?????????true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img10\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(11);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img11\"></A>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img12\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img13\"><BR>\n"+
"<a href=\"#\" onClick=\"window.move(14);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img14\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(15);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img15\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(16);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img16\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(17);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img17\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(18);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img18\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(19);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img19\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(20);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img20\"></A><BR>\n"+
"<a href=\"#\" onClick=\"window.move(21);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img21\"></A>\n"+
"<a href=\"#\" onClick=\"window???a?????????c?????????????????????????????????????`???????????|U?????????.move(22);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img22\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(23);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img23\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(24);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"empty.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img24\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(25);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img25\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(26);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img26\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(27);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img27\"></A><BR>\n"+
"<a href=\"#\" onClick=\"window.move(28);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img28\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(29);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img29\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(30);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img30\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(31);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img31\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(32);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img32\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(33);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img33\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(34);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img34\"></A><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img35\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img36\">\n"+
"<a href=\"#\" onClick=\"window.move(37);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img37\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(38);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img38\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(39);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img39\"></A>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img40\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img41\"><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img42\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img43\">\n"+
"<a href=\"#\" onClick=\"window.move(44);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img44\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(45);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img45\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(46);return false\" onMouseOver=\"window.status='';\n"+
"return true\"><img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img46\"></A>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img47\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img48\"><BR>")
}
else {
document.write(
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img0\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img1\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img2\" \n"+
"onClick=\"window.move(2);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img3\" \n"+
"onClick=\"window.move(3);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img4\" \n"+
"onClick=\"window.move(4);return false\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img5\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img6\"><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img7\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img8\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img9\" \n"+
"onClick=\"window.move(9);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img10\" \n"+
"onClick=\"window.move(10);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img11\" \n"+
"onClick=\"window.move(11);return false\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img12\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img13\"><BR>\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img14\" \n"+
"onClick=\"window.move(14);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img15\" \n"+
"onClick=\"window.move(15);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img16\" \n"+
"onClick=\"window.move(16);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img17\" \n"+
"onClick=\"window.move(17);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img18\" \n"+
"onClick=\"window.move(18);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img19\" \n"+
"onClick=\"window.move(19);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img20\" \n"+
"onClick=\"window.move(20);return false\"><BR>\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img21\" \n"+
"onClick=\"window.move(21);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img22\" \n"+
"onClick=\"window.move(22);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img23\" \n"+
"onClick=\"window.move(23);return false\">\n"+
"<img src=\"empty.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img24\" \n"+
"onClick=\"window.move(24);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img25\" \n"+
"onClick=\"window.move(25);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img26\" \n"+
"onClick=\"window.move(26);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img27\" \n"+
"onClick=\"window.move(27);return false\"><BR>\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img28\" \n"+
"onClick=\"window.move(28);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img29\" \n"+
"onClick=\"window.move(29);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img30\" \n"+
"onClick=\"window.move(30);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img31\" \n"+
"onClick=\"window.move(31);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img32\" \n"+
"onClick=\"window.move(32);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img33\" \n"+
"onClick=\"window.move(33);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img34\" \n"+
"onClick=\"window.move(34);return false\"><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img35\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img36\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img37\" \n"+
"onClick=\"window.move(37);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img38\" \n"+
"onClick=\"window.move(38);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img39\" \n"+
"onClick=\"window.move(39);return false\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img40\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img41\"><BR>\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img42\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img43\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img44\" \n"+
"onClick=\"window.move(44);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img45\" \n"+
"onClick=\"window.move(45);return false\">\n"+
"<img src=\"peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img46\" \n"+
"onCli???a??<??????cck=\"window.move(46);return false\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img47\">\n"+
"<img src=\"blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img48\"><BR>\n");
}
document.write(
"</td></tr>\n"+
"</table>\n"+
"<p>\n"+
"<form name=\"buttonsform\">\n"+
"<input type=\"button\" name=\"new\" value=\"Rejouer\" onClick=\"window.newGame()\">\n"+
"<input type=\"button\" name=\"solve\" value=\"Résoudre\" onClick=\"window.solve()\">\n"+
"<select name=\"options\" onChange=\"(window.changeBoard())\">\n"+
"<option value=\"Cross\">Croix\n"+
"<option value=\"Plus\">Plus\n"+
"<option value=\"Fireplace\">Cheminée\n"+
"<option value=\"Up Arrow\">Flèche\n"+
"<option value=\"Pyramid\">Pyramide\n"+
"<option value=\"Diamond\">Diamant\n"+
"<option selected value=\"Solitaire\">Solitaire\n"+
"</select>\n"+
"</form>\n"+
"<p>\n"+
"<table width=\"400\" border=\"0\">\n"+
"<tr><td>\n"+
"<font face=\"Verdana, Arial, Helvetica\" SIZE=\"-1\" color=\"#000080\">\n"+
"<P align=\"justify\">\n"+
"Essayez d'éclaircir le tableau en sautant par-dessus les pions. \n"+
"Le pion \"éliminé\" sera retiré du champ.\n"+
"S'il y a plus d'une solution, choisissez\n"+
"celle qui vous semble la plus appropriée. Vous avez gagné lorsqu'il \n"+
"n'y a plus qu'un pion (la solution idéale étant qu'il soit au milieu).\n"+
"</font>\n"+
"</td></tr>\n"+
"</table>\n"+
"</td></tr>\n"+
"</table>\n"+
"</td></tr>\n"+
"</table>\n"+
"</center>");
newGame();
// End -->
</script>
<noscript><table
width="100%" height="100%" border="0" cellpadding="0"
cellspacing="0">
<tr><td valign="middle" align="center">
<table border="1" bgcolor="#FFFFBB" cellpadding="15"
cellspacing="0">
<tr><td align=center>
<font face="Verdana, Arial, Helvetica" color="#000080"
SIZE=-1><B>
<font SIZE=+2>JavaScript Solitaire!</font>
<p><BR>
You probably disabled JavaScript in your browser's settings or are
running a <BR>
JavaScript incompatible browser.<p>
This game needs JavaScript 1.1 to run properly.
</td></tr>
</table>
</td></tr>
</table> </noscript>
</center>
</td>
</tr>
<tr>
<td>
<br>
<div>
<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5686917233438795";
/* rene-84.com pages jeux */
google_ad_slot = "7286072762";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
</div>
<br>
<h2 style="text-align: center;">NOUVEAU sur
Rene-84.com : <big style="font-weight: bold;"><a href="http://www.rene-84.com/jeux_gratuits/jeux-flash-en-ligne/" target="_blank">portail avec 70 jeux flash</a></big></h2>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat3347.php?categorie=Action">Action</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat7100.php?categorie=Arcade">Arcade</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat7da6.php?categorie=Aventure">Aventure</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/catf553.php?categorie=Carte">Carte</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cataa61.php?categorie=Casino">Casino</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat4269.php?categorie=Gestion">Gestion</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cata1b5.php?categorie=Puzzle">Puzzle</a></td>
</tr>
<tr>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/catae06.php?categorie=Racing">Racing</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cate97c.php?categorie=Reflexion">Reflexion</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat077f.php?categorie=Role%20Playing">Role
Playing</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/catc0eb.php?categorie=Shoot">Shoot
- tir</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat573a.php?categorie=Sport"> Sport</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cat4b0e.php?categorie=Strategy">Strategy</a></td>
<td align="undefined" valign="undefined"><a target="_blank" href="jeux-flash-en-ligne/cate791.php?categorie=Divers">Divers</a></td>
</tr>
</tbody>
</table>
<h2 style="color: rgb(255, 102, 102); text-align: center;"><big style="color: rgb(0, 0, 153);"><strong><big><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2"><big><big>Règle
du jeu</big></big></font></font></big></strong></big><br>
</h2>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">Tout
d'abord, le solitaire est un jeu qui n'est pas simple.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">Il
aurait été inventé au 17ème
siècle
par un aristocrate emprisonné à la Bastille. Il
se
jouait sur une planchette comportant 37 trous ou alvéoles.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">La
version que je vous présente est le jeu anglais avec 33
trous
en version électronique bien sûr.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">Dans
la configuration de départ
«&nbsp;solitaire&nbsp;»,
tous les trous sont remplis de billes, sauf un. Vous pouvez aussi
sélectionner la disposition et le nombre de ces billes
suivant
la configuration de départ envisagée.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">Le
but du jeu est d'arriver à un plateau ne comptant plus
qu'une
seule bille.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">On
ne peut déplacer une bille qu'en sautant une autre bille
vers
une case vide voisine, comme au jeu de dames. La prise peut se faire
en avant ou en arrière, mais pas en diagonale.Pour
déplacer
une bille, il suffit de cliquer dessus. S'il y a plusieurs
possibilités, l'ordinateur vous demandera de cliquer sur la
case de destination.</font></font></p>
<p style="margin-bottom: 0.5cm; text-align: justify;"><font face="Verdana, sans-serif"><font style="font-size: 9pt;" size="2">Pour
avoir une chance de réussir, il faut procéder
méthodiquement et ne pas laisser une bille isolée
dans
un secteur du plateau.</font></font></p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><big><big><span style="font-weight: bold;"></span></big></big></p>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td align="undefined" valign="undefined"><a href="jeu_dames_gratuit.html">Dames</a></td>
<td align="undefined" valign="undefined"><a href="jouer_bataille_navale_gratuit.html">Bataille
navale</a></td>
<td align="undefined" valign="undefined"><a href="jouer_jeu_demineur_gratuit_.html">Démineur</a></td>
<td align="undefined" valign="undefined"><a href="jouer_jeu_gratuit_du_pendu.html">Pendu</a></td>
</tr>
<tr>
<td align="undefined" valign="undefined"><a href="jouer_jeu_morpion_gratuit.html">Morpion</a></td>
<td align="undefined" valign="undefined"><a href="jouer_au_jeu_du_solitaire_gratuit.html">Solitaire</a></td>
<td align="undefined" valign="undefined"><a href="jeu_sudoku_gratuit.html">Sudoku</a></td>
<td align="undefined" valign="undefined"><a href="quiz.html" target="_blank">Quiz</a></td>
</tr>
<tr>
<td align="undefined" valign="undefined"><a href="jouer_mots_croises.html">Mots croisés</a></td>
<td align="undefined" valign="undefined"><a href="jouer-jeu-bowling.html">Jeu de quilles, bowling</a></td>
<td align="undefined" valign="undefined"><a href="jspace-invaders.html">Jspace invaders 1</a>&nbsp;<a href="invaders_java/space-invaders.html" target="_blank">Jspace&nbsp;2</a></td>
<td align="undefined" valign="undefined"><a href="jeu-serpent-snake.html">Serpent</a></td>
</tr>
<tr>
<td align="undefined" valign="undefined"><a href="retrouver-paires-images.html">Retrouver les
paires d'images</a></td>
<td align="undefined" valign="undefined"><a href="jouer-jeu-memoire.html">Les lumières qui
clignotent</a></td>
<td align="undefined" valign="undefined"><a href="jouer-jeu-plus-moins.html">Plus ou moins</a></td>
<td align="undefined" valign="undefined"><a href="jouer-jeu-tetris.html">Tétris</a></td>
</tr>
<tr>
<td align="undefined" valign="undefined"><a href="poker-un-joueur.html">Poker à un seul joueur</a></td>
<td align="undefined" valign="undefined">J<a href="jeu-des-allumettes.html">eu des
allumettes</a></td>
<td align="undefined" valign="undefined"><a href="jouer_jeu_pong_gratuit.html">Pong</a></td>
<td align="undefined" valign="undefined"><a href="jeux_flash.html" target="_blank">Jeux
divers</a></td>
</tr>
</tbody>
</table>
<br>
<br>
<div>
<center>
      <script type="text/javascript"><!--
google_ad_client = "ca-pub-5686917233438795";
/* Rene-84.com jeux 300 X 250 */
google_ad_slot = "7085742904";
google_ad_width = 300;
google_ad_height = 250;
//-->
      </script>
      <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
      </script></center>
</div><br><br>
<p style="text-align: center;"><font color="#000080"><big style="color: rgb(153, 153, 255); font-weight: bold;"><big>**********</big></big></font></p>
</div>
<div id="contenermenugauche"><!-- DEBUT MENU GAUCHE -->
<div class="petitebarre">Provence</div>
<div class="menugauche">
<ul>
<li><a href="/gordes/index.html" target="_top">Gordes</a>
</li>
<li><a href="/chateauneuf-pape/index.html" target="_top">Châteauneuf
du Pape</a>
</li>
<li><a href="/provence_traditions/index.html" target="_top">Traditions
de Provence </a> </li>
<li><a href="/provence_traditions/santons_provence_histoire_personnages.html" target="_top">Santons
de Provence</a> </li>
<li><a href="/provence_traditions/table_treize_dessert_fete_noel_13.html" target="_top">Treize
desserts de Noël</a> </li>
<li><a href="/provence_traditions/recette_pompe_a_l_huile.html" target="_top">Recettes
desserts</a> </li>
</ul>
</div>
<div class="petitebarre">Logiciels
informatiques</div>
<div class="menugauche">
<ul>
<li><a href="/logiciels_gratuits/logitheque.php">Logithèque
- Téléchargement</a></li>
<li><a href="/logiciels_gratuits/index.html">Antivirus
et sécurité</a> </li>
<li><a href="/logiciels_gratuits/logiciel_naviguation_internet_messagerie.html">Navigation
- messagerie</a> </li>
<li><a href="/logiciels_gratuits/freeware_2.html">Téléchargeurs</a>
</li>
<li><a href="/logiciels_gratuits/freeware_3.html">Utilitaires</a>
</li>
<li><a href="/logiciels_gratuits/freeware_photos_images.html">Photos
et images</a> </li>
<li><a href="/logiciels_gratuits/logiciel_gratuit_bureautique_traitement_texte.html">Bureautique</a>
</li>
<li><a href="/logiciels_gratuits/lecteur_multimedia_logiciel_audio_video_tv_gratuit.html">Multimedia</a>
</li>
<li><a href="/logiciels_gratuits/editeurs-sites-outils-webmasters.html">Logiciels
pour webmasters</a> </li>
<li><a href="/logiciels_gratuits/recherche_logiciels_gratuits.html">Recherche
logiciels</a> </li>
<li><a href="/logiciels_gratuits/nouveaux_logiciels_gratuits.html">Actualités
du&nbsp;logiciel</a> </li>
<li><a href="/logiciels_gratuits/logiciels_astuces.html">Astuces
du jour</a> </li>
<li><a href="/logiciels_gratuits/dictionnaire_informatique.html">Dico&nbsp;informatique</a>
</li>
</ul>
</div>
<div class="petitebarre">Sites
web</div>
<div class="menugauche">
<ul>
<li><a href="/sites_internet/sites_a_voir.html">Annuaire
de sites</a> </li>
<li><a href="/sites_internet/index.html">Les
rubriques</a> </li>
<li><a href="/sites_internet/actualite_internet.html">Actualités
du net</a> </li>
<li><a href="/sites_internet/audit_gratuit_de_site.html">Audit
gratuit de sites</a> </li>
<li><a href="/sites_internet/generateur_balises_meta_metatag.html" target="_blank">Générateur de balises méta</a> </li>
<li><a href="/sites_internet/generateur_code_css.html" target="_blank">Générateur
code CSS</a> </li>
<li><a href="/sites_internet/generateur_erreurs_frappe.html" target="_blank">Générateur erreurs frappe</a> </li>
<li><a href="/moteur_recherche.html">Moteur
recherche</a> </li>
<li><a href="/sites_internet/palette_couleurs_site_web_safe.html" target="_blank">Palette de couleurs</a> </li>
<li><a href="/sites_internet/recherche_whois_nom_domaine.html">Whois
nom domaine</a> </li>
<li><a href="/sites_internet/outil_referencement_gratuit.html">Outil
référencement</a> </li>
<li><a href="/sites_internet/futur_pagerank_google.html">Connaître
futur pagerank</a> </li>
</ul>
</div>
<div class="petitebarre">Loisirs
Passions</div>
<div class="menugauche">
<ul>
<li><a href="/secourisme_travail/index.html">Secourisme</a>
</li>
<li><a href="/associations/index.html" target="_top">Associations</a>
</li>
<li><a href="/gsa-vaucluse/index.html">ASAVPA
et GSA</a> </li>
<li><a href="/chasse/index.html">Chasse</a></li>
<li><a href="/recettes-de-cuisine/index.html">Cuisine</a></li>
<li><a href="/football/index.html">Football</a></li>
<li><a href="/jardinage/index.html">Jardinage</a></li>
</ul>
</div>
<div class="petitebarre">Jeux
gratuits</div>
<div class="menugauche">
<ul>
<li><a href="/jeux_gratuits/index.html">Jeu
du jour</a> </li>
<li><a href="/jeux_quiz.html">Jeux
quiz</a> </li>
<li><a href="/jeux_gratuits/jeu_dames_gratuit.html">Jeu
de dames</a> </li>
<li><a href="/jeux_gratuits/jouer_bataille_navale_gratuit.html">Bataille
navale</a> </li>
<li><a href="/jeux_gratuits/jouer_jeu_demineur_gratuit_.html">Démineur</a>
</li>
<li><a href="/jeux_gratuits/jouer_jeu_pong_gratuit.html">Jeu
de Pong</a> </li>
<li><a href="/jeux_gratuits/jouer_jeu_gratuit_du_pendu.html">Le
pendu</a> </li>
<li><a href="/jeux_gratuits/jouer_jeu_morpion_gratuit.html">Morpion</a>
</li>
<li><a href="/jeux_gratuits/jeu_sudoku_gratuit.html">Sudoku</a>
</li>
<li><a href="/jeux_gratuits/jouer_au_jeu_du_solitaire_gratuit.html">Solitaire</a>
</li>
<li><a href="/jeux_gratuits/jouer_mots_croises.html">Mots
croisés</a> </li>
</ul>
</div>
<div class="petitebarre">Services
gratuits</div>
<div class="menugauche">
<ul>
<li><a href="/annuaire.html" target="_blank">Annuaire
téléphonique</a> </li>
<li><a href="/annuaire_inverse.html" target="_blank">Annuaire
inversé</a> </li>
<li><a href="/dictionnaire_traduction_francais_anglais.html" target="_blank">Dictionnaire&nbsp;Français</a></li>
<li><a href="/services_gratuits/conjuger_verbe_francais.html">Conjugaison
verbe</a></li>
<li><a href="/rechercher_code_postal.html.html">Recherche
code postal</a> </li>
<li><a href="/moteur_recherche.html">Moteur
recherche sites</a> </li>
<li><a href="/meteo_gratuite.html">Météo
gratuite</a> </li>
<li><a href="/programmes_tv.html">Programmes
soir TV</a> </li>
<li><a href="/actualites_echos_coulisses_tv.html">Echos
coulisses TV</a> </li>
<li><a href="/recherche_infos_celebrites.html">Actualité
des célébrités</a> </li>
<li><a href="/actualites_jour.html">Actualités
du jour</a> </li>
<li><a href="/horoscope_gratuit.html">Horoscope
gratuit</a>
</li>
<li><a href="/humour/index.html">Histoire
drôle du jour</a>
</li>
<li><a href="/concours_bons_plans.html">Bons
plans </a> </li>
<li><a href="/resultats_loto.html">Résultats
loto et
jeux</a> </li>
<li><a href="/resultats_match_football.html">Scores
matches foot</a> </li>
<li><a href="/itineraire_plan.html">Itinéraires
et plans</a> </li>
<li><a href="/actualite_cinema.html">Sorties
cinéma</a> </li>
<li><a href="/ecard_gratuite.html" target="_blank">Envoi
cartes postales</a> </li>
<li><a href="/radio_tv_gratuite.html">Radios
et tv
online</a> </li>
<li><a href="/tester_ligne_telephonique_adsl.html" target="_blank">Test
ligne pour ADSL</a> </li>
<li><a href="/horloge_parlante.html">Horloge
parlante</a> </li>
</ul>
</div>
<div class="petitebarre">Site
rene-84.com</div>
<div class="menugauche">
<ul>
<li><a href="/sitemap.html">Plan
du site</a> </li>
<li><a href="/livre_or/livre.html" target="_blank">Livre
d'or</a>
</li>
<li><a href="/contact.html" target="_top">Contact
webmaster</a> </li>
<li><a href="/partenaires.html">Liste
partenaires</a> </li>
<li><a href="/liens-partenaires.html">Faire
un lien</a> </li>
</ul>
</div>
<!-- FIN MENU GAUCHE --></div>
</div>
<div id="corpsdroit"><!-- DEBUT MENU DROITE -->
<div id="contenermenudroite">
<div class="petitebarre">Services
gratuits</div>
<div class="menugauche">
<ul>
<li><a href="/annuaire.html" target="_blank">Annuaire
téléphonique</a> </li>
<li><a href="/annuaire_inverse.html" target="_blank">Annuaire
inversé</a> </li>
<li><a href="/dictionnaire_traduction_francais_anglais.html" target="_blank">Dictionnaire&nbsp;Français</a></li>
<li><a href="/services_gratuits/conjuger_verbe_francais.html">Conjugaison
verbe</a></li>
<li><a href="/rechercher_code_postal.html.html">Recherche
code postal</a> </li>
<li><a href="/moteur_recherche.html">Moteur
recherche sites</a> </li>
<li><a href="/meteo_gratuite.html">Météo
gratuite</a> </li>
<li><a href="/programmes_tv.html">Programmes
soir TV</a> </li>
<li><a href="/actualites_echos_coulisses_tv.html">Echos
coulisses TV</a> </li>
<li><a href="/recherche_infos_celebrites.html">Actualité
des célébrités</a> </li>
<li><a href="/actualites_jour.html">Actualités
du jour</a> </li>
<li><a href="/horoscope_gratuit.html">Horoscope
gratuit</a>
</li>
<li><a href="/humour/index.html">Histoire
drôle du jour</a>
</li>
<li><a href="/concours_bons_plans.html">Concours
bons plans </a> </li>
<li><a href="/resultats_loto.html">Résultats
loto et
jeux</a> </li>
<li><a href="/resultats_match_football.html">Scores
matches foot</a> </li>
<li><a href="/itineraire_plan.html">Itinéraires
et plans</a> </li>
<li><a href="/actualite_cinema.html">Sorties
cinéma</a> </li>
<li><a href="/ecard_gratuite.html" target="_blank">Envoi
cartes postales</a> </li>
<li><a href="/radio_tv_gratuite.html">Radio
et tv
online</a> </li>
<li><a href="/tester_ligne_telephonique_adsl.html" target="_blank">Test
ligne pour ADSL</a> </li>
<li><a href="/horloge_parlante.html">Horloge
parlante</a> </li>
</ul>
<form style="width: 100px;" action="http://www.google.com/search" method="get"><input value="UTF-8" name="ie" type="hidden"><input value="UTF-8" name="oe" type="hidden">
<table style="background-color: rgb(255, 255, 255); width: 142px; height: 118px;">
<tbody>
<tr>
<td><a href="http://www.google.com/"><img style="border: 0px solid ; width: 75px; height: 31px;" alt="Google" src="images/Logogoogle.gif"></a><br>
<input maxlength="255" size="17" name="q"><br>
<input value="Rechercher" name="btnG" type="submit"><font size="-1"><input value="rene-84.com" name="domains" type="hidden"><br>
<input value="" name="sitesearch" type="radio">sur
le
web <br>
<input checked="checked" value="rene-84.com" name="sitesearch" type="radio">&nbsp;Rene-84.com<br>
</font></td>
</tr>
</tbody>
</table>
</form>
<p align="center"><!-- Code WiPub.com pour bannieres 120x600 Automatiques --><font color="#000080">
<script language="JavaScript" type="text/javascript" src="http://www.wipub.com/ban_120.php?id_affilie=4138"></script><!-- Fin Code WiPub.com --></font></p>
</div>
<!-- FIN MENU DROITE --></div>
</div>
</div>
<!-- DEBUT PIED PAGE -->
<div id="pied">
<div id="piedpage1"><font color="#000080"><a href="#haut"><img style="border: 0px solid ; width: 33px; height: 53px;" alt="Retour haut de page" src="images/bouton_haut.png"></a><br>
<a href="http://validator.w3.org/check?uri=referer" target="_blank"><img style="border: 0px solid ; width: 75px; height: 26px;" src="images/w3chtml4.png" alt="Valid HTML 4.01 Transitional"></a>&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<img title="jouer jeu solitaire, solitare jeu, solitaire jeu, jeu electronique solitaire" style="width: 10px; height: 10px;" alt="jouer jeu solitaire, solitare jeu, solitaire jeu, jeu electronique solitaire" src="images/puce.png">
&nbsp; &nbsp; &nbsp; &nbsp;<a href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.rene-84.com/style3colonnes1000.css" target="_blank"><img alt="Valid CSS!" src="images/w3ccss.png" style="border: 0px solid ; width: 75px; height: 26px;"> </a>
</font></div>
<div id="piedpage2"><font color="#000080"><br>
</font></div>
</div>
<!-- DEBUT SiteSearch Google -->
<div style="height: 20px;" id="google">
<form style="width: 160px;" method="get" action="http://www.google.com/search" target="_blank"><u><input name="ie" value="UTF-8" type="hidden"><input name="oe" value="UTF-8" type="hidden"></u>
<table style="height: 10px; left: 821px; width: 173px;">
<tbody>
<tr>
<td colspan="1" rowspan="1"><a href="http://www.google.com/" target="_blank"><img style="left: 2px; width: 35px; height: 18px;" src="http://www.google.com/logos/Logo_40wht.gif" alt="Google" border="0"></a> <input name="q" size="10" maxlength="255" value="" type="text"><input name="btnG" value="OK" style="left: 5px; width: 30px; height: 25px;" type="submit"><font size="-1"><input value="rene-84.com" name="domains" type="hidden"><input name="sitesearch" value="rene-84.com" type="hidden"></font></td>
</tr>
</tbody>
</table>
</form>
</div>
<!-- FIN SiteSearch Google --><!-- DEBUT TRADUCTION VIA GOOGLE -->
<div id="traduction">
<form style="width: 165px;" action="http://translate.google.com/translate"><font color="#000080"><input name="hl" value="fr" type="hidden"><input name="ie" value="UTF8" type="hidden"><input name="oe" value="UTF8" type="hidden"><input name="prev" value="/language_tools" type="hidden">
<script type="text/javascript" language="JavaScript">
document.write('<input type="hidden" name="u" value="'+document.location.href+'">');
</script>
<select name="langpair" size="1"><option value="fr|en" selected="selected">&nbsp;
&nbsp;&nbsp;English</option><option value="fr|de">&nbsp;
&nbsp;&nbsp; Deutch</option><option value="fr|es">&nbsp;
&nbsp;&nbsp; Español</option><option value="fr|it">&nbsp;
&nbsp;&nbsp; Italiano</option><option value="fr|pt">&nbsp;
&nbsp;&nbsp; Português</option><option value="fr|ru">&nbsp;
&nbsp;&nbsp; &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</option><option value="fr|ir">&nbsp;
&nbsp;&nbsp; Irish</option></select>
&nbsp;
<input value="OK" type="submit"></font></form>
</div>
<!-- FIN TRADUCTION VIA GOOGLE --><!-- DEBUT MENU HORIZINTAL -->
<div id="menuhorizontal"><font color="#000080"><a href="/index.html">Accueil</a>&nbsp;
&nbsp;<a href="/provence_traditions/index.html">
Provence</a>&nbsp; &nbsp;<a href="/logiciels_gratuits/index.html">Logiciels</a>&nbsp;
&nbsp;<a href="/sites_internet/index.html">Création
sites</a> &nbsp;&nbsp;<a href="/secourisme_travail/index.html">Secourisme</a>
&nbsp;&nbsp;<a href="/associations/index.html">Associations</a>
&nbsp;&nbsp;<a href="/chasse/index.html">Chasse</a>&nbsp;
&nbsp;<a href="/jeux_gratuits/index.html">Jeux</a>&nbsp;
&nbsp;<a href="/humour/index.html">Humour</a>&nbsp;
&nbsp;<a href="/regarder_television_radio_gratuite/index.html">Médias</a>&nbsp;
&nbsp;<a target="_blank" href="http://www.auto-info.fr">Automobile</a>
&nbsp; <a href="/football/index.html">Football</a>
&nbsp; <a href="/jardinage/index.html">Jardin</a>
&nbsp;&nbsp;<a href="/recettes-de-cuisine/index.html">Cuisine</a>
&nbsp; <a href="/services_gratuits/index.html">Services</a>
&nbsp;&nbsp;<a href="/sitemap.html">Site</a>
</font></div>
<!-- FIN MENU HORIZONTAL --><!-- FIN PIED PAGE --></div>
</body></html>
