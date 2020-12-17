#!/bin/bash
sleep 1
echo "************Installing Package.v2 in the Production Environment***********************"
echo " "
#sshpass -p 'Greenapples9---' scp -r /home/deployment/Package.v2/  @25.104.222.167:/var/www
sudo sshpass -p 'Orangerice' rsync -rz /home/deployment/php/ tashidsherpa@25.68.236.97:/var/www
sleep 3
echo "****************Install Package.v2 Completed. Now..Production is Rebooting *******************"
echo " "
sleep 4
