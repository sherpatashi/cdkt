#!/bin/bash

echo -n "Do you want to Roll Back Production Environment (y/n)?: "
read answer


if [ "$answer" = "y" ]; then
	echo " "
	echo "************Rolling Back to the Package.v1.************"
	echo " "
	echo " "
	
	

	#sshpass -p 'Greenapples9---' carloscaldero@25.104.222.167; sudo rm -rf /var/www/html
	#sshpass -p 'Greenapples9---' scp -r /home/delpoyment/package.v1/ @25.104.222.167:/var/www/html
	sleep 4

	echo "************Roll Back Completed. Now.. Production is Rebooting..***********"
	echo " "
	sleep 3
elif [ "$answer" = "n" ]; then 
	exit 

fi
