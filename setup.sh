#!/bin/bash
set -e

cd /code/
gem install travis
printf "\nGithub login\n"
travis login
travis enable
travis settings builds_only_with_travis_yml --enable
travis env set KBC_DEVELOPERPORTAL_URL https://apps-api.keboola.com --public
travis env set APP_IMAGE my-application --public
read -p "Enter vendor: " VENDOR
travis env set KBC_DEVELOPERPORTAL_VENDOR $VENDOR --public 
read -p "Enter component id: " APP
travis env set KBC_DEVELOPERPORTAL_APP $APP --public 
read -p "Enter service account name: " USERNAME
travis env set KBC_DEVELOPERPORTAL_USERNAME $USERNAME --public 
read -p "Enter service account password: " PASSWORD
travis env set KBC_DEVELOPERPORTAL_PASSWORD $PASSWORD --private
printf "\nRepository configured.\n"
travis open --print
printf "\nNow push a new tag to the repository.\n"
