import mysql.connector
import datetime, sys, time, os
working_dir = "/var/www/html/python_engine"
os.chdir(working_dir)
records = []
cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
check = cnx.cursor()
check.execute("select *from speedtest where status='1'");
for i in check:
	records.append(i)

#Inserting Data in database
ctime = str(datetime.datetime.now())
for i in records:
	check.execute("insert into speedinterval(sid,up,down,ut) values('%s','%s','%s','%s')" % (i[1],i[5],i[4],ctime))
	cnx.commit()
check.close()
cnx.close()

#Delete Data older than 1 months(30 Days)
cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
cdl = cnx.cursor(buffered=True)
cur = cnx.cursor(buffered=True)
cur.execute("select *from speedinterval")
for i in cur:
	ut = datetime.datetime.strptime(i[3], "%Y-%m-%d %H:%M:%S.%f")
	nw = datetime.datetime.now()
	di = nw - ut
	if di > datetime.timedelta(days=30):
		cdl.execute("delete from speedinterval where ut='%s'" % i[3])
		cnx.commit()
	else:
		pass
cur.close()
cdl.close()
cnx.close()
sys.exit(0)
