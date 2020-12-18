#!/bin/bash

echo -n "Do you want to Roll Back Production Environment (y/n)?: "
read answer


if [ "$answer" = "y" ]; then
	echo " "
	echo "************Rolling Back to the Package.v1.************"
	echo " "
	echo " "


	sudo sshpass -p '8Saibaba' ssh divyap@25.96.32.28 "sh -c 'rm -rf /var/www/*'"
	sleep 2
	sudo sshpass -p '8Saibaba' rsync -rz /home/deployment/Package.v1/Pv1.tar.gz divyap@25.96.32.28:/var/www
	sudo sshpass -p '8Saibaba' ssh -t divyap@25.96.32.28'. ~/.barshrc; cd /var/www; tar -xvzf Pv1.tar.gz'
	sleep 2
	clear
	echo " "
	echo "************Rolling Back to the Package.v1.************"
	echo " "
	echo " "
	sleep 2.6
	echo "************Roll Back Completed. Now.. Production is Rebooting..***********"
	echo " "
	sleep 3
elif [ "$answer" = "n" ]; then

	sleep 1.5
	exit
fil
