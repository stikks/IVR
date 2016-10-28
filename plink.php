<?php

shell_exec('plink -v -x -a -T -C -noagent -ssh -L 127.0.0.1:8089:10.64.33.230:80 root@campaign.atp-sevas.com');

