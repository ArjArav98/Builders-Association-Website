import sys
import os

import smtplib

from email import encoders
from email.mime.base import MIMEBase
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

msg = MIMEMultipart()
msg['From'] = "arjun.aravind1998@gmail.com"
msg['To'] = sys.argv[1]
msg['Subject'] = 'Builders Association of India - Welcome!'

body = "Hello there!\nThank you for registering with the Builders Association of India!"
msg.attach(MIMEText(body,'plain'))

text = msg.as_string()
server = smtplib.SMTP('smtp.gmail.com',587)
server.starttls()
server.login("arjun.aravind1998@gmail.com",os.environ['BUILDERS_GMAIL_PASSWORD'])

server.sendmail(msg['From'],msg['To'],text)
server.quit()
