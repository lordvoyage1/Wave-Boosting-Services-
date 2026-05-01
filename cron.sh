#!/bin/bash

LOG_FILE="/home/host.net/public_html/cron.log"

curl -s https://host.net/cron/order?key=key | tee -a $LOG_FILE

echo

curl -s https://host.net/cron/multiple_status?key=key | tee -a $LOG_FILE

echo

curl -s https://host.net/cron/dripfeed?key=key | tee -a $LOG_FILE

echo

curl -s https://host.net/cron/subscriptions?key=key | tee -a $LOG_FILE
echo

# curl -s https://host.net/cron/sync_services?key=key | tee -a $LOG_FILE

echo
