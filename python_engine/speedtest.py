#!/usr/bin/env python

import os, re, time, sys
import mysql.connector
os.chdir("/var/www/html/python_engine")	
def update_server():
	os.system("python speedtest_cli.py --list > temp/speedtest.txt")
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("drop table if exists speedtest")
	cursor.execute("create table speedtest(id bigint(8) auto_increment, sid varchar(255), sname varchar(255), status varchar(255) DEFAULT '0', up varchar(255), down varchar(255), primary key(id));")
	with open('temp/speedtest.txt') as fobj:
		for line in fobj:
			if line[0].isdigit():
				sid, sname = line.split(")",1)
				print sid + "::" + sname
				try:
					cursor.execute('insert into speedtest(sid, sname) values("%s","%s")' % (sid,sname))
					cnx.commit()
				except:
					pass
			else:
				pass
		cursor.close()
		cnx.close()
def set_default():
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("update speedtest set status='1' order by RAND() LIMIT 5")
	cnx.commit()
	cursor.close()
	cnx.close()

def get_speed():
	sid = []
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select *from speedtest where status='1'")
	for i in cursor:
		sid.append(i[1])
	cursor.close()
	cnx.close()
	print sid
	for i in sid:
		os.system("python speedtest_cli.py --simple --server %s > speedtest_temp.txt" % i)
		lines = [line.rstrip('\n') for line in open('speedtest_temp.txt')]
		if len(lines) > 1:
			print "I am in if"
			ping = re.findall(r"[-+]?\d*\.\d+|\d+", lines[0])
			down = re.findall(r"[-+]?\d*\.\d+|\d+", lines[1])
			up = re.findall(r"[-+]?\d*\.\d+|\d+", lines[2])
			cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
			cursor = cnx.cursor()
			cursor.execute("update speedtest set ping='%s', down='%s', up='%s' where sid='%s'" % (ping[0],down[0],up[0],i))
			print "%s updated in database." % i
			cnx.commit()
			cursor.close()
			cnx.close()

#while True:
get_speed()
	#time.sleep(1800)
#update_server()
#set_default()

sys.exit(0)
