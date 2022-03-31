#!/usr/bin/env bash

### This is a Linux only script. Sorry everyone else.

__DIR__=$(cd $(dirname $(realpath "$0")) && pwd)
IMAGE_NAME="interview-cli"
GID=$(id -g)
USER=$(id -un)
GROUP=$(id -gn)
BUILD=0

usage()
{
    echo "USAGE: ${0} [options]"
    echo ""
    echo "--build"
    echo "  Build the docker image"
    echo ""
    echo "--help"
    echo "  Print this message and exit"
}

while [[ "$1" != "" ]]; do
    case "$1" in

        --build)
            BUILD=1
            ;;

        --help)
            usage
            exit
            ;;

    esac
    shift
done

if [[ "$(docker images -q ${IMAGE_NAME} 2>/dev/null)" == "" ]]; then
    echo "Image not found locally, setting build flag"
    BUILD=1
fi

if [[ "$BUILD" -eq 1 ]]; then
    docker \
        build \
        -t "$IMAGE_NAME" \
        --build-arg "UID=${UID}" \
        --build-arg "GID=${GID}" \
        --build-arg "USER=${USER}" \
        --build-arg "GROUP=${GROUP}" \
        "${__DIR__}/docker/cli"
fi

docker \
    run -it --rm \
    -u "${UID}:${GID}" \
    -v "${__DIR__}:/home/${USER}/project" \
    -w "/home/${USER}/project" \
    "$IMAGE_NAME" \
    bash
