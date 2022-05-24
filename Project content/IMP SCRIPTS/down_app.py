
try:
    from gpapi.googleplay import GooglePlayAPI, RequestError
except Exception as e:
    print("Exception Raised "+e.message)

import mysql.connector
from mysql.connector import Error


print("Invoked")
import traceback
import sys
import os
import time

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

#-----GETTING TOKEN AND ID-----
sql_1 = "SELECT * FROM id_token"
sql_2 = curr.execute(sql_1)
rows = curr.fetchall()
user_gsf_id=""
user_gsf_token=""
for row in rows:
    # url=(row)
    user_gsf_id = row[1]
    user_gsf_token = row[2]
#-----END GETTING TOKEN AND ID-----    
    
# gsfId = 4378383513499728047
# authSubToken = "ya29.A0ARrdaM-EqcKpn7qWjRIaTAgyIGdguazFYWe5u97gpkk4aqEbYUxC1-xz9Q_9slS5HZedjCrC-CCqE8sE3ruhFoYv68mN94c0uEhLFFoVniWdZmW2v2TCBp4rdAm5-m7FZzUlHK4NfEySpr7K19sMcCEST1HSnEJxr8sGOD26C-baGhPKzBF_e2hqAEM6vXp6ecqQJQ0lEjOaFrPmCbD_ztiVGKw69xFZvDMpQWLFN0egy_L_nVv1VvlyYrkYGRC3dkxdFACvatdku4ejnbnaZUb5PYamesSymX6tvSQuxXO95PSoXc0TVgOSVOjPLjFI" 
    
    
# server = GooglePlayAPI("it_IT", "Europe/Rome")
server = GooglePlayAPI("en_GB", "Europe/London")

gsfId =user_gsf_id
authSubToken =str(user_gsf_token).strip()

print(gsfId, "\n", authSubToken)

# LOGIN
print("\nLogin with ac2dm token and gsfId saved\n")
server.login(None, None, gsfId, authSubToken)
print("\n-----------------Logged in-------------------------\n")

time.sleep(2)
# DOWNLOAD
# all_args = sys.argv[1:]
# arg1 = 1


for _ in range(3):
       try:
           if len(sys.argv) > 1:
                try :
                    arg1 = sys.argv[1]
                    # print(arg1, "<br><br>")
                
                    docid = arg1
                    server.log(docid)
                    print("\nAttempting to download {}\n".format(docid))
                    fl = server.download(docid)
                    print("\nDownloading, please wait.....\n")
                    with open("/home/appswindowspc/public_html/apks/"+ docid + ".apk", "wb") as apk_file:
                    # with open(docid + ".apk", "wb") as apk_file:
                        for chunk in fl.get("file").get("data"):
                            apk_file.write(chunk)
                        print("\n{} Downloaded Sucessfully\n".format(docid))
                except Exception:
                    # print('\n[[[[[ TRY AGAIN ]]]]\n')
                    traceback.print_exc()
                    sys.exit(1)
                
       # replace Exception with a more specific exception
       except Exception as e:
           err = e
           continue
  
       # no exception, continue remainder of code
else:
    execfile("/public_html/download_scripts/googleplay-api-master/test.py")
# did not break the for loop, therefore all attempts
# raised an exception
# else:
#     raise err    
# if len(sys.argv) > 1:
#     try :
#         arg1 = sys.argv[1]
#         # print(arg1, "<br><br>")
    
#         docid = arg1
#         server.log(docid)
#         print("\nAttempting to download {}\n".format(docid))
#         fl = server.download(docid)
#         print("\nDownloading, please wait.....\n")
#         with open("/home/appswindowspc/public_html/apks/"+ docid + ".apk", "wb") as apk_file:
#         # with open(docid + ".apk", "wb") as apk_file:
#             for chunk in fl.get("file").get("data"):
#                 apk_file.write(chunk)
#             print("\n{} Downloaded Sucessfully\n".format(docid))
            
#     except Exception:
#         # print('\n[[[[[ TRY AGAIN ]]]]\n')
#         traceback.print_exc()
#         sys.exit(1)
    
    
        
        
conn.commit()
        

        
        
        
        
        
        