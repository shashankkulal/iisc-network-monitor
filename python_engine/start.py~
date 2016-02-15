import mysql.connector
import os
import time
import rrdtool
import subprocess
import re
import functions


#Create Database
def create_database(dbname):
	print "[*] Creating Database for %s" % dbname
	rrdtool.create("database/" + dbname + ".rrd",
	"--step","300",
	"--start","0",
	"DS:pmin:GAUGE:600:U:U",
	"DS:pmax:GAUGE:600:U:U",
	"DS:pavg:GAUGE:600:U:U",
	"DS:plos:GAUGE:600:0:100",
	"RRA:AVERAGE:0.5:1:10080",
	"RRA:AVERAGE:0.5:5:8934",
	"RRA:AVERAGE:0.5:60:8784",
	"RRA:AVERAGE:0.5:1440:3660"	
	)
	
def update_database(host):
	print "[*] Updating Database %s.rrd" % host
	output = subprocess.check_output("ping " + host + " -c 1 -q  | egrep \"packet loss|rtt\"", shell=True)

	match = re.search('([\d]*\.[\d]*)/([\d]*\.[\d]*)/([\d]*\.[\d]*)/([\d]*\.[\d]*)', output)
	try:
		ping_min = str(match.group(1))
		ping_avg = str(match.group(2))
		ping_max = str(match.group(3))
	except:
		ping_min = "0"
		ping_avg = "0"
		ping_max = "0"

	match = re.search('(\d*)% packet loss', output)
	pkt_loss = float(match.group(1))
	host = "database/%s.rrd" % host
	rrdtool.update(host, "N:%s:%s:%s:%s" % (ping_min, ping_avg, ping_max, pkt_loss))
	

def graph_for_ping(host):
	print "[*] Generating Graphs for %s" % host
	image = "images/ping_statistics_%s.png" % host
	host = "database/%s.rrd" % host
	rrdtool.graph(image,"-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time",
	"DEF:pmi="+host+":pmin:AVERAGE",
	"LINE1:pmi#800000:Min",
	"DEF:pav="+host+":pavg:AVERAGE",
	"LINE1:pav#0000ff:Avg",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"LINE1:pmx#ff0000:Max")


#Ping Every 1 Minute and create database if not exist.
def check_database():
	cnx = mysql.connector.connect(user='root', password='dese', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from host")
	for ip in cursor:
		if not os.path.exists('database/' + str(ip[0]) + ".rrd"):
			create_database(str(ip[0]))
			
	cursor.close()
	cnx.close()


def do_ping():
	check_database()
	cnx = mysql.connector.connect(user='root', password='dese', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from host")
	for ip in cursor:
		update_database(str(ip[0]))
		graph_for_ping(str(ip[0]))			
	cursor.close()
	cnx.close()

i = 1
while True:
	do_ping()
	print "[*] Ping done %r times" % i
	time.sleep(10)
	i += 1
	functions.internet_bandwidth()
	functions.internet_bandwidth_graph()









