#!/bin/bash
set -x
set -e

composer require $PACKAGE_NAME

php bin/phpunit

. ../scripts/copy.sh
