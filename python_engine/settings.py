#!/usr/bin/env python
import mysql.connector


def get_color():
	color = "#228B22"
	cnx = mysql.connector.connect(user='root', password='1$=46.10RupeesSQL', host='localhost', database='iisc')
	cursor = cnx.cursor()
	cursor.execute("select color from settings")
	for ip in cursor:
		if ip:
			color = ip[0]
		else:
			pass
	cursor.close()
	cnx.close()
	return color