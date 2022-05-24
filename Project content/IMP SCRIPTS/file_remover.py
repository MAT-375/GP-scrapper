# importing os module
import os
import time

# main function
def main():
    
    # specify the path
    # path = "C:/Users/Vir-Dev/Downloads"
    path = "/home/appswindowspc/public_html/apks"
    
    # specify the extension
    extension = ".apk"
    
    # specify the days
    days = 3

	# converting days to seconds
	# time.time() returns current time in seconds
    seconds = time.time() - ((((days * 24) * 60) * 60))
    # print(seconds)
    # checking whether the path exist or not
    if os.path.exists(path):
        
        # check whether the path is directory or not
        if os.path.isdir(path):
        
            # iterating through the subfolders
            for root_folder, folders, files in os.walk(path):
                
                # checking of the files
                for file in files:
                    
                    # file path
                    file_path = os.path.join(root_folder, file)

                    # extracting the extension from the filename
                    file_extension = os.path.splitext(file_path)[1]

                    # checking the file_extension
                    if extension == file_extension:
                        if seconds >= get_file_or_folder_age(file_path):
                            # deleting the file
                            if not os.remove(file_path):
                                
                                # success message
                                print(f"{file_path} deleted successfully")
                                
                            else:
                                
                                # failure message
                                print(f"Unable to delete the {file_path}")
                        else:
                            print(f"{file_path} not older than {days} days")
                            
        else:
            
            # path is not a directory
            print(f"{path} is not a directory")
    
    else:
        
        # path doen't exist
        print(f"{path} doesn't exist")



def get_file_or_folder_age(path):

	# getting ctime of the file/folder
	# time will be in seconds
	ctime = os.stat(path).st_ctime
	# returning the time
	
	return ctime

if __name__ == '__main__':
    # invoking main function
    main()