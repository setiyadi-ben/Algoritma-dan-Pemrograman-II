import time
import mysql.connector
mydb = mysql.connector.connect(
  host="localhost",
  user="admin",
  password="admin",
  database="latihan_db"
)
import datetime
now = datetime.datetime.now()
formatted_date = now.strftime('%Y-%m-%d %H:%M:%S')
mycursor = mydb.cursor()

sql = "INSERT INTO tabelSensor (datetime, hcsr, temp, humi) VALUES (%s, %s, %s, %s)"
val = [
((formatted_date), "10.5", "26.2", "77.7"),
((formatted_date), "15.4", "28.7", "79.3"),
((formatted_date), "20.2", "27.3", "75.6"),
((formatted_date), "25.1", "29.7", "82.5"),
((formatted_date), "30.9", "24.2", "80.1")]
mycursor.executemany(sql, val)

mydb.commit()
print(mycursor.rowcount, "was inserted.")
# Looping
# time.sleep(5)
