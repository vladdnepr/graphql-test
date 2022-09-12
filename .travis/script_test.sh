#!/usr/bin/env sh
set -ev

XDEBUG_MODE=coverage phpunit -c phpunit.xml.dist --coverage-clover build/logs/clover.xml
