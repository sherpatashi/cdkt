#!/bin/bash
sleep 1
echo " "
echo "************Installing Package.v2 in the Production Environment***********************"
echo " "
sudo sshpass -p 'Orangerice' rsync -rz /home/deployment/Package.v2/Pv2.tar.gz tashidsherpa@25.68.236.97:/var/www
sudo sshpass -p 'Orangerice' ssh -t tashidsherpa@25.68.236.97 '. ~/.barshrc; cd /var/www; tar -xvzf Pv2.tar.gz'
sleep 2
clear 
echo " "
echo "************Installing Package.v2 in the Production Environment***********************"
echo " "
sleep 2.5
echo " "
echo "****************Install Package.v2 Completed. Now..Production is Rebooting *******************"
echo " "
sleep 2.5
