#!/bin/bash
sleep 1
echo "************Installing Package.v2 in the Production Environment***********************"
echo " "
sudo sshpass -p 'Orangerice' rsync -rz /home/deployment/Package.v2/ tashidsherpa@25.68.236.97:/var/www
sleep 3
echo "****************Install Package.v2 Completed. Now..Production is Rebooting *******************"
echo " "
sleep 3
