#!/usr/bin/env bash

# Remove old files
rm -vf *.json

# Get data
for state in "Blagoevgrad" "Burgas" "Dobrich" "Gabrovo" "Haskovo" "Kardzhali" "Kyustendil" "Lovech" "Montana" \
    "Pazardzhik" "Pernik" "Pleven" "Plovdiv" "Razgrad" "Ruse" "Shumen" "Silistra" "Sliven" "Smolyan" "Sofia-City" \
    "Sofia" "Stara%20Zagora" "Targovishte" "Varna" "Veliko%20Tarnovo" "Vidin" "Vratsa" "Yambol"; do

    wget "https://nominatim.openstreetmap.org/search?state=${state}&format=geojson&polygon_geojson=1" -O ${state}.json
done