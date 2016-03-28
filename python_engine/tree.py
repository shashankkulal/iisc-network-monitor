#!/usr/bin/env python
import mysql.connector
import os, time, rrdtool, subprocess, re, sys, socket
import settings

working_dir = "/var/www/html/python_engine"
os.chdir(working_dir)
	
	
def create_database(dbname):
	print "CREATE DATABASE"
	rrdtool.create("tree/database/" + dbname + ".rrd",
	"--step","300",
	"--start","0",
	"DS:pmin:GAUGE:600:U:U",
	"DS:pmax:GAUGE:600:U:U",
	"DS:pavg:GAUGE:600:U:U",
	"DS:plos:GAUGE:600:0:100",
	"RRA:AVERAGE:0.5:1:10080",
	"RRA:AVERAGE:0.5:5:8934",
	"RRA:AVERAGE:0.5:60:8784",
	"RRA:AVERAGE:0.5:1440:3660",
	"RRA:MIN:0.5:1:10080",
	"RRA:MIN:0.5:5:8934",
	"RRA:MIN:0.5:60:8784",
	"RRA:MIN:0.5:1440:3660",
	"RRA:MAX:0.5:1:10080",
	"RRA:MAX:0.5:5:8934",
	"RRA:MAX:0.5:60:8784",
	"RRA:MAX:0.5:1440:3660"	
	)

def check_database():
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from tree")
	for ip in cursor:
		if ip:
			if not os.path.exists('tree/database/' + str(ip[0]) + ".rrd"):
				create_database(str(ip[0]))
		else:
			pass
	cursor.close()
	cnx.close()
	
def is_valid_ipv4_address(address):
    try:
        socket.inet_pton(socket.AF_INET, address)
    except AttributeError:
        try:
            socket.inet_aton(address)
        except socket.error:
            return False
        return address.count('.') == 3
    except socket.error:
        return False

    return True

def update_database(host):
	if(is_valid_ipv4_address(host)):
		output = subprocess.check_output("ping " + host + " -c 3 -q  | egrep \'packet loss|rtt\'", shell=True)
		match = re.search('([\d]*\.[\d]*)/([\d]*\.[\d]*)/([\d]*\.[\d]*)/([\d]*\.[\d]*)', output)
		try:
			ping_min = str(match.group(1))
			ping_avg = str(match.group(2))
			ping_max = str(match.group(3))
		except:
			ping_min = "100"
			ping_avg = "100"
			ping_max = "100"

		match = re.search('(\d*)% packet loss', output)
		pkt_loss = str(match.group(1))
		ip = host
		host = "tree/database/%s.rrd" % host
		rrdtool.update(host, "N:%s:%s:%s:%s" % (ping_min, ping_avg, ping_max, pkt_loss))
		cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
		cursor1 = cnx.cursor()
		cursor2 = cnx.cursor()
		cursor1.execute("select *from clink_status where ip='%s'" % ip)
		count = cursor1.fetchall()
		if count:
			cursor2.execute("update clink_status set mi='%s', mx='%s', av='%s', pl='%s' where ip='%s'" %  (ping_min,ping_max,ping_avg,pkt_loss,ip))
		else:
			cursor2.execute("insert into clink_status(ip,mi,mx,av,pl) values('%s','%s','%s','%s','%s')" % (ip,ping_min,ping_max,ping_avg,pkt_loss))
		cnx.commit()
		cursor1.close()
		cursor2.close()
		cnx.close()
	else:
		pass
	
def graph_for_ping(host, color):
	ip = host
	image = "tree/images/ping_statistics_%s.png" % host
	host = "tree/database/%s.rrd" % host
	rrdtool.graph(image,"-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900", "--height","200",
	"DEF:pmx="+host+":pmax:AVERAGE", "--watermark", "`date`",
	"AREA:pmx"+color+":Max")
	rrdtool.graph("tree/images/ps"+ip+"4h.png","-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900",
	 "--height","200", "--end", "now", "--start", "end-4h", "--watermark", "`date`",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"AREA:pmx"+color+":Max")
	rrdtool.graph("tree/images/ps"+ip+"1w.png","-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900",
	 "--height","200", "--end", "00:00", "--start", "end-1w", "--watermark", "`date`",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"AREA:pmx"+color+":Max")
	rrdtool.graph("tree/images/ps"+ip+"4w.png","-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900",
	 "--height","200", "--end", "00:00", "--start", "end-4w", "--watermark", "`date`",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"AREA:pmx"+color+":Max")
	rrdtool.graph("tree/images/ps"+ip+"24w.png","-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900",
	 "--height","200", "--end", "00:00", "--start", "end-24w", "--watermark", "`date`",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"AREA:pmx"+color+":Max")
	rrdtool.graph("tree/images/ps"+ip+"1y.png","-a", "PNG", "--title", "Ping Statistics","--vertical-label", "Time(ms)", "--width", "900",
	 "--height","200", "--end", "00:00", "--start", "end-1y", "--watermark", "`date`",
	"DEF:pmx="+host+":pmax:AVERAGE",
	"AREA:pmx"+color+":Max")
	
def do_ping():
	color = str(settings.get_color())
	check_database()
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from tree")
	for ip in cursor:
		if ip:
			update_database(str(ip[0]))
			graph_for_ping(str(ip[0]),color)
		else:
			pass			
	cursor.close()
	cnx.close()	
