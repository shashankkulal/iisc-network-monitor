import rrdtool
import mysql.connector

#HOURS = end-1h
#Day = end-1d

def last_hour(host):
	host = str(host)
	print host
	rrdtool.graph("images/last_hour_"+host+".png","-a", "PNG", "--slope-mode", "--start", "end-1h", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)

def last_24hour(host):
	rrdtool.graph("images/last_24hour_"+host+".png","-a", "PNG", "--slope-mode", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+":pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)

def last_week(host):
	rrdtool.graph("images/last_week_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-1w", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+":pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)

def last_4week(host):
	rrdtool.graph("images/last_4week_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-4w", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+":pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)

def last_6months(host):
	rrdtool.graph("images/last_6months_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-6m", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+":pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)

def last_1year(host):
	rrdtool.graph("images/last_year_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-1y", "--width", "900", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+":pavg:AVERAGE",
	"AREA:pa#800000:Ping Average"
	)


def get_host():
	cnx = mysql.connector.connect(user='root', password='dese', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from host")
	for ip in cursor:
		last_hour(ip[0])
	cursor.close()
	cnx.close()

	
get_host()
