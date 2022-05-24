import mysql.connector
from mysql.connector import Error
import traceback
import sys
import os

from gpapi.googleplay import GooglePlayAPI

try:
    conn = mysql.connector.connect(host='localhost', database='appswind_appswindowspc', user='appswind_testUser', password='appswind_testUser')

except Exception as ex:
    print("Connection failed")
    print(ex)
    sys.exit(1)


# creating connection
# ===========================================================
conn = mysql.connector.connect(
        host='localhost', database='appswind_appswindowspc', user='appswind_testUser', password='appswind_testUser', use_unicode=True, charset='utf8mb4')

curr = conn.cursor()



mail = "virdev64@gmail.com"
passwd = "virtoxed@64"

api = GooglePlayAPI(locale="en_US", timezone="UTC", device_codename="OnePlus8Pro")
api.login(email=mail, password=passwd)

# print("gsfid "+str(api.gsfId))
# print("token "+str(api.authSubToken))

user_id = api.gsfId
user_token = api.authSubToken

print(user_id, "\n", user_token)


curr.execute("UPDATE id_token SET user_id = '"+str(api.gsfId)+"', user_token = '"+str(api.authSubToken)+"' WHERE token_id  = 1")
                                            
# curr.execute("UPDATE apps_data_test SET status = 3 where app_play_id = '"+str(app_id)+"' ")
print("id and token stored in db\n")
conn.commit()


result = api.search("firefox")

for doc in result:
    if 'docid' in doc:
        print("doc: {}".format(doc["docid"]))
    for cluster in doc["child"]:
        print("\tcluster: {}".format(cluster["docid"]))
        for app in cluster["child"]:
            print("\t\tapp: {}".format(app["docid"]))
            



# walleye
# hotdogb
# OnePlus8Pro