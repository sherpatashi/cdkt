#!/bin/bash
sleep 1
echo " "
echo "************Installing Package.v2 in the Production Environment************"
echo " "
sudo sshpass -p '8Saibaba' rsync -rz /home/deployment/Package.v2/Pv2.tar.gz divyap@25.96.32.28:/var/www
sudo sshpass -p '8Saibaba' ssh -t divyap@25.96.32.28'. ~/.barshrc; cd /var/www; tar -xvzf Pv2.tar.gz'
sleep 2
clear 
echo " "
echo "************Installing Package.v2 in the Production Environment************"
echo " "
echo " "
sleep 2.5
echo "************Install Package.v2 Completed. Now..Production is Rebooting************"
echo " "
sleep 2.5

