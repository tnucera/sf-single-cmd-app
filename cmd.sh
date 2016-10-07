#!/bin/bash

if [ "$#" -lt 1 ]
then
    echo "Usage: cmd <command> [args...]";
    exit;
fi

docker run -t \
    --rm \
    -u php \
    sfsinglecmdapp_php \
    cmd ${@}
