#!/usr/bin/python
print "Content-type:text/html\n"
html = """
<html>
	<head>
		<title>Python CGI</title>
	</head>
<body>
	<h1>Welcome to my website</h1>
	
	<form action="send.py" method="post">
		Enter you name: <input type="text" name="user"><br>
		<input type="submit" value="Go">
	</form>
</body>
</html>
"""
print html
