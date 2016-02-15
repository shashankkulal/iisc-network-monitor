import os, re
import rrdtool

def internet_bandwidth():
	os.system('wget -O /dev/null http://speedtest.wdc01.softlayer.com/downloads/test10.zip -o temp/bandwidth.log');
	os.system("cat temp/bandwidth.log | grep '/s' | grep -Po '(?<=\().*(?=\))' | awk -F' ' '{print $1}' > temp/speed.txt")

# Graphs for Internet Bandwidth
def internet_bandwidth_graph():
	if not os.path.exists('database/proxy_ib.rrd'):
		rrdtool.create("database/proxy_ib.rrd", "--step", "300", "--start", "0",
		"DS:speed:GAUGE:600:U:U",
		"RRA:AVERAGE:0.5:1:10080",
		"RRA:AVERAGE:0.5:5:8934",
		"RRA:AVERAGE:0.5:60:8784",
		"RRA:AVERAGE:0.5:1440:3660"
		)

	f = open("temp/speed.txt").readline().rstrip()
	rrdtool.update("database/proxy_ib.rrd","N:%s" % f)
	rrdtool.graph("images/proxy_ib.png", "-a", "PNG", "--title",
	"Internet Bandwidth",
	"--vertical-label", "MB/s",
	"DEF:sp=database/proxy_ib.rrd:speed:AVERAGE",
	"LINE1:sp#800000:Speed"
	)
