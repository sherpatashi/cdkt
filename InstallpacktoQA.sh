#!/bin/bash
cd ../deployment

if [ ! -d "Package.v2" ]; then
	mkdir -m777 "Package.v2"
	cd Package.v2

	echo " "
	echo "*************Copying Package.v2 from Development Environment************"
	sudo sshpass -p 'Orangerice' ssh tashidsherpa@25.68.236.97 "sh -c 'rm -rf /var/www/*'"

	#sshpass -p 'Greenapples9---' scp -r carloscaldero@25.70.99.22:/var/www/html /home/deployment/Package.v2/
	echo " "
	sleep 2
	 
	echo "************Package.v2 Copy Complete. ************"
	echo " "
	echo " "
echo "#####################################################################################################################################"
	echo " "
	echo " " 
	sleep 2
	echo  "************Now... Deploying Package.v2 to the QA Environment..************"
        echo " "
	

        sleep 4

        #sshpass -p 'Greenapples9---' scp -r /home/deployment/Package.v2/ carloscaldero@25.99.144.95:/var/www/

        echo "************Package.v2 Deployed. Now...installing the Package.v2..************"
	echo " "
	sleep 4
	echo "************Install Package.v2  Completed. Now...QA is Rebooting...***********"
	sleep 3
fi

if [ -d "Package.v2" ]; then 
	#cd Package.v2
	echo " "
	echo  "************Installing package.v2 in the QA Environment************"
	echo " "
  	#sshpass -p 'Greenapples9---' scp -r ~/deployment/Package.v2/html/ carloscaldero@25.99.144.95:/var/www/html/
	#sudo scp -r /home/deployment/Package.v2/ carloscaldero@25.99.144.95:/var/www/
	sudo sshpass -p 'Orangerice' rsync -az tashid@25.86.153.9 /home/deployment/Package.v2/ tashidsherpa@25.68.236.97:/var/www

	sleep 4
	echo "************Install Package.v2 Completed. Now...QA is Rebooting***********"
	echo " "
	sleep 3
fi

