#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Please run with admin privs: sudo ./setup_hosts.sh"
  exit
fi

echo "192.168.33.10   dev.eyebeam.org" >> /etc/hosts
