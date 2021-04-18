#!/bin/bash

count=1

while [[ "$count" -le $1 ]]; do
    touch "$count.js"
    count=$((count + 1))
done
echo "檔案建立完成"