import sys
import os

import smtplib

from email import encoders
from email.mime.base import MIMEBase
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

msg = MIMEMultipart()
msg['From'] = os.environ['BUILDERS_GMAIL_ADDRESS']
msg['To'] = sys.argv[1]
msg['Subject'] = 'Builders Association of India - Welcome!'

body = "Greetings from the Builders Association of India!\n\nThank you for registering with our placement portal. This mail is an automated response to your registration. If a company wants to interview you, you will be notified with an e-mail. If any company attempts to contact you before you have received the e-mail, please submit your complaints at our feedback portal.\n\nFeedback Portal:- BAI.in/feedback/\n\nYours sincerely, Builders Association of India"
msg.attach(MIMEText(body,'plain'))

text = msg.as_string()
server = smtplib.SMTP('smtp.gmail.com',587)
server.starttls()
server.login(os.environ['BUILDERS_GMAIL_ADDRESS'],os.environ['BUILDERS_GMAIL_PASSWORD'])

server.sendmail(msg['From'],msg['To'],text)
server.quit()
