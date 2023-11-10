#!/bin/bash

# Example FTP deployment
# Replace with your FTP credentials and paths
FTP_USERNAME_BACKEND="${FTP_USERNAME_BACKEND}"
FTP_PASSWORD_BACKEND="${FTP_PASSWORD_BACKEND}"
FTP_HOST_BACKEND="${FTP_HOST_BACKEND}"
REMOTE_DIR_BACKEND="${REMOTE_DIR_BACKEND}"

echo "Uploading files to cPanel via FTP..."
lftp -c "set ssl:verify-certificate no; open -u $FTP_USERNAME_BACKEND,$FTP_PASSWORD_BACKEND $FTP_HOST_BACKEND; mirror -R / $REMOTE_DIR_BACKEND"
