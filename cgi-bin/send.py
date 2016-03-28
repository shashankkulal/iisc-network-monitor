#!/usr/bin/python
import cgi, cgitb
form = cgi.FieldStorage()
user = form.getvalue('user')

print "Content-type:text/html\n"
print "<h1>Hello %s</h1>" % (user)
