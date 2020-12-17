#!/bin/bash

cd ../deployment

if [ ! -d "Package.v2" ]; then
	mkdir -m777 "Package.v2"
#	sudo mv Package.v2 /home/deployment/PackVersion
	cd Package.v2

	echo -n "************Copying Package from Developing Environment****************"
	echo " "
	echo " "
	sleep 1
	sudo sshpass -p 'Orangerice' ssh tashidsherpa@25.68.236.97 "sh -c 'rm -rf /var/www/*'"
	sudo sshpass -p 'Orangerice' scp -r  tashidsherpa@25.68.236.97:/var/www/html /home/deployment/Package.v2/
       	#cd PackageVersion/Package.v2
	sleep 2 	
        tar -czf Pv2.tar.gz html
	#sshpass -p 'Greenapples9---' scp -r carloscaldero@25.70.99.22:/var/www/html /home/deployment/PackVersion/
	sleep 1
	echo " "

	echo "*****************Package Copied succesfully******************************"
	echo " "
	echo " "

	echo  "************Now... Deploying Package.v2 to the QA Environment..************"
        echo " "


        sleep 2

        #sshpass -p 'Greenapples9---' scp -r /home/deployment/Package.v2/ carloscaldero@25.99.144.95:/var/www/
	sudo sshpass -p 'Orangerice' rsync -raz /home/deployment/Package.v2/Pv2.tar.gz tashidsherpa@25.68.236.97:/var/www
        #tashid@25.86.153.9
        echo "************Package.v2 Deployed. Now...installing the Package.v2..************"
	echo " "
	sleep 4
	echo "************Install Package.v2  Completed. Now...QA is Rebooting...***********"
	sleep 3

fi
sleep 2

if [ -d "Package.v2" ]; then 

	echo  "*********************Installing package to QA***************************\n"
	echo " "
	sleep 1
	
  	#sshpass -P 'Orangerice' scp -r /home/deployment/Package.v2/ tashidsherpa@25.68.236.97:/var/www
 	sudo sshpass -p 'Orangerice' rsync -raz /home/deployment/Package.v2/Pv2.tar.gz tashidsherpa@25.68.236.97:/var/www
	#tashid@25.86.153.9
	sudo sshpass -p 'Orangerice' ssh -t tashidsherpa@25.68.236.97 '. ~/.barshrc; cd /var/www; tar -xvzf Pv2.tar.gz'
	
	sleep 2
	clear
	echo  "*********************Installing package to QA***************************\n"
	echo " "
	echo " "
	echo "**********************Package intalled Successfully************************"
fi
