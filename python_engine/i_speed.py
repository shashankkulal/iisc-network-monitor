import mysql.connector
import os, sys, time, rrdtool
working_dir = "/var/www/html/python_engine"
os.chdir(working_dir)

def createDb(sid):
	rrdtool.create("speedtest/database/" + sid + ".rrd",
	"--step","3600",
	"--start","N",
	"DS:up:GAUGE:5400:0:200",
	"DS:dw:GAUGE:5400:0:200",
	"RRA:MAX:0.5:1:168",	
	)

	
def updateDb(sid):
	sid = str(sid)
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select down,up from speedtest where sid='%s'" % sid)
	for i in cursor:
		up = str(i[1])
		down = str(i[0])
		rrdtool.update("speedtest/database/"+sid+".rrd", "--template", "up:dw", "N:%s:%s" % (up,down))
	cursor.close()
	cnx.close()
	rrdtool.graph("speedtest/images/"+sid+"_1d.png",
	"--slope-mode", "--start", "-86400", "--end", "now",
	"--width", "900", "--height", "200",
	"-a", "PNG", "--title", "Internet Speed (24 Hours)",
	"--vertical-label", "Mbit", "--watermark", "`date`",
	"--lower-limit", "0",
	"--x-grid", "MINUTE:10:HOUR:1:MINUTE:120:0:%R",
	"--alt-y-grid", "--rigid",
	"DEF:up=speedtest/database/"+sid+".rrd:up:MAX",
	"DEF:dw=speedtest/database/"+sid+".rrd:dw:MAX",
	"LINE1:dw#FF6600:Download",
	"GPRINT:dw:LAST:Cur\: %5.2lf",
	"GPRINT:dw:AVERAGE:Avg\: %5.2lf",
	"GPRINT:dw:MAX:Max\: %5.2lf",
	"GPRINT:dw:MIN:Min\: %5.2lf",
	"LINE2:up#003366:Upload",
	"GPRINT:up:LAST:Cur\: %5.2lf",
        "GPRINT:up:AVERAGE:Avg\: %5.2lf",
        "GPRINT:up:MAX:Max\: %5.2lf",
        "GPRINT:up:MIN:Min\: %5.2lf")


def check_db():
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select sid from speedtest where status='1'")
	for i in cursor:
		if not os.path.exists('speedtest/database/' + str(i[0]) + ".rrd"):
			createDb(str(i[0]))
		else:
			updateDb(str(i[0]))
	cursor.close()
	cnx.close()

#check_db()
