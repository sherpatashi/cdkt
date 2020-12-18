#!/bin/bash

cd ../deployment

if [ ! -d "Package.v2" ]; then
	mkdir -m777 "Package.v2"
	cd Package.v2

	echo " "
	echo "*************Copying Package.v2 from Development Environment************"
	echo " "
	echo " "
	sleep 1
	#sudo sshpass -p 'Orangerice' ssh tashidsherpa@25.68.236.97 "sh -c 'rm -rf /var/www/*'"
	sudo sshpass -p '8Saibaba' scp -r  divyap@25.57.23.231:/var/www/html /home/deployment/Package.v2/
	
	echo " "
	sleep 2
	tar -czf Pv2.tar.gz html
	sleep 1
	echo " "
	echo "************Package.v2 Copy Complete.************"
#	echo " "
#	echo " "
#	echo "#####################################################################################################################################"

	echo " "
	echo " " 
	sleep 2
	echo  "************Now... Deploying Package.v2 to the QA Environment..************"
        echo " "
        sleep 3
	sshpass -p '8Saibaba' rsync -raz /home/deployment/Package.v2/Pv2.tar.gz divyap@25.94.151.224:/var/www/
	sudo sshpass -p '8Saibaba' ssh -t divyap@25.94.151.224 '. ~/.barshrc; cd /var/www; tar -xvzf Pv2.tar.gz'
	sleep 1
	clear
    	echo "************Package.v2 Deployed. Now...installing the Package.v2..************"
	echo " "
	sleep 2.5
	echo "************Install Package.v2 Completed. Now...QA is Rebooting...***********"
	sleep 2.5
fi

if [ -d "Package.v2" ]; then 
	echo " "

	echo "************Installing package.v2 in the QA Environment************"
	echo " "
  	sleep 1
	sudo sshpass -p '8Saibaba' scp -r  /home/deployment/Package.v2/Pv2.tar.gz divyap@25.57.23.231:/var/www

#	sudo sshpass -P '8Saibaba' rsync -raz /home/deployment/Package.v2/Pv2.tar.gz divyap@25.94.151.224:/var/www
	
	sudo sshpass -P '8Saibaba' ssh -t divya@25.94.151.224 ' . ~/.barshrc; cd /var/www; tar -xvzf Pv2.tar.gz'

	sleep 1
#	clear
	echo " "
	echo  "************Installing package.v2 in the QA Environment************"
	echo " "
	echo " "
	sleep 2
	echo "************Install Package.v2 Completed. Now...QA is Rebooting***********"
	echo " "
	sleep 2
fi
