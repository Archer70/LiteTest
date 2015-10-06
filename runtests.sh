#!/bin/bash

PROJECT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

if [ "$1" = "gencoverage" ]
then
	phpunit -c "$PROJECT_DIR/test/config.xml" --coverage-html "$PROJECT_DIR/coverage-reports" "$PROJECT_DIR/test"
else
	phpunit -c "$PROJECT_DIR/test/config.xml" "$PROJECT_DIR/test"
fi
