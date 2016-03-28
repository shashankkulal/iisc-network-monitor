#!/usr/bin/env python
import os
import rrdtool
import mysql.connector
import settings
#HOURS = end-1h
#Day = end-1d

working_dir = "/var/www/html/python_engine"
os.chdir(working_dir)

def last_hour(host,color):
	host = str(host)
	rrdtool.graph("images/last_hour_"+host+".png","-a", "PNG", "--slope-mode", "--start", "end-1h", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)

def last_24hour(host,color):
	host = str(host)
	rrdtool.graph("images/last_24hour_"+host+".png","-a", "PNG", "--slope-mode", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)

def last_week(host,color):
	host = str(host)
	rrdtool.graph("images/last_week_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-1w", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)

def last_4week(host,color):
	host = str(host)
	rrdtool.graph("images/last_4week_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-4w", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)

def last_6months(host,color):
	host = str(host)
	rrdtool.graph("images/last_6months_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-24w", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)

def last_1year(host,color):
	host = str(host)
	rrdtool.graph("images/last_year_"+host+".png","-a", "PNG", "--slope-mode", "--end", "00:00", "--start", "end-1y", "--width", "900", "--height", "200", "--title", "Ping Statistics","--vertical-label", "Time(ms)",
	"DEF:pa=database/"+host+".rrd:pavg:AVERAGE",
	"AREA:pa"+color+":Ping Average"
	)


def get_host():
	color = str(settings.get_color())
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select ip from host")
	for ip in cursor:
		last_hour(ip[0],color)
		last_24hour(ip[0],color)
		last_week(ip[0],color)
		last_4week(ip[0],color)
		last_6months(ip[0],color)
		last_1year(ip[0],color)
	cursor.close()
	cnx.close()

	
get_host()
