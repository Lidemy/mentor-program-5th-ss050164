#!/bin/bash

echo "輸出："
response=$(curl -s https://api.github.com/users/$1)

for i in '"name"' '"bio"' '"location"' '"blog"'
do
    echo "$response" | grep $i | awk -F': "' '{print $2}' | sed 's/",//g' 
done
